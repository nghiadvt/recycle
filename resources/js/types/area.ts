export type AreaListType = {
    id: string;
    zip_no: string;
    zip_no_address: string;
    pref_id: number;
    city_id: number;
    address_no: string;
    address: string;
    addressZipcode: string;
    active: number;
    created_at: string;
    prefecture: Prefecture;
    city: City;
};

type Prefecture = {
    id: string;
    pref_no: string;
    name: string;
    active: number;
    order: number;
};

type City = {
    id: string;
    pref_no: number;
    name: string;
    active: number;
    order: number;
};
