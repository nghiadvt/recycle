import axiosClient from "@/lib/axiosClient";
import type { ServiceArticles, PageInfo } from "@/types";

const serviceArticlesApi = {
    addServiceArticles(data) {
        const url = "/service-articles";
        return axiosClient.post(url, data);
    },
    getListServiceArticles({
        queryKey: [_, page = 1],
    }): Promise<PageInfo<ServiceArticles>> {
        const url = "/service-articles";
        return axiosClient.get(url, {
            params: {
                page,
            },
        });
    },
    editServiceArticles(data: ServiceArticles) {
        const url = `/service-articles/${data.id}`;
        return axiosClient.put(url, data);
    },
    deleteServiceArticles(id: number) {
        const url = `/service-articles/${id}`;
        return axiosClient.delete(url);
    },
};

export default serviceArticlesApi;
