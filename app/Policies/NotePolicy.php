<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;
use App\Models\Note;

class NotePolicy
{
    use HandlesAuthorization;

    public function isAuthorized(User $user, Note $note)
    {
        return  $user->id == $note->user_id; // || isAdmin || isModerator, etc
    }
}
