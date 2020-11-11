<?php

namespace Rpg\Facades;

use Illuminate\Support\Facades\Facade;

class Rpg extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'rpg';
    }
}
