var teachers = [];
var trUpdated = 0;

$("#deliveryDate").attr('disabled', true);

$(document).ready(function () {
    if ($("#update-row").val() !== "") {
        setTimeout(function () {
            updated(null, document.getElementById('update-row').value * 1);
        }, 1000);
    }
    fetchTeachers(function () {
        console.log(teachers);
        $('#inp-autocomplete').autocomplete({
            lookup: teachers,
            onSelect: function (suggestion) {
                $("#fk_id_user").val(suggestion.data);
            }
        });
    });

    $('#select_rol').change(function () {
        var val = $(this).val() * 1;
        if (val === 2) {
            // $("#deliveryDate").attr('disabled', true);
        } else {
            // $("#deliveryDate").attr('disabled', false);
        }
    });


    $('.btn-edit-process-user').click(function () {
        updated(this);
    });

    function updated(btn, btnId = 0) {
        if (trUpdated !== 0) {
            $("#tr-process-user-" + trUpdated).attr('hidden', false);
        }
        var id;
        if (btnId === 0) {
            id = $(btn).attr('data-process-id') * 1;
        } else {
            id = btnId;
        }
        var $tr = $("#tr-process-user-" + id);
        var $td = $("#td-process-user-" + id);
        trUpdated = id;

        var id = $td.find('#inp-value-id').val();
        var idProcess = $td.find('#inp-value-id-process').val();
        var name = $td.find('#inp-value-name').val();
        var rol = $td.find('#inp-value-rol').val() * 1;
        var delivery_date = $td.find('#inp-value-delivery_date').val();

        if (btnId === 0) {
            $("#fk_id_user").val(id);
            $("#inp-autocomplete").val(name);
            $("#select_rol").val(rol);
            $("#deliveryDate").val(delivery_date);
        }
        if (rol === 2) {
            $("#deliveryDate").attr('disabled', true);
        } else {
            $("#deliveryDate").attr('disabled', false);
        }
        $("#inp-autocomplete").prop('readonly', true);
        $("#update-row").val(idProcess);
        $("#btn-dynamic").removeClass('fa-plus-circle ').addClass('fa-check-square');
        $("#btn-dynamic-cancel").attr('hidden', false);

        $tr.attr('hidden', true);
    }


    $("#btn-dynamic-cancel").click(function () {
        $("#tr-process-user-" + trUpdated).attr('hidden', false);
        $("#fk_id_user").val("");
        $("#inp-autocomplete").prop('readonly', false);
        $("#inp-autocomplete").val("");
        $("#deliveryDate").val("");
        $("#deliveryDate").attr('disabled', true);

        $("#update-row").val("");
        $("#btn-dynamic").addClass('fa-plus-circle ').removeClass('fa-check-square');
        $("#btn-dynamic-cancel").attr('hidden', true);
    });

});

function fetchTeachers(ready) {
    $.ajax({
        url: $("#inp-users").val(),
        dataType: 'JSON',
        success: function (result) {
            result.forEach(function (item) {
                teachers.push({value: item.full_name, data: item.id});
            });
            ready();
        }
    });
}

