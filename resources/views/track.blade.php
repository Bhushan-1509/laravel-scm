@extends('layouts.tabler')

@section('content')
<body>
<div class="container mt-3">
    <h1>Product Tracking</h1>
    <form method="get" action="{{ route('track.material') }}">

        <div class="mb-3">
            <label for="product_id" class="form-label">Product ID</label>
            <input type="text" class="form-control" id="product_id" name="uuid" required>
        </div>
        <button type="submit" class="btn btn-primary">Track Product</button>
    </form>

    @if(request()->has('uuid'))
        <div class="card">
            <p class="heading-3">Challan No : {{ $product->challan_no }}</p>
            <p class="heading-3">APM Challan No : {{ $product->apm_challan }}</p>
            <p class="heading-3">Company Name : {{ $product->company_name }}</p>
        </div>
    <div class="card mt-3">
        <div class="card-header">Tracking Stages</div>
        <ul class="list-group list-group-flush">

            @for ($i = 1; $i <= $product->stage; $i++)
                <li class="list-group-item">Stage {{ $i }} completed</li>
            @endfor
        </ul>
    </div>
    @endif

</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFOnVm3LJUs+uPOnTNLrMjTlWvOm8(axhGtxQXnkUHOaIqMSvRdxaTCzNB" crossorigin="anonymous"></script>
</body>
</html>
