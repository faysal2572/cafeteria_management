import { defineConfig } from 'vite';
import laravel from '@vitejs/plugin-laravel';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
