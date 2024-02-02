@extends('layouts.main')

@section('container')
    <div class="d-flex-column align-items-center justify-content-between mb-4">
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-icon-split mb-2">
            <span class="icon text-white-100">
                <i class="fas fa-arrow-alt-circle-left"></i>
            </span>
            <span class="text">Go Back</span>
        </a>
        <h1 class="h3 mb-0 text-gray-800">Create Transaction</h1>
    </div>

    <div class="container row">
        <div class="col-12 bg-danger">
            <h1>dfsdfdsf</h1>

            {{-- <div class="card">
                <div class="card-body">
                    <h1>dfsfsdfsd</h1>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="container row bg-primary">
        <div class="col-6 bg-warning">
            <h1>dfsdfdsf</h1>
            {{-- <div class="card">
                    <div class="card-body">
                        <h1>dfklldsfkd</h1>
                    </div>
                </div> --}}
        </div>
        <div class="col-6">
            <h1>dfsdfdsf</h1>

            {{-- <div class="card">
                    <div class="card-body">
                        <h1>dfklldsfkd</h1>
                    </div>
                </div> --}}
        </div>

    </div>
@endsection
