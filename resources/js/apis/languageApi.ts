import axiosClient from "@/lib/axiosClient";
import type { Language } from "@/types";

const languageApi = {
    getList(): Promise<Language[]> {
        const url = `/languages`;
        return axiosClient.get(url);
    },
    addLanguage(data) {
        const url = `/languages`;
        return axiosClient.post(url, data);
    },
    editLanguage(data) {
        const url = `/languages`;
        return axiosClient.put(url, data);
    },
    deleteLanguage(id) {
        const url = `/languages`;
        return axiosClient.delete(`${url}/${id}`);
    },
};

export default languageApi;
