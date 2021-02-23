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
                ->limit($this->getImagesPerPageSize())
                ->get(),
        ]);
    }

    /**
     * Gets the images that should be shown per page, and divides
     * it by half, if the value is larger than 12 we just cap
     * the images shown per page by 12.
     *
     * @return int
     */
    protected function getImagesPerPageSize()
    {
        return min(app('settings')->get('images.per_page') / 2, 12);
    }
}
