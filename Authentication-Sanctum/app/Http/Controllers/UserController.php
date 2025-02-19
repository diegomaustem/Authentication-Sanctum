<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers()
    {
        return UserResource::collection(User::all());
    }

    public function getUser(User $user)
    {
        return new UserResource($user);
    }
}
