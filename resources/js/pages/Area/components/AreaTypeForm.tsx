import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import { Button, Form, Input, InputNumber, Select, notification } from "antd";
import { useEffect, useState } from "react";
import { AxiosError } from "axios";

import areaApi from "@/apis/areaTypeService";
import { Action, AreaListType } from "@/types";
import { STATUS_TYPE_OPTION } from "@/constants/common";
import SelectBoxSkeleton from "@/components/Skeleton/SelectBoxSkeleton";

type Props = {
    rowSelected?: AreaListType;
    action: Action;
    setTogglePopup: React.Dispatch<React.SetStateAction<boolean>>;
};

const AreaListTypeForm = ({ action, rowSelected, setTogglePopup }: Props) => {
    const [form] = Form.useForm();
    const queryClient = useQueryClient();
    const [selectedPrefecture, setSelectedPrefecture] = useState<
        string | undefined
    >(rowSelected?.prefecture?.id);
    const [isValuesChange, setIsValuesChange] = useState<boolean>(false);
    useEffect(() => {
        if (rowSelected) {
            form.setFieldsValue({
                ...rowSelected,
                prefecture_id: rowSelected?.prefecture.id,
                city_id: rowSelected?.city.id,
            });
            setSelectedPrefecture(rowSelected?.prefecture.id);
            return;
        }
        form.resetFields();
        setSelectedPrefecture("");
    }, [rowSelected]);

    const mutation = useMutation({
        mutationFn:
            action === Action.Add ? areaApi.addAreaList : areaApi.editListArea,
        onSuccess: () => {
            queryClient.invalidateQueries({ queryKey: ["areas"] });
            notification.success({
                message:
                    action === Action.Add
                        ? "Add Area Successfully"
                        : "Edit Area Successfully",
                duration: 2,
            });
            if (action === Action.Add) form.resetFields();
            setSelectedPrefecture("");
            setTogglePopup(false);
            setIsValuesChange(false);
        },
        onError: (error) => {
            const errorMessage =
                error instanceof AxiosError
                    ? error.response?.data.message
                    : "Submit Area fail";
            notification.error({
                message: errorMessage,
                duration: 2,
            });
        },
    });

    const prefectures = useQuery({
        queryKey: ["prefectures"],
        queryFn: areaApi.getPrefectures,
    });

    const cities = useQuery({
        queryKey: ["cities", selectedPrefecture],
        queryFn: areaApi.getCities,
        enabled: !!selectedPrefecture,
    });
    const onFinish = (values: any) => {
        if (isValuesChange) mutation.mutate(values);
    };

    const onFinishFailed = (errorInfo: any) => {
        console.log("Failed:", errorInfo);
    };

    const handleCitySelect = (value) => {
        setSelectedPrefecture(value);
        form.resetFields(["city_id"]);
    };

    return (
        <div className="min-h-[300px] bg-white p-4 rounded-xl">
            <Form
                name="basic"
                form={form}
                labelCol={{ span: 8 }}
                wrapperCol={{ span: 16 }}
                initialValues={{ status: 1 }}
                onFinish={onFinish}
                onFinishFailed={onFinishFailed}
                autoComplete="off"
                onValuesChange={() => setIsValuesChange(true)}
            >
                <Form.Item name="id" hidden>
                    <Input />
                </Form.Item>
                <Form.Item
                    name="pref_id"
                    label="Prefecture"
                    rules={[
                        {
                            required: true,
                            message: "Please input your prefecture!",
                        },
                    ]}
                >
                    {prefectures.isFetching ? (
                        <SelectBoxSkeleton />
                    ) : (
                        <Select
                            aria-required
                            showSearch
                            value={selectedPrefecture}
                            onChange={handleCitySelect}
                            placeholder="Choose prefecture"
                            options={(prefectures?.data || []).map((e) => ({
                                value: e.id,
                                label: e.name,
                            }))}
                            filterOption={(input, option: any) =>
                                (option?.label ?? "")
                                    .toLowerCase()
                                    .includes(input)
                            }
                        ></Select>
                    )}
                </Form.Item>
                <Form.Item
                    name="city_id"
                    label="City"
                    rules={[
                        {
                            required: true,
                            message: "Please input your city!",
                        },
                    ]}
                >
                    {cities.isFetching ? (
                        <SelectBoxSkeleton />
                    ) : (
                        <Select
                            disabled={!selectedPrefecture}
                            aria-required
                            placeholder="Choose city"
                            options={(cities?.data || []).map((e) => ({
                                value: e.id,
                                label: e.name,
                            }))}
                        ></Select>
                    )}
                </Form.Item>

                <Form.Item
                    label="Address"
                    name="address"
                    rules={[
                        {
                            required: true,
                            message: "Please enter your address !",
                        },
                    ]}
                >
                    <Input placeholder="Enter your address " />
                </Form.Item>
                <Form.Item
                    label="Zip code number"
                    name="zip_no"
                    rules={[
                        {
                            required: true,
                            message: "Please enter your zip code number!",
                        },
                        {
                            pattern: new RegExp(/^[0-9]{7}$/),
                            message: "Zip code number invalid!",
                        },
                    ]}
                >
                    <InputNumber
                        formatter={(value) =>
                            `${value}`.replace(/\B(?=(\d{4})+(?!\d))/g, "-")
                        }
                        parser={(value) => Number(value!.replace(/(-*)/g, ""))}
                        className="w-full"
                        placeholder="Enter your zip code number"
                    />
                </Form.Item>
                <Form.Item
                    name="active"
                    label="Status"
                    rules={[
                        {
                            required: true,
                            message: "Please choose your status!",
                        },
                    ]}
                >
                    <Select
                        placeholder="Choose status"
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

export default AreaListTypeForm;
