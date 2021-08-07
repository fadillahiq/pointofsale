<?php

namespace App\Http\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $statusUpdate = false, $formVisible = false, $paginate, $search, $deleteId;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'storedProduct',
        'updatedProduct',
        'formClose' => 'formCloseHandler',
        'formOpen' => 'formOpenHandler',
    ];

    // Optional
    protected $queryString = ['search'];

    public function render()
    {
        return view('livewire.product.index', [
            'products' => $this->search == null ? Product::with('category')->latest()->paginate($this->paginate)
                                                    : Product::with('category')->where('name', 'like', '%'.$this->search.'%')
                                                                                ->orWhere('code', 'like', '%'.$this->search.'%')
                                                                                ->orWhere('stock', 'like', '%'.$this->search.'%')
                                                                                ->orWhere('price', 'like', '%'.$this->search.'%')->paginate($this->paginate)
        ]);
    }

    public function storedProduct($product)
    {
        $this->formVisible = false;
        session()->flash('message', 'Product successfully created.');
    }

    public function updatedProduct($product)
    {
        $this->formVisible = false;
        session()->flash('message', 'Product successfully updated.');
    }

    public function createProduct()
    {
        $this->formVisible = true;
        $this->statusUpdate = false;
        $this->emit('createProduct');
    }

    public function getProduct($id)
    {
        $this->formVisible = true;
        $this->statusUpdate = true;
        $product = Product::find($id);
        $this->emit('getProduct', $product);
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

    public function deleteProduct()
    {
        Product::find($this->deleteId)->delete();

        session()->flash('message', 'Product successfully deleted.');
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
