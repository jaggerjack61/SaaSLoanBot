<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function showPendingUsers()
    {
        return view('pages.pending-users');
    }
    public function showRegisteredUsers()
    {
        return view('pages.registered-users');
    }
    public function showDeniedUsers()
    {
        return view('pages.denied-users');
    }
}
