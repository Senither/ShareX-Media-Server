<?php

namespace App\Providers;

use App\Identifier\IdentifierContract;
use App\Identifier\WordlistIdentifier;
use App\Identifier\StringIdentifier;
use Illuminate\Support\ServiceProvider;

class RandomizeIdentifierProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IdentifierContract::class, function ($app) {
            switch (app('settings')->get('app.url_generator')) {
                case 'wordlist':
                    return new WordlistIdentifier();

                default:
                    return new StringIdentifier();
            }
        });
    }
}
