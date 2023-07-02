import React, { useState, useEffect, useLayoutEffect } from "react";
import {
    MenuFoldOutlined,
    MenuUnfoldOutlined,
    LogoutOutlined,
} from "@ant-design/icons";
import { Layout, theme } from "antd";
import { useNavigate, useLocation } from "react-router-dom";

import { logout } from "@/pages/Login/store/authSlice";
import { useAppDispatch } from "@/hooks/redux";
import { TITLE_BY_ROUTE } from "@/constants/common";
import { ENV_DEVELOPMENT } from "@/config/env";
import Menu from "@/components/Menu";

const { Header, Sider, Content } = Layout;

interface IProp {
    children: React.ReactNode;
}

function MainLayout(props: IProp) {
    const dispatch = useAppDispatch();
    const navigate = useNavigate();
    const location = useLocation();
    const [collapsed, setCollapsed] = useState(false);
    const [windowWidth, setWindowWidth] = useState(window.innerWidth);
    const {
        token: { colorBgContainer },
    } = theme.useToken();

    const onLogout = () => {
        dispatch(logout());
    };

    useEffect(() => {
        const token = localStorage.getItem("user");
        if (!token) {
            navigate("/login");
        }
    }, []);

    useEffect(() => {
        const handleStorageEvent = (event: StorageEvent) => {
            if (
                event.storageArea === window.localStorage &&
                event.key === "user"
            ) {
                window.location.reload();
                navigate("/login");
            }
        };
        window.addEventListener("storage", handleStorageEvent);
        return () => {
            window.removeEventListener("storage", handleStorageEvent);
        };
    }, []);

    useEffect(() => {
        const handleWindowResize = () => {
            setWindowWidth(window.innerWidth);
        };

        window.addEventListener("resize", handleWindowResize);

        return () => {
            window.removeEventListener("resize", handleWindowResize);
        };
    }, []);

    useEffect(() => {
        document.title = `${TITLE_BY_ROUTE[location.pathname]} - ${
            ENV_DEVELOPMENT.APP_NAME
        }`;
    }, [location]);

    return (
        <Layout className="flex h-screen">
            <Sider
                className="!bg-[white] [&>div]:flex [&>div]:flex-col [&>div]:justify-between [&>div]:rounded-l-[20px]"
                trigger={null}
                collapsible
                collapsed={collapsed || windowWidth < 768}
            >
                <div>
                    <div className="flex items-center justify-center ml-[5px] h-[64px]">
                        <img
                            className="mt-[-3]"
                            alt=""
                            src="/images/logo512.png"
                            width="25"
                            height="25"
                        />
                        {!(collapsed || windowWidth < 768) && (
                            <span className="ml-[5px] text-[20px] font-bold text-[#0375c5]">
                                Seattle
                            </span>
                        )}
                    </div>
                    <Menu collapsed={collapsed || windowWidth < 768} />
                </div>
                <div
                    className="flex items-center text-left cursor-pointer ml-[28px] mb-[35px]"
                    onClick={onLogout}
                >
                    <LogoutOutlined className="text-[20px] text-[red]" />
                    {!collapsed && <span className="ml-[5px]">Log out</span>}
                </div>
            </Sider>
            <Layout>
                <Header style={{ padding: 0, background: "#0375c5" }}>
                    <div className="flex justify-between items-center h-full">
                        {React.createElement(
                            collapsed ? MenuUnfoldOutlined : MenuFoldOutlined,
                            {
                                className: "trigger text-[30px] text-white",
                                onClick: () => setCollapsed(!collapsed),
                            }
                        )}
                    </div>
                </Header>
                <Content
                    style={{
                        margin: "24px 16px",
                        padding: 24,
                        minHeight: 280,
                        height: "100%",
                        background: colorBgContainer,
                    }}
                >
                    {props.children}
                </Content>
            </Layout>
        </Layout>
    );
}

export default MainLayout;
