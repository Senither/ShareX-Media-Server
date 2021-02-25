<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Impostering
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$this->isValidImposterRequest($request)) {
            return $next($request);
        }

        if (Str::startsWith($request->route()->uri(), 'user/')) {
            return abort(403, 'You cant view user profile pages while impersonating a user.');
        }

        $imposter = User::find(session('imposter_id'));

        if ($imposter == null) {
            return $next($request);
        }

        // Runs the middleware chain as an imposter, and then resets back
        // to the original user after the request has been processed.
        return $this->runAsImposter(function () use ($request, $next) {
            return $next($request);
        }, $request, $imposter);
    }

    /**
     * Checks if the current request is a valid imposter request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    protected function isValidImposterRequest(Request $request): bool
    {
        return $request->user() !== null
            && session('imposter_id') !== null
            && $request->route()->getName() != 'livewire.message';
    }


    /**
     * Runs the closure as an imposter, and then resets the request user
     * back to the orignal after the closure has been processed.
     *
     * @param  \Closure $callable
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User $imposter
     * @return mixed
     */
    protected function runAsImposter(Closure $callable, Request $request, User $imposter)
    {
        $originalUser = $request->user();

        $this->setRequestUser($request, $imposter);

        $response = $callable();

        $this->setRequestUser($request, $originalUser);

        return $response;
    }

    /**
     * Sets the given user to the request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     */
    protected function setRequestUser(Request $request, User $user): void
    {
        $request->merge(compact('user'));

        $request->setUserResolver(function () use ($user) {
            return $user;
        });
    }
}
