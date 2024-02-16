@extends('layouts.main')

@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customer Data</h1>
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
                    <a href="{{ route('customer.create') }}" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-100">
                            <i class="fas fa-user"></i>
                        </span>
                        <span class="text">Add Customer</span>
                    </a>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <p>Error. Please verify and check again.</p>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover text-center" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th rowspan="2" class="align-middle">No</th>
                            <th rowspan="2" class="align-middle">Customer Name</th>
                            <th rowspan="2" class="align-middle">Customer Email</th>
                            <th colspan="2" class="align-middle">Actions</th>
                        </tr>
                        <tr>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($data))
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td style="width: 5%;"> {{ $key + 1 }} </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td style="width: 10%;">
                                        <a href="{{ route('customer.edit', $item->id) }}" title="Edit"
                                            class="btn btn-warning"><i class="fas fa-pen-square "></i></a>
                                    </td>
                                    <td style="width: 10%;">
                                        <form action="{{ route('customer.destroy', $item->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button title="Delete" class="btn btn-danger"
                                                onclick="return confirm('Are you want to delete this data?')"><i
                                                    class="fas fa-trash "></i></button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">No Data</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
