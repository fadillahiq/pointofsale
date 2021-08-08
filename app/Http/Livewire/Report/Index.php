<?php

namespace App\Http\Livewire\Report;

use App\Exports\OrderExport;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class Index extends Component
{
    public $paginate, $search;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['search'];

    public function render()
    {
        return view('livewire.report.index', [
            'datas' => $this->search == null ? Order::with('productOrder.product.category')->latest()->paginate($this->paginate)
                                                : Order::with('productOrder.product')
                                                        ->where('code', 'like', '%' . $this->search . '%')
                                                        ->orWhere('cashier_name', 'like', '%' . $this->search . '%')
                                                        ->orWhere('total', 'like', '%' . $this->search . '%')
                                                        ->orWhere('pay', 'like', '%' . $this->search . '%')
                                                        ->orWhere('change', 'like', '%' . $this->search . '%')
                                                        ->orwhereHas('productOrder', function ($query) {
                                                            $query->where('qty', 'like', '%' . $this->search . '%');
                                                        })
                                                        ->orwhereHas('productOrder', function ($query) {
                                                            $query->WhereHas('product', function ($q) {
                                                                $q->where('name', 'like', '%' . $this->search . '%');
                                                            });
                                                        })
                                                        ->orwhereHas('productOrder', function ($query) {
                                                            $query->WhereHas('product', function ($q) {
                                                                $q->WhereHas('category', function ($c) {
                                                                    $c->where('name', 'like', '%' . $this->search . '%');
                                                                });
                                                            });
                                                        })
                                                        ->paginate($this->paginate)
        ]);
    }

    public function export_mapping() {
        return Excel::download( new OrderExport(), 'order.xlsx');
    }
}
