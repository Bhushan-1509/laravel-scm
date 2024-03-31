@extends('layouts.tabler')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    {{ __('Create Customer') }}
                </h2>
            </div>
        </div>

        @include('partials._breadcrumbs')
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">

            <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
{{--                    <div class="col-lg-4">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <h3 class="card-title">--}}
{{--                                    {{ __('Customer Image') }}--}}
{{--                                </h3>--}}

{{--                                <img class="img-account-profile rounded-circle mb-2" src="{{ asset('assets/img/demo/user-placeholder.svg') }}" alt="" id="image-preview" />--}}

{{--                                <div class="small font-italic text-muted mb-2">JPG or PNG no larger than 2 MB</div>--}}

{{--                                <input class="form-control @error('photo') is-invalid @enderror" type="file"  id="image" name="photo" accept="image/*" onchange="previewImage();">--}}

{{--                                @error('photo')--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{ $message }}--}}
{{--                                </div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">
                                    {{ __('Customer Details') }}
                                </h3>

                                <div class="row row-cards">
                                    <div class="col-md-12">
                                        <x-input name="companyName" label="Company Name" :required="true"/>
                                        @error('companyName')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="mb-3">
                                            <label for="address" class="form-label required">
                                                Address
                                            </label>

                                            <textarea name="address"
                                                      id="address"
                                                      rows="3"
                                                      class="form-control form-control-solid @error('address') is-invalid @enderror"
                                            >{{ old('address') }}</textarea>

                                            @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <x-input label="City" name="city" :required="true"/>
                                        @error('city')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-md-6">
{{--                                        <label for="bank_name" class="form-label">--}}
{{--                                            Bank Name--}}
{{--                                        </label>--}}

{{--                                        <select class="form-select form-control-solid @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name">--}}
{{--                                            <option selected="" disabled="">Select a bank:</option>--}}
{{--                                            <option value="BRI" @if(old('bank_name') == 'BRI')selected="selected"@endif>BRI</option>--}}
{{--                                            <option value="BNI" @if(old('bank_name') == 'BNI')selected="selected"@endif>BNI</option>--}}
{{--                                            <option value="BCA" @if(old('bank_name') == 'BCA')selected="selected"@endif>BCA</option>--}}
{{--                                            <option value="BSI" @if(old('bank_name') == 'BSI')selected="selected"@endif>BSI</option>--}}
{{--                                            <option value="Mandiri" @if(old('bank_name') == 'Mandiri')selected="selected"@endif>Mandiri</option>--}}
{{--                                        </select>--}}

{{--                                        @error('bank_name')--}}
{{--                                        <div class="invalid-feedback">--}}
{{--                                            {{ $message }}--}}
{{--                                        </div>--}}
{{--                                        @enderror--}}
                                        <x-input label="Pincode" name="pincode" :required="true"/>
                                        @error('pincode')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>


                                    <div class="col-sm-6 col-md-6">
                                        <label for="address" class="form-label required">
                                            States
                                        </label>

                                        <select class="form-select @error('bank_name') is-invalid @enderror"
                                                id="bank_name" name="states">
                                            @foreach($states as $state)
                                                <option value="{{ $state->state_name }}">{{ $state->state_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('states')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <x-input label="GST No" name="gstNo" placeholder="Example: 29ABCDE1234F1Z5"/>
                                        @error('gstNo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="address" class="form-label required">
                                                Company in sez
                                            </label>

                                            <select class="form-select form-control-solid @error('customer_id') is-invalid @enderror" id="companyInSez" name="companyInSez">
                                                <option value="yes" >Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            @error('companyInSez')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label for="address" class="form-label required">
                                                Company Type
                                            </label>

                                            <select class="form-select form-control-solid @error('customer_id') is-invalid @enderror" id="companyType" name="companyType">
                                                <option value="supplier" >Supplier</option>
                                                <option value="customer">Customer</option>
                                            </select>
                                            @error('companyType')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <x-input label="Distance from andheri" name="distanceFromAndheri" placeholder="Kms"/>
                                        @error('distanceFromAndheri')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <x-input label="Distance from vasai" name="distanceFromVasai" placeholder="Kms"/>
                                        @error('distanceFromVasai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">
                                    {{ __('Save') }}
                                </button>

                                <a class="btn btn-outline-warning" href="{{ route('customers.index') }}">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
{{--        <div class="container">--}}
{{--            @if ($errors->any())--}}
{{--                <div class="alert alert-danger">--}}
{{--                    <ul>--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}
    </div>
</div>
@endsection

@pushonce('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce
