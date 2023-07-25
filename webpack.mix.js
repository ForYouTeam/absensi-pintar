require('dotenv').config();
const path = require('path')
const webpack = require('webpack');
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
    .vue()
    .webpackConfig({
        // Konfigurasi lainnya...

        // Menggunakan variabel lingkungan
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'src'),
            },
        },
        plugins: [
            new webpack.DefinePlugin({
                'process.env': {
                    VUE_APP_API_URL: JSON.stringify(process.env.VUE_APP_API_URL),
                },
            }),
        ],
    })
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
