var teachers = [];
var trUpdated = 0;
if ($('#select_rol').val() * 1 === 2) {
    $("#deliveryDate").attr('disabled', true);
}
$(document).ready(function () {
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
            $("#deliveryDate").attr('disabled', true);
        } else {
            $("#deliveryDate").attr('disabled', false);
        }
    });


    $('.btn-edit-process-user').click(function () {
        if (trUpdated !== 0) {
            $("#tr-process-user-" + trUpdated).attr('hidden', false);
        }
        var id = $(this).attr('data-process-id') * 1;
        var $tr = $("#tr-process-user-" + id);
        var $td = $("#td-process-user-" + id);
        trUpdated = id;

        var id = $td.find('#inp-value-id').val();
        var name = $td.find('#inp-value-name').val();
        var rol = $td.find('#inp-value-rol').val() * 1;
        var delivery_date = $td.find('#inp-value-delivery_date').val();

        $("#fk_id_user").val(id);
        $("#inp-autocomplete").val(name);
        $("#select_rol").val(rol);
        if (rol === 2) {
            $("#deliveryDate").attr('disabled', true);
        } else {
            $("#deliveryDate").attr('disabled', false);
        }
        $("#deliveryDate").val(delivery_date);
        $("#btn-dynamic").removeClass('fa-plus-circle ').addClass('fa-check-square');
        $("#btn-dynamic-cancel").attr('hidden', false);
        $tr.attr('hidden', true);
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

