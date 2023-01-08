<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Services\SendMessageService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class PendingUsersTable extends Component
{
    use withPagination,LivewireAlert;

    public $search='';
    private $sender;

    public function mount()
    {
        $this->sender = new SendMessageService();
    }


    public function render()
    {
        $results=Customer::where('name','LIKE','%'.$this->search.'%')
            ->orWhere('EC','LIKE','%'.$this->search.'%')
            ->orWhere('bank','LIKE','%'.$this->search.'%')
            ->orWhere('account_number','LIKE','%'.$this->search.'%')
            ->orWhere('phone_no','LIKE','%'.$this->search.'%')
            ->paginate(30);

        return view('livewire.pending-users-table',compact('results'));
    }

    public function register($id)
    {
        $customer=Customer::find($id);
        $customer->update([
            'status' => 'registered',
            'handled_by'=>auth()->user()->id]);

        $customer->save();
        $this->alert('success','User has been successfully registered');

        $this->sender->sendMsgTemplate($customer->phone_no,'account_status','registered');
    }

    public function deny($id)
    {

        $customer=Customer::find($id);
        $customer->update([
            'status' => 'denied',
            'handled_by'=>auth()->user()->id]);
        $customer->save();

        $this->alert('error','User has been been denied registration');

        $this->sender->sendMsgTemplate($customer->phone_no,'account_status','denied');

    }
}
