import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import { useEffect, useState } from "react";
import { Button, Form, Input, Select, notification } from "antd";
import { MinusCircleOutlined, PlusOutlined } from "@ant-design/icons";
import ReactQuill from "react-quill";

import garbageApi from "@/apis/garbageApi";
import { STATUS_TYPE_OPTION } from "@/constants/common";
import { Action } from "@/types";
import type { Garbage } from "@/types/garbage";
import { onErrorMessage } from "@/utils";
import SelectBoxSkeleton from "@/components/Skeleton/SelectBoxSkeleton";
import "react-quill/dist/quill.snow.css";

type Props = {
    rowSelected?: Garbage;
    action: Action;
    setTogglePopup: React.Dispatch<React.SetStateAction<boolean>>;
};

const GarbageForm = ({ rowSelected, action, setTogglePopup }: Props) => {
    const [form] = Form.useForm();
    const [isValuesChange, setIsValuesChange] = useState<boolean>(false);
    const [valuesContent, setValuesContent] = useState<string[]>([]);
    const queryClient = useQueryClient();

    useEffect(() => {
        if (rowSelected) {
            const serviceGarbageType = rowSelected.service_garbage_contents.map(
                (garbageContent) => garbageContent.service_garbage_type_id
            );
            setValuesContent(
                rowSelected.service_garbage_contents.map(
                    (garbageContent) => garbageContent.content
                )
            );
            form.setFieldsValue({
                ...rowSelected,
                service_garbage_type: serviceGarbageType,
            });
        } else {
            form.resetFields();
            setValuesContent([""]);
        }
    }, [rowSelected]);

    const mutation = useMutation({
        mutationFn:
            action === Action.Add
                ? garbageApi.addGarbage
                : garbageApi.editGarbage,
        onSuccess: () => {
            queryClient.invalidateQueries({ queryKey: ["garbages"] });
            notification.success({
                message:
                    action === Action.Add
                        ? "Add Garbage Successfully"
                        : "Edit Garbage Successfully",
                duration: 2,
            });
            if (action === Action.Add) form.resetFields();
            setIsValuesChange(false);
            setTogglePopup(false);
        },
        onError: (error) => {
            onErrorMessage(error, "Submit Garbage Failed");
        },
    });
    const handleOnFinish = (values: any) => {
        if (isValuesChange)
            mutation.mutate({
                ...values,
                service_garbage_content: valuesContent,
            });
    };

    const handleOnFinishFailed = (errorInfo: any) => {
        console.log("Failed:", errorInfo);
    };

    const { data: selectOption, isLoading } = useQuery({
        queryKey: ["garbage-parent"],
        queryFn: garbageApi.getGarbageParent,
    });

    const { data: garbageTypes, isLoading: isLoadingGarbageType } = useQuery({
        queryKey: ["service-garbage-types"],
        queryFn: garbageApi.getServiceGarbageType,
        // enabled: focusGarbageType,
    });

    return (
        <div className="min-h-[300px] bg-white p-4 rounded-xl">
            <Form
                form={form}
                name="basic"
                labelCol={{ span: 8 }}
                wrapperCol={{ span: 16 }}
                style={{ maxWidth: 800 }}
                initialValues={{ active: 1, service_garbage_type: [undefined] }}
                onFinish={handleOnFinish}
                onFinishFailed={handleOnFinishFailed}
                autoComplete="off"
                onValuesChange={() => setIsValuesChange(true)}
            >
                <Form.Item name="id" hidden>
                    <Input />
                </Form.Item>
                <Form.Item
                    label="Name"
                    name="name"
                    rules={[
                        {
                            required: true,
                            message: "Please input your name!",
                        },
                    ]}
                >
                    <Input placeholder="Enter garbage name" />
                </Form.Item>

                <Form.Item label="Description" name="description">
                    <Input.TextArea
                        rows={3}
                        placeholder="Enter a description for Garbage"
                    />
                </Form.Item>
                <Form.Item label="Service garbage parent" name="parent_id">
                    {isLoading ? (
                        <SelectBoxSkeleton />
                    ) : (
                        <Select
                            placeholder="Select a Garbage Type"
                            options={[
                                {
                                    value: null,
                                    label: "None",
                                },
                                ...selectOption
                                    ?.filter(
                                        (option) =>
                                            option.id !== rowSelected?.id
                                    )
                                    .map((option) => ({
                                        value: option.id,
                                        label: option.name,
                                    })),
                            ]}
                        />
                    )}
                </Form.Item>
                <Form.List name="service_garbage_type">
                    {(fields, { add, remove }) => (
                        <>
                            {fields.map(
                                ({ key, name, ...restField }, index) => (
                                    <div key={key} className="relative">
                                        <Form.Item
                                            {...restField}
                                            name={name}
                                            required
                                            label="Service Garbage Type"
                                            className={`${
                                                index !== 0
                                                    ? "[&>div>div:first-child]:hidden tablet:[&>div>div:first-child]:invisible tablet:[&>div>div:first-child]:block"
                                                    : ""
                                            }`}
                                            rules={[
                                                {
                                                    required: true,
                                                    message:
                                                        "Please select service garbage type!",
                                                },
                                            ]}
                                        >
                                            {isLoading ? (
                                                <SelectBoxSkeleton />
                                            ) : (
                                                <Select
                                                    placeholder="Select a option and change input text above"
                                                    options={garbageTypes?.map(
                                                        (garbageType) => ({
                                                            label: garbageType.name,
                                                            value: garbageType.id,
                                                        })
                                                    )}
                                                />
                                            )}
                                        </Form.Item>
                                        <div className="flex pb-6 -mt-4">
                                            <div className="basis-[33.33333%]"></div>
                                            <ReactQuill
                                                theme="snow"
                                                value={valuesContent[index]}
                                                onChange={(valueChange) => {
                                                    setIsValuesChange(true);
                                                    setValuesContent(
                                                        valuesContent.map(
                                                            (
                                                                value,
                                                                indexContent
                                                            ) =>
                                                                indexContent ===
                                                                index
                                                                    ? valueChange
                                                                    : value
                                                        )
                                                    );
                                                }}
                                                className="flex-1 [&>div]:h-auto z-[999]"
                                                placeholder="Write the content of garbage type service"
                                            />
                                        </div>
                                        {fields.length > 1 ? (
                                            <MinusCircleOutlined
                                                onClick={() => remove(name)}
                                                className="absolute -right-7 top-[10px]"
                                            />
                                        ) : null}
                                    </div>
                                )
                            )}
                            <Form.Item
                                label="add"
                                className="[&>div>div:first-child]:hidden tablet:[&>div>div:first-child]:invisible tablet:[&>div>div:first-child]:block"
                            >
                                <Button
                                    type="dashed"
                                    onClick={() => {
                                        setValuesContent((prev) => [
                                            ...prev,
                                            "",
                                        ]);
                                        add();
                                    }}
                                    block
                                    icon={<PlusOutlined />}
                                >
                                    Add Service Garbage Type
                                </Button>
                            </Form.Item>
                        </>
                    )}
                </Form.List>
                <Form.Item
                    label="Status"
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

export default GarbageForm;
