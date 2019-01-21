<?php
/**
 * Created by PhpStorm.
 * User: bgreenes
 * Date: 2019-01-21
 * Time: 09:35
 */

namespace BenGreenes\LaravelPreset;


use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class Preset extends LaravelPreset
{
    public static function install()
    {
        static::cleanSassDirectory();
        static::updatePackages();
        static::updateMix();
        static::updateScripts();
    }

    public static function cleanSassDirectory()
    {
        File::cleanDirectory(resource_path('sass'));
    }

    public static function updatePackageArray($packages)
    {
        return [
                   'tailwindcss'            => '^0.7.3',
                   'elm-webpack-loader'     => '^5.0.0',
                   'elm-hot-webpack-loader' => '^1.0.2',
                   'prettier'               => '^1.15.3',
                   'prettier-plugin-elm'    => '^0.4.2',
                   'laravel-mix-tailwind'   => '^0.1.0'
               ] + Arr::except($packages, [
                'axios',
                'bootstrap',
                'popper.js',
                'lodash',
                'jquery',

            ]);
    }

    public static function updateMix()
    {
        copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    public static function updateScripts()
    {
        copy(__DIR__.'/stubs/app.js', resource_path('js/app.js'));
        copy(__DIR__.'/stubs/bootstrap.js', resource_path('js/bootstrap.js'));
        File::deleteDirectory(resource_path('js/components'));
        copy(__DIR__.'/stubs/elm.json', base_path('elm.json'));
        File::copyDirectory(__DIR__.'/stubs/elm', resource_path('elm'));

        copy(__DIR__.'/stubs/web.php', base_path('routes/web.php'));
        copy(__DIR__.'/stubs/User.php', app_path('User.php'));

        File::deleteDirectory(resource_path('sass'));
        File::copyDirectory(__DIR__.'/stubs/sass', resource_path('sass'));

        File::cleanDirectory(resource_path('views'));
        copy(__DIR__.'/stubs/index.blade.php', resource_path('views/index.blade.php'));
    }

}
