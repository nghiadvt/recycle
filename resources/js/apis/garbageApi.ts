import axiosClient from "@/lib/axiosClient";
import type { Garbage, PageInfo } from "@/types";

const garbageApi = {
    addGarbage(data) {
        const url = "/service-garbages";
        return axiosClient.post(url, data);
    },
    getListGarbage({ queryKey: [_, page = 1] }): Promise<PageInfo<Garbage>> {
        const url = "/service-garbages";
        return axiosClient.get(url, {
            params: {
                page,
            },
        });
    },
    getGarbageParent(): Promise<any> {
        const url = "/service-garbage/parents";
        return axiosClient.get(url);
    },
    editGarbage(data: Garbage) {
        const url = `/service-garbages/${data.id}`;
        return axiosClient.put(url, data);
    },
    deleteGarbage(id: number) {
        const url = `/service-garbages/${id}`;
        return axiosClient.delete(url);
    },
    getServiceGarbageType(): Promise<any> {
        const url = "/service-garbage-types";
        return axiosClient.get(url);
    },
};

export default garbageApi;
