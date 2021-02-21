const mix = require("laravel-mix");

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

mix.react("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .extract(["react", "react-dom"])
    .webpackConfig({
        resolve: {
            alias: {
                "@components": path.resolve(
                    __dirname,
                    "resources/js/components/"
                ),
                "@utils": path.resolve(__dirname, "resources/js/utils/"),
                "@sass": path.resolve(__dirname, "resources/sass/")
            }
        }
    });
