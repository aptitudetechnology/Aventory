const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    mode: "jit",
    purge: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    daisyui: {
        themes: [
            {
                mytheme: {
                    primary: "#15803d",
                    "primary-focus": "#15803d",
                    "primary-content": "#ffffff",
                    secondary: "#5f646d",
                    "secondary-focus": "#303541",
                    "secondary-content": "#ffffff",
                    accent: "#3b82f6",
                    "accent-focus": "#1d4ed8",
                    "accent-content": "#ffffff",
                    neutral: "#3d4451",
                    "neutral-focus": "#2a2e37",
                    "neutral-content": "#ffffff",
                    "base-100": "#ffffff",
                    "base-200": "#f9fafb",
                    "base-300": "#d1d5db",
                    "base-content": "#1f2937",
                    info: "#2094f3",
                    success: "#22c55e",
                    warning: "#facc15",
                    error: "#dc2626",
                },
            },
        ],
    },
    variants: {
        extend: {
            opacity: ["disabled"],
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("daisyui"),
    ],
};
