<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(protected UserRepository $userRepository)
    {
    }

    /**
     * Show user list
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = $this->userRepository->getAllUsers();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show user edit page
     *
     * @param User $user
     *
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user detail
     *
     * @param Request $request
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'status' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Activate the user
     *
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function activate(User $user)
    {
        $user->update(['status' => 'active']);

        return redirect()->route('admin.users.index')->with('success', 'User activated successfully.');
    }

    /**
     * Deactivate the user
     *
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function deactivate(User $user)
    {
        $user->update(['status' => 'inactive']);

        return redirect()->route('admin.users.index')->with('success', 'User deactivated successfully.');
    }

}
