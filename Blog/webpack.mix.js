const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../public').mergeManifest();

mix.js(__dirname + '/Resources/assets/js/app.js', 'vendor/wink/app.js')
    .sass(__dirname + '/Resources/assets/sass/light.scss', 'vendor/wink', {}, [tailwindcss('./light.js')]);

if (mix.inProduction()) {
    mix.version();
}
