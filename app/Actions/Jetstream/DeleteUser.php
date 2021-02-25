<?php

namespace App\Actions\Jetstream;

use Illuminate\Support\Facades\Storage;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        $this->deleteMediaResource($user, 'images');

        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }

    /**
     * Delete the user media resource directory.
     *
     * @param  string  $name
     * @return void
     */
    protected function deleteMediaResource($user, $name)
    {
        Storage::deleteDirectory($name . '/' . $user->id);
    }
}
