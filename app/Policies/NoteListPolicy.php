<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;
use App\Models\NoteList;

class NoteListPolicy
{
    use HandlesAuthorization;

    public function isAuthorized(User $user, NoteList $noteList)
    {
        return  $user->id == $noteList->user_id; // || isAdmin || isModerator, etc
    }
}
