<?php

namespace App\Http\Livewire\Url;

use Livewire\Component;

class UrlPreview extends Component
{
    /**
     * The url the component previews.
     *
     * @var \App\Models\Url
     */
    public $url;

    /**
     * Deletes the url associated with the component.
     *
     * @return void
     */
    public function delete()
    {
        $this->url->delete();

        $this->emitUp('urlDeleted');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('url.url-preview', [
            'url' => $this->url,
        ]);
    }
}
