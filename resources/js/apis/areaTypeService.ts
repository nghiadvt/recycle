import axiosClient from "@/lib/axiosClient";
import { AreaListType } from "@/types";

const areaApi = {
    addAreaList(data: Omit<AreaListType, "id">): Promise<AreaListType> {
        const url = "/areas";
        return axiosClient.post(url, data);
    },
    getListArea({ queryKey: [_, page = 1, { ...valueFilter }] }): Promise<any> {
        const url = "/areas";
        return axiosClient.get(url, {
            params: {
                page,
                ...valueFilter,
            },
        });
    },
    editListArea(data: AreaListType): Promise<AreaListType> {
        const url = "/areas/" + data.id;
        return axiosClient.put(url, data);
    },
    deleteListArea(id) {
        const url = `/areas/` + id;
        return axiosClient.delete(url);
    },
    getPrefectures(): Promise<any> {
        const url = "/prefectures";
        return axiosClient.get(url);
    },
    getCities({ queryKey: [_, id] }): Promise<any> {
        const url = `/cities`;
        return axiosClient.get(url, {
            params: {
                prefecture: id,
            },
        });
    },
    getAreaOptions(): Promise<AreaListType[]> {
        const url = "/schedule/areas";
        return axiosClient.get(url);
    },
};

export default areaApi;
