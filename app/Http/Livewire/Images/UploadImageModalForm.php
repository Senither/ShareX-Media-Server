<?php

namespace App\Http\Livewire\Images;

use App\Models\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadImageModalForm extends Component
{
    use WithFileUploads;

    /**
     * Determines if the modal should be shown to the user.
     *
     * @var boolean
     */
    public $showModal = false;

    /**
     * The image that should be uploaded.
     *
     * @var mixed
     */
    public $image = null;

    /**
     * Handle state changes when the model is toggeled.
     *
     * @param  bool $state
     * @return void
     */
    public function updatedShowModal($state)
    {
        if (!$state) {
            $this->reset('image');
        }
    }

    /**
     * Handle image validation when images are uploaded.
     *
     * @param  \Livewire\TemporaryUploadedFile  $image
     * @return void
     */
    public function updatedImage($image)
    {
        $extension = pathinfo($image->getFilename(), PATHINFO_EXTENSION);
        if (!in_array($extension, ['jpeg', 'png', 'jpg', 'gif'])) {
            $this->reset('image');
        }

        $this->validate([
            'image' => ['image', 'mimes:jpeg,png,jpg,gif'],
        ]);
    }

    /**
     * Handles uploading and saving the image.
     *
     * @return
     */
    public function save()
    {
        if ($this->image) {
            $image = Image::createAndSave($this->image);

            session()->flash('upload-url', $image->resource_url);
        }

        $this->reset('image');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('images.upload-image-modal-form');
    }
}
