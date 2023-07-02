import { Button, DatePicker, Input, Modal, Space, Table, Tag } from "antd";
import { useEffect, useState } from "react";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import clsx from "clsx";

import scheduleApi from "@/apis/scheduleApi";
import { Action, Status } from "@/types";
import ScheduleForm from "./components/ScheduleForm";
import Moment from "react-moment";
import type { ColumnsType, TablePaginationConfig } from "antd/es/table";
import type { FilterValue, SorterResult } from "antd/es/table/interface";
import { Schedule } from "@/types";
import { onErrorMessage } from "@/utils";
import dayjs from "dayjs";
import { useTableHeight } from "@/hooks";

type TableParams = {
    pagination?: TablePaginationConfig;
    sortField?: string;
    sortOrder?: string;
    filters?: Record<string, FilterValue>;
};

const Schedule = () => {
    const initValueFilter = {
        address: "",
        dateStartAt: "",
    };
    const [togglePopup, setTogglePopup] = useState<boolean>(false);
    const [action, setAction] = useState<Action>(Action.Add);
    const [toggleDeleteSchedule, setToggleDeleteSchedule] =
        useState<boolean>(false);
    const [scheduleFilterValue, setScheduleFilterValue] =
        useState(initValueFilter);
    const [scheduleFilterQuery, setScheduleFilterQuery] =
        useState(initValueFilter);

    //Config pagination table params
    const [tableParams, setTableParams] = useState<TableParams>({
        pagination: {
            current: 1,
            pageSize: 10,
        },
    });

    const [rowSelected, setRowSelected] = useState<any>(null);
    const queryClient = useQueryClient();

    useTableHeight();

    // Get list schedule
    const { data, isLoading } = useQuery({
        queryKey: [
            "schedules",
            tableParams.pagination?.current,
            scheduleFilterQuery,
        ],
        queryFn: scheduleApi.getList,
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

    // Handle on paginate table
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
        mutationFn: scheduleApi.deleteSchedule,
        onMutate: async (scheduleId) => {
            await queryClient.cancelQueries({
                queryKey: [
                    "schedules",
                    tableParams.pagination?.current,
                    scheduleFilterQuery,
                ],
            });

            // Snapshot the previous value
            const previousSchedules = queryClient.getQueryData([
                "schedules",
                tableParams.pagination?.current,
                scheduleFilterQuery,
            ]);
            // Optimistically update to the new value
            queryClient.setQueryData(
                [
                    "schedules",
                    tableParams.pagination?.current,
                    scheduleFilterQuery,
                ],
                (old: any) => ({
                    ...old,
                    data: old?.data.filter(
                        (schedule) => schedule.id !== scheduleId
                    ),
                })
            );

            // Return a context object with the snapshotted value
            return { previousSchedules };
        },
        onError: (err, _, context) => {
            queryClient.setQueryData(
                [
                    "schedules",
                    tableParams.pagination?.current,
                    scheduleFilterQuery,
                ],
                context?.previousSchedules
            );
            onErrorMessage(err, "Delete schedule fail!!");
        },
        onSettled: () => {
            queryClient.invalidateQueries({ queryKey: ["schedules"] });
            setToggleDeleteSchedule(false);
        },
    });
    //Define fields and render columns table
    const columns: ColumnsType<Schedule> = [
        {
            title: "ID",
            dataIndex: "id",
            key: "id",
            width: 50,
            ellipsis: true,
        },
        {
            title: "Date Start",
            dataIndex: "date_start_at",
            key: "date_start_at",
            width: 150,
            render: (_, record) => record.date_start_at.split(" ")[0],
        },
        {
            title: "Date End",
            dataIndex: "date_end_at",
            key: "date_end_at",
            width: 150,
            render: (_, record) => record.date_end_at.split(" ")[0],
        },
        {
            title: "Time Start",
            dataIndex: "time_start_at",
            key: "time_start_at",
            width: 120,
        },
        {
            title: "Time End",
            dataIndex: "time_end_at",
            key: "time_end_at",
            width: 120,
        },
        {
            title: "Area",
            key: "area",
            ellipsis: true,
            width: 180,
            render: (_, record) => record.area.address,
        },
        {
            title: "Day",
            key: "day_of_week",
            width: 100,
            render: (_, record) => <Tag>{record.day}</Tag>,
        },
        {
            title: "Repeat",
            dataIndex: "day_status",
            key: "day_status",
            width: 100,
            render: (_, { day_status, is_repeat }) => (
                <span
                    className={clsx({
                        "text-green-600": is_repeat === Status.Active,
                        "text-red-400": is_repeat === Status.Inactive,
                    })}
                >
                    {day_status}
                </span>
            ),
        },
        {
            title: "Garbage Type Schedules",
            key: "garbage_type_schedules",
            width: 270,
            render: (_, record) => (
                <div className="space-y-4 max-h-[200px] overflow-auto scrollbar-style py-2">
                    {record.garbage_type_schedules.map((tag) => (
                        <Tag key={tag.id}>{tag.garbage_type.name}</Tag>
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
                            setToggleDeleteSchedule(true);
                            setRowSelected(record);
                        }}
                    >
                        Delete
                    </Button>
                </Space>
            ),
        },
    ];
    //Handle on delete schedule
    const handleOnDelete = () => {
        mutation.mutate(rowSelected?.id);
    };

    const handleResetValueFilter = () => {
        setScheduleFilterValue(initValueFilter);
        setScheduleFilterQuery(initValueFilter);
    };

    return (
        <div className="p-0 md:p-5 space-y-4">
            {/* Button Add new and filter*/}
            {/* <div className="flex sm:justify-between gap-2 relative sm:static">
                <div className="w-full">
                    <Space.Compact className="flex-col sm:flex-row w-full">
                        <Space.Compact className="h-[45px]">
                            <Input
                                style={{ width: "calc(100% - 120px)" }}
                                placeholder="Address"
                                value={scheduleFilterValue.address}
                                onChange={(e) =>
                                    setScheduleFilterValue({
                                        ...scheduleFilterValue,
                                        address: e.target.value,
                                    })
                                }
                            />
                            <DatePicker
                                format={"YYYY-MM-DD"}
                                placeholder="Date Start"
                                value={
                                    !scheduleFilterValue.dateStartAt
                                        ? undefined
                                        : dayjs(scheduleFilterValue.dateStartAt)
                                }
                                onChange={(e) =>
                                    setScheduleFilterValue({
                                        ...scheduleFilterValue,
                                        dateStartAt:
                                            dayjs(e).format("YYYY-MM-DD"),
                                    })
                                }
                                className="hide-cross-icon w-[120px]"
                            />
                        </Space.Compact>
                        <Space.Compact className="ml-0 sm:ml-[-1px]">
                            <Button
                                type="primary"
                                className="h-[45px]"
                                onClick={() =>
                                    setScheduleFilterQuery({
                                        ...scheduleFilterValue,
                                        dateStartAt:
                                            scheduleFilterValue.dateStartAt ===
                                            "Invalid Date"
                                                ? ""
                                                : scheduleFilterValue.dateStartAt,
                                    })
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
                    </Space.Compact>
                </div>
                <div className="ml-auto sm:mx-0 absolute sm:static bottom-0 right-0">
                    <Button
                        type="primary"
                        className="bg-[#3f4aeb] h-[45px] ml-auto block"
                        onClick={() => {
                            setTogglePopup(true);
                            setAction(Action.Add);
                        }}
                    >
                        Add Schedules
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
                    Add Schedules
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
                title="Delete Schedule Type"
                open={toggleDeleteSchedule}
                onOk={handleOnDelete}
                okButtonProps={{
                    danger: true,
                }}
                confirmLoading={mutation.isLoading}
                okText="Delete"
                onCancel={() => setToggleDeleteSchedule(false)}
                cancelButtonProps={{
                    disabled: mutation.isLoading,
                }}
            >
                <p>Are you sure?</p>
            </Modal>
            {/* Modal add language */}
            <Modal
                title={action === Action.Add ? "Add Schedule" : "Edit Schedule"}
                open={togglePopup}
                footer={null}
                onCancel={() => {
                    setTogglePopup(false);
                }}
                width={650}
                maskClosable={false}
            >
                <ScheduleForm
                    action={action}
                    rowSelected={action === Action.Edit && rowSelected}
                    setTogglePopup={setTogglePopup}
                />
            </Modal>
        </div>
    );
};

export default Schedule;
