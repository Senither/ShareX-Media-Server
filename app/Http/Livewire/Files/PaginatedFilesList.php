<?php

namespace App\Http\Livewire\Files;

use App\Models\File;
use Livewire\Component;
use Livewire\WithPagination;

class PaginatedFilesList extends Component
{
    use WithPagination;

    /**
     * The events the component should listen for.
     *
     * @var array
     */
    protected $listeners = ['fileDeleted' => '$refresh'];

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('files.paginated-files-list', [
            'files' => File::latest()->paginate(app('settings')->get('files.per_page')),
        ]);
    }
}
