import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import reactRefresh from "@vitejs/plugin-react-refresh";
export default defineConfig({
    plugins: [
        laravel(["resources/js/app.tsx","resources/css/app.css"]),
        reactRefresh({
            // Exclude storybook stories and node_modules
            exclude: [/\.stories\.(t|j)sx?$/, /node_modules/],
            // Only .tsx files
            include: "**/*.tsx",
        }),
    ],
    resolve: {
        mainFields: [],
    },
});
