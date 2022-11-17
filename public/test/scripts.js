/* Based on http://jsfiddle.net/sqrrt/2/ */

$(document).ready(function () {
    var counter = 0;

    $(".button-add").on("click", function () {
        counter = $('#this-table tr').length - 2;

        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input class="form-control" type="text" name="title[]"/></td>';
        cols += '<td><input class="form-control" type="text" name="value[]"/></td>';

        cols += '<td><div class="button-delete"></div></td>';
        newRow.append(cols);
        $("table.sortable-table").append(newRow);
        counter++;
    });

    $("table.sortable-table").on("click", ".button-delete", function (event) {
        $(this).closest("tr").remove();

        counter -= 1
        $('.button-add').attr('disabled', false).prop('value', "Add Row");
    });
});
