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
            <div class="card-body col-lg-7">
                <div class="container">
                    <div class="row">
                        @foreach ($data_item as $item)
                            <div class="col-lg-4 p-2">
                                <div class="card shadow-sm">
                                    <img src="/img/milo.jpg" style="object-fit: cover;" class="rounded" alt="tadfs"
                                        height="140px" width="100%">
                                    <div class="card-body p-2">
                                        <p class="h6">{{ $item->name }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <small class="text-body-secondary">Stock:</small>
                                                <small class="text-body-secondary">{{ $item->stock_level }}</small>
                                                <br>
                                                <small class="text-body-secondary">price:</small>
                                                <small class="text-body-secondary">{{ number_format($item->price) }}</small>
                                            </div>
                                            <div class="btn-group">
                                                <button type="button"
                                                    onclick="create_list({{ $item->id }}, '{{ $item->name }}', '{{ number_format($item->price) }}')"
                                                    class="btn btn-sm btn-outline-primary">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card-body col-lg-5">
                <table class="table table-hover text-center" id="calculation" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Delete</th>
                        </tr>

                    </thead>
                    <tbody id="calculation_data">
                        <tr>
                            <td colspan="4">The list is currently empty.</td>
                        </tr>
                    </tbody>
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
        let addedIds = new Set();

        function create_list(id, name, price) {
            $(document).ready(() => {
                if (addedIds.has(id)) {
                    alert('Duplicate entry is not allowed.');
                    return;
                }

                addedIds.add(id);

                let tbody = $('#calculation_data');
                let emptyMessageRow = tbody.find('tr td:contains("The list is currently empty.")');
                console.log(tbody.children());
                if (tbody.children().length == 1 && emptyMessageRow.length == 0) {
                    tbody.append('<tr><td colspan="4">The list is currently empty.</td></tr>');
                }

                create_calc(id, name, price, emptyMessageRow);

                function create_calc(id, name, price) {
                    let row = $('<tr>');

                    let cell1 = $('<td>').text(name);
                    row.append(cell1);

                    let cell2 = $('<td>').css('width', 'auto');

                    let input = $('<input>').attr('id', `qty-${id}`).attr('type', 'number').attr('value', 1).css(
                        'width', '60%');
                    cell2.append(input);

                    let jarak = $('<br>');
                    cell2.append(jarak);

                    let decrementButton = $('<button>').addClass('btn btn-outline-primary')
                        .append($('<i>').addClass('fas fa-minus-circle'))
                        .click(function() {
                            decrementQuantity(`qty-${id}`);
                        });
                    cell2.append(decrementButton);


                    let incrementButton = $('<button>').addClass('btn btn-outline-primary')
                        .append($('<i>').addClass('fas fa-plus-circle'))
                        .click(function() {
                            incrementQuantity(`qty-${id}`);
                        });
                    cell2.append(incrementButton);

                    row.append(cell2);

                    let cell3 = $('<td>').text(price);
                    row.append(cell3);

                    let cell4 = $('<td>');
                    let trashButton = $('<a>').addClass('btn btn-danger').append($('<i>').addClass('fas fa-trash'));
                    trashButton.click(function(event) {
                        event.preventDefault();
                        addedIds.delete(id);
                        $(this).parent().parent().remove()
                    });
                    cell4.append(trashButton);
                    row.append(cell4);

                    if (emptyMessageRow.length > 0) {
                        emptyMessageRow.parent().remove();
                    }

                    $('#calculation').append(row);
                }
            });

        }



        function remove_item(id) {
            $(document).ready(() => {
                // Remove the item with the given id
                $(`#qty-${id}`).closest('tr').remove();

                // Check if the list is empty after removal
                let tbody = $('#calculation_data');
                if (tbody.children().length === 0) {
                    // If the list is empty, add the explanation message
                    tbody.append('<tr><td colspan="4">The list is currently empty.</td></tr>');
                }
            });
        }
    </script>
@endsection
