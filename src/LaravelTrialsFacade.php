<?php

namespace Dukevomv\LaravelTrials;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Dukevomv\LaravelTrials\LaravelTrials
 */
class LaravelTrialsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-trials';
    }
}
