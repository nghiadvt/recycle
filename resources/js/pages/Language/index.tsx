import { useState } from "react";
import { Button, Modal, Space, Table } from "antd";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";

import languageApi from "@/apis/languageApi";

import type { Language } from "@/types";
import { Action } from "@/types";
import LanguageForm from "./components/LanguageForm";

export default function Language() {
    const [toggleAddLanguage, setToggleAddLanguage] = useState(false);
    const [toggleEditLanguage, setToggleEditLanguage] = useState(false);
    const [rowSelected, setRowSelected] = useState<Language | any | null>(null);
    const [toggleDeleteLanguage, setToggleDeleteLanguage] = useState(false);
    const [confirmLoading, setConfirmLoading] = useState(false);
    const queryClient = useQueryClient();

    const mutation = useMutation({
        mutationFn: languageApi.deleteLanguage,
        onMutate: () => {
            setConfirmLoading(true);
        },
        onSuccess: () => {
            queryClient.invalidateQueries({ queryKey: ["languages"] });
            setToggleDeleteLanguage(false);
            setConfirmLoading(false);
        },
    });

    const { isLoading, data, error } = useQuery({
        queryKey: ["languages"],
        queryFn: languageApi.getList,
    });

    const data1 = [
        {
            key: 1,
            id: 1,
            language: "Japan",
            locale: "jp",
        },
    ];
    const columns = [
        {
            title: "id",
            dataIndex: "id",
            key: "id",
            render: (text) => <a>{text}</a>,
        },
        {
            title: "Language",
            dataIndex: "language",
            key: "language",
        },
        {
            title: "Locale",
            dataIndex: "locale",
            key: "locale",
        },
        {
            title: "Action",
            key: "action",
            render: (_, record) => (
                <Space size="middle">
                    <Button
                        className="text-yellow-500 border-yellow-500 hover:!text-yellow-400 hover:!border-yellow-400 "
                        onClick={() => {
                            setToggleEditLanguage(true);
                            setRowSelected(record);
                        }}
                    >
                        Edit
                    </Button>
                    <Button
                        danger
                        type="primary"
                        onClick={() => {
                            setToggleDeleteLanguage(true);
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
        mutation.mutate(rowSelected?.key);
    };
    return (
        <div className="p-5 space-y-4">
            <div>
                <Button
                    type="primary"
                    className="bg-[#3f4aeb] h-[45px] ml-auto block"
                    onClick={() => setToggleAddLanguage(!toggleAddLanguage)}
                >
                    Add Language
                </Button>
            </div>
            <div>
                <Table
                    columns={columns}
                    dataSource={data1}
                    loading={isLoading}
                />
            </div>
            {/* Modal delete language */}
            <Modal
                title="Delete Language"
                open={toggleDeleteLanguage}
                onOk={handleOnDelete}
                okButtonProps={{
                    danger: true,
                }}
                confirmLoading={confirmLoading}
                okText="Delete"
                onCancel={() => setToggleDeleteLanguage(false)}
            >
                <p>Are you sure?</p>
            </Modal>
            {/* Modal add language */}
            <Modal
                title="Language Form"
                open={toggleAddLanguage || toggleEditLanguage}
                footer={null}
                onCancel={() => {
                    setToggleAddLanguage(false);
                    setToggleEditLanguage(false);
                }}
            >
                <LanguageForm
                    action={toggleAddLanguage ? Action.Add : Action.Edit}
                />
            </Modal>
        </div>
    );
}
