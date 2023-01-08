<?php

namespace App\Http\Livewire;


use App\Models\LoanHistory;
use App\Models\PaymentLedger;
use App\Services\SendMessageService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ApprovedLoansTable extends Component
{
    use withPagination,LivewireAlert;
    public $search = '';
    public $amount;
    public $loanId;
    public $notes;
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
        return view('livewire.approved-loans-table',compact('results'));
    }


    public function denyLoan($id)
    {

        $loan=LoanHistory::find($id);
        $loan->update([
            'status' => 'denied',
            'handled_by'=>auth()->user()->id]);
        $loan->save();

        $this->alert('error','User has been denied loan.',[
            'position' => 'center',
            'timer' => 6000,
            'toast' => true,
        ]);

        $template=new SendMessageService();
        $template->sendMsgTemplate($loan->owner->phone_no,'loan_status','denied');

    }

    public function setLoanId($loanId)
    {
        $this->loanId = $loanId;
//        $this->renderState=0;
    }

    public function payLoan()
    {
        $ledger=PaymentLedger::create([
            'loan_id' => $this->loanId,
            'amount' => $this->amount,
            'notes'=>$this->notes
        ]);
        $ledger->save();
        $this->alert('success','You have successfully paid '.$ledger->amount.$ledger->loan->currency,[
            'position' => 'center',
            'timer' => 6000,
            'toast' => true,
        ]);
        $template=new SendMessageService();
        $template->sendMsgTemplate($ledger->loan->owner->phone_no,'credit_loan',$ledger->amount);
        $this->render();


    }

    public function defaultLoan($id)
    {
        $loan=LoanHistory::find($id);
        $loan->status = 'defaulted';
        $loan->save();
        $this->alert('error', 'Loan has been marked as defaulted',[
            'position' => 'center',
            'timer' => 6000,
            'toast' => true,
        ]);

        $template=new SendMessageService();
        $template->sendMsgTemplate($loan->owner->phone_no,'loan_status','marked as defaulted');

    }

    public function completeLoan($id)
    {
        $loan=LoanHistory::find($id);
        $loan->status = 'paid';
        $loan->save();
        $this->alert('success', 'Loan has been marked as completed',[
            'position' => 'center',
            'timer' => 6000,
            'toast' => true,
        ]);

        $template=new SendMessageService();
        $template->sendMsgTemplate($loan->owner->phone_no,'loan_status','fully paid');

    }

    public function viewLoan($id)
    {
        $this->paymentHistory=PaymentLedger::where('loan_id',$id)->get();

    }

}
