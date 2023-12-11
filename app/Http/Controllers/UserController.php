<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(User::class, 'user');
    }
    public function index()
    {
        return UserResource::collection(User::all());
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $payload = $request->validated();
        $role = Role::where('title', $payload['role_title'])->first();
        $user->update(['role_id' => $role->id]);
        return new UserResource($user);
    }
}
