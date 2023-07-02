export enum Action {
    Add = "add",
    Edit = "edit",
}

export enum Status {
    Active = 1,
    Inactive = 0,
}

export type PageInfo<T> = {
    current_page: number;
    data: T[];
    total_item: number;
    total_page: number;
};
