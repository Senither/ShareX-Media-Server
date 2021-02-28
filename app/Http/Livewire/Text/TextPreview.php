<?php

namespace App\Http\Livewire\Text;

use Livewire\Component;

class TextPreview extends Component
{
    /**
     * The text the component previews.
     *
     * @var \App\Models\Text
     */
    public $text;

    /**
     * Deletes the text associated with the component.
     *
     * @return void
     */
    public function delete()
    {
        $this->text->delete();

        $this->emitUp('fileDeleted');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('text.text-preview');
    }
}
