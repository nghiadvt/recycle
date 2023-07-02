import { useMutation, useQueryClient } from "@tanstack/react-query";
import { useEffect, useState } from "react";
import { Button, Form, Input, Select, Upload, UploadFile } from "antd";
import { UploadOutlined } from "@ant-design/icons";

import { Action, Service } from "@/types";
import { STATUS_TYPE_OPTION } from "@/constants/common";
import { onErrorMessage, onSuccessMessage } from "@/utils";
import serviceApi from "@/apis/serviceApi";
import ReactQuill from "react-quill";

type Props = {
    rowSelected?: Service;
    action: Action;
    setTogglePopup: React.Dispatch<React.SetStateAction<boolean>>;
};

const ServiceForm = ({ rowSelected, action, setTogglePopup }: Props) => {
    const [isImgChanged, setIsImgChanged] = useState<boolean>(false);
    const [isUploading, setIsUploading] = useState<boolean>(false);
    const [isValuesChange, setIsValuesChange] = useState<boolean>(false);
    const [fileList, setFileList] = useState<UploadFile[]>([]);
    const [valueContent, setValueContent] = useState<string>("");
    const [form] = Form.useForm();
    const queryClient = useQueryClient();
    useEffect(() => {
        if (rowSelected) {
            form.setFieldsValue(rowSelected);
            setFileList(
                rowSelected.image_url
                    ? [
                          {
                              uid: "1",
                              name: rowSelected.image_url ?? "",
                              status: "done",
                              url: rowSelected.URLImage,
                          },
                      ]
                    : []
            );
            setIsValuesChange(false);
            setIsImgChanged(false);
            return;
        }
        setFileList([]);
        form.resetFields();
    }, [rowSelected]);
    const mutation = useMutation({
        mutationFn:
            action === Action.Add
                ? serviceApi.addService
                : serviceApi.editService,
        onSuccess: (data) => {
            // queryClient.setQueryData(["garbage-type"], data);
            queryClient.invalidateQueries(["services"]);
            onSuccessMessage(action, "Service");
            if (action === Action.Add) {
                form.resetFields();
                setFileList([]);
            }
            setTogglePopup(false);
            setIsValuesChange(false);
        },
        onError: (error) => {
            onErrorMessage(error, "Submit Service Failed!");
        },
    });

    const handleOnFinish = (values: any) => {
        if (action === Action.Add) {
            //append image to formData
            if (values.image && !values.image.file.type.startsWith("image/")) {
                onErrorMessage(_, "Image is invalid!");
                return;
            }
            const formData = new FormData();
            formData.append("title", values.title);
            formData.append("description", values.description ?? null);
            formData.append("content", valueContent ?? null);
            formData.append("active", values.active);
            if (values.image) formData.append("image_url", values.image.file);
            mutation.mutate(formData);
        } else {
            //omit image field in form data
            const valuesWithoutImage = {
                title: values.title,
                description: values.description,
                content: valueContent,
                active: values.active,
            };

            if (isValuesChange) {
                mutation.mutate({
                    ...valuesWithoutImage,
                    id: rowSelected?.id,
                });
            }
            if (isImgChanged) {
                (async function () {
                    try {
                        setIsUploading(true);
                        const formData = new FormData();
                        if (fileList.length === 1)
                            formData.append("image_url", values.image.file);
                        const data = await serviceApi.updateImage(
                            rowSelected?.id,
                            formData
                        );
                        onSuccessMessage("Update", "service image");
                        setIsUploading(false);
                        setIsImgChanged(false);
                        setTogglePopup(false);
                        // queryClient.setQueryData(["garbage-type"], data);
                        queryClient.invalidateQueries(["services"]);
                    } catch (error) {
                        setIsUploading(false);
                        onErrorMessage(error, "Update Service Image Failed!");
                    }
                })();
            }
        }
    };

    const handleOnFinishFailed = (errorInfo: any) => {
        console.log("Failed:", errorInfo);
    };

    const onImageChange = (info) => {
        setFileList(info.fileList);
        setIsImgChanged(true);
    };
    return (
        <div className="bg-white p-4 rounded-xl">
            <Form
                form={form}
                name="basic"
                labelCol={{ span: 8 }}
                wrapperCol={{ span: 16 }}
                initialValues={{ active: 1 }}
                onFinish={handleOnFinish}
                onFinishFailed={handleOnFinishFailed}
                autoComplete="off"
                onValuesChange={(value) => {
                    if (Object.keys(value)[0] !== "image")
                        setIsValuesChange(true);
                }}
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
                            message: "Please enter title!",
                        },
                    ]}
                >
                    <Input placeholder="Enter the title service" />
                </Form.Item>
                <Form.Item label="Description" name="description">
                    <Input.TextArea
                        rows={3}
                        placeholder="Enter the description for service"
                    />
                </Form.Item>
                <Form.Item label="Content" name="content">
                    <ReactQuill
                        theme="snow"
                        value={valueContent}
                        onChange={setValueContent}
                        className="flex-1 [&>div]:h-auto z-[999]"
                        placeholder="Write the content of service"
                    />
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
                <Form.Item
                    label="Image"
                    name="image"
                    // rules={[{ required: true }]}
                >
                    <Upload
                        beforeUpload={() => false}
                        onChange={onImageChange}
                        fileList={fileList}
                        listType="picture"
                        maxCount={1}
                        accept="image/*"
                    >
                        <Button icon={<UploadOutlined />}>Upload</Button>
                    </Upload>
                </Form.Item>

                <Form.Item wrapperCol={{ offset: 8, span: 16 }}>
                    <Button
                        type="primary"
                        htmlType="submit"
                        loading={mutation.isLoading || isUploading}
                    >
                        Submit
                    </Button>
                </Form.Item>
            </Form>
        </div>
    );
};

export default ServiceForm;
