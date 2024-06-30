/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class", // or 'media' if you prefer that
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        // Add paths to your views and components here
    ],
    theme: {
        extend: {},
    },
    plugins: [],
};
