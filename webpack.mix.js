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
    
    mix.copy('node_modules/ckeditor4/adapters', 'public/ckeditor/adapters');
    mix.copy('node_modules/ckeditor4/lang', 'public/ckeditor/lang');
    mix.copy('node_modules/ckeditor4/plugins', 'public/ckeditor/plugins');
    mix.copy('node_modules/ckeditor4/skins', 'public/ckeditor/skins');
    mix.copy('node_modules/ckeditor4/vendor', 'public/ckeditor/vendor');
    mix.copy('node_modules/ckeditor4/styles.js', 'public/ckeditor/styles.js');
    mix.copy('node_modules/ckeditor4/package.json', 'public/ckeditor/package.json');
    mix.copy('node_modules/ckeditor4/ckeditor.js', 'public/ckeditor/ckeditor.js');
    mix.copy('node_modules/ckeditor4/composer.json', 'public/ckeditor/composer.json');
    mix.copy('node_modules/ckeditor4/contents.css', 'public/ckeditor/contents.css');