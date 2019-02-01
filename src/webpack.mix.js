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
    .sass('resources/sass/app.scss', 'public/css');

mix.sass('resources/sass/layout_platform.scss', 'public/css');
mix.sass('resources/sass/layout_app.scss', 'public/css');
mix.sass('resources/sass/layout_questions.scss', 'public/css');
mix.sass('resources/sass/layout_splash.scss', 'public/css');
mix.sass('resources/sass/content_blocks.scss', 'public/css');
mix.sass('resources/sass/grid.scss', 'public/css');
mix.sass('resources/sass/containers.scss', 'public/css');
mix.sass('resources/sass/questions.scss', 'public/css');
mix.sass('resources/sass/splashes.scss', 'public/css');


mix.js('resources/js/sidebar_admin.js', 'public/js');
mix.js('resources/js/sidebar_app.js', 'public/js');
mix.js('resources/js/tableControls.js', 'public/js');
mix.js('resources/js/behaviour.js', 'public/js');
mix.js('resources/js/appBehaviour.js', 'public/js');
mix.js('resources/js/platformBehaviour.js', 'public/js');
mix.js('resources/js/splashBehaviour.js', 'public/js');
