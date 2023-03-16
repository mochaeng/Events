import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/main.css",
                "resources/js/app.js",
                "resources/js/showPage.js",
            ],
            refresh: [...refreshPaths, "app/Http/Livewire/**"],
        }),
    ],
});
