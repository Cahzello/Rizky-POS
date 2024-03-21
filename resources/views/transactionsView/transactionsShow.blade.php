@extends('layouts.main')

@section('container')
    <div class="d-flex-column align-items-center justify-content-between mb-4">
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-icon-split mb-2">
            <span class="icon text-white-100">
                <i class="fas fa-arrow-alt-circle-left"></i>
            </span>
            <span class="text">Go Back</span>
        </a>
        <h1 class="h3 mb-0 text-gray-800">Transaction Detail</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-xl-6 col-md-6 mb-2">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint, hic exercitationem illum numquam ea
                        tenetur molestiae est quaerat ipsam consequuntur ad iste velit! Reiciendis neque autem eligendi
                        laudantium dolore amet.</p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive-md mb-3">
                <table class="table table-striped table-bordered table-hover text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th rowspan="2" class="align-middle">Transactions ID</th>
                            <th rowspan="2" class="align-middle">Cashier Name</th>
                            <th rowspan="2" class="align-middle">Customer Name</th>
                            <th rowspan="2" class="align-middle">Total Amount</th>
                            <th rowspan="2" class="align-middle">Timestamps</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 5%;"> {{ $transactionData->id }} </td>
                            <td> {{ $cashierName }} </td>
                            <td> {{ $customerName }} </td>
                            <td>Rp {{ number_format($transactionData->total_amount) }} </td>
                            <td> {{ $transactionData->created_at->setTimeZone('Asia/Jakarta')->toDayDateTimeString() }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2 class="h3 text-gray-800 mb-3">List Item</h2>
            @foreach ($itemData as $key => $item)
                <div class="table-responsive-md">
                    <table class="table table-striped table-bordered table-hover text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th rowspan="2" class="align-middle">Item Name</th>
                                <th rowspan="2" class="align-middle">Price</th>
                                <th rowspan="2" class="align-middle">Cost Price</th>
                                <th rowspan="2" class="align-middle">Category</th>
                                <th rowspan="2" class="align-middle">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 20%;"> {{ $item->name }} </td>
                                <td>Rp {{ number_format($item->price) }} </td>
                                <td>Rp {{ number_format($item->cost_price) }} </td>
                                <td>{{ $category[$key] }} </td>
                                <td> {{ $transactionItem[$key]->quantity }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endforeach

        </div>
    </div>
@endsection
