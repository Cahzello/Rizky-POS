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
                    <label for="item-name">Item Name</label>
                    <div class="input-group mb-3 w-50">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-dolly-flatbed"></i></span>
                        </div>
                        <input type="text" class="form-control @error('item-name') is-invalid @enderror" value="{{old('item-name')}}" id="item-name" name="item-name" autofocus>
                        @error('item-name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="item-price">Item Price</label>
                    <div class="input-group mb-3 w-50">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                        </div>
                        <input type="number" class="form-control @error('item-price') is-invalid @enderror" value="{{old('item-price')}}" id="item-price" name="item-price">
                        @error('item-price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="item-stock">Item Stock Level</label>
                    <div class="input-group mb-3 w-50">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                        </div>
                        <input type="number" class="form-control @error('item-stock') is-invalid @enderror" value="{{old('item-stock')}}" id="item-stock" name="item-stock">
                        @error('item-stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="item-category">Item Category</label>
                    <p>Haven't create category?<a href="{{route('category.index')}}"> Create one</a></p>
                    <div class="input-group mb-3 w-50">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                        </div>
                        <select class="form-control @error('item-category') is-invalid @enderror" id="item-category" name="item-category">
                            <option value="">null</option>
                            <option value="barang">Barang</option>
                        </select>
                        @error('item-category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="item-cost-price">Item Cost Price</label>
                    <div class="input-group mb-3 w-50">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-coins"></i></span>
                        </div>
                        <input type="number" class="form-control @error('item-cost-price') is-invalid @enderror" value="{{old('item-name')}}" id="item-cost-price" name="item-cost-price">
                        @error('item-cost-price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <label for="item-desc">Item Description (Optional)</label>
                    <div class="input-group w-50">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-edit"></i></span>
                        </div>
                        <textarea class="form-control" id="item-desc" name="item-desc"></textarea>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection
