import { ENV_DEVELOPMENT } from "@/config/env";
import axiosClient from "@/lib/axiosClient";
import { GarbageType } from "@/types";

const garbageTypeApi = {
    addGarbageType(data): Promise<GarbageType[]> {
        const url = "/garbage-types";
        return axiosClient.post(url, data, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
    },
    getListGarbageType(): Promise<GarbageType[]> {
        const url = "/garbage-types";
        return axiosClient.get(url);
    },
    editGarbageType(data: GarbageType): Promise<GarbageType[]> {
        const url = `/garbage-types/${data.id}`;
        return axiosClient.put(url, data);
    },
    updateImage(id, data): Promise<GarbageType[]> {
        const url = `/garbage-types/update-image/${id}`;
        return axiosClient.post(url, data, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
    },
    deleteGarbageType(id: number) {
        const url = `/garbage-types/${id}`;
        return axiosClient.delete(url);
    },
    getAllGarbageType(): Promise<GarbageType[]> {
        const url = "/garbage-types-active";
        return axiosClient.get(url);
    },
    //crud garbage type option
    addGarbageTypeOption(data): Promise<any> {
        const url = "/container-garbage-type";
        return axiosClient.post(url, data, {
            baseURL: ENV_DEVELOPMENT.BASE_URL.replace("/admin", ""),
        });
    },
    updateOption(id, data): Promise<GarbageType[]> {
        const url = `/container-garbage-types/update-container/${id}`;
        return axiosClient.post(url, data, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
    },
};

export default garbageTypeApi;
