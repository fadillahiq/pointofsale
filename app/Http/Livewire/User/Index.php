<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $statusUpdate = false, $formVisible = false, $paginate, $search, $deleteId;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'storedUser',
        'updatedUser',
        'formClose' => 'formCloseHandler',
        'formOpen' => 'formOpenHandler',
    ];

    // Optional
    protected $queryString = ['search'];

    public function render()
    {
        return view('livewire.user.index', [
            'users' => $this->search == null ? User::with('roles')->where('id', '!=', auth()->user()->id)->latest()->paginate($this->paginate)
                                                    : User::with('roles')->where('id', '!=', auth()->user()->id)
                                                                            ->where('name', 'like', '%'.$this->search.'%')
                                                                            ->orWhere('email', 'like', '%'.$this->search.'%')
                                                                            ->paginate($this->paginate)
        ]);
    }

    public function storedUser($user)
    {
        $this->formVisible = false;
        session()->flash('message', 'User successfully created.');
    }

    public function updatedUser($user)
    {
        $this->formVisible = false;
        session()->flash('message', 'User successfully updated.');
    }

    public function createUser()
    {
        $this->formVisible = true;
        $this->statusUpdate = false;
        $this->emit('createUser');
    }

    public function getUser($id)
    {
        $this->formVisible = true;
        $this->statusUpdate = true;
        $user = User::with('roles')->find($id);
        $this->emit('getUser', $user);
    }

    public function deleteConfirm($id)
    {
        if($id)
        {
            $this->deleteId = $id;
        }else {
            abort(404);
        }
    }

    public function deleteUser()
    {
        User::find($this->deleteId)->delete();

        session()->flash('message', 'User successfully deleted.');
    }

    public function formCloseHandler()
    {
        $this->formVisible = false;
    }

    public function formOpenHandler()
    {
        $this->formVisible = true;
    }
}
