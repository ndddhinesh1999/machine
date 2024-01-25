$(document).ready(function () {
    $('#example').DataTable();
});
$(document).ready(function () {
    $(".datepicker").datepicker({
        inline: true,
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: '-70:+70',
        minDate: 0
    });
});

function check_company_name(company_id) {
    var company_name = $('#company_name').val();
    $.get('company-ajax.php?action=check_company_name', { company_name: company_name, company_id: company_id }, function (response) {
        if (response == 1) {
            $('#company_name').attr('class', 'form-control is-invalid');
            $('.error_message').html("Company Name Aldready Exist");
            $('#company_name').val("");
        } else {
            $('#company_name').attr('class', 'form-control');
            $('.error_message').html("Please enter Company name.");
        }
    });
}
function check_user_name() {
    var company_user_name = $('#company_user_name').val();
    $.get('company-ajax.php?action=check_user_name', { company_user_name: company_user_name }, function (response) {
        if (response == 1) {
            $('#company_name').attr('class', 'form-control is-invalid');
            $('.error_message').html("Company Name Aldready Exist");
            $('#company_name').val("");
        } else {
            $('#company_name').attr('class', 'form-control');
            $('.error_message').html("Please enter Company name.");
        }
    });
}


function checkmobilelength() {
    var mobile = $('#company_contact_no').val();
    if (mobile.length != 10) {
        $('#company_contact_no').val('');
        $('#company_contact_no').attr('class', 'form-control is-invalid');
    } else {
        $('#company_contact_no').attr('class', 'form-control');
    }
}

function checkmobilelength1() {
    var mobile = $('#company_owner_contact_no').val();
    if (mobile.length != 10) {
        $('#company_owner_contact_no').val('');
        $('#company_owner_contact_no').attr('class', 'form-control is-invalid');
    } else {
        $('#company_owner_contact_no').attr('class', 'form-control');
    }
}

function delete_record(company_id, status) {
    if (status == 'delete') {
        $('#exampleModalLabel').html('Delete Record');
        $('.modal-body').html('<p>Are you sure you want to delete your record?</p>');
        $('#company_hidden_status').val(status);
    } else if (status == 'undo') {
        $('#exampleModalLabel').html('Undo Record');
        $('.modal-body').html('<p>Are you sure you want to undo your record?</p>');
        $('#company_hidden_status').val(status);
    }
    $('#company_hidden_id').val(company_id);
}
$('#delete_button').click(function () {
    var company_hidden_id = $('#company_hidden_id').val();
    var status = $('#company_hidden_status').val();
    $.post('company-ajax.php?action=delete_record', {
        company_id: company_hidden_id,
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
    var page = $('#company_page').val();
    var status = $('#company_status').val();
    if (page == 'edit' && status == 1) {
        $('#company_form input').attr('readonly', 'readonly');
        $('#company_form textarea').attr('readonly', 'readonly');
        $('#company_form select').attr('disabled', true);
    }
});

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