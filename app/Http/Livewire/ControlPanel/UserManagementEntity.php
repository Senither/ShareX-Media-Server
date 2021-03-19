<?php

namespace App\Http\Livewire\ControlPanel;

use Illuminate\Support\Facades\Hash;
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
     * Indicates if user is being edited.
     *
     * @var bool
     */
    public $confirmingUserEditing = false;

    /**
     * The user form values.
     *
     * @var array
     */
    public $userForm;

    /**
     * List of validation attribute names that are more human friendly.
     *
     * @var array
     */
    protected $validationAttributes = [
        'userForm.name' => 'name',
        'userForm.email' => 'email',
        'userForm.password' => 'password',
    ];

    /**
     * Set the user form data and resets error bag when
     * confirming user editing state changes.
     *
     * @return void
     */
    public function updatedConfirmingUserEditing()
    {
        $this->resetErrorBag();

        $this->userForm = $this->user->only('name', 'email');
    }

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
     * Updates the user.
     *
     * @return void
     */
    public function updateUser()
    {
        $content = $this->validate()['userForm'];

        if (array_key_exists('password', $content)) {
            $content['password'] = Hash::make($content['password']);
        }

        $this->user->update($content);

        $this->emit('saved');
    }

    /**
     * Impersonates the user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function impersonateUser()
    {
        return redirect()->route('imposter.join', $this->user);
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

    /**
     * The validation rules for the component.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'userForm.name' => ['required', 'string', 'min:2'],
            'userForm.email' => ['required', 'email', 'unique:users,email,' . $this->user->id],
            'userForm.password' => ['nullable', 'string', 'min:8'],
        ];
    }
}
