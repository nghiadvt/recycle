import { useEffect, useState } from "react";

import { useMutation, useQueryClient } from "@tanstack/react-query";
import { Button, Form, Input, Select, notification } from "antd";
import { useForm } from "antd/es/form/Form";
import { AxiosError } from "axios";

import { Action } from "@/types";
import { PAGE_TYPE_OPTION, STATUS_TYPE_OPTION } from "@/constants/common";
import ReactQuill from "react-quill";
import pageApi from "@/apis/pageApi";
import { PageType } from "@/types/page";

type Props = {
    rowSelected?: PageType | null;
    action: Action;
    setTogglePopup: React.Dispatch<React.SetStateAction<boolean>>;
};

export default function PageForm({
    action,
    rowSelected,
    setTogglePopup,
}: Props) {
    const [form] = useForm();
    const queryClient = useQueryClient();

    const [isValuesChange, setIsValuesChange] = useState<boolean>(false);

    useEffect(() => {
        if (rowSelected) form.setFieldsValue(rowSelected);
        else form.resetFields();
    }, [rowSelected]);

    const mutation = useMutation({
        mutationFn: action === Action.Add ? pageApi.addPage : pageApi.editPage,
        onSuccess: () => {
            queryClient.invalidateQueries({ queryKey: ["pages"] });
            notification.success({
                message:
                    action === Action.Add
                        ? "Add Page Successfully"
                        : "Edit Page Successfully",
                duration: 2,
            });
            if (action === Action.Add) form.resetFields();
            setIsValuesChange(false);
            setTogglePopup(false);
        },
        onError: (error) => {
            const errorMessage =
                error instanceof AxiosError
                    ? error.response?.data.message
                    : "Submit Page fail";

            notification.error({
                message: errorMessage,
                duration: 2,
            });
        },
    });

    const onFinish = (rowSelected: any) => {
        if (isValuesChange) mutation.mutate(rowSelected);
    };

    const onFinishFailed = (errorInfo: any) => {
        console.log("Failed:", errorInfo);
    };

    return (
        <div className="bg-white rounded-xl">
            <Form
                name="basic"
                form={form}
                labelCol={{ span: 4 }}
                wrapperCol={{ span: 20 }}
                onFinish={onFinish}
                onFinishFailed={onFinishFailed}
                initialValues={{ active: 1 }}
                autoComplete="off"
                onValuesChange={() => setIsValuesChange(true)}
            >
                <Form.Item name="id" hidden>
                    <Input />
                </Form.Item>
                <Form.Item
                    label="Title"
                    name="title"
                    rules={[
                        {
                            required: true,
                            message: "Please input your title!",
                        },
                    ]}
                >
                    <Input placeholder="Please input your title" />
                </Form.Item>
                <Form.Item
                    label="Content"
                    name="content"
                    rules={[
                        {
                            required: true,
                            message: "Please input your content!",
                        },
                    ]}
                >
                    <ReactQuill
                        theme="snow"
                        className="flex-1 [&>div]:h-auto z-[999]"
                        placeholder="Write the content of service"
                    />
                </Form.Item>
                <Form.Item label="Description" name="description">
                    <Input.TextArea
                        rows={3}
                        placeholder="Please input your description!"
                    />
                </Form.Item>
                <Form.Item
                    name="type"
                    label="Type"
                    rules={[
                        { required: true, message: "Please input your type!" },
                    ]}
                >
                    <Select
                        placeholder="Please choose your type!"
                        options={PAGE_TYPE_OPTION}
                    ></Select>
                </Form.Item>
                <Form.Item
                    name="active"
                    label="Status"
                    rules={[{ required: true }]}
                >
                    <Select
                        placeholder="Select a option and change input text above"
                        options={STATUS_TYPE_OPTION}
                    ></Select>
                </Form.Item>
                <Button
                    type="primary"
                    htmlType="submit"
                    loading={mutation.isLoading}
                    className="mx-auto block"
                >
                    Submit
                </Button>
            </Form>
        </div>
    );
}
