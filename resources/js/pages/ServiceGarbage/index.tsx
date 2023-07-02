import { Button, Input, Modal, Space, Table, Tag, Tooltip } from "antd";
import { useEffect, useState } from "react";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import clsx from "clsx";

import garbageApi from "@/apis/garbageApi";
import { Action, Status } from "@/types";
import GarbageForm from "./components/GarbageForm";
import Moment from "react-moment";
import type { ColumnsType, TablePaginationConfig } from "antd/es/table";
import type { FilterValue, SorterResult } from "antd/es/table/interface";
import { useTableHeight } from "@/hooks";

type TableParams = {
    pagination?: TablePaginationConfig;
    sortField?: string;
    sortOrder?: string;
    filters?: Record<string, FilterValue>;
};

const Garbage = () => {
    const initValueFilter = {
        name: "",
    };
    const [togglePopup, setTogglePopup] = useState<boolean>(false);
    const [action, setAction] = useState<Action>(Action.Add);
    const [toggleDeleteGarbage, setToggleDeleteGarbage] =
        useState<boolean>(false);
    const [serGarbageFilterValue, setSerGarbageFilterValue] =
        useState(initValueFilter);
    const [serGarbageFilterQuery, setSerGarbageFilterQuery] =
        useState(initValueFilter);

    const [tableParams, setTableParams] = useState<TableParams>({
        pagination: {
            current: 1,
            pageSize: 10,
        },
    });

    const [rowSelected, setRowSelected] = useState<any>(null);
    const queryClient = useQueryClient();

    useTableHeight();

    const { data, isLoading } = useQuery({
        queryKey: [
            "garbages",
            tableParams.pagination?.current,
            // serGarbageFilterQuery,
        ],
        queryFn: garbageApi.getListGarbage,
    });

    useEffect(() => {
        if (data && data.current_page <= data.total_page)
            setTableParams({
                ...tableParams,
                pagination: {
                    ...tableParams.pagination,
                    total: data.total_item,
                },
            });
        if (data && data.current_page > data.total_page)
            setTableParams({
                ...tableParams,
                pagination: {
                    ...tableParams.pagination,
                    current: data.total_page,
                    total: data.total_item,
                },
            });
    }, [data]);

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
        mutationFn: garbageApi.deleteGarbage,
        onMutate: async (garbageId) => {
            await queryClient.cancelQueries({
                queryKey: ["garbages", tableParams.pagination?.current],
            });

            // Snapshot the previous value
            const previousGarbages = queryClient.getQueryData([
                "garbages",
                tableParams.pagination?.current,
            ]);
            // Optimistically update to the new value
            queryClient.setQueryData(
                ["garbages", tableParams.pagination?.current],
                (old: any) => ({
                    ...old,
                    data: old?.data.filter(
                        (schedule) => schedule.id !== garbageId
                    ),
                })
            );

            // Return a context object with the snapshotted value
            return { previousGarbages };
        },
        onError: (err, _, context) => {
            queryClient.setQueryData(
                ["garbages", tableParams.pagination?.current],
                context?.previousGarbages
            );
        },
        onSettled: () => {
            queryClient.invalidateQueries({ queryKey: ["garbages"] });
            setToggleDeleteGarbage(false);
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
            title: "Name",
            dataIndex: "name",
            key: "name",
            ellipsis: true,
            width: 200,
        },
        {
            title: "Slug",
            dataIndex: "slug",
            key: "slug",
            ellipsis: true,
            width: 200,
        },
        {
            title: "Description",
            key: "description",
            width: 300,
            ellipsis: true,
            render: (_, record) => (
                <Tooltip placement="bottom" title={record.description}>
                    <span>{record.description}</span>
                </Tooltip>
            ),
        },
        {
            title: "Parent",
            dataIndex: "parent_name",
            key: "slug",
            ellipsis: true,
            width: 200,
        },
        {
            title: "Service Garbage Type",
            key: "garbage_type_schedules",
            width: 270,
            render: (_, record) => (
                <div className="space-y-4 max-h-[200px] overflow-auto scrollbar-style py-2">
                    {record.service_garbage_contents.map((tag) => (
                        <Tooltip
                            key={tag.id}
                            placement="bottom"
                            title={tag.service_garbage_type.name}
                        >
                            <Tag>{tag.service_garbage_type.name}</Tag>
                        </Tooltip>
                    ))}
                </div>
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
                            setToggleDeleteGarbage(true);
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

    const handleResetValueFilter = () => {
        setSerGarbageFilterValue(initValueFilter);
        setSerGarbageFilterQuery(initValueFilter);
    };

    return (
        <div className="p-0 md:p-5 space-y-4">
            {/* Button Add new and filter*/}
            {/* <div className="flex sm:justify-between flex-col sm:flex-row gap-2">
                <div className="ml-auto sm:mx-0">
                    <Space.Compact className="h-[45px]">
                        <Input
                            placeholder="Name"
                            value={serGarbageFilterValue.name}
                            onChange={(e) =>
                                setSerGarbageFilterValue({
                                    ...serGarbageFilterValue,
                                    name: e.target.value,
                                })
                            }
                        />
                        <Button
                            type="primary"
                            className="h-[45px]"
                            onClick={() =>
                                setSerGarbageFilterQuery(serGarbageFilterValue)
                            }
                        >
                            Search
                        </Button>
                        <Button
                            type="default"
                            className="h-[45px]"
                            onClick={handleResetValueFilter}
                        >
                            Reset
                        </Button>
                    </Space.Compact>
                </div>
                <div>
                    <Button
                        type="primary"
                        className="bg-[#3f4aeb] h-[45px] ml-auto block"
                        onClick={() => {
                            setTogglePopup(true);
                            setAction(Action.Add);
                        }}
                    >
                        Add Service Garbage
                    </Button>
                </div>
            </div> */}
            {/* Button add new and not have filter*/}
            <div>
                <Button
                    type="primary"
                    className="bg-[#3f4aeb] h-[45px] ml-auto block"
                    onClick={() => {
                        setTogglePopup(true);
                        setAction(Action.Add);
                    }}
                >
                    Add Service Garbage
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
                title="Delete Garbage Type"
                open={toggleDeleteGarbage}
                onOk={handleOnDelete}
                okButtonProps={{
                    danger: true,
                }}
                cancelButtonProps={{
                    disabled: mutation.isLoading,
                }}
                confirmLoading={mutation.isLoading}
                okText="Delete"
                onCancel={() => setToggleDeleteGarbage(false)}
            >
                <p>Are you sure?</p>
            </Modal>
            {/* Modal add language */}
            <Modal
                title={
                    action === Action.Add
                        ? "Add Service Garbage"
                        : "Edit Service Garbage"
                }
                open={togglePopup}
                footer={null}
                onCancel={() => {
                    setTogglePopup(false);
                }}
                maskClosable={false}
                width={800}
            >
                <GarbageForm
                    action={action}
                    rowSelected={action === Action.Edit && rowSelected}
                    setTogglePopup={setTogglePopup}
                />
            </Modal>
        </div>
    );
};

export default Garbage;
