
@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h3 class="card-title">
                                    {{ __('New Order') }}
                                </h3>
                            </div>
                            <div class="card-actions btn-actions">
                                <x-action.close route="{{ route('orders.index') }}"/>
                            </div>
                        </div>
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row gx-3 mb-3">
                                    @include('partials.session')
                                    <div class="col-md-4">
                                        <label for="purchase_date" class="small my-1">
                                            {{ __('Date') }}
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input name="order_date" id="order_date" type="date"
                                               class="form-control example-date-input @error('order_date') is-invalid @enderror"
                                               value="{{ old('order_date') ?? now()->format('Y-m-d') }}"
                                               required
                                        >

                                        @error('order_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="small mb-1" for="customer_id">
                                            {{ __('Customer') }}
                                            <span class="text-danger">*</span>
                                        </label>

                                        <select class="form-select form-control-solid @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id">
                                            <option selected="" disabled="">
                                                Select a customer:
                                            </option>

                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->company_name }}">
                                                    {{ $customer->company_name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('customer_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="small mb-1" for="reference">
                                            {{ __('Order No') }}
                                        </label>

                                        <input type="text" class="form-control"
                                               id="orderNo"
                                               name="orderNo"
                                               value=""
                                        >

                                        @error('orderNo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small mb-1" for="reference">
                                            {{ __('Rate') }}
                                        </label>

                                        <input type="text" class="form-control"
                                               id="rate"
                                               name="rate"
                                               value=""
                                        >

                                        @error('rate')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small mb-1" for="reference">
                                            {{ __('No of Products') }}
                                        </label>
                                        <input type="text" class="form-control" name="noOfProducts" id="noOfProducts" aria-label="Username" aria-describedby="basic-addon1">
                                        @error('noOfProducts')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row gx-3 mb-3" id="selectContainer">

                                </div>

                            </div>
                            <div class="card-footer text-end">

                                <button type="submit" class="btn btn-success add-list mx-1">
                                    {{ __('Save Order') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('noOfProducts').addEventListener('input', function () {
            var number = parseInt(this.value);
            var selectContainer = document.getElementById('selectContainer');
            selectContainer.innerHTML = '';

            for (var i = 1; i <= number; i++) {
                var selectDiv = document.createElement('div');
                selectDiv.classList.add('col-md-4');

                var label = document.createElement('label');
                label.textContent = 'Product ' + i;
                label.classList.add('small', 'mb-1');

                var select = document.createElement('select');
                select.classList.add('form-select', 'form-control');
                select.name = 'product_' + i;
                @php
                    $products = \App\Models\Item::all();
                @endphp
                @foreach($products as $product)
                var option = document.createElement('option');
                option.text = '{{ $product->item_name }}'; // Assuming 'name' is the field in your Product model
                option.value = '{{ $product->item_name }}'; // Assuming 'id' is the primary key in your Product model
                select.add(option);
                @endforeach

                selectDiv.appendChild(label);
                selectDiv.appendChild(select);

                selectContainer.appendChild(selectDiv);
            }
        });
    </script>
@endsection

@pushonce('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce
