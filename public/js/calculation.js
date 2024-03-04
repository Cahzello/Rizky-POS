let addedIds = new Set();
let total = [];

function create_list(id, name, price) {
    $(document).ready(() => {
        if (addedIds.has(id)) {
            alert("Duplicate entry is not allowed.");
            return;
        }
        let tbody = $("#calculation_data");

        addedIds.add(id);
        updateEmptyMessage(tbody);
        create_calc(id, name, price);
    });
}

function updateEmptyMessage(tbody) {
    let emptyMessageRow = tbody.find(
        'tr td:contains("The list is currently empty.")'
    );
    if (addedIds.size > 0 && emptyMessageRow.length > 0) {
        // If there are items and the empty message is present, remove the empty message
        emptyMessageRow.parent().remove();
    } else if (addedIds.size == 0 && emptyMessageRow.length == 0) {
        // If there are no items and the empty message is not present, add the empty message
        tbody.append(
            '<tr><td colspan="4">The list is currently empty.</td></tr>'
        );
    }
}

function create_calc(id, name, price) {
    let tbody = $("#calculation_data");
    let row = $("<tr>");

    let cell1 = $("<td>").text(name);
    row.append(cell1);

    let cell2 = $("<td>").css("width", "auto");

    let input = $("<input>")
        .attr("id", `qty-${id}`)
        .attr("type", "number")
        .attr("value", 1)
        .change((event) => {
            let inputValue = event.target.value;
            addItem(id, price, inputValue);
        })
        .css("width", "60%");
    cell2.append(input);

    let jarak = $("<br>");
    cell2.append(jarak);

    let decrementButton = $("<button>")
        .addClass("btn btn-outline-primary")
        .append($("<i>").addClass("fas fa-minus-circle"))
        .click(function () {
            decrementQuantity(`qty-${id}`);
            // addItem(id, price, 1);
        });
    cell2.append(decrementButton);

    let incrementButton = $("<button>")
        .addClass("btn btn-outline-primary")
        .append($("<i>").addClass("fas fa-plus-circle"))
        .click(function () {
            incrementQuantity(`qty-${id}`);
            // addItem(id, price, 1);
        });
    cell2.append(incrementButton);

    row.append(cell2);

    let displayPrice = Intl.NumberFormat(['ban', 'id'], {style: 'currency', currency: 'IDR'}).format(price);
    let cell3 = $("<td>").text(displayPrice).attr("id", `price`);
    row.append(cell3);

    let cell4 = $("<td>");
    let trashButton = $("<a>")
        .addClass("btn btn-danger")
        .append($("<i>").addClass("fas fa-trash"));
    trashButton.click(function (event) {
        event.preventDefault();
        addedIds.delete(id);
        updateEmptyMessage(tbody);
        $(this).parent().parent().remove();
        removeItem(id);
    });
    cell4.append(trashButton);
    row.append(cell4);

    $("#calculation").append(row);
    addItem(id, price, 1);
}

function addItem(id, price, quantity) {
    let item = total.find((item) => item.id === id);
    if (item) {
        item.quantity = quantity;
    } else {
        total.push({ id: id, price: parseFloat(price), quantity: quantity });
    }

    console.log(sumPrice());
    console.log(total);
}

function removeItem(id) {
    let index = total.findIndex((item) => item.id === id);
    console.log(index);
    if (index !== -1) {
        total.splice(index, 1);
    }

    console.log(total);
    console.log(sumPrice());
}

function increaseQuantity(id) {
    let item = total.find((item) => item.id === id);
    if (item) {
        item.quantity++;
    }

    console.log(sumPrice());
    console.log(total);
}

function decreaseQuantity(id) {
    let item = total.find((item) => item.id === id);
    if (item && item.quantity > 0) {
        item.quantity--;
    }

    console.log(sumPrice());
    console.log(total);
}

function sumPrice() {
    let totalPrice = total.reduce((total, item) => {
        return total + item.price * item.quantity;
    }, 0);
    let finalPrice = totalPrice.toFixed(0);
    updatePriceView(finalPrice);
    return finalPrice;
}

function incrementQuantity(inputId) {
    let inputField = document.getElementById(inputId);
    let currentValue = parseInt(inputField.value);
    inputField.value = currentValue + 1;
    inputField.dispatchEvent(new Event('change'));
}

function decrementQuantity(inputId) {
    let inputField = document.getElementById(inputId);
    let currentValue = parseInt(inputField.value);
    if (currentValue > 1) {
        inputField.value = currentValue - 1;
    }
    inputField.dispatchEvent(new Event('change'));
}

function updatePriceView(updatedPrice) {
    let displayPrice = updatedPrice === 0 ? 0 : updatedPrice;
    let priceView = document.getElementById("subtotal");
    priceView.innerText = Intl.NumberFormat(['ban', 'id'], {style: 'currency', currency: 'IDR'}).format(displayPrice);
}
window.addEventListener("load", () => {
    updatePriceView(0);
});

window.addEventListener("beforeunload", (e) => {
    e.preventDefault();
    e.returnValue = true;
});
