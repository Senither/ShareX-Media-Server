<?php

namespace App\Http\Livewire\Files;

use Livewire\Component;

class PaginatedFilesList extends Component
{
    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('files.paginated-files-list');
    }
}
