<?php

namespace App\Http\Livewire;

use App\Models\Image;
use Livewire\Component;
use Livewire\WithPagination;

class PaginatedImageList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('images.paginated-image-list')
            ->withImages(Image::latest()->paginate(24));
    }
}
