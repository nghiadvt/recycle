import { useEffect, useState } from "react";
import Cookies from "js-cookie";
import { Formik, Form } from "formik";
import { Button, Checkbox, Input, Space } from "antd";
import { EyeInvisibleOutlined, EyeTwoTone } from "@ant-design/icons";
import { useNavigate } from "react-router-dom";

import { initialValues } from "./constants";
import { schemesLogin } from "./schemas";
import { login } from "./store/authSlice";
import { useAppDispatch, useAppSelector } from "@/hooks";

export default function Login() {
    const [checked, setChecked] = useState(false);
    const navigate = useNavigate();
    const dispatch = useAppDispatch();
    const { isLoading } = useAppSelector((state) => state.auth);

    const callback = () => {
        navigate("/area");
    };

    const onSubmit = async (values: { email: string; password: string }) => {
        dispatch(
            login({
                email_login: values.email,
                password: values.password,
                callback,
            })
        );
        const rememberMe =
            localStorage.getItem("rememberMe") === "true" ? true : false;
        if (rememberMe) {
            const expires = new Date(
                Date.now() + 7 * 24 * 60 * 60 * 1000
            ).toUTCString();

            const encodeEmail = btoa(values.email);
            const encodedPassword = btoa(values.password);
            document.cookie = `username=${encodeEmail}; expires=${expires}; path=/login`;
            document.cookie = `password=${encodedPassword}; expires=${expires}; path=/login`;
        }
    };
    function checkRemember(event) {
        if (event.target.checked) {
            localStorage.setItem("rememberMe", "true");
        } else {
            localStorage.removeItem("rememberMe");
        }
        setChecked(event.target.checked);
    }

    const email = atob(Cookies.get("username") || "");
    const password = atob(Cookies.get("password") || "");

    return (
        <div className="flex flex-col items-center">
            <div className="flex mb-[0.9rem] text-[34px]">
                <span className="text-[#495057] font-bold">Admin</span>
                <span className="ml-[5px] text-[#495057]">RECYCLE</span>
            </div>
            <div className="flex flex-col bg-white border-[2px] px-[20px] py-[20px] w-[350px] h-[330px]">
                <p className="text-center mt-[10px] text-[#8a8787]">
                    Sign in to start your session
                </p>
                <Formik
                    initialValues={initialValues}
                    validationSchema={schemesLogin}
                    onSubmit={onSubmit}
                >
                    {({
                        values,
                        errors,
                        touched,
                        handleChange,
                        handleBlur,
                        setFieldValue,
                    }) => {
                        useEffect(() => {
                            const rememberMe =
                                localStorage.getItem("rememberMe");
                            if (rememberMe) {
                                setFieldValue("email", email);
                                setFieldValue("password", password);
                                setChecked(true);
                            }
                        }, []);
                        return (
                            <Form className="flex flex-col mt-[16px]">
                                <Input
                                    className="w-[100%] h-[45px]"
                                    type="email"
                                    name="email"
                                    onChange={handleChange}
                                    onBlur={handleBlur}
                                    value={values.email}
                                    placeholder="Email"
                                />
                                <div className="flex justify-start items-center relative my-[15px]">
                                    <p className="absolute text-[#eb3f3f] mt-[-5px] text-[14px]">
                                        {errors.email &&
                                            touched.email &&
                                            errors.email}
                                    </p>
                                </div>
                                <Space direction="vertical">
                                    <Input.Password
                                        className="w-[100%] h-[45px]"
                                        type="password"
                                        name="password"
                                        onChange={handleChange}
                                        onBlur={handleBlur}
                                        value={values.password}
                                        placeholder="Password"
                                        iconRender={(visible) =>
                                            visible ? (
                                                <EyeTwoTone />
                                            ) : (
                                                <EyeInvisibleOutlined />
                                            )
                                        }
                                    />
                                </Space>
                                <div className="flex justify-start items-center relative my-[15px]">
                                    <p className="absolute text-[#eb3f3f] mt-[-5px] text-[14px]">
                                        {errors.password &&
                                            touched.password &&
                                            errors.password}
                                    </p>
                                </div>
                                <div className="flex justify-between items-center">
                                    <div>
                                        <Checkbox
                                            onChange={checkRemember}
                                            checked={checked}
                                        />
                                        <span className="font-normal text-[#666666] ml-[5px]">
                                            Remember me
                                        </span>
                                    </div>
                                    <Button
                                        loading={isLoading}
                                        type="primary"
                                        className="bg-[#007bff] h-[45px]"
                                        htmlType="submit"
                                    >
                                        Sign in
                                    </Button>
                                </div>
                                <p className="text-[#007bff] cursor-pointer mt-[20px] text-left">
                                    I forgot my password
                                </p>
                            </Form>
                        );
                    }}
                </Formik>
            </div>
        </div>
    );
}
