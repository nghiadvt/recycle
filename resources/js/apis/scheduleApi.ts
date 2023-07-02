import axiosClient from "@/lib/axiosClient";
import { PageInfo, Schedule, ScheduleDay } from "@/types";

const scheduleApi = {
    getList({
        queryKey: [_, page = 1, { ...valueFilter }],
    }): Promise<PageInfo<Schedule>> {
        const url = "/schedules";
        return axiosClient.get(url, {
            params: {
                page,
                ...valueFilter,
            },
        });
    },
    addSchedule(data) {
        const url = `/schedules`;
        return axiosClient.post(url, data);
    },
    editSchedule(data) {
        const url = `/schedules/${data.id}`;
        return axiosClient.put(url, data);
    },
    deleteSchedule(id) {
        const url = `/schedules/${id}`;
        return axiosClient.delete(url);
    },
};

export default scheduleApi;
