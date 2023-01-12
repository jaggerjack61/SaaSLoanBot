<?php

namespace App\Http\Livewire;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class SystemUsersTable extends Component
{
    use withPagination,LivewireAlert;


    public $search='';


    public function render()
    {
        $results=User::where('name','LIKE','%'.$this->search.'%')
            ->orWhere('access','LIKE','%'.$this->search.'%')
            ->orWhere('status','LIKE','%'.$this->search.'%')
            ->paginate(30);
        return view('livewire.system-users-table',compact('results'));
    }

    public function activate(User $user)
    {
        $user->status='active';
        $user->save();
        $this->alert('success',$user->name.' has been activated.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function deactivate(User $user)
    {
        $user->status='inactive';
        $user->save();
        $this->alert('error',$user->name.' has been deactivated.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function promote(User $user)
    {
        $user->access='admin';
        $user->save();
        $this->alert('success',$user->name.' has been promoted to Administrator level.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function demote(User $user)
    {
        $user->access='user';
        $user->save();
        $this->alert('error',$user->name.' has been demoted to user level.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
    }
}
