<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    public function viewAny(User $user): bool
    {
        if($user->role->title === 'admin') return true;
        else return false;
    }

    public function update(User $user, User $model): bool
    {
        if($user->role->title === 'admin') return true;
        else return false;
    }
}
