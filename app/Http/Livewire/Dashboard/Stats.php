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
        return view('dashboard.stats', array_merge([
            'disk' => $this->calculateUsedDiskSpace(),
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
                'urls' => Url::count(),
            ];
        });
    }

    /**
     * Calculates the size and unit of the users used disk space.
     *
     * @return array
     */
    protected function calculateUsedDiskSpace()
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max(request()->user()->disk_space_used, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return [
            'size' => round($bytes, 1),
            'unit' => $units[$pow],
        ];
    }
}
