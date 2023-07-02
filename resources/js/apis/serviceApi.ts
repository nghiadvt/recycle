import axiosClient from "@/lib/axiosClient";
import { PageInfo, Service } from "@/types";

const serviceApi = {
    addService(data): Promise<PageInfo<Service>> {
        const url = "/services";
        return axiosClient.post(url, data, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
    },
    getList({ queryKey: [_, page = 1] }): Promise<PageInfo<Service>> {
        const url = "/services";
        return axiosClient.get(url, {
            params: {
                page,
            },
        });
    },
    editService(data: Service): Promise<PageInfo<Service>> {
        const url = `/services/${data.id}`;
        return axiosClient.put(url, data);
    },
    updateImage(id, data): Promise<PageInfo<Service>> {
        const url = `/services/update-image/${id}`;
        return axiosClient.post(url, data, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
    },
    deleteService(id: number) {
        const url = `/services/${id}`;
        return axiosClient.delete(url);
    },
};

export default serviceApi;
