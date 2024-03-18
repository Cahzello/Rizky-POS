@extends('layouts.main')

@section('container')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-whphp ite-50"></i> Generate Report</a>
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

    <!-- Content Row -->
    {{-- <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Earnings (Monthly)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div> --}}

    <!-- Content -->
    <div class="row">
        <div class="col-lg-6 mb-2">

            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Latest Item Created</h6>
                </div>
                <div class="card-body">
                    @if ($data['itemData'] == null)
                        <p>No Data Created</p>
                        <a href="{{ route('items.create') }}" class="btn btn-primary">Create Item</a>
                    @else
                        <p>Item Name: {{ $data['itemData']->name }}</p>
                        <p>Date Item Created:
                            {{ $data['itemData']->created_at->setTimeZone('Asia/Jakarta')->toDayDateTimeString() }}</p>
                        <p>Date Item Updated:
                            {{ $data['itemData']->updated_at->setTimeZone('Asia/Jakarta')->toDayDateTimeString() }}</p>
                    @endif
                </div>
            </div>

        </div>

        <div class="col-lg-6 mb-2">

            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Latest Category Created</h6>
                </div>
                <div class="card-body">
                    @if ($data['categoryData'] == null)
                        <p>No Data Created</p>
                        <a href="{{ route('category.create') }}" class="btn btn-primary">Create Category</a>
                    @else
                        <p>Item Name: {{ $data['categoryData']->name }}</p>
                        <p>Date Item Created:
                            {{ $data['categoryData']->created_at->setTimeZone('Asia/Jakarta')->toDayDateTimeString() }}</p>
                        <p>Date Item Updated:
                            {{ $data['categoryData']->updated_at->setTimeZone('Asia/Jakarta')->toDayDateTimeString() }}</p>
                    @endif
                </div>
            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Latest Customer Inputted</h6>
                </div>
                <div class="card-body">
                    @if ($data['customerData'] == null)
                        <p>No Data Inputted</p>
                        <a href="{{ route('customer.create') }}" class="btn btn-primary">Input Customer</a>
                    @else
                        <p>Item Name: {{ $data['customerData']->name }}</p>
                        <p>Date Item Created:
                            {{ $data['customerData']->created_at->setTimeZone('Asia/Jakarta')->toDayDateTimeString() }}</p>
                        <p>Date Item Updated:
                            {{ $data['customerData']->updated_at->setTimeZone('Asia/Jakarta')->toDayDateTimeString() }}</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
