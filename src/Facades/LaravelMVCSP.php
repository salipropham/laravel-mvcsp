<?php

namespace SaliproPham\LaravelMVCSP\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelMVCSP extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravelmvcsp';
    }
}
