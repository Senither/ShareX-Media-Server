<?php

namespace App\Http\Livewire\Text;

use App\Models\Text;
use Livewire\Component;
use Livewire\WithPagination;

class PaginatedTextList extends Component
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
        return view('text.paginated-text-list', [
            'textFiles' => Text::latest()->paginate(24),
        ]);
    }
}
