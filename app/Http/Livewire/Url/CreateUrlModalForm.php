<?php

namespace App\Http\Livewire\Url;

use App\Models\Url;
use Livewire\Component;

class CreateUrlModalForm extends Component
{
    /**
     * Determines if the modal should be shown to the user.
     *
     * @var boolean
     */
    public $showModal = false;

    /**
     * The URL that should be shortened.
     *
     * @var string
     */
    public $url;

    /**
     * Handle state changes when the model is toggeled.
     *
     * @param  bool $state
     * @return void
     */
    public function updatedShowModal($state)
    {
        if (!$state) {
            $this->reset('url');
        }
    }

    /**
     * Handles validation the URL and saving the new shorten URL.
     *
     * @return void
     */
    public function save()
    {
        $this->validate([
            'url' => ['string', 'url'],
        ]);

        $url = Url::createAndSave($this->url);

        session()->flash('upload-url', $url->resource_url);

        $this->reset('url');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('url.create-url-modal-form');
    }
}
