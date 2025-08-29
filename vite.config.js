import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/loader.css',
                'resources/css/video-player.css',
                'resources/js/editor/controls-handler.js',
                'resources/js/editor/export-handler.js',
                'resources/js/editor/file-handler.js',
                'resources/js/editor/file-upload.js',
                'resources/js/editor/toggle-handler.js',
                'resources/js/app.js',
                'resources/js/date-handler.js',
                'resources/js/delete-handler.js',
                'resources/js/faq-handler.js',
                'resources/js/follow-handler.js',
                'resources/js/infiniteScroll.js',
                'resources/js/like-handler.js',
                'resources/js/number-handler.js',
                'resources/js/save-handler.js',
                'resources/js/search-handler.js',
                'resources/js/video-player.js',
                'resources/js/vid-click-handler.js',
            ],
            refresh: true,
            base: '/'
        }),
    ],
});
