<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Services\SendMessageService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class RegisteredUsersTable extends Component
{
    use withPagination,LivewireAlert;

    public $search='';



    public function render()
    {
        $results=Customer::where('name','LIKE','%'.$this->search.'%')
            ->orWhere('EC','LIKE','%'.$this->search.'%')
            ->orWhere('bank','LIKE','%'.$this->search.'%')
            ->orWhere('account_number','LIKE','%'.$this->search.'%')
            ->orWhere('phone_no','LIKE','%'.$this->search.'%')
            ->orWhereHas('handler', function($query){$query->where('name', 'like', '%'.$this->search.'%');})
            ->paginate(30);
        return view('livewire.registered-users-table',compact('results'));
    }

    public function deny($id)
    {

        $customer=Customer::find($id);
        $customer->update([
            'status' => 'denied',
            'handled_by'=>auth()->user()->id]);
        $customer->save();

        $this->alert('error','User has been been denied registration',[
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
        $sender= new SendMessageService();
        $sender->sendMsgTemplate($customer->phone_no,'account_status','denied');

    }
}
