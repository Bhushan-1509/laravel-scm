<?php

namespace App\Livewire\Tables;

use App\Models\Customer;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class SupplierTable extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $sortField = 'name';

    public $sortAsc = false;

    public function sortBy($field): void
    {
        if($this->sortField === $field)
        {
            $this->sortAsc = ! $this->sortAsc;

        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
//        $customers = Customer::query()
//            ->where('company_name', 'like', '%' . trim($this->search) . '%')
//            ->orWhere('gst_no', 'like', '%' . trim($this->search) . '%')
//            ->paginate($this->perPage);
        $suppliers = Supplier::query()->where('name', 'like', '%'. trim($this->search) . '%')
            ->orWhere('email', 'like', '% ' . trim($this->search) . '%')
            ->paginate($this->perPage);
        return view('livewire.tables.supplier-table', [
            'suppliers' =>$suppliers
        ]);
    }
}
