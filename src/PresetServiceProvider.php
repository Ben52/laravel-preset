<?php

namespace BenGreenes\LaravelPreset;


use Illuminate\Foundation\Console\PresetCommand;
use Illuminate\Support\ServiceProvider;

class PresetServiceProvider extends ServiceProvider
{


    public function boot() {
        PresetCommand::macro('elm', function($command) {
            Preset::install();

            $command->info('Elm and tailwind installed successfully');
            $command->comment('run `composer require laravel/passport`');
            $command->comment('run `yarn`');
            $command->comment('run `./node_modules/.bin/tailwind init`');
        });
    }

}
