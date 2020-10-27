const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../public').mergeManifest();

mix.js(__dirname + '/Resources/assets/js/app.js', 'js/portfolios.js')
    .sass( __dirname + '/Resources/assets/sass/app.scss', 'css/portfolios.css');

if (mix.inProduction()) {
    mix.version();
}