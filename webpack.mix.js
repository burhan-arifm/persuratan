const mix = require("laravel-mix");
const path = require("path");

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

mix.webpackConfig({
    resolve: {
        alias: {
            ziggy: path.resolve("vendor/tightenco/ziggy/dist")
        }
    }
});

mix.js("resources/js/core.js", "public/js")
    .js("resources/js/admin.js", "public/js")
    .js("resources/js/form.js", "public/js")
    .extract(["jquery", "popper.js", "bootstrap"], "public/js/vendor.core.js")
    .extract(
        ["dayjs", "vue", "laravel-echo", "pusher-js", "howler", "ziggy"],
        "public/js/vendor.admin.js"
    )
    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/sass/form.scss", "public/css")
    .sass("resources/sass/login.scss", "public/css");
