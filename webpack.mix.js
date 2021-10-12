const mix = require('laravel-mix');
const tailwindcss = require("tailwindcss");
require('laravel-mix-purgecss');

mix.js('resources/js/app.js', 'public/js').vue()
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        postCss: [ tailwindcss('./tailwind.config.js') ],
    })
    .webpackConfig(require('./webpack.config'))
    .purgeCss()
    // .browserSync('http://127.0.0.1:8000/')
    .disableNotifications();

if (mix.inProduction()) {
    mix.version();
}
