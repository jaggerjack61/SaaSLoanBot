<?php

namespace App\Http\Livewire\reports;

use App\Models\PaymentLedger;
use Illuminate\Support\Carbon;
use Livewire\Component;

class PaymentsReportTable extends Component
{
    public $currency='none';
    public $start='';
    public $end='';

    public function render()
    {

        $start=Carbon::parse($this->start?:Carbon::now())->startOfDay();
        $end=Carbon::parse($this->end?:Carbon::now())->endOfDay();

        $results=PaymentLedger::whereBetween('created_at',[$start,$end])
            ->whereHas('loan', function($query){$query->where('currency', $this->currency);})
            ->get();
        //dd($start,$end,$results);

        return view('livewire.reports.payments-report-table',compact('results'));
    }
}
