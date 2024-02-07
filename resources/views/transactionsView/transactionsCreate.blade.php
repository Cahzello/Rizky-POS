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

    <div class="card">
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
        <div class="row">
            <div class="card-body col-sm-8">
                <div class="container">
                    <div class="row">
                        @for ($i = 1; $i < 9; $i++)
                            <div class="col-sm-3 p-2">
                                <div class="card shadow-sm">
                                    <img src="/img/milo.jpg" style="object-fit: cover;" class="rounded" alt="tadfs"
                                        height="140px" width="100%">
                                    <div class="card-body p-2">
                                        <p class="h6">Milo</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <small class="text-body-secondary">Stock:</small>
                                                <small class="text-body-secondary">{{ rand(1, 877) }}</small>
                                            </div>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-primary">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="card-body col-sm-4">
                <table class="table table-hover text-center" style="width: 100%">
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Delete</th>
                    </tr>
                    @for ($i = 1; $i < 5; $i++)
                        <tr>
                            <td>Milo</td>
                            <td>
                                <button class="btn btn-outline-primary"
                                    onclick="decrementQuantity('qty-{{ $i }}')"><i
                                        class="fas fa-minus-circle"></i></button>
                                <input id="qty-{{ $i }}" type="number" value="{{ rand(1, 4) }}"
                                    style="width: 40%">
                                <button class="btn btn-outline-primary"
                                    onclick="incrementQuantity('qty-{{ $i }}')"><i
                                        class="fas fa-plus-circle"></i></button>
                            </td>
                            <td>50000</td>
                            <td><a href="" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                        </tr>
                    @endfor
                </table>

                <hr>

                <div class="row">
                    <span class="col">
                        <p>Subtotal:</p>
                    </span>
                    <span class="col text-right">
                        <p>470.000</p>
                    </span>
                </div>

                <hr>

                <a href="" class="btn btn-danger">Cancel</a>
                <a href="" class="btn btn-primary">Charge</a>
            </div>

        </div>
    </div>

    <script>
        function incrementQuantity(inputId) {
            var inputField = document.getElementById(inputId);
            var currentValue = parseInt(inputField.value);
            inputField.value = currentValue + 1;
        }

        function decrementQuantity(inputId) {
            var inputField = document.getElementById(inputId);
            var currentValue = parseInt(inputField.value);
            if (currentValue > 1) {
                inputField.value = currentValue - 1;
            }
        }
    </script>
@endsection
