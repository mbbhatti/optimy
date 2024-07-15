<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository
{
    /**
     * Get all users.
     *
     * @return Collection
     */
    public function getAllUsers(): Collection
    {
        return User::all();
    }

    /**
     * Create | Update User.
     *
     * @param Request $request
     *
     * @return int
     */
    public function create(Request $request): int
    {
        $user = User::firstOrNew(['id' => request('id')]);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->remember_token = Str::random(60);
        $user->save();

        return $user->id;
    }

    /**
     * Get the count of all users.
     *
     * @return int
     */
    public function getUserCount()
    {
        return User::count();
    }
}

