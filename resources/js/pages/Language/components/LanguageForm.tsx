import { useMutation, useQueryClient } from "@tanstack/react-query";
import { useEffect, useState } from "react";
import { Button } from "antd";
import languageApi from "@/apis/languageApi";
import DefaultSelect from "@/components/SelectInput";

import { Action } from "@/types";

type Props = {
    rowSelected?: string;
    action: Action;
};

const LanguageForm = ({ rowSelected, action }: Props) => {
    const queryClient = useQueryClient();
    const [selected, setSelected] = useState(rowSelected ?? "");

    useEffect(() => {
        setSelected(rowSelected!);
    }, [rowSelected]);

    const mutation = useMutation({
        mutationFn:
            action === Action.Add
                ? languageApi.addLanguage
                : languageApi.editLanguage,
        onSuccess: () => {
            queryClient.invalidateQueries({ queryKey: ["languages"] });
        },
    });

    const handleOnSubmit = () => mutation.mutate(selected);
    return (
        <div className="max-w-[600px] max-h-[300px] bg-white p-4 min-w-[400px] rounded-xl">
            <div>
                <h1 className="capitalize">{action.toLowerCase()} language</h1>
                <DefaultSelect
                    selected={selected}
                    setSelected={setSelected}
                    options={[]}
                />
                <Button
                    type="primary"
                    className="w-full bg-[#3f4aeb] h-[45px] mt-[15px]"
                    onClick={handleOnSubmit}
                >
                    Continue
                </Button>
            </div>
        </div>
    );
};

export default LanguageForm;
