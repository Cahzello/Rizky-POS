@extends('layouts.main')


@section('container')
    <div class="d-flex-column align-items-center justify-content-between mb-4">
        <a href="{{ route('list-users.index') }}" class="btn btn-secondary btn-icon-split mb-2">
            <span class="icon text-white-100">
                <i class="fas fa-arrow-alt-circle-left"></i>
            </span>
            <span class="text">Go Back</span>
        </a>
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
            <form action="{{route('list-users.update', $data->id)}}" method="post">
                @method('PUT')
                @csrf
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Username: </span>
                    <input type="text" value="{{ $data->username }}" class="form-control" aria-label="Username"
                        aria-describedby="basic-addon1" disabled>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Email: </span>
                    <input type="text" value="{{ $data->email }}" class="form-control" aria-label="Username"
                        aria-describedby="basic-addon1" disabled>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Role: </span>
                    <input type="text" value="{{ $data->role }}" class="form-control" aria-label="Username"
                        aria-describedby="basic-addon1" disabled>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Change Role: </span>
                    <select name="role" class="form-select" aria-label="Default select example">
                        <option value="NULL" selected>Open this select menu</option>
                        <option value="admin">admin</option>
                        <option value="user">user</option>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary">
            </form>
            <hr>
            <form action="{{ route('list-users.destroy', $data->id) }}" method="post">
                @method('delete')
                @csrf
                <input type="submit" class="btn btn-danger" value="Delete Account"
                    onclick="return confirm('Apakah anda mau menghapus akun ini? ')">
                <div class="alert alert-danger my-3">
                    <p>This action take delete the account and all records data have been created.</p>
                </div>
            </form>
        </div>
    </div>
@endsection
