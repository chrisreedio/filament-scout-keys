<?php

namespace ChrisReedIO\ScoutKeys\Filament\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ChrisReedIO\ScoutKeys\Filament\FilamentScoutKeys
 */
class FilamentScoutKeys extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ChrisReedIO\ScoutKeys\Filament\FilamentScoutKeys::class;
    }
}
