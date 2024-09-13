<?php

namespace ChrisReedIO\FilamentScoutKeys\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ChrisReedIO\FilamentScoutKeys\FilamentScoutKeys
 */
class FilamentScoutKeys extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ChrisReedIO\FilamentScoutKeys\FilamentScoutKeys::class;
    }
}
