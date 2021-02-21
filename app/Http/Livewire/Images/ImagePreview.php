<?php

namespace App\Http\Livewire\Images;

use Livewire\Component;

class ImagePreview extends Component
{
    /**
     * The image the component previews.
     *
     * @var \App\Models\Image
     */
    public $image;

    /**
     * Deletes the image associated with the component.
     *
     * @return void
     */
    public function delete()
    {
        $this->image->delete();

        $this->emitUp('imageDeleted');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('images.image-preview', [
            'image' => $this->image,
        ]);
    }
}
