<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $statusUpdate = false, $formVisible, $paginate, $search;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'storedCategory',
        'updatedCategory',
        'formClose' => 'formCloseHandler',
        'formOpen' => 'formOpenHandler',
    ];

    protected $queryString = ['search'];

    public function render()
    {
        return view('livewire.category.index', [
            'categories' => $this->search == null ? Category::latest()->paginate($this->paginate)
                                                    : Category::where('name', 'like', '%'.$this->search.'%')->paginate($this->paginate)
        ]);
    }

    public function storedCategory($category)
    {
        $this->formVisible = false;
        session()->flash('message', 'Category successfully created.');
    }

    public function updatedCategory($category)
    {
        $this->formVisible = false;
        session()->flash('message', 'Category successfully updated.');
    }

    public function getCategory($id)
    {
        $this->formVisible = true;
        $this->statusUpdate = true;
        $category = Category::find($id);
        $this->emit('getCategory', $category);
    }

    public function deleteCategory($id)
    {
        if($id)
        {
            $category = Category::find($id);
            $category->delete();

            session()->flash('message', 'Category successfully deleted.');
        }
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
