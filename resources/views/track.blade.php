<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tracking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
</head>
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
            <p class="heading-3 mx-3">Challan No : {{ $product->challan_no }}</p>
            <p class="heading-3 mx-3">APM Challan No : {{ $product->apm_challan_no }}</p>
            <p class="heading-3 mx-3">Company Name : {{ $product->company_name }}</p>
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
    @if($product == null && request()->has('uuid'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "No product found!    ",
                footer: '<a href="#">Why do I have this issue?</a>'
            });
        </script>
    @endif

</div>
{{--<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFOnVm3LJUs+uPOnTNLrMjTlWvOm8(axhGtxQXnkUHOaIqMSvRdxaTCzNB" crossorigin="anonymous"></script>
{{--</body>--}}
</body>
</html>
