import axiosClient from "@/lib/axiosClient";

const categoryApi = {
    getCategoriesList({ queryKey: [_, page = 1] }): Promise<any> {
        const url = `/service-categories`;
        return axiosClient.get(url, { params: { page } });
    },
    addCategoriesList(data) {
        const url = `/service-categories`;
        return axiosClient.post(url, data);
    },
    editCategoriesList(data) {
        const url = `/service-categories/` + data.id;
        return axiosClient.put(url, data);
    },
    deleteCategoriesList(id) {
        const url = `/service-categories`;
        return axiosClient.delete(`${url}/${id}`);
    },
};

export default categoryApi;
