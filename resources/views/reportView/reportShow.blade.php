@extends('layouts.main')

@section('container')
    <div class="d-flex-column align-items-center justify-content-between mb-4">
        <a href="{{ route('reports.index') }}" class="btn btn-secondary btn-icon-split mb-2">
            <span class="icon text-white-100">
                <i class="fas fa-arrow-alt-circle-left"></i>
            </span>
            <span class="text">Go Back</span>
        </a>
        <h1 class="h3 mb-0 text-gray-800">Report Result</h1>
    </div>

    <div class="card ">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-xl-6 col-md-6 mb-4">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint, hic exercitationem illum numquam ea
                        tenetur molestiae est quaerat ipsam consequuntur ad iste velit! Reiciendis neque autem eligendi
                        laudantium dolore amet.</p>
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
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            <h2 class="text-gray-800 mb-3">Report Between ({{ $salesSummary->start_date }}) -
                ({{ $salesSummary->end_date }})</h2>
            <h2 class="text-dark mb-3 h3">Sales Summary</h2>
            <div class="table-responsive-md">
                <table class="table table-striped table-bordered table-hover text-center" style="width: 75%;">
                    <thead class="thead-dark">
                        <tr>
                            <th class="align-middle">Total Transactions</th>
                            <th class="align-middle">Total Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $salesSummary->total_transactions }}</td>
                            <td>Rp {{ number_format($salesSummary->total_sales) }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <h2 class="text-dark mb-3 h3">Sales Product Report</h2>
            <div class="table-responsive-md">
                <table class="table table-striped table-bordered table-hover text-center" style="width: 75%;">
                    <thead class="thead-dark">
                        <tr>
                            <th class="align-middle">Item Name</th>
                            <th class="align-middle">Total Sold</th>
                            <th class="align-middle">Total Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salesByProduct as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->total_sold }}</td>
                                <td>Rp {{ number_format($item->total_sales) }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
