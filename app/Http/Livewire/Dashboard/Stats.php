<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\File;
use App\Models\Image;
use App\Models\Text;
use App\Models\Url;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Stats extends Component
{
    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('dashboard.stats', array_merge([
            'disk' => \convertByteToHuman(request()->user()->disk_space_used),
        ], $this->getStats()));
    }

    /**
     * Generate a unique cache key for the signed in user.
     *
     * @return string
     */
    protected function getCacheKey()
    {
        return 'dashboard.stats::' . request()->user()->id;
    }

    /**
     * Gets the stats for the signed in user.
     *
     * @return array
     */
    protected function getStats()
    {
        return Cache::remember($this->getCacheKey(), now()->addDay(), function () {
            return [
                'images' => Image::count(),
                'texts' => Text::count(),
                'files' => File::count(),
                'urls' => Url::count(),
            ];
        });
    }
}
