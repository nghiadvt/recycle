import logger from "redux-logger";

import { configureStore } from "@reduxjs/toolkit";
import authReducer from "@/pages/Login/store/authSlice";
import messageReducer from "@/pages/Login/store/messageSlice";

const store = configureStore({
    reducer: {
        auth: authReducer,
        message: messageReducer,
    },
    middleware: (getDefaultMiddleware) => getDefaultMiddleware().concat(logger),
});

export default store;

// Infer the `RootState` and `AppDispatch` types from the store itself
export type RootState = ReturnType<typeof store.getState>;
// Inferred type: {posts: PostsState, comments: CommentsState, users: UsersState}
export type AppDispatch = typeof store.dispatch;
