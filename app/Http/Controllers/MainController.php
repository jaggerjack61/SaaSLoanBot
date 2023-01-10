<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\LoanHistory;
use App\Models\PaymentLedger;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function showDashboard(){
        $customers=Customer::all();
        $loans=LoanHistory::all();
        $payments=PaymentLedger::all();
        $zwlIn=0;
        $usdIn=0;
        foreach($loans as $loan){
            if($loan->currency=='RTGS'){
                foreach($payments as $payment){
                    if($payment->loan_id==$loan->id){
                        $zwlIn+=$payment->amount;
                    }
                }
            }
        }
        foreach($loans as $loan){
            if($loan->currency=='USD'){
                foreach($payments as $payment){
                    if($payment->loan_id==$loan->id){
                        $usdIn+=$payment->amount;
                    }
                }
            }
        }
        $usdOut=LoanHistory::where('currency','USD')->whereIn('status',['approved','paid','defaulted'])->sum('amount');
        $zwlOut=LoanHistory::where('currency','RTGS')->whereIn('status',['approved','paid','defaulted'])->sum('amount');


        return view('pages.dashboard',compact('customers','loans','payments','zwlIn','usdIn','usdOut','zwlOut'));
    }
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
    public function viewUser(Customer $customer)
    {
        $results=LoanHistory::where('customer_id',$customer->id)->get();
        $payments=PaymentLedger::all();
        return view('pages.users.view',compact('customer','payments','results'));
    }
}
