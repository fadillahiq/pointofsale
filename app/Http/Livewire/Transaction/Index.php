<?php

namespace App\Http\Livewire\Transaction;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $product_id, $paymentInput;

    public function render()
    {
        $payment = (integer)$this->paymentInput;
        return view('livewire.transaction.index', [
            'products' => Product::where('stock', '>=', 1)->latest()->get(),
            'transactions' => Transaction::with('product')->latest()->get(),
            'payment' => $payment
        ]);
    }

    protected $rules = [
        'product_id' => 'required|unique:transactions',
    ];

    public function store()
    {
        $this->validate();

        $product = Product::where('id', $this->product_id)->first();

        $transaction = Transaction::create([
            'product_id' => $this->product_id,
            'qty' => 1,
            'total' => $product->price
        ]);

        $stock = $product->stock - $transaction->qty;
        $product->update([
            'stock' => $stock
        ]);
    }

    public function decrement($id)
    {
        $transaction = Transaction::with('product')->find($id);
        $transaction->update([
            'qty' => $transaction->qty - 1,
            'total' => $transaction->product->price * ($transaction->qty - 1)
        ]);

        $product = Product::where('id', $transaction->product_id)->first();
        $stock = $product->stock + 1;
        $product->update([
            'stock' => $stock
        ]);
    }

    public function increment($id)
    {
        $transaction = Transaction::find($id);
        $transaction->update([
            'qty' => $transaction->qty + 1,
            'total' => $transaction->product->price * ($transaction->qty + 1)
        ]);

        $product = Product::where('id', $transaction->product_id)->first();
        $stock = $product->stock - 1;
        $product->update([
            'stock' => $stock
        ]);
    }

    public function deleteTransaction($id)
    {
        if($id)
        {
            $transaction = Transaction::find($id);
            $transaction->delete();

            $product = Product::where('id', $transaction->product_id)->first();
            $stock = $product->stock + $transaction->qty;
            $product->update([
                'stock' => $stock
            ]);
        }else{
            abort(404);
        }
    }
}
