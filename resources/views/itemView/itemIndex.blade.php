@extends('layouts.main')

@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Items</h1>
    </div>

    <div class="card ">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-xl-6 col-md-6 mb-4">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint, hic exercitationem illum numquam ea
                        tenetur molestiae est quaerat ipsam consequuntur ad iste velit! Reiciendis neque autem eligendi
                        laudantium dolore amet.</p>
                </div>
                <div class="col-xl-auto col-md-6 mb-2">
                    <a href="{{ route('items.create') }}" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-100">
                            <i class="fas fa-dolly-flatbed"></i>
                        </span>
                        <span class="text">Add Item</span>
                    </a>
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
            <div class="table-responsive-md">
                <table class="table table-striped table-bordered table-hover text-center" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th rowspan="2" class="align-middle">No</th>
                            <th rowspan="2" class="align-middle">Nama Item</th>
                            <th rowspan="2" class="align-middle">Stock</th>
                            <th rowspan="2" class="align-middle">Price</th>
                            <th rowspan="2" class="align-middle">Cost Price</th>
                            <th rowspan="2" class="align-middle">Category</th>
                            <th colspan="2">Actions</th>
                        </tr>
                        <tr>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($data->total() > 0)
                            @foreach ($data as $key => $item)
                                <tr id="{{ 'data_' . $item->id}}">
                                    <td style="width: 5%;">{{ $data->firstItem() + $loop->index }}</td>
                                    <td>{{$item->name}}</td>
                                    <td {{$item->stock_level == 0 ? 'class=table-danger' : ''}}>{{$item->stock_level}}</td>
                                    <td>Rp {{number_format($item->price)}}</td>
                                    <td>Rp {{number_format($item->cost_price)}}</td>
                                    <td>{{ $category[$key]}}</td>
                                    <td style="width: 10%;">
                                        <a href="{{route('items.edit', $item->id)}}" title="Edit" class="btn btn-warning"><i
                                                class="fas fa-pen-square"></i> </a>
                                    </td>
                                    <td style="width: 10%;">
                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button title="Delete" class="btn btn-danger"
                                                onclick="return confirm('Are you want to delete this data?')"><i
                                                    class="fas fa-trash "></i></button>
                                        </form>                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">No Data</td>
                            </tr>
                        @endif


                    </tbody>
                </table>
            </div>
            {{$data->links('pagination::bootstrap-4')}}
        </div>
    </div>
@endsection
