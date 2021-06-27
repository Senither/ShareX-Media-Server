<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions([
            'image:upload',
            'text:upload',
            'url:upload',
            'file:upload',
        ]);

        Jetstream::permissions([
            'image:view',
            'image:list',
            'image:upload',
            'image:delete',
            'text:view',
            'text:list',
            'text:upload',
            'text:delete',
            'url:view',
            'url:list',
            'url:upload',
            'url:delete',
            'file:view',
            'file:list',
            'file:upload',
            'file:delete',
        ]);
    }
}
