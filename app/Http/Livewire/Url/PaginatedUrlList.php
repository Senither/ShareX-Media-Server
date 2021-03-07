<?php

namespace App\Http\Livewire\Url;

use App\Models\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PaginatedUrlList extends Component
{
    use WithPagination;

    /**
     * The events the component should listen for.
     *
     * @var array
     */
    protected $listeners = ['urlDeleted' => '$refresh'];

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('url.paginated-url-list', [
            'urls' => Url::latest()->paginate(
                app('settings')->get('urls.per_page')
            ),
        ]);
    }
}
