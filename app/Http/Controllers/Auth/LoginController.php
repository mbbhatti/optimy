<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Validate incoming request.
     *
     * @param  array  $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'email'    => 'required|email',
            'password' => 'required|alphaNum|min:6'
        ]);
    }

    /**
     * User login.
     *
     * @param Request $request
     *
     * @return Application|Factory|View
     */
    public function login(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect('login')
                ->withErrors($validator)
                ->withInput($request->except(['password']));
        }

        $user = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        if (auth()->attempt($user)) {
            return redirect('/');
        }

        return redirect('login')->with('error', 'Username or password is incorrect');

    }

    /**
     * User logout
     *
     * @return RedirectResponse|Redirector
     */
    public function logout(): Redirector|RedirectResponse
    {
        Auth::logout();

        return redirect('login');
    }
}
