<?php

namespace App\Providers;

use App\Models\File;
use App\Models\Image;
use App\Models\Text;
use App\Models\Url;
use App\Observers\FileObserver;
use App\Observers\ImageObserver;
use App\Observers\TextObserver;
use App\Observers\UrlObserver;
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
        Text::observe(TextObserver::class);
        File::observe(FileObserver::class);
        Url::observe(UrlObserver::class);
    }
}
