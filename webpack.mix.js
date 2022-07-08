const mix = require('laravel-mix');
let minifier = require('minifier');

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
        //
    ]);

minifier.minify('public/css/style.css');
minifier.minify('public/after_login/new_ui/css/style.css');
minifier.minify('public/after_login/new_ui/css/exam-analytics.css');
minifier.minify('public/after_login/new_ui/css/exampage.css');
minifier.minify('public/after_login/new_ui/css/responsive.css');
minifier.minify('public/after_login/new_ui/css/tab-responsive.css');
minifier.minify('public/after_login/new_ui/css/mobile-responsive.css');
/********** current css **********/
minifier.minify('public/after_login/current_ui/css/style.css');
minifier.minify('public/after_login/current_ui/css/page_clander.css');
minifier.minify('public/after_login/current_ui/css/custom_clander.css');
minifier.minify('public/after_login/current_ui/css/theme_clander.css');
minifier.minify('public/after_login/current_ui/css/mobile.css');