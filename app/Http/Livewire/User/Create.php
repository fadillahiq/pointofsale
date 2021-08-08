<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name, $email, $role, $password;

    protected $listeners = ['createUser'];

    public function render()
    {
        return view('livewire.user.create');
    }

    protected $rules = [
        'name' => 'required|min:4|string',
        'email' => 'required|min:2|email|unique:users',
        'role' => 'required',
        'password' => 'required|min:8'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createUser()
    {
        $this->name = '';
        $this->email = '';
        $this->role = '';
        $this->password = '';
    }

    private function resetInput()
    {
        $this->name = '';
        $this->email = '';
        $this->role = '';
        $this->password = '';
    }

    public function store()
    {
        $this->validate();
        // Execution doesn't reach here if validation fails.

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);

        if($this->role == "admin")
        {
            $user->assignRole('admin');
        }else {
            $user->assignRole('cashier');
        }

        $this->resetInput();

        $this->emit('storedUser', $user);
    }
}
