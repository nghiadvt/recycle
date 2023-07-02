module.exports = {
    content: [
        "./resources/views/index.blade.php",
        "./resources/js/**/*.{js,ts,jsx,tsx}",
    ],
    theme: {
        extend: {
            screens: {
                tablet: "560px",
            },
        },
    },
    plugins: [],
    corePlugins: {
        preflight: false, // <== disable this!
    },
};
