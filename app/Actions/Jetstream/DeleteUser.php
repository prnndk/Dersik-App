<?php

namespace App\Actions\Jetstream;

use App\Notifications\NotifyBot;
use Illuminate\Support\Facades\Notification;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param mixed $user
     *
     * @return void
     */
    public function delete($user)
    {
        Notification::send(auth()->user(), new NotifyBot('User '.$user->name.' menghapus akun'));
        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}
