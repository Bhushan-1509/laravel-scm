<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Products') }}
            </h3>
        </div>

        <div class="card-actions">
            <x-action.create route="{{ route('purchases.create') }}" />
        </div>
    </div>

    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <div class="text-secondary">
                Show
                <div class="mx-2 d-inline-block">
                    <select wire:model.live="perPage" class="form-select form-select-sm" aria-label="result per page">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                    </select>
                </div>
                entries
            </div>
            <div class="ms-auto text-secondary">
                Search:
                <div class="ms-2 d-inline-block">
                    <input type="text" wire:model.live="search" class="form-control form-control-sm" aria-label="Search invoice">
                </div>
            </div>
        </div>
    </div>

    <x-spinner.loading-spinner/>

    <div class="table-responsive">
        <table wire:loading.remove class="table table-bordered card-table table-vcenter text-nowrap datatable">
            <thead class="thead-light">
            <tr>
                <th class="align-middle text-center w-1">
                    {{ __('No.') }}
                </th>
                <th scope="col" class="align-middle text-center">
                    <a wire:click.prevent="sortBy('purchase_no')" href="#" role="button">
                        {{ __('Product Name.') }}
                        @include('inclues._sort-icon', ['field' => 'purchase_no'])
                    </a>
                </th>
                <th scope="col" class="align-middle text-center">
                    <a wire:click.prevent="sortBy('supplier_id')" href="#" role="button">
                        {{ __('Rod Diameter') }}
                        @include('inclues._sort-icon', ['field' => 'supplier_id'])
                    </a>
                </th>
                <th scope="col" class="align-middle text-center">
                    <a wire:click.prevent="sortBy('date')" href="#" role="button">
                        {{ __('Unit Weight') }}
                        @include('inclues._sort-icon', ['field' => 'date'])
                    </a>
                </th>
                <th scope="col" class="align-middle text-center">
                    <a wire:click.prevent="sortBy('total_amount')" href="#" role="button">
                        {{ __('Unit Price') }}
                        @include('inclues._sort-icon', ['field' => 'total_amount'])
                    </a>
                </th>
                <th scope="col" class="align-middle text-center">
                    <a wire:click.prevent="sortBy('status')" href="#" role="button">
                        {{ __('Quantity') }}
                        @include('inclues._sort-icon', ['field' => 'status'])
                    </a>
                </th>
                <th scope="col" class="align-middle text-center">
                    {{ __('Total') }}
                </th>
                <th scope="col" class="align-middle text-center">
                    {{ __('Action') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse ($items as $item)
                <tr>
                    <td class="align-middle text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $item->item_name }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $item->rod_diameter }} m
                    </td>
                    <td class="align-middle text-center">
                        {{ $item->unit_weight }} kg
                    </td>
                    <td class="align-middle text-center">
                        {{ $item->unit_price }} INR
                    </td>
                    <td class="align-middle text-center">
                        {{ $item->quantity }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $item->total }}  INR
                    </td>


                    <td class="align-middle text-center" style="width: 10%">
                        <x-button.show class="btn-icon" route="{{ route('items.show', $item->uuid) }}"/>
                        {{-- <x-button.complete class="btn-icon"  onclick="return confirm('Are you sure to approve purchase no. {{ $purchase->purchase_no }}!') route="{{ route('purchases.update', $purchase->uuid) }}"/> --}}
{{--                        <x-button.edit class="btn-icon" route="{{ route('items.edit', $item->uuid) }}" onclick="return confirm('Are you sure to approve purchase no. {{ $item->item_name }}?')"/>--}}
                        <x-button.delete class="btn-icon" onclick="return confirm('Are you sure!')" route="{{ route('items.destroy', $item->uuid) }}"/>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="align-middle text-center" colspan="7">
                        No results found
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary">
            Showing <span>{{ $items->firstItem() }}</span>
            to <span>{{ $items->lastItem() }}</span> of <span>{{ $items->total() }}</span> entries
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $items->links() }}
        </ul>
    </div>
</div>
