import { createSlice } from "@reduxjs/toolkit";
import { notification } from "antd";
import { createAsyncThunk } from "@reduxjs/toolkit";

import * as apiServices from "../services";

export const login = createAsyncThunk("auth/login", async (payload: any) => {
    try {
        const { callback } = payload;
        const response: any = await apiServices.login(payload);
        localStorage.setItem("user", JSON.stringify(response));
        callback();
        return response;
    } catch (error: any) {
        notification.error({
            message: error?.response?.data.message,
            duration: 2,
        });
    }
});

export const logout = createAsyncThunk("auth/logout", async () => {
    await apiServices.logout();
    localStorage.removeItem("user");
    window.location.replace("/login");
});

const authSlice = createSlice({
    name: "auth",
    initialState: {
        admin: null,
        isLoading: false,
        isLoggedIn: false,
    },
    reducers: {},
    extraReducers: (builder) => {
        builder.addCase(login.pending, (state) => {
            state.isLoading = true;
        });
        builder.addCase(login.fulfilled, (state, action) => {
            state.isLoading = false;
            state.isLoggedIn = true;
            state.admin = action.payload;
        });
        builder.addCase(login.rejected, (state, action) => {
            state.isLoading = false;
            state.isLoggedIn = false;
        });
        builder.addCase(logout.fulfilled, (state, action) => {
            state.isLoggedIn = false;
            state.admin = null;
        });
    },
});

export default authSlice.reducer;
