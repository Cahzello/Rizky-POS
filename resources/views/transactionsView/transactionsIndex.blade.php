@extends('layouts.main')

@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transactions</h1>
    </div>

    <div class="card ">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-xl-6 col-md-6 mb-2">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint, hic exercitationem illum numquam ea
                        tenetur molestiae est quaerat ipsam consequuntur ad iste velit! Reiciendis neque autem eligendi
                        laudantium dolore amet.</p>
                </div>
                <div class="col-xl-auto col-md-6 mb-2">
                    <a href="{{route('transactions.create')}}" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-100">
                            <i class="fas fa-exchange-alt"></i>
                        </span>
                        <span class="text">Create Transactions</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive-md">
                <table class="table table-striped table-bordered table-hover text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Cashier Name</th>
                            <th>Customer Name</th>
                            <th>Total Amount</th>
                            <th>Timestamps</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>udin</td>
                            <td>fath</td>
                            <td>10000000</td>
                            <td>123455</td>
                            <td>
                                <a href="" title="Edit Transactions" class="btn btn-warning"><i
                                        class="fas fa-pen-square "></i> Edit Data</a>
                            </td>
                            <td>
                                <a href="" title="Delete Transactions" class="btn btn-danger"><i
                                    class="fas fa-trash "></i> Delete Data</a>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
