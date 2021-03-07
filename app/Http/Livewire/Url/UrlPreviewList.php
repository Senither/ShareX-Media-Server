<?php

namespace App\Http\Livewire\Url;

use App\Models\Url;
use Livewire\Component;

class UrlPreviewList extends Component
{
    /**
     * The events the component should listen for.
     *
     * @var array
     */
    protected $listeners = ['urlDeleted' => '$refresh'];

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('url.url-preview-list', [
            'urls' => Url::latest()
                ->limit($this->getUrlsPerPageSize())
                ->get(),
        ]);
    }

    /**
     * Gets the amount of shorten URLs that should be shown per page, and
     * divides it by half, if the value is larger than 12 we just cap
     * the urls shown per page at 12.
     *
     * @return int
     */
    protected function getUrlsPerPageSize()
    {
        return min(app('settings')->get('urls.per_page') / 2, 12);
    }
}
