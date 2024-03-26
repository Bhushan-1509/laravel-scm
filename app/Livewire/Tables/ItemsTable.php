<?php

namespace App\Livewire\Tables;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ItemsTable extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $sortField = 'item_name';

    public $sortAsc = false;

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.tables.category-table', [
            'categories' => Item::where("user_id", auth()->id())->with(['items'])
                ->search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
        ]);
    }
}
