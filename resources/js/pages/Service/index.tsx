import { Button, Modal, Space, Table, Tooltip } from "antd";
import { useEffect, useState } from "react";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import clsx from "clsx";

import { Action, Service, Status } from "@/types";
// import GarbageForm from "./components/GarbageForm";
import Moment from "react-moment";
import type { ColumnsType, TablePaginationConfig } from "antd/es/table";
import type { FilterValue, SorterResult } from "antd/es/table/interface";
import serviceApi from "@/apis/serviceApi";
import ServiceForm from "./components/ServiceForm";

type TableParams = {
    pagination?: TablePaginationConfig;
    sortField?: string;
    sortOrder?: string;
    filters?: Record<string, FilterValue>;
};

const Service = () => {
    const [togglePopup, setTogglePopup] = useState<boolean>(false);
    const [action, setAction] = useState<Action>(Action.Add);
    const [toggleDeleteService, setToggleDeleteService] =
        useState<boolean>(false);

    const [tableParams, setTableParams] = useState<TableParams>({
        pagination: {
            current: 1,
            pageSize: 10,
        },
    });

    const [rowSelected, setRowSelected] = useState<any>(null);
    const queryClient = useQueryClient();

    const { data, isLoading } = useQuery({
        queryKey: ["services", tableParams.pagination?.current],
        queryFn: serviceApi.getList,
        onSuccess: (data) => {
            setTableParams({
                ...tableParams,
                pagination: {
                    ...tableParams.pagination,
                    total: data.total_item,
                },
            });
        },
        refetchOnWindowFocus: false,
    });
    const handleTableChange = (
        pagination: TablePaginationConfig,
        sorter: SorterResult<any>
    ) => {
        setTableParams({
            pagination,
            ...sorter,
        });
    };

    const mutation = useMutation({
        mutationFn: serviceApi.deleteService,
        onMutate: async (serviceId) => {
            await queryClient.cancelQueries({
                queryKey: ["services", tableParams.pagination?.current],
            });

            // Snapshot the previous value
            const previousService = queryClient.getQueryData([
                "services",
                tableParams.pagination?.current,
            ]);
            // Optimistically update to the new value
            queryClient.setQueryData(
                ["services", tableParams.pagination?.current],
                (old: any) => ({
                    ...old,
                    data: old?.data.filter(
                        (service) => service.id !== serviceId
                    ),
                })
            );

            // Return a context object with the snapshotted value
            return { previousService };
        },
        onError: (err, _, context) => {
            queryClient.setQueryData(
                ["services", tableParams.pagination?.current],
                context?.previousService
            );
            // onErrorMessage(err, "Delete schedule fail!!");
        },
        onSettled: () => {
            queryClient.invalidateQueries({ queryKey: ["services"] });
            setToggleDeleteService(false);
        },
    });
    const columns: ColumnsType<any> = [
        {
            title: "ID",
            dataIndex: "id",
            key: "id",
            width: 50,
        },
        {
            title: "Title",
            dataIndex: "title",
            key: "title",
            sorter: true,
            ellipsis: true,
            width: 150,
        },
        {
            title: "Slug",
            dataIndex: "slug",
            key: "slug",
            sorter: true,
            ellipsis: true,
            width: 150,
        },
        {
            title: "Image",
            dataIndex: "URLImage",
            key: "URLImage",
            width: 150,
            render: (_, { URLImage }) => (
                <a href={URLImage} target="_blank">
                    <img
                        src={URLImage}
                        className="object-cover max-h-[100px]"
                    />
                </a>
            ),
        },
        {
            title: "Status",
            dataIndex: "active",
            key: "status",
            width: 80,
            ellipsis: true,
            render: (_, { active }) => (
                <span
                    className={clsx(
                        "rounded-full h-[15px] w-[15px] block mx-auto",
                        {
                            "bg-green-600": active === Status.Active,
                            "bg-red-400": active === Status.Inactive,
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
            ellipsis: true,
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
            fixed: "right",
            width: 200,
            render: (_, record) => (
                <Space size="middle">
                    <Button
                        className="text-yellow-500 border-yellow-500 hover:!text-yellow-400 hover:!border-yellow-400 "
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
                            setToggleDeleteService(true);
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
                    Add Service
                </Button>
            </div>
            <Table
                rowKey={"id"}
                columns={columns}
                dataSource={data?.data}
                loading={isLoading}
                pagination={
                    data && data.total_page > 1 && tableParams.pagination
                }
                onChange={handleTableChange}
                scroll={{ y: `${500}px` }}
            />
            {/* Modal delete language */}
            <Modal
                title="Delete Service"
                open={toggleDeleteService}
                onOk={handleOnDelete}
                okButtonProps={{
                    danger: true,
                }}
                confirmLoading={mutation.isLoading}
                okText="Delete"
                onCancel={() => setToggleDeleteService(false)}
                cancelButtonProps={{
                    disabled: mutation.isLoading,
                }}
            >
                <p>Are you sure?</p>
            </Modal>
            {/* Modal add service */}
            <Modal
                title={action === Action.Add ? "Add Service" : "Edit Service"}
                open={togglePopup}
                footer={null}
                onCancel={() => {
                    setTogglePopup(false);
                }}
                maskClosable={false}
                width={700}
            >
                <ServiceForm
                    action={action}
                    rowSelected={action === Action.Edit && rowSelected}
                    setTogglePopup={setTogglePopup}
                />
            </Modal>
        </div>
    );
};

export default Service;
