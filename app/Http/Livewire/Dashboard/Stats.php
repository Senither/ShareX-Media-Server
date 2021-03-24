<?php

namespace App\Http\Livewire\Dashboard;

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
        return view(
            'dashboard.stats',
            Cache::remember($this->getCacheKey(), 60 * 15, function () {
                return [
                    'images' => Image::count(),
                    'texts' => Text::count(),
                    'urls' => Url::count(),
                ];
            })
        );
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
}
