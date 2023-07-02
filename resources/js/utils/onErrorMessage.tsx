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
