import axiosClient from "@/lib/axiosClient";

export const login = async (payload: object) => {
    return axiosClient.post("login", payload);
};

export const logout = async () => {
    return axiosClient.post("logout");
};
