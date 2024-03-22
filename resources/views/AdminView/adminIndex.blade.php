@extends('layouts.main')

@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List of Users</h1>
    </div>

    <div class="card ">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-xl-6 col-md-6 mb-2">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint, hic exercitationem illum numquam ea
                        tenetur molestiae est quaerat ipsam consequuntur ad iste velit! Reiciendis neque autem eligendi
                        laudantium dolore amet.</p>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }} <br>
                    @endforeach
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
                            <th rowspan="2" class="align-middle">Username</th>
                            <th rowspan="2" class="align-middle">User Email</th>
                            <th rowspan="2" class="align-middle">Role</th>
                            <th colspan="2" class="align-middle">Actions</th>
                        </tr>
                        <tr>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data->total() > 0)
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td style="width: 5%;"> {{ $data->firstItem() + $loop->index }} </td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td style="width: 10%;">
                                        <a href="{{ route('list-users.show', $item->id) }}" title="Edit"
                                            class="btn btn-primary"><i class="fas fa-eye"></i></a>
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
            {{ $data->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
