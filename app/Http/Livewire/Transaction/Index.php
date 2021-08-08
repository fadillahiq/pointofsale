<?php

namespace App\Http\Livewire\Transaction;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use PDF;
class Index extends Component
{
    public $product_id, $qty, $payInput, $total, $change;

    public function render()
    {
        $pay = (integer)$this->payInput;
        return view('livewire.transaction.index', [
            'products' => Product::where('stock', '>=', 1)->latest()->get(),
            'transactions' => Transaction::with('product')->latest()->get(),
            'pay' => $pay
        ]);
    }

    public function resetInput()
    {
        $this->product_id = '';
        $this->qty = '';
        $this->payInput = '';
    }

    // Realtime Validation
    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName, [
    //         'product_id' => 'required|unique:transactions'
    //     ]);
    // }

    public function store()
    {
        DB::transaction(function (){
            $product = Product::where('id', $this->product_id)->first();

            $this->validate([
                'product_id' => 'required|unique:transactions,product_id',
                'qty' => 'required|integer|min:1|max:'.$product->stock
            ]);


            $transaction = Transaction::create([
                'product_id' => $this->product_id,
                'qty' => $this->qty,
                'total' => $product->price * $this->qty
            ]);

            $stock = $product->stock - $transaction->qty;
            $product->update([
                'stock' => $stock
            ]);

            $this->resetInput();
        });
    }

    public function submit()
    {
        $transactions = Transaction::get();
        if($this->payInput < $transactions->sum('total')){
            session()->flash('message', 'Your money is not enough !');
        }else {
            DB::transaction(function () {
                $transactions = Transaction::get();
                $order = Order::create([
                    'code' => IdGenerator::generate(['table' => 'orders', 'field' => 'code', 'length' => 10, 'prefix' =>'INV-']),
                    'cashier_name' => auth()->user()->name,
                    'total' => $transactions->sum('total'),
                    'pay' => $this->payInput,
                    'change' => $this->payInput - $transactions->sum('total')
                ]);

                foreach($transactions as $transaction)
                {
                    $data2 = [
                        'order_id' => $order->id,
                        'product_id' => $transaction->product_id,
                        'qty' => $transaction->qty,
                        'total' => $transaction->total,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ];

                    OrderProduct::insert($data2);

                    Transaction::where('id', $transaction->id)->delete();
                }

                $this->resetInput();

                // session()->flash('success', 'Transaction Success !');

                return redirect()->route('invoice', $order->code);
            });
        }
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
