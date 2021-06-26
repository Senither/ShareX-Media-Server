<?php

namespace App\Http\Livewire\Files;

use Livewire\Component;

class FilePreview extends Component
{
    /**
     * The file the component previews.
     *
     * @var \App\Models\File
     */
    public $file;

    /**
     * Deletes the file associated with the component.
     *
     * @return void
     */
    public function delete()
    {
        $this->file->delete();

        $this->emitUp('fileDeleted');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('files.file-preview');
    }
}
