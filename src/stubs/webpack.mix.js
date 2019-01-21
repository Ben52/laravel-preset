const mix = require("laravel-mix");
const tailwind = require("laravel-mix-tailwind");


mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css").tailwind();

mix.webpackConfig({
    devServer: {
        disableHostCheck: true
    },
    module: {
        rules: [
            {
                test: /\.elm$/,
                exclude: [/elm-stuff/, /node_modules/],

                use: [
                    { loader: "elm-hot-webpack-loader" },
                    {
                        loader: "elm-webpack-loader",
                        options: {
                            cwd: __dirname
                        }
                    }
                ]
            },
            {
                test: /\.elm$/,
                exclude: [/elm-stuff/, /node_modules/],
                use: {
                    loader: "elm-webpack-loader",
                    options: {}
                }
            }]
    }
});


