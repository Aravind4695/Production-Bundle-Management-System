@extends('layouts.app')

@section('content')

<h3 class="mb-4">Production Dashboard</h3>

<div class="row">

    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h6>Total Bundles</h6>
                <h3>{{ $totalBundles }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h6>Total Quantity</h6>
                <h3>{{ $totalQuantity }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h6>Total Completed</h6>
                <h3>{{ $totalCompleted }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h6>Total Rejected</h6>
                <h3>{{ $totalRejected }}</h3>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-md-4 mb-3">
        <div class="card border-primary">
            <div class="card-body">
                <h6>Average Efficiency</h6>
                <h3>{{ number_format($averageEfficiency, 2) }}%</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card border-success">
            <div class="card-body">
                <h6>Today's Production</h6>
                <h3>{{ $todayProduction }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card border-danger">
            <div class="card-body">
                <h6>Today's Rejection</h6>
                <h3>{{ $todayRejection }}</h3>
            </div>
        </div>
    </div>

</div>

@endsection