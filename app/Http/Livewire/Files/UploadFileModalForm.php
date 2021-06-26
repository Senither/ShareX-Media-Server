<?php

namespace App\Http\Livewire\Files;

use Livewire\Component;

class UploadFileModalForm extends Component
{
    /**
     * Determines if the modal should be shown to the user.
     *
     * @var boolean
     */
    public $showModal = false;

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('files.upload-file-modal-form');
    }
}
