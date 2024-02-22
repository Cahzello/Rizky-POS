let addedIds = new Set();
let tbody = $("#calculation_data");

function create_list(id, name, price) {
    $(document).ready(() => {
        if (addedIds.has(id)) {
            alert("Duplicate entry is not allowed.");
            return;
        }
        let emptyMessageRow = tbody.find(
            'tr td:contains("The list is currently empty.")'
        );
        addedIds.add(id);
        check_list(emptyMessageRow);
        // console.log(tbody.children())
        console.log(emptyMessageRow);
        create_calc(id, name, price, emptyMessageRow);
    });
}

function check_list(param) {
    console.log("func check");  
    console.log(param);

    if (addedIds.size == 0 && param.length == 1) {
        tbody.append(
            '<tr><td colspan="4">The list is currently empty.</td></tr>'
        );
    }
}

function create_calc(id, name, price, emptyMessageRow) {
    let row = $("<tr>");

    let cell1 = $("<td>").text(name);
    row.append(cell1);

    let cell2 = $("<td>").css("width", "auto");

    let input = $("<input>")
        .attr("id", `qty-${id}`)
        .attr("type", "number")
        .attr("value", 1)
        .css("width", "60%");
    cell2.append(input);

    let jarak = $("<br>");
    cell2.append(jarak);

    let decrementButton = $("<button>")
        .addClass("btn btn-outline-primary")
        .append($("<i>").addClass("fas fa-minus-circle"))
        .click(function () {
            decrementQuantity(`qty-${id}`);
        });
    cell2.append(decrementButton);

    let incrementButton = $("<button>")
        .addClass("btn btn-outline-primary")
        .append($("<i>").addClass("fas fa-plus-circle"))
        .click(function () {
            incrementQuantity(`qty-${id}`);
        });
    cell2.append(incrementButton);

    row.append(cell2);

    let cell3 = $("<td>").text(price);
    row.append(cell3);

    let cell4 = $("<td>");
    let trashButton = $("<a>")
        .addClass("btn btn-danger")
        .append($("<i>").addClass("fas fa-trash"));
    trashButton.click(function (event) {
        event.preventDefault();
        addedIds.delete(id);
        console.log(addedIds);
        check_list(emptyMessageRow);
        console.log(emptyMessageRow.length);

        $(this).parent().parent().remove();
    });
    cell4.append(trashButton);
    row.append(cell4);

    if (emptyMessageRow.length > 0) {
        emptyMessageRow.parent().remove();
    }

    $("#calculation").append(row);
}

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
