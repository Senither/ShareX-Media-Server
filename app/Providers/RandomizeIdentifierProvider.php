<?php

namespace App\Providers;

use App\Identifier\IdentifierContract;
use App\Identifier\StringIdentifier;
use App\Identifier\WordlistIdentifier;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class RandomizeIdentifierProvider extends ServiceProvider
{
    /**
     * The list of identifier generators.
     *
     * @var array
     */
    protected $generators = [
        'wordlist' => WordlistIdentifier::class,
        'characters' => StringIdentifier::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IdentifierContract::class, function ($app) {
            $selectedGenerator = app('settings')->get('app.url_generator');

            if (array_key_exists($selectedGenerator, $this->generators)) {
                return new $this->generators[$selectedGenerator]();
            }

            if ($selectedGenerator == 'random') {
                return app()->make(Arr::random($this->generators));
            }

            return new StringIdentifier();
        });
    }
}
