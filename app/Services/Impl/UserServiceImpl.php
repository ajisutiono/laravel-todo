<?php

namespace App\Services\Impl;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class UserServiceImpl implements UserService
{
    public function login(string $email, string $password): bool
    {
        return Auth::attempt([
            "email" => $email,
            "password" => $password
        ]);
    }
}
