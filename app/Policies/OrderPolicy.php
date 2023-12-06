<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function viewAny(User $user, string|null $qUser): bool
    {
        if($user->role->title === 'manager') return true;
        else {
            if(isset($qUser)) {
                if($user->id === (int) $qUser) return true;
                else return false;
            } else {
                return false;
            }
        }
    }
    public function view(User $user, Order $order): bool
    {
        //
    }

    public function create(User $user): bool
    {
        //
    }

    public function update(User $user, Order $order): bool
    {
        //
    }

    public function delete(User $user, Order $order): bool
    {
        //
    }
}
