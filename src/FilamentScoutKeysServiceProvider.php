<?php

namespace ChrisReedIO\ScoutKeys\Filament;

use ChrisReedIO\ScoutKeys\Filament\Commands\FilamentScoutKeysCommand;
use ChrisReedIO\ScoutKeys\Filament\Testing\TestsFilamentScoutKeys;
use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentScoutKeysServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-scout-keys';

    public static string $viewNamespace = 'filament-scout-keys';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('chrisreedio/filament-scout-keys');
            });

        // $configFileName = $package->shortName();
        $configFileName = 'scout-keys-filament';

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile('scout-keys-filament');
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/filament-scout-keys/{$file->getFilename()}"),
                ], 'filament-scout-keys-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsFilamentScoutKeys);
    }

    protected function getAssetPackageName(): ?string
    {
        return 'chrisreedio/filament-scout-keys';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('filament-scout-keys', __DIR__ . '/../resources/dist/components/filament-scout-keys.js'),
            // Css::make('filament-scout-keys-styles', __DIR__ . '/../resources/dist/filament-scout-keys.css'),
            // Js::make('filament-scout-keys-scripts', __DIR__ . '/../resources/dist/filament-scout-keys.js'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            // FilamentScoutKeysCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_filament-scout-keys_table',
        ];
    }
}
