export type PageType = {
    id: number;
    title: string;
    content: string;
    type: number;
    slug: string;
    created_at: string;
    updated_at: string;
    type_name: string;
};

export type PageSendType = {
    id?: number;
    title: string;
    content: string;
    type: number;
};
