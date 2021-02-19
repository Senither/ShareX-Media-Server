<?php

namespace App\Observers;

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
        // TODO: Generate thumbnail here
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
