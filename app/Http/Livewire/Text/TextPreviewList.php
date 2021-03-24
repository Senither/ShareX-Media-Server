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
                ->limit(6)
                ->get(),
        ]);
    }
}
