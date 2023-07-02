import { AreaListType, GarbageType } from "@/types";
export type Schedule = {
    id: number;
    date_start_at: string;
    date_end_at: string;
    time_start_at: string;
    time_end_at: string;
    active: number;
    area_id: number;
    created_at: string;
    area: AreaListType;
    day_status: string;
    is_repeat: number;
    day: string;
    day_of_week: number;
    garbage_type_schedules: GarbageTypeSchedule[];
};

type GarbageTypeSchedule = {
    id: number;
    garbage_type_id: number;
    schedule_day: ScheduleDay;
    garbage_type: GarbageType;
};

export type ScheduleDay = {
    id: number;
    day_of_week: string;
    dayStatus: string;
};
