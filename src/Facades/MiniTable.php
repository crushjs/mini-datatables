<?php

namespace Crushjs\MiniDataTables\Facades;

use Illuminate\Support\Facades\Facade;

class MiniTable extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'minitable';
    }
}
