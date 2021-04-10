<?php

namespace App\Http\Livewire\Preview;

use App\Models\Text;
use Livewire\Component;

class TextInformation extends Component
{
    /**
     * The text the component previews.
     *
     * @var \App\Models\Text
     */
    public $text;

    /**
     * Determines if the modal should be shown to the user.
     *
     * @var boolean
     */
    public $showModal = false;

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount(Text $text)
    {
        $this->text = $text;
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('preview.text-information');
    }
}
