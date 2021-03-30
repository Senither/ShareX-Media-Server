<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Senither\VersionComparison\Facades\Version;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.app', function ($view) {
            $view->with('version', Version::getCurrentVersion());
        });
    }
}
