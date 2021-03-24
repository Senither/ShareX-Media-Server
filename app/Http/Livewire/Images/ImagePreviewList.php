<?php

namespace App\Http\Livewire\Images;

use App\Models\Image;
use Livewire\Component;

class ImagePreviewList extends Component
{
    /**
     * The events the component should listen for.
     *
     * @var array
     */
    protected $listeners = ['imageDeleted' => '$refresh'];

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('images.image-preview-list', [
            'images' => Image::latest()
                ->limit(6)
                ->get(),
        ]);
    }
}
