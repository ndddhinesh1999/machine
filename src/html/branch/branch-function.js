$(document).ready(function () {
    $('#example').DataTable();
});
function check_branch_name(company_ids, branch_id) {
    result_id = '';
    if (company_ids != '') {
        result_id = company_ids;
    } else {
        var company_id = $('#company_id').val();
        if (company_id == '') {
            $('#company_id').attr('class', 'form-select is-invalid');
            $('#branch_name').val("");
        } else {
            $('#company_id').attr('class', 'form-select');
            result_id = company_id;
        }
    }

    var branch_name = $('#branch_name').val();
    $.get('branch-ajax.php?action=check_branch_name', { company_id: result_id, branch_name: branch_name, branch_id: branch_id }, function (response) {
        if (response == 1) {
            $('#branch_name').attr('class', 'form-control is-invalid');
            $('.error_message').html("Branch Name Aldready Exist");
            $('#branch_name').val("");
        } else {
            $('#branch_name').attr('class', 'form-control');
            $('.error_message').html("Please enter branch name.");
        }
    })
}

function checkmobilelength() {
    var mobile = $('#branch_contact_no').val();
    if (mobile.length != 10) {
        $('#branch_contact_no').val('');
        $('#branch_contact_no').attr('class', 'form-control is-invalid');
    } else {
        $('#branch_contact_no').attr('class', 'form-control');
    }
}


function check_code(company_id, branch_id) {
    var branch_code = $('#branch_code').val();


    if (branch_code == '') {
        $('#branch_code').attr('class', 'form-control is-invalid');
    } else {
        $('#branch_code').attr('class', 'form-control');
    }
    result_company_id = '';
    if (company_id == '') {
        var company_get_id = $('#company_id').val();
        if (company_get_id == '') {
            $('#company_id').attr('class', 'form-select is-invalid');
            $('#branch_code').val('');
        } else {
            $('#company_id').attr('class', 'form-select');
            result_company_id = company_get_id;
        }


    } else {
        result_company_id = company_id;
    }
    if (result_company_id != '') {

        $.get('branch-ajax.php?action=check_branch_code', { company_id: result_company_id, branch_code: branch_code, branch_id: branch_id }, function (response) {
            if (response == 1) {
                $('#branch_code').attr('class', 'form-control is-invalid');
                $('.error_messge').html('Branch code already exist.');
                $('#branch_code').val('');
            } else {
                $('#branch_code').attr('class', 'form-control');
                $('.error_messge').html('Please enter code.');
            }
        });
    }
}
$('#branch_email').on('blur', function () {
    $.get('branch-ajax.php?action=check_branch_email', { branch_id: $('#branch_id').val(), branch_email: $('#branch_email').val() }, function (response) {
        if (response == 1) {
            $('#branch_email').attr('class', 'form-control is-invalid');
            $('.error_messge_1').html('Branch email already exist.');
            $('#branch_email').val('');
        } else {
            $('#branch_email').attr('class', 'form-control');
            $('.error_messge_1').html('Please enter email.');
        }
    });
})
function delete_record(branch_id, status) {
    if (status == 'delete') {
        $('#exampleModalLabel').html('Delete Record');
        $('.modal-body').html('<p>Are you sure you want to delete your record?</p>');
        $('#branch_hidden_status').val(status);
    } else if (status == 'undo') {
        $('#exampleModalLabel').html('Undo Record');
        $('.modal-body').html('<p>Are you sure you want to undo your record?</p>');
        $('#branch_hidden_status').val(status);
    }
    $('#branch_hidden_id').val(branch_id);
}
$('#delete_button').click(function () {
    var branch_hidden_id = $('#branch_hidden_id').val();
    var status = $('#branch_hidden_status').val();
    $.post('branch-ajax.php?action=delete_record', {
        branch_id: branch_hidden_id,
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
    var page = $('#branch_page').val();
    var status = $('#branch_status').val();
    if (page == 'edit' && status == 1) {
        $('#branch_form input').attr('readonly', 'readonly');
        $('#branch_form textarea').attr('readonly', 'readonly');
        $('#branch_form select').attr('disabled', true);
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