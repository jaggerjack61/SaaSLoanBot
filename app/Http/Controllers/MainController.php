<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function showPendingUsers()
    {
        return view('pages.users.pending');
    }
    public function showRegisteredUsers()
    {
        return view('pages.users.registered');
    }
    public function showDeniedUsers()
    {
        return view('pages.users.denied');
    }
    public function showPendingLoans()
    {
        return view('pages.loans.pending');
    }
    public function showApprovedLoans()
    {
        return view('pages.loans.approved');
    }
    public function showDeniedLoans()
    {
        return view('pages.loans.denied');
    }
    public function showCompletedLoans()
    {
        return view('pages.loans.completed');
    }
    public function showDefaultedLoans()
    {
        return view('pages.loans.defaulted');
    }
}
