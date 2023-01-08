<?php

namespace App\Http\Livewire;

use App\Models\LoanHistory;
use App\Services\SendMessageService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class PendingLoansTable extends Component
{
    use withPagination,LivewireAlert;
    public $search = '';

    public function render()
    {
        $results=LoanHistory::where('amount','LIKE','%'.$this->search.'%')
            ->orWhereHas('owner', function($query){$query->where('name', 'like', '%'.$this->search.'%');})
            ->orWhereHas('handler', function($query){$query->where('name', 'like', '%'.$this->search.'%');})
            ->paginate();
        return view('livewire.pending-loans-table',compact('results'));
    }

    public function approveLoan($id)
    {
        $loan=LoanHistory::find($id);
        if($loan->owner->status=='registered'){
            $loan->update([
                'status' => 'approved',
                'handled_by'=>auth()->user()->id]);
            $loan->save();

            $this->alert('success','User has been approved for the loan.',[
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
            $template=new SendMessageService();
            $template->sendMsgTemplate($loan->owner->phone_no,'loan_status','approved');
        }
        else{
            $this->alert('error','This user is not registered. Please register them first.',[
                'position' => 'center',
                'timer' => 6000,
                'toast' => true,
            ]);
        }

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
}
