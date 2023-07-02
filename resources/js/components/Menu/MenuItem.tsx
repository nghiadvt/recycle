import { NavLink } from "react-router-dom";

export default function MenuItem({ item, collapsed }: any) {
    return (
        <NavLink
            to={item.to}
            className={({ isActive }) =>
                `flex items-center justify-start p-4 hover:bg-blue-400/40 rounded-lg cursor-pointer text-slate-900 hover:text-blue-900 gap-4 ${
                    isActive ? "bg-blue-400/40" : "bg-transparent"
                } ${collapsed ? "justify-center" : "justify-start"}`
            }
        >
            <item.Icon className="shrink-0" />
            <span
                className={`font-bold gap-4 ${
                    collapsed ? "hidden" : "inline"
                } truncate`}
            >
                {item.label}
            </span>
        </NavLink>
    );
}
