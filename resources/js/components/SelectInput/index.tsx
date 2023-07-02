import { Select } from "antd";

type Props = {
    selected?: string;
    setSelected: any;
    placeholder?: string;
    options: {
        value: string;
        label: string;
    }[];
};

const DefaultSelect = ({
    selected,
    setSelected,
    placeholder,
    options,
}: Props) => {
    const handleOnChange = (value) => {
        setSelected(value);
    };

    const filterOption = (input, option) =>
        (option?.label ?? "").includes(input);

    const filterSort = (optionA, optionB) =>
        (optionA?.label ?? "")
            .toLowerCase()
            .localeCompare((optionB?.label ?? "").toLowerCase());

    return (
        <Select
            showSearch
            className="w-full"
            value={selected ?? null}
            placeholder={placeholder ?? ""}
            optionFilterProp="children"
            filterOption={filterOption}
            filterSort={filterSort}
            onChange={handleOnChange}
            options={options}
        />
    );
};

export default DefaultSelect;
