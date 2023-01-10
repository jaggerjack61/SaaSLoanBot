<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function showPayments()
    {
        return view('pages.reports.payments');
    }

    public function showLoans()
    {
        return view('pages.reports.loans');
    }
}
