import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            buildDirectory: 'build',
            refresh: true,
        }),
    ],
    // server: {
    //     host: '0.0.0.0',
    //     hmr: {
    //         host: 'https://trustsphere-webapp.azurewebsites.net',
    //     },
    // },
    build: {
        outDir: 'public/build',
    },
});
