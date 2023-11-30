<?php

namespace App\Policies;

use App\Models\Computer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ComputerPolicy
{

    public function viewAny(?User $user): bool
    {
        return true;
    }


    public function view(?User $user, Computer $computer): bool
    {
        return true;
    }


    public function create(User $user): bool
    {
        if($user->role->title === 'admin') return true;
        else return false;
    }

    public function update(User $user, Computer $computer): bool
    {
        if($user->role->title === 'admin') return true;
        else return false;
    }


    public function delete(User $user, Computer $computer): bool
    {
        if($user->role->title === 'admin') return true;
        else return false;
    }
}
