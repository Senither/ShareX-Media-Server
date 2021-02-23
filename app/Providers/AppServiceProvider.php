<?php

namespace App\Providers;

use App\Models\Image;
use App\Observers\ImageObserver;
use App\Settings\SettingsManager;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('settings', function () {
            return new SettingsManager();
        });

        Image::observe(ImageObserver::class);
    }
}
