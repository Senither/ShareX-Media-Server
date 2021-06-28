<?php

namespace App\Observers;

use App\Jobs\CalculateUsedDiskSpace;
use App\Jobs\GenerateImageThumbnail;
use App\Models\Image;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
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
        $queue = [new GenerateImageThumbnail($image)];

        if (request()->user()) {
            $queue[] = new CalculateUsedDiskSpace(request()->user());
        }

        Bus::chain($queue)->dispatch();
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

        foreach (Image::$supportedSizes as $size) {
            Storage::delete('images/' . $image->getResourceName($size . 'x' . $size));
        }

        if (request()->user()) {
            CalculateUsedDiskSpace::dispatch(request()->user());
        }
    }
}
