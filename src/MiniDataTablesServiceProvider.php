<?php

namespace Crushjs\MiniDataTables;

use Illuminate\Support\ServiceProvider;

class MiniDataTablesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('minitable', function () {
            return new MiniDataTables();
        });
    }
}
