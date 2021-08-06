<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class Create extends Component
{
    public $name;

    public function render()
    {
        return view('livewire.category.create');
    }

    protected $rules = [
        'name' => 'required|min:4',
    ];

    private function resetInput()
    {
        $this->name = '';
    }

    public function store()
    {
        $this->validate();

        // Execution doesn't reach here if validation fails.

        $category = Category::create([
            'name' => $this->name
        ]);

        $this->resetInput();

        $this->emit('storedCategory', $category);
    }
}