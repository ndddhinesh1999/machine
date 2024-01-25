
function toggle_truncate(value) {

    var check = $('#truncate').prop('checked');
    if (check == true) {
        $('.truncate').each(function () {
            $(this).attr('checked', true);
        });
    } else {
        $('.truncate').each(function () {
            $(this).attr('checked', false);
        });

    }
}
function toggle_drop(value) {

    var check = $('#drop').prop('checked');
    if (check == true) {
        $('.drop').each(function () {
            $(this).attr('checked', true);
        });
    } else {
        $('.drop').each(function () {
            $(this).attr('checked', false);
        });
    }
}

function toggle_db(id) {
    var check = $('#db_modify' + id).prop('checked');
    if (check == true) {
        $('.db_form' + id).each(function () {
            $(this).attr('disabled', false);
            var $checkboxes = $("input[name='primary[]']");
            var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
            if (countCheckedCheckboxes == 0) {
                $('#primary' + id).attr('disabled', false);
            } else {
                $('#primary' + id).attr('disabled', true);
            }
            $('#db_modify' + id).attr('checked', true);
        });
    } else {
        $('.db_form' + id).each(function () {
            $(this).attr('disabled', true);
            $('#primary' + id).prop('checked', false);
            $('#primary' + id).attr('disabled', true);
            $('#db_modify' + id).attr('checked', false);
        });

    }
}
function toggle() {
    var check = $('#db_checkbox').prop('checked');
    if (check == true) {
        $('.db_checkbox').each(function () {
            $(this).attr('checked', true);
        });
        $('.db_select_all').each(function () {
            $(this).attr('disabled', false);
        });
        var $checkboxes = $("input[name='primary[]']");
        var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
        if (countCheckedCheckboxes == 0) {
            $('.primary_key').each(function () {
                $(this).attr('disabled', false);
            });
        } else {
            $('.primary_key').each(function () {
                var check_box = $(this).prop('checked');
                if (check_box == false) {
                    $(this).attr('disabled', true);
                }

            });
        }
    } else {
        $('.db_checkbox').each(function () {
            $(this).attr('checked', false);
        });
        $('.db_select_all').each(function () {
            $(this).attr('disabled', true);
        });
        $('.primary_key').each(function () {
            $(this).attr('disabled', true);
            $(this).attr('checked', false);
        });
    }
}

$('#table_name').on('change', function () {
    var table_name = $(this).val();

    $.get('features-ajax.php?action=get_colom', { table_name: table_name }, function (data) {
        if (data == 1) {
            console.log(data);
            $('.coloms_div').html('<div class="d-flex justify-content-center"><p class="mt-4 text-danger">No records found</p></div>');
        } else {
            $('.coloms_div').html(data);
        }

    });
    if (table_name != '') {
        $('#update_db').show();
    } else {
        $('#update_db').hide();
    }
})

function add_row(page) {
    var type = page;

    var length = $('#db_table tr').length;
    var append_row = '<tr><td> <input type="checkbox" name="field[]" value="" id="db_modify' + length + '" onclick="toggle_db(' + length + ')"  class="form-check-input db_checkbox"></td><td> ' + length + '</td><td><input type="text" value="" name="field_name[]" disabled id="field_name' + length + '" class="form-control db_form' + length + ' db_select_all"><input type="hidden" value="" name="hidden_field_name[]" disabled id="hidden_field_name' + length + '"  class="form-control db_form' + length + ' db_select_all"></td><td><select name="type[]" disabled id="type' + length + '" class="form-select db_form' + length + ' db_select_all"><option value=""></option></select><input type="hidden" value="" name="hidden_type[]" disabled id="hidden_type' + length + '" class="form-control db_form' + length + ' db_select_all"> </td> <td>  <input type="text" value="" name="length[]" disabled id="length' + length + '" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control db_form' + length + ' db_select_all"> <input type="hidden" value="" name="hidden_length[]" disabled id="hidden_length' + length + '" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control db_form' + length + ' db_select_all"></td> <td> <input type="text" value="" name="default[]" disabled id="default' + length + '" class="form-control db_form' + length + ' db_select_all"> <input type="hidden" value="" name="hidden_default[]" disabled id="hidden_default' + length + '" class="form-control db_form' + length + ' db_select_all"></td> ';
    if (type == 'create') {
        append_row += '<td> <input type="checkbox" name="primary[]" value="" id="primary' + length + '"  class="form-check-input primary_key" disabled onclick="primary_check(' + length + ');"></td>';
    }
    append_row += '</tr>';
    $.get('features-ajax.php?action=get_type', function (data) {
        $('#type' + length).html(data);
    });
    $('#db_table').append(append_row);
}

function primary_check(id) {
    var main_check_box = $('#db_modify' + id).prop('checked');
    var check = $('#primary' + id).prop('checked');
    if (check == true) {
        var fiel_name = $('#field_name' + id).val();
        if (fiel_name == '') {
            $('#field_name' + id).attr('class', 'form-control is-invalid');
        } else {
            $('#field_name' + id).attr('class', 'form-control is-valid');
        }
        $('.primary_key').each(function () {

            $(this).attr('disabled', true);
        });
        $('#primary' + id).attr('disabled', false);
    } else {
        $('.primary_key').each(function () {
            $(this).attr('disabled', false);
        });
        $('#field_name' + id).attr('class', 'form-control');
        $('#primary' + id).attr('disabled', false);
    }
}
function myFunction() {
    $('.form_cheeck').each(function () {
        var check = $(this).is('checked');
        if ($(this).is(':checked')) {
            $(this).attr('disabled', false);
        } else {
            $(this).attr('disabled', true);
        }
    })
    return true;
}
function check_table_name() {
    var table_name = $('#create_table_name').val();
    if (table_name != '') {
        $.get('features-ajax.php?action=check_table_name', { table_name: table_name }, function (data) {
            if (data == 1) {
                $('#create_table_name').attr('class', 'form-control is-invalid');
            } else {
                $('#create_table_name').attr('class', 'form-control is-valid');
            }

        });
    } else {
        $('#create_table_name').attr('class', 'form-control');
    }
}
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()