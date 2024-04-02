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
                                            <option value="{{ $customer->company_name }}" @selected( old('customer_id') == $customer->id)>
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
                                    <label class="small mb-1" for="customer_id">
                                        {{ __('Product') }}
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select class="form-select form-control-solid @error('product_id') is-invalid @enderror" id="product_id" name="product_id">
                                        <option selected="" disabled="">
                                            Select a product:
                                        </option>

                                        @foreach ($products as $product)
                                             <option value="{{ $product->id }}" @selected( old('product_id') == $product->id)>
                                                {{ $product->item_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('product_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                            </div>


                        </div>
                        <div class="card-footer text-end">

                            <button type="submit" class="btn btn-success add-list mx-1 {{ $itemsCount > 0 ? '' : 'disabled' }}">
                                {{ __('Save Order') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection

@pushonce('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce
