@extends('layouts.tabler')

@section('content')
    <div class="container mt-5">
        @if(isset($orderPieChart) and isset($orderBarChart) and isset($materialPieChart) and isset($supplierPieChart))
            <div class="container">
                <div class="row mb-4">
                    <div class="col-lg-6">
                        <!-- First Column Content -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Completed and Pending Orders</h5>
                                    <img src="data:image/png;base64,{{ base64_encode($orderPieChart) }}" alt="Generated Image">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Second Column Content -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Orders By Month</h5>
                                <img src="data:image/png;base64,{{ base64_encode($orderBarChart) }}" alt="Generated Image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-6">
                        <!-- Second Column Content -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Various Raw Materials</h5>
                                <img src="data:image/png;base64,{{ base64_encode($materialPieChart) }}" alt="Generated Image">
                            </div>
                        </div>
                    </div>
                <div class="col-lg-6">
                    <!-- Second Column Content -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Supplier Types</h5>
                            <img src="data:image/png;base64,{{ base64_encode($supplierPieChart) }}" alt="Generated Image">
                        </div>
                    </div>
                </div>
                </div>
        </div>
        @else
            <p>Error: Image data not available</p>
        @endif
    </div>
@endsection
