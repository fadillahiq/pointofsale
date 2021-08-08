<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class Update extends Component
{
    public $name, $categoryId;
    protected $listeners = ['getCategory'];

    public function render()
    {
        return view('livewire.category.update');
    }

    public function getCategory($category)
    {
        $this->name = $category['name'];
        $this->categoryId = $category['id'];
    }

    protected $rules = [
        'name' => 'required|min:4',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    private function resetInput()
    {
        $this->name = '';
    }

    public function update()
    {
        $this->validate();

        // Execution doesn't reach here if validation fails.

        if($this->categoryId)
        {
            $category = Category::find($this->categoryId);
            $category->update([
                'name' => $this->name
            ]);

            $this->resetInput();

            $this->emit('updatedCategory', $category);
        }
    }
}
