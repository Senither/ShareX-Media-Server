<?php

namespace App\Http\Livewire\ControlPanel;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class UserManagementList extends Component
{
    use WithPagination;

    /**
     * The events the component should listen for.
     *
     * @var array
     */
    protected $listeners = ['userDeleted' => '$refresh'];

    /**
     * The search query to filter users by.
     *
     * @var string
     */
    public $search;

    /**
     * Determines if the create user modal should be shown or not.
     *
     * @var boolean
     */
    public $displayingCreateNewUser = false;

    /**
     * The user details used when creating a new user.
     *
     * @var array
     */
    public $userDetails = [
        'name' => '',
        'email' => '',
    ];

    /**
     * The validation rules for the component.
     *
     * @var array
     */
    protected $rules = [
        'userDetails.name' => 'required|string|min:2',
        'userDetails.email' => 'required|email|unique:users,email',
    ];

    /**
     * List of validation attribute names that are more human friendly.
     *
     * @var array
     */
    protected $validationAttributes = [
        'userDetails.name' => 'name',
        'userDetails.email' => 'email',
    ];

    /**
     * Reset user details and the the error bag when
     * the create user modal state changes.
     *
     * @return void
     */
    public function updatedDisplayingCreateNewUser()
    {
        $this->resetErrorBag();

        $this->userDetails = [
            'name' => '',
            'email' => '',
        ];
    }

    /**
     * Create a new user instance.
     *
     * @return void
     */
    public function createNewUser()
    {
        $this->validate();

        $password = Str::random(16);

        User::create(array_merge([
            'password' => Hash::make($password)
        ], $this->userDetails));

        session()->flash('createdUser', array_merge([
            'password' => $password
        ], $this->userDetails));

        $this->displayingCreateNewUser = false;
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('control-panel.user-management-list', [
            'users' => User::orderBy('name', 'asc')
                ->when(mb_strlen($this->search) > 2, function ($query) {
                    return $query
                        ->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                })
                ->paginate(5),
        ]);
    }
}
