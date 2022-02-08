const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');


mix.styles([
    'public/assets/vendor/bootstrap/css/bootstrap.min.css',
    'public/assets/vendor/glightbox/css/glightbox.min.css',
    'public/assets/vendor/swiper/swiper-bundle.min.css',
    'public/assets/css/style.css',
], 'public/assets/css/all.css');


mix.scripts([
    'public/assets/vendor/purecounter/purecounter.js',
    'public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
    'public/assets/vendor/glightbox/js/glightbox.min.js',
    'public/assets/vendor/swiper/swiper-bundle.min.js',
    'public/assets/vendor/typed.js/typed.min.js',
    'public/assets/vendor/php-email-form/validate.js',
    'public/assets/js/main.js',
], 'public/assets/js/all.js');
