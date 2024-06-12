<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();

        return UserResource::collection($users);
    }

    public function store (StoreUpdateUserRequest $request)
    {
        $data = $request->validated();
        $data ['password'] = bcrypt($request ->password);
        
        $user = User::create($data);
        return new UserResource($user);
    }
}
