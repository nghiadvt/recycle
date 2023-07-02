export type CategoryType = {
    id: number;
    title: string;
    slug: string;
    description: string;
    status: boolean;
    created_at: string;
    updated_at: string;
};

export type Service = {
    id: number;
    title: string;
    slug: string;
    image_url?: string;
    content?: string;
    description?: string;
    active: number;
    created_at: string;
    updated_at?: string;
    URLImage?: string;
};

export type ServiceArticles = {
    id: number;
    title: string;
    parent_id: string;
    slug: string;
    description: string;
    active: number;
    created_at: string;
};
