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
                ->limit(12)
                ->get(),
        ]);
    }
}
