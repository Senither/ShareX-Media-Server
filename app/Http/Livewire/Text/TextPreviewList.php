<?php

namespace App\Http\Livewire\Text;

use App\Models\Text;
use Livewire\Component;

class TextPreviewList extends Component
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
        return view('text.text-preview-list', [
            'textFiles' => Text::latest()
                ->limit($this->getTextFilesPerPageSize())
                ->get(),
        ]);
    }

    /**
     * Gets the amount of text files that should be shown per page, and
     * divides it by half, if the value is larger than 12 we just cap
     * the text files shown per page at 12.
     *
     * @return int
     */
    protected function getTextFilesPerPageSize()
    {
        return min(app('settings')->get('texts.per_page') / 2, 12);
    }
}
