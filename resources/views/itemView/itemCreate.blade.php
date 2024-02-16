@extends('layouts.main')

@section('container')
    <div class="d-flex-column align-items-center justify-content-between mb-4">
        <a href="{{ route('items.index') }}" class="btn btn-secondary btn-icon-split mb-2">
            <span class="icon text-white-100">
                <i class="fas fa-arrow-alt-circle-left"></i>
            </span>
            <span class="text">Go Back</span>
        </a>
        <h1 class="h3 mb-0 text-gray-800">Input Data Item</h1>
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
                    <p>Error. Form hasn't meet requirement. Please verify again.</p>
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('items.store') }}" method="POST">
                @csrf
                <div class="has-validation">
                    <label for="name">Item Name</label>
                    <div class="input-group mb-3 w-50">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-dolly-flatbed"></i></span>
                        </div>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" id="name" name="name" autofocus>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="price">Item Price</label>
                    <div class="input-group mb-3 w-50">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                        </div>
                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                            value="{{ old('price') }}" id="price" name="price">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="cost-price">Item Cost Price</label>
                    <div class="input-group mb-3 w-50">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-coins"></i></span>
                        </div>
                        <input type="number" class="form-control @error('cost_price') is-invalid @enderror"
                            value="{{ old('cost_price') }}" id="cost-price" name="cost_price">
                        @error('cost_price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="stock">Item Stock Level</label>
                    <div class="input-group mb-3 w-50">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                        </div>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror"
                            value="{{ old('stock_level') }}" id="stock" name="stock_level">
                        @error('stock_level')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="category">Item Category</label>
                    <div class="input-group mb-3 w-50">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                        </div>
                        <select class="form-control @error('category') is-invalid @enderror" id="category"
                            name="categories_id">
                            <option value="">null</option>
                            @foreach ($data as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <p>Haven't create category?<a href="{{ route('category.index') }}"> Create one</a></p>
                </div>
                <input type="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection
