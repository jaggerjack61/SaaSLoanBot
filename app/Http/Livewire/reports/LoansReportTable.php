<?php

namespace App\Http\Livewire\reports;

use App\Models\LoanHistory;
use App\Models\PaymentLedger;
use Illuminate\Support\Carbon;
use Livewire\Component;

class LoansReportTable extends Component
{
    public $status='none';
    public $currency='none';
    public $start='';
    public $end='';

    public function render()
    {

        $start=Carbon::parse($this->start?:Carbon::now())->startOfDay();
        $end=Carbon::parse($this->end?:Carbon::now())->endOfDay();

        if(!$this->status){
            if(!$this->currency){
                $results=LoanHistory::whereBetween('created_at',[$start,$end])
                    ->whereNot('status','in-progress')
                    ->get();
            }
            else{
                $results=LoanHistory::whereBetween('created_at',[$start,$end])
                    ->whereNot('status','in-progress')
                    ->where('currency',$this->currency)
                    ->get();
            }
        }
        else{
            if(!$this->currency){
                $results=LoanHistory::whereBetween('created_at',[$start,$end])
                    ->where('status',$this->status)
                    ->get();
            }
            else{
                $results=LoanHistory::whereBetween('created_at',[$start,$end])
                    ->where('status',$this->status)
                    ->where('currency',$this->currency)
                    ->get();
            }

        }

        $payments=PaymentLedger::all();
        return view('livewire.reports.loans-report-table',compact('payments','results'));
    }
}
