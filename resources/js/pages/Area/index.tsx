import { useEffect, useState } from "react";
import {
    Button,
    Modal,
    Space,
    Table,
    TablePaginationConfig,
    Input,
} from "antd";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import clsx from "clsx";
import {
    ColumnsType,
    FilterValue,
    SorterResult,
} from "antd/es/table/interface";

import areaApi from "@/apis/areaTypeService";
import AreaListTypeForm from "./components/AreaTypeForm";
import { Action } from "@/types";
import { useTableHeight } from "@/hooks";

type TableParams = {
    pagination?: TablePaginationConfig;
    sortField?: string;
    sortOrder?: string;
    filters?: Record<string, FilterValue>;
};

const AreasList = () => {
    const initValueFilter = {
        zipCode: "",
        address: "",
    };
    const queryClient = useQueryClient();
    const [togglePopup, setTogglePopup] = useState<boolean>(false);
    const [action, setAction] = useState<Action>(Action.Add);
    const [toggleDeleteListArea, setToggleDeleteListArea] = useState(false);
    const [tableParams, setTableParams] = useState<TableParams>({
        pagination: {
            current: 1,
            pageSize: 10,
            showSizeChanger: false,
        },
    });
    const [areaFilterValue, setAreaFilterValue] = useState(initValueFilter);
    const [areaFilterQuery, setAreaFilterQuery] = useState(initValueFilter);

    const [rowSelected, setRowSelected] = useState<any>(null);

    useTableHeight();

    const { data, isLoading } = useQuery({
        queryKey: ["areas", tableParams.pagination?.current, areaFilterQuery],
        queryFn: areaApi.getListArea,
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

    const mutation = useMutation({
        mutationFn: areaApi.deleteListArea,
        onMutate: async (areaId) => {
            await queryClient.cancelQueries({
                queryKey: [
                    "areas",
                    tableParams.pagination?.current,
                    areaFilterQuery,
                ],
            });

            // Snapshot the previous value
            const previousAreas = queryClient.getQueryData([
                "areas",
                tableParams.pagination?.current,
                areaFilterQuery,
            ]);
            // Optimistically update to the new value
            queryClient.setQueryData(
                ["areas", tableParams.pagination?.current, areaFilterQuery],
                (old: any) => ({
                    ...old,
                    data: old?.data?.filter((area) => area.id !== areaId),
                })
            );

            // Return a context object with the snapshotted value
            return { previousAreas };
        },
        onError: (err, _, context) => {
            queryClient.setQueryData(
                ["areas", tableParams.pagination?.current, areaFilterQuery],
                context?.previousAreas
            );
            // onErrorMessage(err, "Delete schedule fail!!");
        },
        onSettled: () => {
            queryClient.invalidateQueries({ queryKey: ["areas"] });
            setToggleDeleteListArea(false);
        },
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

    const columns: ColumnsType<any> = [
        {
            title: "Id",
            dataIndex: "id",
            key: "id",
            width: 50,
        },
        {
            title: "City",
            key: "city",
            width: 150,
            render: (_, { city }) => <span>{city.name}</span>,
        },
        {
            title: "Prefecture",
            key: "prefecture",
            width: 150,
            render: (_, { prefecture }) => <span>{prefecture.name}</span>,
        },
        {
            title: "Address",
            key: "address",
            width: 150,
            render: (_, { address }) => <span>{address}</span>,
        },
        {
            title: "Zip Code Number",
            dataIndex: "zip_no",
            key: "zip_no",
            width: 150,
            render: (_, { zip_no }) => (
                <span>
                    {zip_no.toString().replace(/\B(?=(\d{4})+(?!\d))/g, "-")}
                </span>
            ),
        },
        {
            title: "Status",
            dataIndex: "active",
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
                            setToggleDeleteListArea(true);
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
        setAreaFilterValue(initValueFilter);
        setAreaFilterQuery(initValueFilter);
    };

    return (
        <div className="p-0 md:p-5 space-y-4">
            {/* Button Add new and filter*/}
            {/* <div className="flex sm:justify-between gap-2 relative sm:static">
                <div className="w-full">
                    <Space.Compact className="flex-col sm:flex-row w-full">
                        <Space.Compact>
                            <Input
                                style={{ width: "50%", height: "45px" }}
                                placeholder="Zip Code"
                                value={areaFilterValue.zipCode}
                                onChange={(e) =>
                                    setAreaFilterValue({
                                        ...areaFilterValue,
                                        zipCode: e.target.value,
                                    })
                                }
                            />
                            <Input
                                style={{ width: "50%", height: "45px" }}
                                placeholder="Address"
                                value={areaFilterValue.address}
                                onChange={(e) =>
                                    setAreaFilterValue({
                                        ...areaFilterValue,
                                        address: e.target.value,
                                    })
                                }
                            />
                        </Space.Compact>
                        <Space.Compact className="ml-0 sm:ml-[-1px]">
                            <Button
                                type="primary"
                                className="h-[45px]"
                                onClick={() =>
                                    setAreaFilterQuery(areaFilterValue)
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
                        className="bg-[#3f4aeb] h-[45px]"
                        onClick={() => {
                            setTogglePopup(true);
                            setAction(Action.Add);
                        }}
                    >
                        Add Area
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
                    Add Area
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
                        y: "500px",
                    }}
                />
            </div>
            <Modal
                title="Delete Area"
                open={toggleDeleteListArea}
                onOk={handleOnDelete}
                okButtonProps={{
                    danger: true,
                }}
                confirmLoading={mutation.isLoading}
                okText="Delete"
                onCancel={() => setToggleDeleteListArea(false)}
                cancelButtonProps={{
                    disabled: mutation.isLoading,
                }}
            >
                <p>Are you sure?</p>
            </Modal>
            <Modal
                title={action === Action.Add ? "Add Area" : "Edit Area"}
                open={togglePopup}
                footer={null}
                onCancel={() => {
                    setTogglePopup(false);
                }}
                maskClosable={false}
            >
                <AreaListTypeForm
                    action={action}
                    rowSelected={action === Action.Edit && rowSelected}
                    setTogglePopup={setTogglePopup}
                />
            </Modal>
        </div>
    );
};

export default AreasList;
