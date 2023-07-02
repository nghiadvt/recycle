import { useEffect, useState } from "react";

import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import { Button, Form, Input, Select, notification } from "antd";
import ReactQuill from "react-quill";

import { STATUS_TYPE_OPTION } from "@/constants/common";
import { Action, ServiceArticles } from "@/types";
import serviceArticlesApi from "@/apis/serviceArticlesApi";
import categoryApi from "@/apis/categoryApi";
import serviceApi from "@/apis/serviceApi";
import { onErrorMessage, onSuccessMessage } from "@/utils";
import SkeletonInput from "antd/es/skeleton/Input";
import SelectBoxSkeleton from "@/components/Skeleton/SelectBoxSkeleton";

type Props = {
    rowSelected?: ServiceArticles;
    action: Action;
    setTogglePopup: React.Dispatch<React.SetStateAction<boolean>>;
};

const ServiceArtForm = ({ rowSelected, action, setTogglePopup }: Props) => {
    const [form] = Form.useForm();
    const [isValuesChange, setIsValuesChange] = useState<boolean>(false);
    const queryClient = useQueryClient();
    useEffect(() => {
        if (rowSelected) form.setFieldsValue(rowSelected);
        else form.resetFields();
    }, [rowSelected]);
    const mutation = useMutation({
        mutationFn:
            action === Action.Add
                ? serviceArticlesApi.addServiceArticles
                : serviceArticlesApi.editServiceArticles,
        onSuccess: () => {
            queryClient.invalidateQueries({ queryKey: ["service-articles"] });
            onSuccessMessage(action, "Service Articles");
            if (action === Action.Add) form.resetFields();
            setIsValuesChange(false);
            setTogglePopup(false);
        },
        onError: (error) => {
            onErrorMessage(error, "Submit Service Articles Failed!");
        },
    });
    const handleOnFinish = (values: any) => {
        if (isValuesChange) mutation.mutate(values);
    };

    const handleOnFinishFailed = (errorInfo: any) => {
        console.log("Failed:", errorInfo);
    };

    const { data: serviceOption, isLoading: isLoadingService } = useQuery({
        queryKey: ["services"],
        queryFn: serviceApi.getList,
    });

    const { data: serviceCateOption, isLoading: isLoadingServiceCate } =
        useQuery({
            queryKey: ["category"],
            queryFn: categoryApi.getCategoriesList,
        });
    return (
        <div className="min-h-[300px] bg-white p-4  rounded-xl">
            <Form
                form={form}
                name="basic"
                labelCol={{ span: 8 }}
                wrapperCol={{ span: 16 }}
                initialValues={{ active: 1 }}
                onFinish={handleOnFinish}
                onFinishFailed={handleOnFinishFailed}
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
                            message: "Please input service article title!",
                        },
                    ]}
                >
                    <Input placeholder="Enter service article title" />
                </Form.Item>

                <Form.Item label="Description" name="description">
                    <Input.TextArea
                        rows={3}
                        placeholder="Enter a description for Garbage"
                    />
                </Form.Item>
                <Form.Item label="Content" name="content">
                    <ReactQuill
                        theme="snow"
                        className="flex-1 [&>div]:h-auto z-[999]"
                        placeholder="Write the content of service"
                    />
                </Form.Item>
                <Form.Item
                    label="Service Category"
                    name="services_category_id"
                    rules={[
                        {
                            required: true,
                            message: "Service Category is required!",
                        },
                    ]}
                >
                    {isLoadingServiceCate ? (
                        <SelectBoxSkeleton />
                    ) : (
                        <Select
                            placeholder="Select a Service Category"
                            loading={isLoadingServiceCate}
                            options={serviceCateOption?.data.map((option) => ({
                                value: option.id,
                                label: option.title,
                            }))}
                        />
                    )}
                </Form.Item>
                <Form.Item
                    label="Service"
                    name="services_id"
                    rules={[
                        {
                            required: true,
                            message: "Service is required!",
                        },
                    ]}
                >
                    {isLoadingServiceCate ? (
                        <SelectBoxSkeleton />
                    ) : (
                        <Select
                            placeholder="Select a Service"
                            loading={isLoadingService}
                            options={serviceOption?.data.map((option) => ({
                                value: option.id,
                                label: option.title,
                            }))}
                        />
                    )}
                </Form.Item>
                <Form.Item
                    label="Active"
                    name="active"
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
};

export default ServiceArtForm;
