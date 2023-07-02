import * as Yup from "yup";

export const schemesLogin = Yup.object().shape({
    email: Yup.string().email("Invalid email").required("Email is required"),
    password: Yup.string()
        .required("Password is required")
        .min(6, "This Field requires at least 6 characters"),
});
