import ROUTE_PATH from "@/config/routes";
import Language from "@/pages/Language";
import Login from "@/pages/Login";
import MainLayout from "@/layouts/MainLayout";
import { AuthLayout } from "@/layouts/AuthLayout";
import GarbageType from "@/pages/GarbageType";
import Garbage from "@/pages/ServiceGarbage";
import Area from "@/pages/Area";
import Schedule from "@/pages/Schedule";
import ServiceCategories from "@/pages/ServiceCategories";
import ServiceArticles from "@/pages/ServiceArticles";
import Service from "../pages/Service";
import PageManagement from "@/pages/PageManagement";

const publicRoutes = [
    {
        path: ROUTE_PATH.LOGIN,
        element: Login,
        layout: AuthLayout,
    },
    {
        path: ROUTE_PATH.LANGUAGE,
        element: Language,
        layout: MainLayout,
    },
    {
        path: ROUTE_PATH.AREA,
        element: Area,
        layout: MainLayout,
    },
    {
        path: ROUTE_PATH.GARBAGE_TYPE,
        element: GarbageType,
        layout: MainLayout,
    },
    {
        path: ROUTE_PATH.SERVICE_CATEGORY,
        element: ServiceCategories,
        layout: MainLayout,
    },
    {
        path: ROUTE_PATH.SERVICE_GARBAGE,
        element: Garbage,
        layout: MainLayout,
    },
    {
        path: ROUTE_PATH.SERVICE_ARTICLES,
        element: ServiceArticles,
        layout: MainLayout,
    },
    {
        path: ROUTE_PATH.SERVICE,
        element: Service,
        layout: MainLayout,
    },
    {
        path: ROUTE_PATH.SCHEDULE,
        element: Schedule,
        layout: MainLayout,
    },
    {
        path: ROUTE_PATH.PAGE_MANAGEMENT,
        element: PageManagement,
        layout: MainLayout,
    },
];

export { publicRoutes };
