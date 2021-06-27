<?php

namespace App\Observers;

use App\Jobs\CalculateUsedDiskSpace;
use App\Models\File;
use Cache;
use Storage;

class FileObserver
{
    /**
     * Handle the File "created" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function created(File $file)
    {
        CalculateUsedDiskSpace::dispatch(request()->user());

        Cache::forget('dashboard.stats::' . request()->user()->id);
    }

    /**
     * Handle the File "deleted" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function deleted(File $file)
    {
        Storage::delete('files/' . $file->getResourceName());

        Cache::forget('dashboard.stats::' . request()->user()->id);

        CalculateUsedDiskSpace::dispatch(request()->user());
    }
}
