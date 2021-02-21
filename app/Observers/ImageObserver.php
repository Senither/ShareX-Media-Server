<?php

namespace App\Observers;

use App\Jobs\GenerateImageThumbnail;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageObserver
{
    /**
     * Handle the Image "created" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function created(Image $image)
    {
        GenerateImageThumbnail::dispatch($image);
    }

    /**
     * Handle the Image "deleted" event.
     *
     * @param  \App\Models\Image  $image
     * @return void
     */
    public function deleted(Image $image)
    {
        Storage::delete('images/' . $image->getResourceName());
    }
}
