<?php

namespace App\Http\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Create extends Component
{
    public $code, $name, $price, $stock, $category_id;

    protected $listeners = ['createProduct'];

    public function render()
    {
        return view('livewire.product.create', [
            'categories' => Category::all()
        ]);
    }

    protected $rules = [
        'name' => 'required|string|min:4',
        'price' => 'required|integer',
        'stock' => 'required|integer|min:1',
        'category_id' => 'required'
    ];

    public function createProduct()
    {
        $this->name = '';
        $this->price = '';
        $this->stock = '';
        $this->category_id = '';
    }

    private function resetInput()
    {
        $this->name = '';
        $this->price = '';
        $this->stock = '';
        $this->category_id = '';
    }

    public function store()
    {
        $this->validate();

        $this->code = IdGenerator::generate(['table' => 'products', 'field' => 'code', 'length' => 10, 'prefix' =>'P-']);
        //output: P-000001

        // Execution doesn't reach here if validation fails.

        $product = Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'stock' => $this->stock,
            'category_id' => $this->category_id,
            'code' => $this->code
        ]);

        $this->resetInput();

        $this->emit('storedProduct', $product);
    }
}
