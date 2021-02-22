<?php

namespace App\Http\Livewire\Images;

use App\Models\Image;
use Livewire\Component;
use Livewire\WithPagination;

class PaginatedImageList extends Component
{
    use WithPagination;

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
        return view('images.paginated-image-list', [
            'images' => Image::latest()->paginate(app('settings')->get('images.per_page')),
        ]);
    }
}
