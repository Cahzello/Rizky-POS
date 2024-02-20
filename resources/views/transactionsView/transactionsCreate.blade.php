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
                <table class="table table-hover text-center" id="calculation" style="width: 100%">
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

    <script>
        $(document).ready(function() {
            function create_list() {
                // Create a new row
                var row = $('<tr>');

                // Add the first cell with the static string 'Milo'
                var cell1 = $('<td>').text('milo');
                row.append(cell1);

                // Add the second cell with two buttons and an input field
                var cell2 = $('<td>').css('width', '80%');

                // Create the decrement button
                var decrementButton = $('<button>').addClass('btn btn-outline-primary')
                    .append($('<i>').addClass('fas fa-minus-circle'))
                    .click(function() {
                        decrementQuantity('qty-');
                    });
                cell2.append(decrementButton);

                // Create the input field
                var input = $('<input>').attr('id', 'qty-').attr('type', 'number').css('width', '40%').val(Math
                    .floor(Math
                        .random() * 4) + 1);
                cell2.append(input);

                // Create the increment button
                var incrementButton = $('<button>').addClass('btn btn-outline-primary')
                    .append($('<i>').addClass('fas fa-plus-circle'))
                    .click(function() {
                        incrementQuantity('qty-');
                    });
                cell2.append(incrementButton);

                row.append(cell2);

                // Add the third cell with the static string '50000'
                var cell3 = $('<td>').text('50000');
                row.append(cell3);

                // Add the fourth cell with the trash button
                var cell4 = $('<td>');
                var trashButton = $('<a>').addClass('btn btn-danger').append($('<i>').addClass('fas fa-trash'));
                trashButton.click(function(event) {
                    event.preventDefault(); // Prevent the default action of the anchor tag
                    $(this).parent().parent().remove()
                });
                cell4.append(trashButton);
                row.append(cell4);

                // Append the row to the table
                $('#calculation').append(row);

            }

        });
    </script>
@endsection
