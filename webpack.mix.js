const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);
mix.js('resources/js/welcome.js', 'public/js')
    .css('resources/css/welcome.css', 'public/css');

mix.js('resources/js/garbageCan.js', 'public/js')
    .css('resources/css/garbageCan.css', 'public/css');

if (mix.inProduction()) {
    mix.version();
}
