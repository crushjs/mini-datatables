<?php

namespace Crushjs\MiniDataTables;

use Illuminate\Support\ServiceProvider;
use Crushjs\MiniDataTables\Console\MakeDataTableCommand;

class MiniDataTablesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('minitable', function () {
            return new MiniDataTables();
        });
    }

    public function boot()
    {
        // views
        $this->loadViewsFrom(
            __DIR__ . '/../resources/views',
            'mini-datatables'
        );

        // publish assets
        $this->publishes([

            __DIR__ . '/../resources/css/table.css' =>
            public_path('vendor/mini-datatables/table.css'),

            __DIR__ . '/../resources/js/table.js' =>
            public_path('vendor/mini-datatables/table.js'),

        ], 'mini-datatables-assets');

        // artisan commands
        if ($this->app->runningInConsole()) {

            $this->commands([
                MakeDataTableCommand::class,
            ]);
        }
    }
}
