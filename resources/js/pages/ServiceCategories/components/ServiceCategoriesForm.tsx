import { useEffect, useState } from "react";

import { useMutation, useQueryClient } from "@tanstack/react-query";
import { Button, Form, Input, Select, notification } from "antd";
import { useForm } from "antd/es/form/Form";
import { AxiosError } from "axios";
import TextArea from "antd/es/input/TextArea";

import { Action } from "@/types";
import categoryApi from "@/apis/categoryApi";
import { STATUS_TYPE_OPTION } from "@/constants/common";

type Props = {
    rowSelected?: string;
    action: Action;
    setTogglePopup: React.Dispatch<React.SetStateAction<boolean>>;
};

export default function ServiceCategoriesForm({
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
        mutationFn:
            action === Action.Add
                ? categoryApi.addCategoriesList
                : categoryApi.editCategoriesList,
        onSuccess: () => {
            queryClient.invalidateQueries({ queryKey: ["category"] });
            notification.success({
                message:
                    action === Action.Add
                        ? "Add Category Successfully"
                        : "Edit Category Successfully",
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
                    : "Submit Category fail";

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
        <div className="max-w-[600px] max-h-[450px] bg-white p-4 min-w-[400px] rounded-xl">
            <Form
                name="basic"
                form={form}
                labelCol={{ span: 8 }}
                wrapperCol={{ span: 16 }}
                style={{ maxWidth: 600 }}
                initialValues={{ remember: true }}
                onFinish={onFinish}
                onFinishFailed={onFinishFailed}
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
                    label="Description"
                    name="description"
                    rules={[
                        {
                            required: true,
                            message: "Please input your description!",
                        },
                    ]}
                >
                    <TextArea placeholder="Please input your description" />
                </Form.Item>
                <Form.Item
                    name="active"
                    label="Status"
                    rules={[{ required: true }]}
                >
                    <Select
                        placeholder="Please choose your status!"
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
