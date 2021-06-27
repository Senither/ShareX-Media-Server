<?php

namespace App\Http\Livewire\Files;

use App\Models\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFileModalForm extends Component
{
    use WithFileUploads;

    /**
     * Determines if the modal should be shown to the user.
     *
     * @var boolean
     */
    public $showModal = false;


    /**
     * The file that should be uploaded.
     *
     * @var mixed
     */
    public $file = null;

    /**
     * Hydrates the component.
     *
     * @return void
     */
    public function hydrate()
    {
        $this->resetErrorBag();
    }

    /**
     * Handle state changes when the model is toggled.
     *
     * @param  bool $state
     * @return void
     */
    public function updatedShowModal($state)
    {
        if (!$state) {
            $this->resetErrorBag();
        }
    }

    /**
     * Handles uploading and saving the file.
     *
     * @return
     */
    public function save()
    {
        $this->resetErrorBag();

        if ($this->file) {
            $file = File::createAndSave($this->file);

            session()->flash('upload-url', $file->resource_url);
        }

        $this->reset('file');
    }

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
