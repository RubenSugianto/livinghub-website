<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CustomChatify extends Facade
{
    /**
     * Get the registered name of the component in the service container.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'custom-chatify';
    }
}
