import { useEffect, useState } from "react";

import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import {
    Button,
    Form,
    Input,
    Select,
    DatePicker,
    notification,
    Radio,
    TimePicker,
    Space,
} from "antd";
import { MinusCircleOutlined, PlusOutlined } from "@ant-design/icons";
import type { RangePickerProps } from "antd/es/date-picker";

import { Action } from "@/types";
import {
    SCHEDULE_DAY,
    SCHEDULE_DAY_TYPE_OPTION,
    STATUS_TYPE_OPTION,
} from "@/constants/common";
import areaApi from "@/apis/areaTypeService";
import scheduleApi from "@/apis/scheduleApi";
import garbageTypeApi from "@/apis/garbageTypeApi";
import dayjs from "dayjs";
import { Schedule } from "@/types";
import { onErrorMessage } from "@/utils";
import SelectBoxSkeleton from "@/components/Skeleton/SelectBoxSkeleton";
import { useDebounce } from "@/hooks";

type Props = {
    rowSelected?: Schedule;
    action: Action;
    setTogglePopup: React.Dispatch<React.SetStateAction<boolean>>;
};

const ScheduleForm = ({ rowSelected, action, setTogglePopup }: Props) => {
    const [form] = Form.useForm();
    const [isValuesChange, setIsValuesChange] = useState<boolean>(false);
    const [searchTextArea, setSearchTextArea] = useState<string>("");
    const searchTextAreaDebounced = useDebounce(searchTextArea, 500);
    const queryClient = useQueryClient();
    //Check form action to reset fields
    useEffect(() => {
        if (rowSelected) {
            const garbageTypeId = rowSelected.garbage_type_schedules.map(
                (schedule) => schedule.garbage_type_id
            );
            //Convert date data form string type to array type
            const startDay = dayjs(
                rowSelected.date_start_at.split(" ")[0],
                "YYYY-MM-DD"
            );
            const endDay = dayjs(
                rowSelected.date_end_at.split(" ")[0],
                "YYYY-MM-DD"
            );
            const startTime = dayjs(rowSelected.time_start_at, "HH:mm");
            const endTime = dayjs(rowSelected.time_end_at, "HH:mm");

            form.setFieldsValue({
                ...rowSelected,
                garbage_type: garbageTypeId,
                day_range: [startDay, endDay],
                time_start_at: startTime,
                time_end_at: endTime,
            });
            setSearchTextArea("");
        } else form.resetFields();
    }, [rowSelected]);
    //Check form action to mutation form
    const mutation = useMutation({
        mutationFn:
            action === Action.Add
                ? scheduleApi.addSchedule
                : scheduleApi.editSchedule,
        onSuccess: (data) => {
            queryClient.invalidateQueries(["schedules"]);
            notification.success({
                message:
                    action === Action.Add
                        ? "Add Schedule Successfully"
                        : "Edit Schedule Successfully",
                duration: 2,
            });
            if (action === Action.Add) form.resetFields();
            setTogglePopup(false);
            setIsValuesChange(false);
        },
        onError: (error) => {
            onErrorMessage(error, "Submit Schedule Failed!");
        },
    });
    //Handle on submit form
    const handleOnFinish = (values: any) => {
        if (isValuesChange) {
            //Convert value range date to valid form value
            const date_start_at = dayjs(values.day_range[0]).format(
                "YYYY-MM-DD"
            );
            const date_end_at = dayjs(values.day_range[1]).format("YYYY-MM-DD");

            const time_start_at = dayjs(values.time_start_at).format(
                "HH:mm:ss"
            );
            const time_end_at = dayjs(values.time_end_at).format("HH:mm:ss");

            //Mutate form data
            mutation.mutate({
                id: values.id,
                area_id: values.area_id,
                active: values.active,
                day_of_week: values.day_of_week,
                date_start_at,
                date_end_at,
                time_end_at,
                time_start_at,
                garbage_type: values.garbage_type,
                is_repeat: values.is_repeat,
            });
        }
    };

    const handleOnFinishFailed = (errorInfo: any) => {
        console.log("Failed:", errorInfo);
    };
    // Get options for select box
    const { data: garbageTypes, isLoading: isLoadingGarbageType } = useQuery({
        queryKey: ["garbage-type-option"],
        queryFn: garbageTypeApi.getAllGarbageType,
        // enabled: focusGarbageType,
        staleTime: 0,
    });
    const { data: areaTypes, isFetching: isLoadingAreaType } = useQuery({
        queryKey: ["area-options"],
        queryFn: areaApi.getAreaOptions,
        // enabled: !!(searchTextAreaDebounced || rowSelected?.area?.address),
        staleTime: 0,
    });
    const disabledDate: RangePickerProps["disabledDate"] = (current) => {
        // Can not select days before today and today
        return current && current < dayjs().startOf("day");
    };
    return (
        <div className="min-h-[300px] bg-white p-4 px-8 min-w-[300px] rounded-xl">
            <Form
                form={form}
                name="basic"
                labelCol={{ span: 8 }}
                wrapperCol={{ span: 16 }}
                style={{ minWidth: 250 }}
                initialValues={{
                    active: 1,
                    garbage_type: [undefined],
                    is_repeat: 0,
                }}
                onFinish={handleOnFinish}
                onFinishFailed={handleOnFinishFailed}
                autoComplete="off"
                onValuesChange={() => setIsValuesChange(true)}
            >
                <Form.Item name="id" hidden>
                    <Input />
                </Form.Item>
                <Form.Item
                    label="Range Day"
                    name="day_range"
                    rules={[
                        { required: true, message: "Please input date range!" },
                    ]}
                >
                    <DatePicker.RangePicker
                        format={"YYYY-MM-DD"}
                        disabledDate={disabledDate}
                        className="w-full"
                    />
                </Form.Item>
                <Form.Item
                    label={
                        <div>
                            <span className="text-[#ff4d4f] font-['SimSun']">
                                *
                            </span>{" "}
                            Rang Time
                        </div>
                    }
                    rules={[{ required: true }]}
                    className="mb-0"
                >
                    <Space direction="horizontal">
                        <Form.Item
                            name="time_start_at"
                            rules={[
                                {
                                    required: true,
                                    message: "Please input time start!",
                                },
                            ]}
                        >
                            <TimePicker
                                format={"HH:mm"}
                                placeholder="Start time"
                            />
                        </Form.Item>

                        <Form.Item
                            name="time_end_at"
                            rules={[
                                {
                                    required: true,
                                    message: "Please input time end!",
                                },
                            ]}
                        >
                            <TimePicker
                                format={"HH:mm"}
                                placeholder="End time"
                            />
                        </Form.Item>
                    </Space>
                </Form.Item>

                <Form.Item
                    label="Schedule Day"
                    name="day_of_week"
                    rules={[
                        {
                            required: true,
                            message: "Please input Schedule day!",
                        },
                    ]}
                >
                    <Select
                        placeholder="Select a day"
                        options={SCHEDULE_DAY}
                        // onFocus={() => setFocusScheduleDay(true)}
                    ></Select>
                </Form.Item>
                <Form.Item label="Type" name="is_repeat">
                    <Radio.Group
                        options={SCHEDULE_DAY_TYPE_OPTION}
                        // onChange={onChange4}
                        optionType="button"
                        buttonStyle="solid"
                    />
                </Form.Item>

                <Form.Item
                    label="Area"
                    name="area_id"
                    rules={[{ required: true, message: "Please input Area!" }]}
                >
                    <Select
                        placeholder="Select area"
                        showSearch
                        filterOption={(input, option: any) =>
                            (option?.label ?? "").toLowerCase().includes(input)
                        }
                        filterSort={(optionA, optionB) =>
                            (optionA?.label ?? "")
                                .toLowerCase()
                                .localeCompare(
                                    (optionB?.label ?? "").toLowerCase()
                                )
                        }
                        options={areaTypes?.map((areaType) => ({
                            label: areaType.addressZipcode,
                            value: areaType.id,
                        }))}
                        // onSearch={(value) => setSearchTextArea(value)}
                        loading={isLoadingAreaType}
                    ></Select>
                </Form.Item>
                <Form.List name="garbage_type">
                    {(fields, { add, remove }) => (
                        <>
                            {fields.map(
                                ({ key, name, ...restField }, index) => (
                                    <div key={key} className="relative">
                                        <Form.Item
                                            {...restField}
                                            name={name}
                                            rules={[
                                                {
                                                    required: true,
                                                    message:
                                                        "Please select garbage type",
                                                },
                                            ]}
                                            label="Garbage Type"
                                            className={`${
                                                index !== 0
                                                    ? "[&>div>div:first-child]:hidden tablet:[&>div>div:first-child]:invisible tablet:[&>div>div:first-child]:block"
                                                    : ""
                                            }`}
                                        >
                                            {isLoadingGarbageType ? (
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
                                        {fields.length > 1 &&
                                        !isLoadingGarbageType ? (
                                            <MinusCircleOutlined
                                                onClick={() => remove(name)}
                                                className="absolute -right-7 bottom-[10px]"
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
                                    onClick={() => add()}
                                    block
                                    icon={<PlusOutlined />}
                                >
                                    Add Garbage Type
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
                <Form.Item wrapperCol={{ offset: 8, span: 16 }}>
                    <Button
                        type="primary"
                        htmlType="submit"
                        loading={mutation.isLoading}
                    >
                        Submit
                    </Button>
                </Form.Item>
            </Form>
        </div>
    );
};

export default ScheduleForm;
