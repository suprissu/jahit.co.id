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

mix.react("resources/js/app.js", "public/js").sass(
    "resources/sass/app.scss",
    "public/css"
);

mix.webpackConfig({
    output: { chunkFilename: "assets/next/js/[name].js?id=[chunkhash]" },
    resolve: {
        alias: {
            //adding react and react-dom may not be necessary for you but it did fix some issues in my setup.
            react: path.resolve("node_modules/react"),
            "react-dom": path.resolve("node_modules/react-dom"),

            "@components": path.resolve("resources/js/components"),
            "@utils": path.resolve("resources/js/utils"),
            "@sass": path.resolve("resources/sass")
        }
    }
});
