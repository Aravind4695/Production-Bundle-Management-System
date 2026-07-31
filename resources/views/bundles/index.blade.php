@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h3>Production Bundles</h3>

    <a href="{{ route('bundles.create') }}" class="btn btn-primary">
        + New Bundle
    </a>

</div>

<!-- filters -->
<form method="GET" action="{{ route('bundles.index') }}">

    <div class="row mb-3">

        <div class="col-md-3">
            <input type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control"
                placeholder="Search...">
        </div>

        <div class="col-md-2">
            <select name="buyer_id" class="form-select">

                <option value="">Buyer</option>

                @foreach($buyers as $buyer)

                    <option value="{{ $buyer->id }}"
                        {{ request('buyer_id') == $buyer->id ? 'selected' : '' }}>

                        {{ $buyer->buyer_name }}

                    </option>

                @endforeach

            </select>
        </div>

        <div class="col-md-2">
            <select name="style_id" class="form-select">

                <option value="">Style</option>

                @foreach($styles as $style)

                    <option value="{{ $style->id }}"
                        {{ request('style_id') == $style->id ? 'selected' : '' }}>

                        {{ $style->style_no }}

                    </option>

                @endforeach

            </select>
        </div>

        <div class="col-md-2">
            <select name="line_id" class="form-select">

                <option value="">Line</option>

                @foreach($lines as $line)

                    <option value="{{ $line->id }}"
                        {{ request('line_id') == $line->id ? 'selected' : '' }}>

                        {{ $line->line_name }}

                    </option>

                @endforeach

            </select>
        </div>

        <div class="col-md-3">
            <button class="btn btn-primary">
                Search
            </button>

            <a href="{{ route('bundles.index') }}"
            class="btn btn-secondary">

                Reset

            </a>
        </div>

    </div>

    <div class="row mb-3">

        <div class="col-md-3">

            <input type="date"
                name="date_from"
                value="{{ request('date_from') }}"
                class="form-control">

        </div>

        <div class="col-md-3">

            <input type="date"
                name="date_to"
                value="{{ request('date_to') }}"
                class="form-control">

        </div>

    </div>

</form>

<!-- table -->
<div class="card shadow">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Bundle No</th>
                        <th>Buyer</th>
                        <th>Style</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Line</th>
                        <th>Qty</th>
                        <th>Completed</th>
                        <th>Rejected</th>
                        <th>Balance</th>
                        <th>Efficiency</th>
                        <th>Rejection</th>
                        <th>Operator</th>
                        <th>Date</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($bundles as $bundle)

                    <tr>

                        <td>{{ $bundle->bundle_no }}</td>

                        <td>{{ $bundle->buyer->buyer_name }}</td>

                        <td>{{ $bundle->style->style_no }}</td>

                        <td>{{ $bundle->color }}</td>

                        <td>{{ $bundle->size }}</td>

                        <td>{{ $bundle->line->line_name }}</td>

                        <td>{{ $bundle->quantity }}</td>

                        <td>{{ $bundle->completed_qty }}</td>

                        <td>{{ $bundle->rejected_qty }}</td>

                        <td>
                            {{ $bundle->quantity - $bundle->completed_qty - $bundle->rejected_qty }}
                        </td>

                        <td>
                            {{ number_format(($bundle->completed_qty / $bundle->quantity) * 100, 2) }}%
                        </td>

                        <td>
                            {{ number_format(($bundle->rejected_qty / $bundle->quantity) * 100, 2) }}%
                        </td>

                        <td>{{ $bundle->operator_name }}</td>

                        <td>{{ $bundle->production_date }}</td>

                        <td>

                            <a href="{{ route('bundles.show',$bundle->id) }}"
                               class="btn btn-sm btn-info">

                                View

                            </a>

                            <a href="{{ route('bundles.edit',$bundle->id) }}"
                               class="btn btn-sm btn-warning">

                                Edit

                            </a>
                            <form action="{{ route('bundles.destroy', $bundle->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this bundle?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="15" class="text-center">

                            No Bundles Found

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        {{ $bundles->links() }}

    </div>

</div>

@endsection