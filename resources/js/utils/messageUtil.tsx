import { notification } from "antd";
import { AxiosError } from "axios";

export const onErrorMessage = (error: unknown, defaultMsg: string) => {
    const errorMessage =
        error instanceof AxiosError
            ? error?.response?.data.message
            : defaultMsg;

    notification.error({
        message: errorMessage,
        duration: 2,
    });
};

export const onSuccessMessage = (type: string, feature: string) => {
    notification.success({
        message: `${type} ${feature} Successfully`,
        duration: 2,
        className: "capitalize",
    });
};
