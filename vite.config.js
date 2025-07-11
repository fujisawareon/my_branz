import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/manager_app.js',
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/css/common.css',
                'resources/scss/manager/main.scss',
            ],
            refresh: true,
        }),
        react(),
    ],
    optimizeDeps: {
        include: ['moment', 'jquery', 'daterangepicker'],
    },
    server: {
        host: true,
        cors: true,
        hmr: {
            host: 'localhost',
        },
    },
});
