<?php

namespace App\Http\Livewire\ControlPanel;

use Laravel\Jetstream\Contracts\DeletesUsers;
use Livewire\Component;

class UserManagementEntity extends Component
{
    /**
     * The user the user management entity component is mounted with.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * Indicates if user deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingUserDeletion = false;

    /**
     * Deletes the user.
     *
     * @return void
     */
    public function deleteUser(DeletesUsers $deleter)
    {
        $deleter->delete($this->user->fresh());

        $this->confirmingUserDeletion = false;

        $this->emitUp('userDeleted');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('control-panel.user-management-entity');
    }
}
