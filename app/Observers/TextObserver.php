<?php

namespace App\Observers;

use App\Jobs\CalculateUsedDiskSpace;
use App\Models\Text;
use Illuminate\Support\Facades\Cache;

class TextObserver
{
    /**
     * Handle the Text "created" event.
     *
     * @param  \App\Models\Text  $text
     * @return void
     */
    public function created(Text $text)
    {
        Cache::forget('dashboard.stats::' . request()->user()->id);

        CalculateUsedDiskSpace::dispatch(request()->user());
    }

    /**
     * Handle the Text "deleted" event.
     *
     * @param  \App\Models\Text  $text
     * @return void
     */
    public function deleted(Text $text)
    {
        Cache::forget('dashboard.stats::' . request()->user()->id);

        CalculateUsedDiskSpace::dispatch(request()->user());
    }
}
