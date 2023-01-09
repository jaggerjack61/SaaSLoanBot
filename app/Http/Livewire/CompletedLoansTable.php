<?php

namespace App\Http\Livewire;

use App\Models\LoanHistory;
use App\Models\PaymentLedger;
use App\Services\SendMessageService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class CompletedLoansTable extends Component
{
    use withPagination;
    public $search = '';
    public $paymentHistory;

    public function mount(){
        $this->paymentHistory=PaymentLedger::all();
    }

    public function render()
    {
        $results=LoanHistory::where('amount','LIKE','%'.$this->search.'%')
            ->orWhereHas('owner', function($query){$query->where('name', 'like', '%'.$this->search.'%');})
            ->orWhereHas('handler', function($query){$query->where('name', 'like', '%'.$this->search.'%');})
            ->paginate();
        $payments=PaymentLedger::all();
        return view('livewire.completed-loans-table',compact('results','payments'));
    }

    public function viewLoan($id)
    {
        $this->paymentHistory=PaymentLedger::where('loan_id',$id)->get();

    }


}
