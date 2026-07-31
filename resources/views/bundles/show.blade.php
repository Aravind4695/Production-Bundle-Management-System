@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header d-flex justify-content-between">

        <h4>Bundle Details</h4>

        <a href="{{ route('bundles.index') }}" class="btn btn-secondary">
            Back
        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th>Bundle Number</th>
                <td>{{ $bundle->bundle_no }}</td>
            </tr>

            <tr>
                <th>Buyer</th>
                <td>{{ $bundle->buyer->buyer_name }}</td>
            </tr>

            <tr>
                <th>Style</th>
                <td>{{ $bundle->style->style_no }}</td>
            </tr>

            <tr>
                <th>Color</th>
                <td>{{ $bundle->color }}</td>
            </tr>

            <tr>
                <th>Size</th>
                <td>{{ $bundle->size }}</td>
            </tr>

            <tr>
                <th>Sewing Line</th>
                <td>{{ $bundle->line->line_name }}</td>
            </tr>

            <tr>
                <th>Quantity</th>
                <td>{{ $bundle->quantity }}</td>
            </tr>

            <tr>
                <th>Completed</th>
                <td>{{ $bundle->completed_qty }}</td>
            </tr>

            <tr>
                <th>Rejected</th>
                <td>{{ $bundle->rejected_qty }}</td>
            </tr>

            <tr>
                <th>Balance</th>
                <td>{{ $bundle->quantity - $bundle->completed_qty - $bundle->rejected_qty }}</td>
            </tr>

            <tr>
                <th>Efficiency</th>
                <td>{{ number_format(($bundle->completed_qty / $bundle->quantity) * 100, 2) }}%</td>
            </tr>

            <tr>
                <th>Rejection</th>
                <td>{{ number_format(($bundle->rejected_qty / $bundle->quantity) * 100, 2) }}%</td>
            </tr>

            <tr>
                <th>Operator</th>
                <td>{{ $bundle->operator_name }}</td>
            </tr>

            <tr>
                <th>Production Date</th>
                <td>{{ $bundle->production_date }}</td>
            </tr>

            <tr>
                <th>Remarks</th>
                <td>{{ $bundle->remarks }}</td>
            </tr>

        </table>

    </div>

</div>

@endsection