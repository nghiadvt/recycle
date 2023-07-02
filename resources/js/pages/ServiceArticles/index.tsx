import { Button, Modal, Space, Table, Tooltip } from "antd";
import { useState } from "react";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import clsx from "clsx";

import { Action, Status } from "@/types";
import Moment from "react-moment";
import type { ColumnsType, TablePaginationConfig } from "antd/es/table";
import type { FilterValue, SorterResult } from "antd/es/table/interface";
import serviceArticlesApi from "@/apis/serviceArticlesApi";
import ServiceArticlesForm from "./components/ServiceArticlesForm";

type TableParams = {
    pagination?: TablePaginationConfig;
    sortField?: string;
    sortOrder?: string;
    filters?: Record<string, FilterValue>;
};

const ServiceArticles = () => {
    const [togglePopup, setTogglePopup] = useState<boolean>(false);
    const [action, setAction] = useState<Action>(Action.Add);
    const [toggleDeleteServiceArt, setToggleDeleteServiceArt] =
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
        queryKey: ["service-articles", tableParams.pagination?.current],
        queryFn: serviceArticlesApi.getListServiceArticles,
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
        mutationFn: serviceArticlesApi.deleteServiceArticles,
        onMutate: async (serviceArtId) => {
            await queryClient.cancelQueries({
                queryKey: ["service-articles", tableParams.pagination?.current],
            });

            // Snapshot the previous value
            const previousGarbages = queryClient.getQueryData([
                "service-articles",
                tableParams.pagination?.current,
            ]);
            // Optimistically update to the new value
            queryClient.setQueryData(
                ["service-articles", tableParams.pagination?.current],
                (old: any) => ({
                    ...old,
                    data: old?.data.filter(
                        (ServiceArticles) => ServiceArticles.id !== serviceArtId
                    ),
                })
            );

            // Return a context object with the snapshotted value
            return { previousGarbages };
        },
        onError: (err, _, context) => {
            queryClient.setQueryData(
                ["service-articles", tableParams.pagination?.current],
                context?.previousGarbages
            );
        },
        onSettled: () => {
            queryClient.invalidateQueries({ queryKey: ["service-articles"] });
            setToggleDeleteServiceArt(false);
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
            key: "slug",
            sorter: true,
            ellipsis: true,
            width: 150,
            render: (_, record) => (
                <Tooltip placement="bottomLeft" title={record.slug}>
                    <span>{record.slug}</span>
                </Tooltip>
            ),
        },
        {
            title: "Service",
            key: "service",
            ellipsis: true,
            width: 200,
            render: (_, record) => record.services.title,
        },
        {
            title: "Service Category",
            key: "service_category",
            ellipsis: true,
            width: 200,
            render: (_, record) => record.services_category.title,
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
                            setToggleDeleteServiceArt(true);
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
                    Add Service Article
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
                title="Delete Service Article"
                open={toggleDeleteServiceArt}
                onOk={handleOnDelete}
                okButtonProps={{
                    danger: true,
                }}
                confirmLoading={mutation.isLoading}
                okText="Delete"
                onCancel={() => setToggleDeleteServiceArt(false)}
                cancelButtonProps={{
                    disabled: mutation.isLoading,
                }}
            >
                <p>Are you sure?</p>
            </Modal>
            {/* Modal add language */}
            <Modal
                title={
                    action === Action.Add
                        ? "Add Service Article"
                        : "Edit Service Article"
                }
                open={togglePopup}
                footer={null}
                onCancel={() => {
                    setTogglePopup(false);
                }}
                maskClosable={false}
                width={700}
            >
                <ServiceArticlesForm
                    action={action}
                    rowSelected={action === Action.Edit && rowSelected}
                    setTogglePopup={setTogglePopup}
                />
            </Modal>
        </div>
    );
};

export default ServiceArticles;
