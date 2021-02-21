<?php

namespace App\Providers;

use App\Identifier\IdentifierContract;
use App\Identifier\SentenceIdentifier;
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
            // TODO: Check for settings value here and return
            // the identifier the user wants to use.
            $settingsValue = 'string';

            switch ($settingsValue) {
                case 'sentence':
                    return new SentenceIdentifier();

                default:
                    return new StringIdentifier();
            }
        });
    }
}
