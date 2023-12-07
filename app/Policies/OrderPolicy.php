<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Log;

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
        if($user->role->title === 'manager') return true;
        else if($user->role->title === 'user') {
            if($user->id === $order->user_id) return true;
            else return false;
        } else {
            return false;
        }
    }

    public function update(User $user, Order $order, array $payload): bool
    {
        if($user->role->title === 'manager') {
            if(isset($payload['computers']) AND isset($payload['components'])) {
                return false;
            } else if(isset($payload['status'])) {
                if(isset($payload['status']) AND $payload['status'] !== 'completed') return false;
            }
        } else if($user->role->title === 'user') {
            if($user->id !== $order->user_id) return false;
            else if(isset($payload['status']) AND $payload['status'] !== 'created') return false;
        } else {
            return false;
        }

        return true;
    }

    public function delete(User $user, Order $order): bool
    {
        //
    }
}
