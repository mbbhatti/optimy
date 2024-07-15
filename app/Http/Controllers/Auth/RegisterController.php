<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * @param Request $request
     * @param UserRepository $userRepository
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function register(Request $request, UserRepository $userRepository)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }

        $user = $userRepository->create($request);
        if (!$user) {
            return redirect('register')->with('error', 'Account not registered!');
        }

        return redirect('login')->with('success', 'Account has been registered successfully.');
    }
}
