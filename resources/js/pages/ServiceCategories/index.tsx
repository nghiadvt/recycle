import { useState } from "react";
import clsx from "clsx";
import { Button, Modal, Space, Table, TablePaginationConfig } from "antd";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import {
    ColumnsType,
    FilterValue,
    SorterResult,
} from "antd/es/table/interface";

import type { CategoryType } from "@/types";
import { Action } from "@/types";
import categoryApi from "@/apis/categoryApi";
import ServiceCategoriesForm from "./components/ServiceCategoriesForm";
import Moment from "react-moment";

type TableParams = {
    pagination?: TablePaginationConfig;
    sortField?: string;
    sortOrder?: string;
    filters?: Record<string, FilterValue>;
};

export default function ServiceCategories() {
    const [togglePopup, setTogglePopup] = useState<boolean>(false);
    const [action, setAction] = useState<Action>(Action.Add);
    const [rowSelected, setRowSelected] = useState<CategoryType | any | null>(
        null
    );
    const [toggleDeleteCategory, setToggleDeleteCategory] = useState(false);
    const [tableParams, setTableParams] = useState<TableParams>({
        pagination: {
            current: 1,
            pageSize: 10,
        },
    });

    const queryClient = useQueryClient();

    const mutation = useMutation({
        mutationFn: categoryApi.deleteCategoriesList,
        onMutate: async (serviceCateId) => {
            await queryClient.cancelQueries({
                queryKey: ["category", tableParams.pagination?.current],
            });

            // Snapshot the previous value
            const previousServiceCate = queryClient.getQueryData([
                "category",
                tableParams.pagination?.current,
            ]);
            // Optimistically update to the new value
            queryClient.setQueryData(
                ["category", tableParams.pagination?.current],
                (old: any) => ({
                    ...old,
                    data: old?.data.filter(
                        (service) => service.id !== serviceCateId
                    ),
                })
            );

            // Return a context object with the snapshotted value
            return { previousServiceCate };
        },
        onError: (err, _, context) => {
            queryClient.setQueryData(
                ["services", tableParams.pagination?.current],
                context?.previousServiceCate
            );
            // onErrorMessage(err, "Delete schedule fail!!");
        },
        onSettled: () => {
            queryClient.invalidateQueries({ queryKey: ["category"] });
            setToggleDeleteCategory(false);
        },
    });

    const { isLoading, data } = useQuery({
        queryKey: ["category", tableParams.pagination?.current],
        queryFn: categoryApi.getCategoriesList,
        retry: false,
        onSuccess: (data) => {
            setTableParams({
                ...tableParams,
                pagination: {
                    ...tableParams.pagination,
                    total: data.total,
                },
            });
        },
        refetchOnWindowFocus: false,
    });

    const columns: ColumnsType<any> = [
        {
            title: "Id",
            dataIndex: "id",
            key: "id",
            width: 50,
        },
        {
            title: "Title",
            dataIndex: "title",
            key: "title",
            width: 150,
        },
        {
            title: "Slug",
            dataIndex: "slug",
            key: "slug",
            width: 150,
        },
        {
            title: "Description",
            dataIndex: "description",
            key: "description",
            width: 300,
        },
        {
            title: "Status",
            dataIndex: "status",
            key: "status",
            width: 80,
            render: (_, { active }) => (
                <span
                    className={clsx(
                        "rounded-full w-[15px] h-[15px] block mx-auto",
                        {
                            "bg-green-600": active == 1,
                            "bg-red-400": active != 1,
                        }
                    )}
                ></span>
            ),
        },
        {
            title: "Created At",
            dataIndex: "created_at",
            key: "created_at",
            width: 200,
            render: (_, record) => (
                <span>
                    <Moment
                        date={record.created_at}
                        format="DD/MM/YYYY HH:mm"
                    />
                </span>
            ),
        },
        {
            title: "Action",
            key: "action",
            width: 200,
            fixed: "right",
            render: (_, record) => (
                <Space size="middle">
                    <Button
                        className="text-yellow-500 border-yellow-500 hover:!text-yellow-400 hover:!border-yellow-400"
                        onClick={() => {
                            setTogglePopup(true);
                            setRowSelected(record);
                            setAction(Action.Edit);
                        }}
                    >
                        Edit
                    </Button>
                    <Button
                        danger
                        type="primary"
                        onClick={() => {
                            setToggleDeleteCategory(true);
                            setRowSelected(record);
                        }}
                    >
                        Delete
                    </Button>
                </Space>
            ),
        },
    ];
    const handleOnDelete = () => {
        mutation.mutate(rowSelected?.id);
    };

    const handleTableChange = (
        pagination: TablePaginationConfig,
        sorter: SorterResult<any>
    ) => {
        setTableParams({
            pagination,
            ...sorter,
        });
    };
    return (
        <div className="p-0 md:p-5 space-y-4">
            <div>
                <Button
                    type="primary"
                    className="bg-[#3f4aeb] h-[45px] ml-auto block"
                    onClick={() => {
                        setTogglePopup(true);
                        setAction(Action.Add);
                    }}
                >
                    Add Service Category
                </Button>
            </div>
            <div>
                <Table
                    rowKey={"id"}
                    columns={columns}
                    dataSource={data?.data}
                    loading={isLoading}
                    pagination={tableParams.pagination}
                    onChange={handleTableChange}
                    scroll={{
                        y: "600px",
                    }}
                />
            </div>
            <Modal
                title="Delete Category"
                open={toggleDeleteCategory}
                onOk={handleOnDelete}
                okButtonProps={{
                    danger: true,
                }}
                cancelButtonProps={{
                    disabled: mutation.isLoading,
                }}
                confirmLoading={mutation.isLoading}
                okText="Delete"
                onCancel={() => setToggleDeleteCategory(false)}
            >
                <p>Are you sure?</p>
            </Modal>
            <Modal
                title={
                    action === Action.Add
                        ? "Add Service Category"
                        : "Edit Service Category"
                }
                open={togglePopup}
                footer={null}
                onCancel={() => {
                    setTogglePopup(false);
                }}
                maskClosable={false}
            >
                <ServiceCategoriesForm
                    action={action}
                    rowSelected={action === Action.Edit && rowSelected}
                    setTogglePopup={setTogglePopup}
                />
            </Modal>
        </div>
    );
}
