import ROUTE_PATH from "@/config/routes";
import {
    MapSearch,
    Category2,
    CalendarTime,
    Category,
    Trash,
    Recycle,
    Article,
    Book,
} from "tabler-icons-react";

export const MENU_ITEMS = [
    // {
    //     key: "1",
    //     icon: <TranslationOutlined />,
    //     label: (
    //         <Link to={ROUTE_PATH.LANGUAGE}>
    //             <div>Language</div>
    //         </Link>
    //     ),
    // },
    {
        key: "2",
        Icon: MapSearch,
        to: ROUTE_PATH.AREA,
        label: "Area",
    },
    {
        key: "4",
        Icon: Category2,
        to: ROUTE_PATH.GARBAGE_TYPE,
        label: "Garbage Type",
    },
    {
        key: "5",
        Icon: CalendarTime,
        to: ROUTE_PATH.SCHEDULE,
        label: "Schedule",
    },
    // {
    //     key: "6",
    //     Icon: Category,
    //     to: ROUTE_PATH.SERVICE_CATEGORY,
    //     label: "Service Category",
    // },

    // {
    //     key: "7",
    //     Icon: Recycle,
    //     to: ROUTE_PATH.SERVICE,
    //     label: "Service",
    // },
    {
        key: "3",
        Icon: Trash,
        to: ROUTE_PATH.SERVICE_GARBAGE,
        label: "Service Garbage",
    },
    // {
    //     key: "8",
    //     Icon: Article,
    //     to: ROUTE_PATH.SERVICE_ARTICLES,
    //     label: "Service Article",
    // },
    {
        key: "9",
        Icon: Book,
        to: ROUTE_PATH.PAGE_MANAGEMENT,
        label: "Privacy Policy",
    },
];
