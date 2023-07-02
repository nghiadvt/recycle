export type Garbage = {
    id: number;
    name: string;
    slug: string;
    description: string;
    active: number;
    parent_id: number;
    service_garbage_contents: any;
    created_at: string;
};

export type GarbageType = {
    id: number;
    name: string;
    description: string;
    active: string;
    price: string;
    created_at: string;
    updated_at: string;
    icon: string;
    URLImage: string;
    unit: string;
    container_garbage_types: any;
};
