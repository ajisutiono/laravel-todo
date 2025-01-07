<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        if ($request->session()->exists("email")) {
            return redirect('/todo');
        } else {
            return redirect('/login');
        }
    }
}
