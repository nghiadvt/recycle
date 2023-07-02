import { useMutation, useQueryClient } from "@tanstack/react-query";
import { useEffect, useState } from "react";
import {
    Button,
    Form,
    Input,
    InputNumber,
    Select,
    Space,
    Upload,
    UploadFile,
} from "antd";
import {
    MinusCircleOutlined,
    PlusOutlined,
    UploadOutlined,
} from "@ant-design/icons";

import garbageTypeApi from "@/apis/garbageTypeApi";
import { Action, GarbageType } from "@/types";
import { GARBAGE_TYPE_OPTION, STATUS_TYPE_OPTION } from "@/constants/common";
import { onSuccessMessage } from "@/utils";
import { onErrorMessage } from "@/utils";
import ReactQuill from "react-quill";

type Props = {
    rowSelected?: GarbageType;
    action: Action;
    setTogglePopup: React.Dispatch<React.SetStateAction<boolean>>;
};

const GarbageTypeForm = ({ rowSelected, action, setTogglePopup }: Props) => {
    const [isImgChanged, setIsImgChanged] = useState<boolean>(false);
    const [isImgOptionChanged, setIsImgOptionChanged] =
        useState<boolean>(false);
    const [isUploading, setIsUploading] = useState<boolean>(false);
    const [fileList, setFileList] = useState<UploadFile[]>([]);
    const [fileListOption, setFileListOption] = useState<
        (UploadFile | undefined)[]
    >([]);
    const [isValuesChange, setIsValuesChange] = useState<boolean>(false);

    const [form] = Form.useForm();
    const queryClient = useQueryClient();
    useEffect(() => {
        if (rowSelected) {
            form.setFieldsValue(rowSelected);
            setFileList(
                rowSelected.URLImage
                    ? [
                          {
                              uid: "1",
                              name: rowSelected.icon ?? "",
                              status: "done",
                              url: rowSelected.URLImage,
                          },
                      ]
                    : []
            );
            const fileListOptions = rowSelected.container_garbage_types.map(
                (option) => ({
                    uid: option.id,
                    name: `${option.image?.slice(0, 10)}...` ?? "",
                    status: "done",
                    url: option.URLImage,
                })
            );
            setFileListOption(fileListOptions);
            setIsValuesChange(false);
            setIsImgChanged(false);
            setIsImgOptionChanged(false);
            return;
        }
        setFileList([]);
        form.resetFields();
    }, [rowSelected]);

    const mutation = useMutation({
        mutationFn:
            action === Action.Add
                ? garbageTypeApi.addGarbageType
                : garbageTypeApi.editGarbageType,
        onSuccess: (data) => {
            queryClient.invalidateQueries(["garbage-type"]);
            onSuccessMessage(action, "Garbage type");
            if (action === Action.Add) {
                form.resetFields();
                setFileList([]);
            }
            setTogglePopup(false);
            setIsValuesChange(false);
        },
        onError: (error) => {
            onErrorMessage(error, "Submit Garbage Type Failed!");
        },
    });

    const handleOnFinish = (values: any) => {
        if (action === Action.Add) {
            //append image to formData
            if (values.icon && !values.icon.file.type.startsWith("image/")) {
                onErrorMessage(_, "Image is invalid!");
                return;
            }
            const formData = new FormData();
            formData.append("name", values.name);
            formData.append("price", values.price);
            formData.append("description", values.description);
            formData.append("unit", values.unit);
            values.container_garbage_types.forEach((option, index) => {
                formData.append(
                    `container_garbage_types[${index}][bin_size]`,
                    option.bin_size
                );
                formData.append(
                    `container_garbage_types[${index}][image]`,
                    option.image.file
                );
            });
            formData.append("active", values.active);
            if (values.icon) formData.append("icon", values.icon.file);
            mutation.mutate(formData);
        } else {
            //handle value on edit garbage type
            const valuesWithoutImage = {
                name: values.name,
                description: values.description,
                price: values.price,
                unit: values.unit,
                active: values.active,
            };
            if (isValuesChange) {
                mutation.mutate({
                    ...valuesWithoutImage,
                    id: rowSelected?.id,
                });
                // garbageTypeApi.addGarbageTypeOption({...values.})
            }
            if (isImgChanged) {
                (async function () {
                    try {
                        setIsUploading(true);
                        const formData = new FormData();
                        if (fileList.length === 1)
                            formData.append("icon", values.icon.file);
                        const data = await garbageTypeApi.updateImage(
                            rowSelected?.id,
                            formData
                        );
                        if (!isValuesChange) {
                            onSuccessMessage("Update", "Garbage type image");
                            queryClient.invalidateQueries(["garbage-type"]);
                        }
                        setIsUploading(false);
                        setIsImgChanged(false);
                        setIsValuesChange(false);
                        setTogglePopup(false);
                    } catch (error) {
                        setIsUploading(false);
                        onErrorMessage(
                            error,
                            "Update Garbage Type Image Failed!"
                        );
                    }
                })();
            }
            if (isImgOptionChanged) {
                (async function () {
                    try {
                        setIsUploading(true);
                        const formData = new FormData();
                        values.container_garbage_types.forEach(
                            (option, index) => {
                                formData.append(
                                    `${index}[bin_size]`,
                                    option.bin_size
                                );
                                if (option.image.file)
                                    formData.append(
                                        `${index}[image]`,
                                        option.image.file
                                    );
                                if (
                                    rowSelected?.container_garbage_types?.[
                                        index
                                    ]?.id
                                )
                                    formData.append(
                                        `${index}[container_id]`,
                                        rowSelected?.container_garbage_types[
                                            index
                                        ].id
                                    );
                            }
                        );
                        const data = await garbageTypeApi.updateOption(
                            rowSelected?.id,
                            formData
                        );
                        if (!isValuesChange && !isImgChanged)
                            onSuccessMessage("Update", "Garbage type option");
                        queryClient.invalidateQueries(["garbage-type"]);
                        setIsUploading(false);
                        setIsImgOptionChanged(false);
                        setIsValuesChange(false);
                        setTogglePopup(false);
                    } catch (error) {
                        console.log(error);
                        setIsUploading(false);
                        onErrorMessage(
                            error,
                            "Update Garbage Type Option Failed!"
                        );
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

    const onImageOptionChange = (info, index) => {
        setFileListOption((prev) =>
            prev.map((file, i) => (index === i ? info.file : file))
        );
    };

    return (
        <div className="bg-white p-4 rounded-xl">
            <Form
                form={form}
                name="basic"
                labelCol={{ span: 8 }}
                wrapperCol={{ span: 16 }}
                initialValues={{
                    active: 1,
                    container_garbage_types: [
                        {
                            bin_size: undefined,
                            image: undefined,
                        },
                    ],
                }}
                onFinish={handleOnFinish}
                onFinishFailed={handleOnFinishFailed}
                autoComplete="off"
                onValuesChange={(value) => {
                    if (
                        Object.keys(value)[0] !== "icon" &&
                        Object.keys(value)[0] !== "container_garbage_types"
                    )
                        setIsValuesChange(true);
                    if (Object.keys(value)[0] === "container_garbage_types")
                        setIsImgOptionChanged(true);
                }}
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
                <Form.Item
                    label="Price"
                    name="price"
                    rules={[
                        {
                            required: true,
                            message: "Please input garbage type price!",
                        },
                    ]}
                >
                    <InputNumber
                        max={999999}
                        min={0}
                        formatter={(value) =>
                            `$ ${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                        }
                        parser={(value) => value!.replace(/\$\s?|(,*)/g, "")}
                        placeholder="Enter garbage type price"
                        className="w-full"
                    />
                </Form.Item>
                <Form.Item label="Description" name="description">
                    <ReactQuill
                        theme="snow"
                        className="flex-1 [&>div]:h-auto z-[999]"
                        placeholder="Write the description of garbage type"
                    />
                </Form.Item>
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
                <Form.Item
                    label="Image"
                    name="icon"
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

                <Form.Item
                    name="unit"
                    label="Unit"
                    rules={[
                        {
                            required: true,
                            message: "Please select unit",
                        },
                    ]}
                >
                    <Select
                        placeholder="Select a option and change input text above"
                        options={GARBAGE_TYPE_OPTION}
                    />
                </Form.Item>
                <Form.List name="container_garbage_types">
                    {(fields, { add, remove }) => (
                        <>
                            {fields.map(
                                ({ key, name, ...restField }, index) => (
                                    <div key={key} className="relative">
                                        <Form.Item
                                            label={
                                                <div>
                                                    <span className="text-[#ff4d4f] font-['SimSun']">
                                                        *
                                                    </span>{" "}
                                                    Options
                                                </div>
                                            }
                                            className="mb-0"
                                        >
                                            <Space direction="horizontal">
                                                <Form.Item
                                                    {...restField}
                                                    name={[name, "bin_size"]}
                                                    rules={[
                                                        {
                                                            required: true,
                                                            message:
                                                                "Please enter bin size",
                                                        },
                                                    ]}
                                                    className="shrink-0"
                                                >
                                                    <InputNumber
                                                        min={1}
                                                        max={99999}
                                                        placeholder="Bin size"
                                                        className="w-[100px]"
                                                    />
                                                </Form.Item>
                                                <Form.Item
                                                    {...restField}
                                                    name={[name, "image"]}
                                                    rules={[
                                                        {
                                                            required: true,
                                                            message:
                                                                "Upload the image for option",
                                                        },
                                                    ]}
                                                >
                                                    <Upload
                                                        beforeUpload={() =>
                                                            false
                                                        }
                                                        fileList={
                                                            fileListOption[
                                                                index
                                                            ]
                                                                ? [
                                                                      fileListOption[
                                                                          index
                                                                      ] as UploadFile,
                                                                  ]
                                                                : undefined
                                                        }
                                                        onChange={(info) =>
                                                            onImageOptionChange(
                                                                info,
                                                                index
                                                            )
                                                        }
                                                        maxCount={1}
                                                        accept="image/*"
                                                        className="flex gap-2 [&_.ant-upload-list-item-name]:max-w-[140px]"
                                                    >
                                                        <Button
                                                            icon={
                                                                <UploadOutlined />
                                                            }
                                                        >
                                                            Upload
                                                        </Button>
                                                    </Upload>
                                                </Form.Item>
                                            </Space>
                                        </Form.Item>
                                        {fields.length > 1 && (
                                            <MinusCircleOutlined
                                                onClick={() => {
                                                    remove(name);
                                                    setFileListOption((prev) =>
                                                        prev.filter(
                                                            (item, i) =>
                                                                i !== index
                                                        )
                                                    );
                                                }}
                                                className="absolute right-0 top-[10px]"
                                            />
                                        )}
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
                                        add();
                                        setFileListOption((prev) => [
                                            ...prev,
                                            undefined,
                                        ]);
                                    }}
                                    block
                                    icon={<PlusOutlined />}
                                >
                                    Add Garbage Type Option
                                </Button>
                            </Form.Item>
                        </>
                    )}
                </Form.List>
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

export default GarbageTypeForm;
