import ROUTE_PATH from "@/config/routes";

export const STATUS_TYPE_OPTION = [
    {
        value: 0,
        label: "Inactive",
    },
    {
        value: 1,
        label: "Active",
    },
];

export const GARBAGE_TYPE_OPTION = [
    {
        value: "cart",
        label: "Cart",
    },
    {
        value: "gal",
        label: "Gal",
    },
];

export const SCHEDULE_DAY_TYPE_OPTION = [
    {
        value: 0,
        label: "No-repeat",
    },
    {
        value: 1,
        label: "Repeat",
    },
];

export const SCHEDULE_DAY = [
    {
        value: 1,
        label: "Monday",
    },
    {
        value: 2,
        label: "Tuesday",
    },
    {
        value: 3,
        label: "Wednesday",
    },
    {
        value: 4,
        label: "Thursday",
    },
    {
        value: 5,
        label: "Friday",
    },
    {
        value: 6,
        label: "Saturday",
    },
    {
        value: 7,
        label: "Sunday",
    },
];

export const TITLE_BY_ROUTE = {
    [ROUTE_PATH.LOGIN]: "Login",
    [ROUTE_PATH.LANGUAGE]: "Language",
    [ROUTE_PATH.GARBAGE_TYPE]: "Garbage Types",
    [ROUTE_PATH.AREA]: "Area",
    [ROUTE_PATH.SERVICE_GARBAGE]: "Service Garbage",
    [ROUTE_PATH.SCHEDULE]: "Schedule",
    [ROUTE_PATH.SERVICE_CATEGORY]: "Service Category",
    [ROUTE_PATH.PAGE]: "Page",
    [ROUTE_PATH.SERVICE]: "Service",
    [ROUTE_PATH.SERVICE_ARTICLES]: "Service Articles",
    [ROUTE_PATH.PAGE_MANAGEMENT]: "Page Management",
};

export const PAGE_TYPE_OPTION = [
    {
        value: 1,
        label: "None",
    },
    {
        value: 2,
        label: "Term of Service",
    },
    {
        value: 3,
        label: "Privacy Policy",
    },
];
