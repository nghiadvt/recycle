import axios from "axios";
import { ENV_DEVELOPMENT } from "../config/env";
const getToken = () => JSON.parse(localStorage.getItem("user")!)?.access_token;
const axiosClient = axios.create({
    baseURL: ENV_DEVELOPMENT.BASE_URL,
    headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
    },
});

axiosClient.interceptors.request.use(
    (config) => {
        config.headers.Authorization = `Bearer ${getToken()}`;
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

axiosClient.interceptors.response.use(
    (response) => response?.data?.data ?? {},
    (error) => {
        if (error.response.status === 413)
            return Promise.reject("Request entity too large");
        if (error.response.status === 401 && getToken()) {
            localStorage.removeItem("user");
            window.location.replace("/login");
        }
        return Promise.reject(error);
    }
);
export default axiosClient;
