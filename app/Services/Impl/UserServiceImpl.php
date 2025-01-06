<?php

namespace App\Services\Impl;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserServiceImpl implements UserService
{
    private array $users = [
        "aji" => "rahasia"
    ];
    
    public function login(string $email, string $password): bool
    {
       if (!isset($this->users[$email])) {
            return false;
       }

       $correctPassword = $this->users[$email];
       return $password == $correctPassword;
    }
}
