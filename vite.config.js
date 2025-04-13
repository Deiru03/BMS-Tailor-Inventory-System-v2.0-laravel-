import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                    'resources/js/app.js',
                    'resources/js/product-js/product.js',
                    'resources/js/sales-js/sales.js'
                ],
            refresh: true,
        }),
    ],
});
