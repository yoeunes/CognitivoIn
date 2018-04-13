let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 // .sass('resources/assets/sass/app.scss', 'public/css')
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/scss/main.scss', 'public/css').webpackConfig({
    resolve: {
        modules: [
            path.resolve(__dirname, 'vendor/laravel/spark-aurelius/resources/assets/js'),
            'node_modules',
          
        ],
        alias: {
            'vue$': 'vue/dist/vue.js'
        }
    }
});;
