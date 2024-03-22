@extends('layouts.main')

@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Generate Reports</h1>
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
            <form action="" method="POST">
                @csrf
                <div>
                    <label for="cost-price">Start Date</label>
                    <div class="input-group mb-3 w-50">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                            value="{{ old('start_date') }}" id="cost-price" name="start_date">
                        @error('start_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="cost-price">End Date</label>
                    <div class="input-group mb-3 w-50">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                            value="{{ old('end_date') }}" id="cost-price" name="end_date">
                        @error('end_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <input type="submit" value="Submit" class="btn btn-primary">
            </form>

            
            <div class="table-responsive-md my-4">
                <h2 class="text-dark mb-3 h3">Reports Data</h2>
                <table class="table table-striped table-bordered table-hover text-center" style="width: 100%;">
                    <thead class="thead-dark">
                        <tr>
                            <th class="align-middle">No</th>
                            <th class="align-middle">Date Report Created</th>
                            <th class="align-middle">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 10%;">1</td>
                            <td>sfdsf</td>
                            <td>sdfdsf</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
