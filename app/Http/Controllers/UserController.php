<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function doLogin(Request $request)
    {
        // data user
        $email =  $request->input('email');
        $password = $request->input('password');

        //validasi
        if (empty($email) || empty($password)) {
            return view('auth.login', [
                'title' => 'Login',
                'error' => 'email or password is required'
            ]);
        }

        if ($this->userService->login($email, $password)) {
            $request->session()->put("email", $email);
            return redirect('/');
        }

        return view('auth.login', [
            'title' => 'Login',
            'error' => 'email or password is wrong'
        ]);

    }

    public function doLogout(Request $request)
    {
        $request->session()->forget("email");
        return redirect('/');
    }
}
