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
                    'resources/js/owl.carousel.min.js',
                    
                    //
                    'resources/css/admincss/style.min.css',
                    'resources/css/admincss/float-chart.css',

                    //
                    'resources/js/adminjs/bootstrap.min.js',
                    'resources/js/adminjs/chart-page-init.js',
                    'resources/js/adminjs/custom.min.js',
                    'resources/js/adminjs/excanvas.js',
                    'resources/js/adminjs/jquery.flot.js',
                    'resources/js/adminjs/jquery.flot.pie.js',
                    'resources/js/adminjs/jquery.flot.time.js',
                    'resources/js/adminjs/jquery.flot.stack.js',
                    'resources/js/adminjs/jquery.flot.crosshair.js',
                    'resources/js/adminjs/jquery.flot.tooltip.js',
                    'resources/js/adminjs/jquery.min.js',
                    'resources/js/adminjs/perfect-scrollbar.jquery.min.js',
                    'resources/js/adminjs/sidebarmenu.js',
                    'resources/js/adminjs/sparkline.js',
                    'resources/js/adminjs/waves.js',],
            refresh: true,
        }),
    ],
});
