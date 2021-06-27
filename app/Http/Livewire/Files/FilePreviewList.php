<?php

namespace App\Http\Livewire\Files;

use App\Models\File;
use Livewire\Component;

class FilePreviewList extends Component
{
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
        return view('files.file-preview-list', [
            'files' => File::latest()
                ->limit(6)
                ->get(),
        ]);
    }
}
