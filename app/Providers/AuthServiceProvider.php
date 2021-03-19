<?php

namespace App\Providers;

use App\Models\Image;
use App\Models\Text;
use App\Models\Url;
use App\Policies\ImagePolicy;
use App\Policies\TextPolicy;
use App\Policies\UrlPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Image::class => ImagePolicy::class,
        Text::class => TextPolicy::class,
        Url::class => UrlPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
