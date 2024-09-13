<?php

namespace ChrisReedIO\ScoutKeys\Filament;

use ChrisReedIO\ScoutKeys\Filament\Resources\SearchKeyResource;
use Filament\Contracts\Plugin;
use Filament\Panel;

class FilamentScoutKeysPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-scout-keys';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            SearchKeyResource::class,
        ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
