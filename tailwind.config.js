import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    darkMode: "class",

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                gov: {
                    primary: "#003DA5", // Biru pemerintah
                    secondary: "#D32F2F", // Merah
                    accent: "#FFC107", // Kuning
                    light: "#F5F5F5", // Abu-abu terang
                    dark: "#1F1F1F", // Abu-abu gelap
                },
            },
        },
    },

    plugins: [forms, require("daisyui")],
};
