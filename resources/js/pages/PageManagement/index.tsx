import pageApi from "@/apis/pageApi";
import { Action, Status } from "@/types";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import { Button, Modal, Space, Table } from "antd";
import { ColumnsType } from "antd/es/table";
import { useState } from "react";
import Moment from "react-moment";
import PageForm from "./components/PageForm";
import { PageType } from "@/types/page";
import clsx from "clsx";
import { useTableHeight } from "@/hooks";

const PageManagement = () => {
    const [action, setAction] = useState<Action>(Action.Add);
    const [togglePopup, setTogglePopup] = useState<boolean>(false);
    const [toggleDeletePage, setToggleDeletePage] = useState<boolean>(false);
    const [rowSelected, setRowSelected] = useState<PageType | null>(null);

    const { data, isLoading } = useQuery({
        queryKey: ["pages"],
        queryFn: pageApi.getPageList,
        onSuccess(data) {
            data.sort((a, b) => b.id - a.id);
        },
    });

    useTableHeight();

    const queryClient = useQueryClient();

    const mutation = useMutation({
        mutationFn: pageApi.deletePage,
        onMutate: async (pageId) => {
            await queryClient.cancelQueries({
                queryKey: ["pages"],
            });

            // Snapshot the previous value
            const previousPages = queryClient.getQueryData(["pages"]);
            // Optimistically update to the new value
            queryClient.setQueryData(["pages"], (old: any) =>
                old?.filter((pages) => pages.id !== pageId)
            );

            // Return a context object with the snapshotted value
            return { previousPages };
        },
        onError: (err, _, context) => {
            queryClient.setQueryData(["pages"], context?.previousPages);
        },
        onSettled: () => {
            queryClient.invalidateQueries({ queryKey: ["pages"] });
            setToggleDeletePage(false);
        },
    });

    const handleOnDelete = () => {
        mutation.mutate(rowSelected?.id!);
    };

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
            ellipsis: true,
            width: 200,
        },
        {
            title: "Description",
            dataIndex: "description",
            key: "description",
            ellipsis: true,
            width: 300,
        },
        {
            title: "Slug",
            dataIndex: "slug",
            key: "slug",
            ellipsis: true,
            width: 200,
        },
        {
            title: "Type",
            dataIndex: "type_name",
            key: "type_name",
            width: 150,
            ellipsis: true,
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
            width: 150,
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
                            setToggleDeletePage(true);
                            setRowSelected(record);
                        }}
                    >
                        Delete
                    </Button>
                </Space>
            ),
        },
    ];

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
                    Add Page
                </Button>
            </div>
            <Table
                rowKey={"id"}
                columns={columns}
                dataSource={data}
                loading={isLoading}
                scroll={{ y: `${500}px` }}
            />
            <Modal
                title="Delete Page"
                open={toggleDeletePage}
                onOk={handleOnDelete}
                okButtonProps={{
                    danger: true,
                }}
                confirmLoading={mutation.isLoading}
                okText="Delete"
                onCancel={() => setToggleDeletePage(false)}
                cancelButtonProps={{
                    disabled: mutation.isLoading,
                }}
            >
                <p>Are you sure?</p>
            </Modal>
            <Modal
                title={action === Action.Add ? "Add Page" : "Edit Page"}
                open={togglePopup}
                footer={null}
                onCancel={() => {
                    setTogglePopup(false);
                }}
                width={700}
                maskClosable={false}
            >
                <PageForm
                    action={action}
                    rowSelected={action === Action.Edit ? rowSelected : null}
                    setTogglePopup={setTogglePopup}
                />
            </Modal>
        </div>
    );
};

export default PageManagement;
