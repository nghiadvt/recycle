import axiosClient from "@/lib/axiosClient";
import { PageSendType } from "@/types/page";

const pageApi = {
    getPageList(): Promise<any> {
        const url = `/pages`;
        return axiosClient.get(url);
    },
    addPage(data: PageSendType) {
        const url = `/pages`;
        return axiosClient.post(url, data);
    },
    editPage(data: PageSendType) {
        const url = `/pages/${data.id}`;
        return axiosClient.put(url, data);
    },
    deletePage(id: number) {
        const url = `/pages/${id}`;
        return axiosClient.delete(url);
    },
};

export default pageApi;
