$(document).ready(function () {
    $(".datepicker").datepicker({
        inline: true,
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: '-70:+70'
    });
});

function check_mobile_no(employee_id) {
    var number = $('#employee_contact_no').val();
    $.get('employee-ajax.php?action=check_employee_number', { number: number, employee_id: employee_id }, function (response) {
        if (response == 1) {
            $('#employee_contact_no').val('');
            $('#employee_contact_no').attr('class', 'form-control is-invalid');
            $('.user_number').html('Mobile No Already Exist');
        } else {
            $('#employee_contact_no').attr('class', 'form-control');
            $('.user_number').html('Please enter 10 digits mobile no');
        }
    });

}
function show_lock_days() {
    var value = $('#employee_lock_status').val();
    if (value == 1) {
        $('.lock_days').show();
    } else {
        $('.lock_days').hide();
        $('#employee_lock_days').val("");
    }
}

function checkmobilelength(employee_id) {
    var mobile = $('#employee_contact_no').val();
    if (mobile.length != 10) {
        $('#employee_contact_no').val('');
        $('.user_number').html('Please enter 10 digits mobile no');
        $('#employee_contact_no').attr('class', 'form-control is-invalid');
    } else {
        check_mobile_no(employee_id);
    }
}

$(document).ready(function () {
    $('#example').DataTable();
});

function get_branch() {
    var company_id = $('#employee_company_id').val();
    $.get('employee-ajax.php?action=get_branch', { company_id: company_id }, function (response) {
        $('#employee_branch_id').html(response);
    });
}

function search_get_branch() {
    var company_id = $('#search_company_id').val();
    $.get('employee-ajax.php?action=get_branch', { company_id: company_id }, function (response) {
        $('#search_branch_id').html(response);
    });
}


function delete_record(employee_id, status) {
    if (status == 'delete') {
        $('#exampleModalLabel').html('Delete Record');
        $('.modal-body').html('<p>Are you sure you want to delete your record?</p>');
        $('#employee_hidden_status').val(status);
    } else if (status == 'undo') {
        $('#exampleModalLabel').html('Undo Record');
        $('.modal-body').html('<p>Are you sure you want to undo your record?</p>');
        $('#employee_hidden_status').val(status);
    }
    $('#employee_hidden_id').val(employee_id);
}
$('#delete_button').click(function () {
    var employee_hidden_id = $('#employee_hidden_id').val();
    var status = $('#employee_hidden_status').val();
    $.post('employee-ajax.php?action=delete_record', {
        employee_id: employee_hidden_id,
        status: status
    }, function (data) {
        $('#exampleModal').modal('hide');
        if (data != 2) {
            if (status == 'delete') {
                $('#record_name').html(data);
                $('#exampleModalLabel1').html('Delete Record');
                $('#record_status').html('deleted.');
                $('#success_modal').modal('show');
            } else if (status == 'undo') {
                $('#record_name').html(data);
                $('#exampleModalLabel1').html('Undo Record');
                $('#record_status').html('restored.');
                $('#success_modal').modal('show');
            }
        }
    });
});

$(function () {
    var page = $('#employee_page').val();
    var status = $('#employee_status').val();
    if (page == 'edit' && status == 1) {
        $('#employee_form input').attr('readonly', 'readonly');
        $('#employee_form textarea').attr('readonly', 'readonly');
        $('#employee_form select').attr('disabled', true);
    }
});

function check_employee() {
    var company_id = $('#company_id').val();
    var employee_code = $('#employee_code').val();
    var employee_company_id = $('#employee_company_id').val();
    var user_level = $('#user_level').val();
    if (user_level == 'admin' && company_id != employee_company_id) {
        $.get('employee-ajax.php?action=check_employee', { company_id: employee_company_id, employee_code: employee_code }, function (response) {
            if (response == 1) {
                $('#employee_company_id  option[value=' + company_id + ']').prop("selected", true);
                alert('Employee already exist');
            }
        });
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