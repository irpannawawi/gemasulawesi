import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import {viteStaticCopy} from 'vite-plugin-static-copy';
export default defineConfig({
    plugins: [
        viteStaticCopy({
            targets: [
              { src: 'node_modules/tinymce/**/*', dest: 'public/js/tinymce' },
            ],
            verbose: true,
          }),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/footer-editorial.js',
                'resources/js/footer.js',
                'resources/js/select2.js',
                'resources/js/tempus.js',
            ],
            refresh: true,
        }),
    ],
});
