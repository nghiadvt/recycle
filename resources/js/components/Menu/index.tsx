import { MENU_ITEMS } from "@/constants/menu";
import MenuItem from "./MenuItem";

export default function Menu({ collapsed }: { collapsed: boolean }) {
    return (
        <ul className="space-y-2 p-2 ">
            {MENU_ITEMS.map((menuItem) => (
                <MenuItem
                    key={menuItem.key}
                    item={menuItem}
                    collapsed={collapsed}
                />
            ))}
        </ul>
    );
}
