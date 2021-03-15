<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HasNoMedia extends Component
{
    /**
     * The singular media type.
     *
     * @var string
     */
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.has-no-media');
    }
}
