@extends('layouts.tabler')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center mb-3">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Edit Raw Material') }}
                    </h2>
                </div>
            </div>

            @include('partials._breadcrumbs', ['model' => $product])
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">

                <form action="{{ route('products.update', $product->uuid) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row">
{{--                        <div class="col-lg-4">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-body">--}}
{{--                                    <h3 class="card-title">--}}
{{--                                        {{ __('Product Image') }}--}}
{{--                                    </h3>--}}

{{--                                    <img class="img-account-profile mb-2"--}}
{{--                                        src="{{ $product->product_image ? asset('storage/' . $product->product_image) : asset('assets/img/products/default.webp') }}"--}}
{{--                                        alt="" id="image-preview">--}}

{{--                                    <div class="small font-italic text-muted mb-2">--}}
{{--                                        JPG or PNG no larger than 2 MB--}}
{{--                                    </div>--}}

{{--                                    <input type="file" accept="image/*" id="image" name="product_image"--}}
{{--                                        class="form-control @error('product_image') is-invalid @enderror"--}}
{{--                                        onchange="previewImage();">--}}

{{--                                    @error('product_image')--}}
{{--                                        <div class="invalid-feedback">--}}
{{--                                            {{ $message }}--}}
{{--                                        </div>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="col-lg-12">

                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ __('Product Details') }}
                                    </h3>

                                    <div class="row row-cards">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    {{ __('Company Name') }}
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="text" id="companyName" name="companyName"
                                                    class="form-control @error('companyName') is-invalid @enderror"
                                                    placeholder="Product name" value="{{ old('name', $product->company_name) }}">

                                                @error('companyName')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="category_id" class="form-label">
                                                    Challan No
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="text" id="challanNo" name="challanNo"
                                                       class="form-control @error('challanNo') is-invalid @enderror"
                                                       placeholder="Example : CHL-2024-ABC-123456"
                                                       value="{{ old('challanNo', $product->challan_no) }}">

                                                @error('challanNo')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="unit_id">
                                                    {{ __('Type') }}
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="text" id="type" name="type"
                                                       class="form-control @error('type') is-invalid @enderror"
                                                       placeholder="0"
                                                       value="{{ old('type', $product->type) }}">

                                                @error('type')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="buying_price">
                                                    APM Challan No
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="text" id="apmChallanNo" name="apmChallanNo"
                                                    class="form-control @error('apmChallanNo') is-invalid @enderror"
                                                    placeholder="0"
                                                    value="{{ old('apmChallanNo', $product->apm_challan_no) }}">

                                                @error('apmChallanNo')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="selling_price" class="form-label">
                                                    Size
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="text" id="size" name="size"
                                                    class="form-control @error('size') is-invalid @enderror"
                                                    placeholder="0"
                                                    value="{{ old('size', $product->size) }}">

                                                @error('size')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="quantity" class="form-label">
                                                    {{ __('Quantity') }}
                                                </label>

                                                <input class="form-control" name="quantity" id="quantity" type="text" readonly value="{{ old('quantity', $product->quantity) }}"  required="true" aria-required="true" style="color: var(--tblr-secondary);background-color: var(--tblr-bg-surface-secondary); opacity: 1;"/>


                                                {{-- <input type="text" id="quantity" name="quantity"
                                                    class="form-control"
                                                    min="0" value="{{ old('quantity', $product->quantity) }}"
                                                    placeholder="0" disabled > --}}
                                                @error('quantity')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="quantity_alert" class="form-label">
                                                    {{ __('For') }}
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="text" id="for" name="for"
                                                    class="form-control @error('for') is-invalid @enderror"
                                                    min="0" placeholder="0"
                                                    value="{{ old('for', $product->for) }}">

                                                @error('for')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label for="tax" class="form-label">
                                                    {{ __('Cutting Size') }}
                                                </label>

                                                <input type="number" id="cuttingSize" name="cuttingSize"
                                                    class="form-control @error('cuttingSize') is-invalid @enderror"
                                                    min="0" placeholder="0"
                                                    value="{{ old('cuttingSize', $product->tax) }}">

                                                @error('cuttingSize')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="tax_type">
                                                    {{ __('Cutting Weight') }}
                                                </label>

                                                <input type="number" id="cuttingWeight" name="cuttingWeight"
                                                       class="form-control @error('cuttingWeight') is-invalid @enderror"
                                                       placeholder="0"
                                                       value="{{ old('cuttingWeight', $product->cutting_weight) }}">
                                                @error('cuttingWeight')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="tax_type">
                                                    {{ __('Order No') }}
                                                </label>

                                                <input type="text" id="orderNo" name="orderNo"
                                                       class="form-control @error('orderNo') is-invalid @enderror"
                                                       placeholder="0"
                                                       value="{{ old('orderNo', $product->order_no) }}">
                                                @error('orderNo')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="tax_type">
                                                    {{ __('Order Size') }}
                                                </label>

                                                <input type="text" id="orderSize" name="orderSize"
                                                       class="form-control @error('orderSize') is-invalid @enderror"
                                                       placeholder="0"
                                                       value="{{ old('orderSize', $product->order_size) }}">
                                                @error('orderSize')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3 mb-0">
                                                <label for="notes" class="form-label">
                                                    {{ __('notes') }}
                                                </label>

                                                <textarea name="notes" id="notes" rows="5" class="form-control @error('notes') is-invalid @enderror"
                                                    placeholder="Product notes">{{ old('notes', $product->notes) }}</textarea>

                                                @error('notes')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit">
                                        {{ __('Update') }}
                                    </button>

                                    <a class="btn btn-danger" href="{{ url()->previous() }}">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection

@pushonce('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce
