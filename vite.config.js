import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/bootstrap-icons.css',
                    'resources/css/app.css',
                    'resources/css/bootstrap.min.css',
                    'resources/css/owl.carousel.min.css',
                    'resources/css/owl.theme.default.min.css',
                    'resources/css/tooplate-gotto-job.css',

                    'resources/js/bootstrap.min.js',
                    'resources/js/app.js',
                    'resources/js/counter.js',
                    'resources/js/custom.js',
                    'resources/js/jquery.min.js',
                    'resources/js/owl.carousel.min.js'],
            refresh: true,
        }),
    ],
});
