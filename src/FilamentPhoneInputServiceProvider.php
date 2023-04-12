<?php

namespace Ysfkaya\FilamentPhoneInput;


use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\AssetManager;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentPhoneInputServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-phone-input')
            ->hasViews()
            ->hasRoute('web');
    }



    protected array $beforeCoreScripts = [
        'filament-phone-input' => __DIR__.'/../dist/js/filament-phone-input.js',
    ];

    protected array $scripts = [
        'intl-tel-input-utils' => __DIR__.'/../dist/intl-tel-input/utils.js',
    ];

    public function packageRegistered(): void
    {
        $this->app->resolving(AssetManager::class, function () {
            \Filament\Support\Facades\FilamentAsset::register([
                Css::make('filament-phone-input', __DIR__.'/../dist/css/filament-phone-input.css'),
                Css::make('intl-tel-input', __DIR__.'/../dist/css/intl-tel-input.css'),
                AlpineComponent::make('filament-phone-input', __DIR__.'/../dist/js/filament-phone-input.js'), //TODO compile to module
                Js::make('intl-tel-input-utils', __DIR__.'/../dist/intl-tel-input/utils.js'),
            ], 'tanthammar/filament-extras');

        });
    }
}
