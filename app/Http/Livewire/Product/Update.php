<?php

namespace App\Http\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Update extends Component
{
    public $name, $price, $stock, $category_id, $productId;
    protected $listeners = ['getProduct'];

    public function render()
    {
        return view('livewire.product.update', [
            'categories' => Category::all()
        ]);
    }

    public function getProduct($product)
    {
        $this->name = $product['name'];
        $this->price = $product['price'];
        $this->stock = $product['stock'];
        $this->category_id = $product['category_id'];
        $this->productId = $product['id'];
    }

    protected $rules = [
        'name' => 'required|string|min:4',
        'price' => 'required|integer',
        'stock' => 'required|integer|min:1',
        'category_id' => 'required'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    private function resetInput()
    {
        $this->name = '';
        $this->price = '';
        $this->stock = '';
        $this->category_id = '';
    }

    public function update()
    {
        $this->validate();

        // Execution doesn't reach here if validation fails.

        if($this->productId)
        {
            $product = Product::find($this->productId);
            $product->update([
                'name' => $this->name,
                'price' => $this->price,
                'stock' => $this->stock,
                'category_id' => $this->category_id
            ]);

            $this->resetInput();

            $this->emit('updatedProduct', $product);
        }
    }
}
