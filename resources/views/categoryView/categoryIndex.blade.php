@extends('layouts.main')

@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Category</h1>
    </div>

    <div class="card ">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-xl-6 col-md-6 mb-4">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint, hic exercitationem illum numquam ea
                        tenetur molestiae est quaerat ipsam consequuntur ad iste velit! Reiciendis neque autem eligendi
                        laudantium dolore amet.</p>
                </div>
                <div class="col-xl-auto col-md-6 m b-2">
                    <a href="{{route('category.create')}}" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-100">
                            <i class="fas fa-filter"></i>
                        </span>
                        <span class="text">Add Category</span>
                    </a>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>udin</td>
                            <td>
                                <a href="" title="Edit Transactions" class="btn btn-warning"><i
                                        class="fas fa-pen-square "></i></a>
                                <a href="" title="Delete Transactions" class="btn btn-danger"><i
                                        class="fas fa-trash "></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
