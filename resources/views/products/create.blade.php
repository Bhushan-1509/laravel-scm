@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <x-alert/>

        <div class="row row-cards">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
{{--                    <div class="col-lg-4">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <h3 class="card-title">--}}
{{--                                    {{ __('Raw Material Image') }}--}}
{{--                                </h3>--}}

{{--                                <img class="img-account-profile mb-2" src="{{ asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />--}}

{{--                                <div class="small font-italic text-muted mb-2">--}}
{{--                                    JPG or PNG no larger than 2 MB--}}
{{--                                </div>--}}

{{--                                <input--}}
{{--                                    type="file"--}}
{{--                                    accept="image/*"--}}
{{--                                    id="image"--}}
{{--                                    name="product_image"--}}
{{--                                    class="form-control @error('product_image') is-invalid @enderror"--}}
{{--                                    onchange="previewImage();"--}}
{{--                                >--}}

{{--                                @error('product_image')--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{ $message }}--}}
{{--                                </div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h3 class="card-title">
                                        {{ __('Add Raw Material') }}

                                    </h3>
                                </div>

                                <div class="card-actions">
                                    <a href="{{ route('products.index') }}" class="btn-action">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M18 6l-12 12"></path><path d="M6 6l12 12"></path></svg>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row row-cards">
                                    <div class="col-md-12">
                                        <x-input name="Company Name"
                                                 id="name"
                                                 placeholder="Company name"
                                                 value="{{ old('name') }}"
                                                 required="true"
                                        />

                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label">
                                                Challan No
                                                <span class="text-danger">*</span>
                                            </label>

{{--                                            @if ($categories->count() === 1)--}}
{{--                                                <select name="category_id" id="category_id"--}}
{{--                                                        class="form-select @error('category_id') is-invalid @enderror"--}}
{{--                                                        readonly--}}
{{--                                                >--}}
{{--                                                    @foreach ($categories as $category)--}}
{{--                                                        <option value="{{ $category->id }}" selected>--}}
{{--                                                            {{ $category->name }}--}}
{{--                                                        </option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                            @else--}}
{{--                                                <select name="category_id" id="category_id"--}}
{{--                                                        class="form-select @error('category_id') is-invalid @enderror"--}}
{{--                                                >--}}
{{--                                                    <option selected="" disabled="">--}}
{{--                                                        Select a category:--}}
{{--                                                    </option>--}}

{{--                                                    @foreach ($categories as $category)--}}
{{--                                                        <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected="selected" @endif>--}}
{{--                                                            {{ $category->name }}--}}
{{--                                                        </option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                            @endif--}}
                                            <x-input name=""
                                                     id="challanNo"
                                                     placeholder="Example : CHL-2024-ABC-123456"
                                                     value="{{ old('name') }}"
                                            />
                                            @error('category_id')
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

                                            @if ($units->count() === 1)
                                                <select name="category_id" id="category_id"
                                                        class="form-select @error('category_id') is-invalid @enderror"
                                                        readonly
                                                >
                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit->id }}" selected>
                                                            {{ $unit->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <select name="unit_id" id="unit_id"
                                                        class="form-select @error('unit_id') is-invalid @enderror"
                                                >
                                                    <option selected="" disabled="">
                                                        Select a unit:
                                                    </option>

                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit->id }}" @if(old('unit_id') == $unit->id) selected="selected" @endif>{{ $unit->name }}</option>
                                                    @endforeach
                                                </select>
                                            @endif

                                            @error('unit_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <x-input type="text"
                                                 label="APM Challan No"
                                                 name="apmChallanNo"
                                                 id="buying_price"
                                                 placeholder="Example : CHL-2024-ABC-123456"
                                                 value="{{ old('buying_price') }}"
                                                 required="true"
                                        />
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <x-input type="number"
                                                 label="Size"
                                                 name="size"
                                                 id="selling_price"
                                                 placeholder="0"
                                                 value="{{ old('selling_price') }}"
                                                 required="true"
                                        />
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <x-input type="number"
                                                 label="Quantity"
                                                 name="quantity"
                                                 id="quantity"
                                                 placeholder="0"
                                                 value="{{ old('quantity') }}"
                                        />
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <x-input type="text"
                                                 label="For"
                                                 name="for"
                                                 id="quantity_alert"
                                                 placeholder="0"
                                                 value="{{ old('quantity_alert') }}"
                                                 required="true"
                                        />
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <x-input type="number"
                                                 label="Cutting Size"
                                                 name="cuttingSize"
                                                 id="tax"
                                                 placeholder="0"
                                                 value="{{ old('tax') }}"
                                                 required="true"
                                        />
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
{{--                                            <label class="form-label" for="tax_type">--}}
{{--                                                {{ __('Cutting Weight') }}--}}
{{--                                            </label>--}}

{{--                                            <select name="tax_type" id="tax_type"--}}
{{--                                                    class="form-select @error('tax_type') is-invalid @enderror"--}}
{{--                                            >--}}
{{--                                                @foreach(\App\Enums\TaxType::cases() as $taxType)--}}
{{--                                                <option value="{{ $taxType->value }}" @selected(old('tax_type') == $taxType->value)>--}}
{{--                                                    {{ $taxType->label() }}--}}
{{--                                                </option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}

{{--                                            @error('tax_type')--}}
{{--                                            <div class="invalid-feedback">--}}
{{--                                                {{ $message }}--}}
{{--                                            </div>--}}
{{--                                            @enderror--}}
                                            <x-input type="number" name="cuttingWeight"
                                                     label="Cutting Weight"
                                                     id="tax_type"
                                                     placeholder="0"
                                                     value="{{ old('name') }}"
                                                     required="true"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="unit_id">
                                                {{ __('Order No') }}
                                                <span class="text-danger">*</span>
                                            </label>

                                            <select name="tax_type" id="tax_type"
                                                    class="form-select @error('tax_type') is-invalid @enderror"
                                            >
                                                @foreach(\App\Enums\TaxType::cases() as $taxType)
                                                    <option value="{{ $taxType->value }}" @selected(old('tax_type') == $taxType->value)>
                                                        {{ $taxType->label() }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <x-input type="text"
                                                     label="Order Size"
                                                     name="orderSize"
                                                     id="orderSize"
                                                     placeholder="0"
                                                     value="{{ old('order_size') }}"
                                                     required="true"
                                                     step="1"
                                            />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="notes" class="form-label">
                                                {{ __('Notes') }}
                                            </label>

                                            <textarea name="notes"
                                                      id="notes"
                                                      rows="5"
                                                      class="form-control @error('notes') is-invalid @enderror"
                                                      placeholder="Notes"
                                            ></textarea>

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
                                <x-button.save type="submit">
                                    {{ __('Save') }}
                                </x-button.save>

                                <a class="btn btn-warning" href="{{ url()->previous() }}">
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
@endsection

@pushonce('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce
