<?php

namespace App\Observers;

use App\Jobs\CalculateUsedDiskSpace;
use App\Jobs\GenerateUrlPreview;
use App\Models\Url;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class UrlObserver
{
    /**
     * Handle the Url "created" event.
     *
     * @param  \App\Models\Url  $url
     * @return void
     */
    public function created(Url $url)
    {
        $queue = [new GenerateUrlPreview($url)];

        if (request()->user()) {
            $queue[] = new CalculateUsedDiskSpace(request()->user());
        }

        Bus::chain($queue)->dispatch();
    }

    /**
     * Handle the Url "deleted" event.
     *
     * @param  \App\Models\Url  $url
     * @return void
     */
    public function deleted(Url $url)
    {
        Storage::delete('urls/' . $url->name . '.jpg');

        if (request()->user()) {
            CalculateUsedDiskSpace::dispatch(request()->user());
        }
    }
}
