import { Button, Modal, Space, Table, Tag } from "antd";
import { useState } from "react";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import clsx from "clsx";
import Moment from "react-moment";

import garbageTypeApi from "@/apis/garbageTypeApi";
import GarbageTypeForm from "./components/GarbageTypeForm";

import { Action, Status } from "@/types";
import { ColumnsType } from "antd/es/table";
import { ENV_DEVELOPMENT } from "@/config/env";
import { useTableHeight } from "@/hooks";

const GarbageType = () => {
    const [togglePopup, setTogglePopup] = useState<boolean>(false);
    const [action, setAction] = useState<Action>(Action.Add);
    const [toggleDeleteGarbageType, setToggleDeleteGarbageType] =
        useState<boolean>(false);

    const [rowSelected, setRowSelected] = useState<any>(null);
    const queryClient = useQueryClient();

    useTableHeight();

    const { data, isLoading } = useQuery({
        queryKey: ["garbage-type"],
        queryFn: garbageTypeApi.getListGarbageType,
    });

    const mutation = useMutation({
        mutationFn: garbageTypeApi.deleteGarbageType,
        onMutate: async (garbageTypeId) => {
            await queryClient.cancelQueries({
                queryKey: ["garbage-type"],
            });

            // Snapshot the previous value
            const previousGarbageTypes = queryClient.getQueryData([
                "garbage-type",
            ]);
            // Optimistically update to the new value
            queryClient.setQueryData(["garbage-type"], (old: any) =>
                old?.filter((schedule) => schedule.id !== garbageTypeId)
            );

            // Return a context object with the snapshotted value
            return { previousGarbageTypes };
        },
        onError: (err, _, context) => {
            queryClient.setQueryData(
                ["garbage-type"],
                context?.previousGarbageTypes
            );
        },
        onSettled: () => {
            queryClient.invalidateQueries({ queryKey: ["garbage-type"] });
            setToggleDeleteGarbageType(false);
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
            width: 150,
        },
        {
            title: "Price",
            dataIndex: "price",
            key: "price",
            width: 150,
            render: (_, record) => (
                <span>
                    {Number(record.price).toLocaleString(
                        ENV_DEVELOPMENT.APP_LOCALE,
                        {
                            style: "currency",
                            currency: ENV_DEVELOPMENT.APP_CURRENCY,
                        }
                    )}
                </span>
            ),
        },
        {
            title: "Unit",
            dataIndex: "unit",
            key: "unit",
            width: 120,
        },
        {
            title: "Options",
            key: "container_garbage_types",
            width: 270,
            render: (_, record) => (
                <div className="space-y-4 max-h-[200px] overflow-auto scrollbar-style py-2">
                    {record.container_garbage_types
                        .sort((a, b) => a.bin_size - b.bin_size)
                        .map((tag) => (
                            <Tag key={tag.id}>{tag.bin_size}</Tag>
                        ))}
                </div>
            ),
        },
        {
            title: "Icon",
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
                            setToggleDeleteGarbageType(true);
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
                    Add Garbage Type
                </Button>
            </div>
            <div>
                <Table
                    rowKey={"id"}
                    columns={columns}
                    dataSource={data}
                    loading={isLoading}
                    scroll={{ y: "500px" }}
                />
            </div>
            {/* Modal delete language */}
            <Modal
                title="Delete Garbage Type"
                open={toggleDeleteGarbageType}
                onOk={handleOnDelete}
                okButtonProps={{
                    danger: true,
                }}
                confirmLoading={mutation.isLoading}
                okText="Delete"
                onCancel={() => setToggleDeleteGarbageType(false)}
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
                        ? "Add Garbage Type"
                        : "Edit Garbage Type"
                }
                open={togglePopup}
                footer={null}
                onCancel={() => {
                    setTogglePopup(false);
                }}
                maskClosable={false}
                width={800}
            >
                <GarbageTypeForm
                    action={action}
                    rowSelected={action === Action.Edit && rowSelected}
                    setTogglePopup={setTogglePopup}
                />
            </Modal>
        </div>
    );
};

export default GarbageType;
