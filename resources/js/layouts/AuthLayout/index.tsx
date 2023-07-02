import { useEffect } from "react";
import { useNavigate } from "react-router-dom";

interface IProp {
    children: JSX.Element;
}

export function AuthLayout(props: IProp) {
    const navigate = useNavigate();
    useEffect(() => {
        const token = JSON.parse(localStorage.getItem("user")!)?.access_token;
        if (token) {
            navigate("/area");
            return;
        }
    }, []);
    return (
        <div className="flex justify-center items-center bg-[#e9ecef] h-[100vh]">
            {props.children}
        </div>
    );
}
