<?php

namespace App\Policies;

use App\Models\Component;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ComponentPolicy
{

    public function viewAny(?User $user): bool
    {
        return true;
    }


    public function view(?User $user, Component $component): bool
    {
        return true;
    }


    public function create(User $user): bool
    {
        if($user->role->title === 'admin') return true;
        else return false;
    }

    public function update(User $user, Component $component): bool
    {
        if($user->role->title === 'admin') return true;
        else return false;
    }


    public function delete(User $user, Component $component): bool
    {
        if($user->role->title === 'admin') return true;
        else return false;
    }
}
