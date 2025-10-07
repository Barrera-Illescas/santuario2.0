import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import vuetify from 'vite-plugin-vuetify';
import path from 'path';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/app1.js',
                'resources/js/usuario.js',
                'resources/sass/app.scss',
                'resources/css/styles.css',
                'resources/css/styles2.css',
                'resources/css/app.css',
            ],
            refresh: true,
        }),

        vue(),
        vuetify(),
    ],
    resolve: {
        alias: {
            'vue': 'vue/dist/vue.esm-bundler',
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
    build: {
        chunkSizeWarningLimit: 1600,
    },
    css: {
        preprocessorOptions: {
            scss: {
                api: 'modern',
            },
        },
    },
});
