<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;

class Update extends Component
{
    public $name, $userId, $email, $role;
    protected $listeners = ['getUser'];

    public function render()
    {
        return view('livewire.user.update');
    }

    public function getUser($user)
    {
        $data = User::where('id', $user)->first();
        $this->name = $data->name;
        $this->email = $data->email;
        $this->role = $data->getRoleNames();
        $this->userId = $data->id;
    }

    private function resetInput()
    {
        $this->name = '';
        $this->email = '';
        $this->role = '';
    }

    public function updated($propertyName)
    {
        $user = User::find($this->userId);
        $this->validateOnly($propertyName, [
            'name' => 'required|min:4|string',
            'email' => 'required|min:2|email|unique:users,email,'.$user->id,
            'role' => 'required',
        ]);
    }

    public function update()
    {
        $user = User::find($this->userId);
        $this->validate([
            'name' => 'required|min:4|string',
            'email' => 'required|min:2|email|unique:users,email,'.$user->id,
            'role' => 'required',
        ]);

        // Execution doesn't reach here if validation fails.

        if($this->userId)
        {
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);

            if($this->role == "admin")
            {
                $user->removeRole('admin');
                $user->removeRole('cashier');
                $user->assignRole('admin');
            }else {
                $user->removeRole('admin');
                $user->removeRole('cashier');
                $user->assignRole('cashier');
            }

            $this->resetInput();

            $this->emit('updatedUser', $user);
        }
    }
}
