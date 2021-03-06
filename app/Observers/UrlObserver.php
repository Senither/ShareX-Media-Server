<?php

namespace App\Observers;

use App\Jobs\GenerateUrlPreview;
use App\Models\Url;
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
        GenerateUrlPreview::dispatch($url);
    }

    /**
     * Handle the Url "deleted" event.
     *
     * @param  \App\Models\Url  $url
     * @return void
     */
    public function deleted(Url $url)
    {
        Storage::delete('urls/' . $image->name . '.jpg');
    }
}