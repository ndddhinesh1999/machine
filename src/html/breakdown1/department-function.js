
function get_branch() {
  var company_id = $('#company_id').val();
  $.get('department-ajax.php?action=get_branch', { company_id: company_id }, function (response) {
    $('#branch_id').html(response);
  });
}
$(document).ready(function () {
  $('#example').DataTable();
});
function search_get_branch() {
  var company_id = $('#search_company_id').val();
  $.get('department-ajax.php?action=get_branch', { company_id: company_id }, function (response) {
    $('#search_branch_id').html(response);
  });
}

function delete_record(department_id, status) {
  if (status == 'delete') {
    $('#exampleModalLabel').html('Delete Record');
    $('.modal-body').html('<p>Are you sure you want to delete your record?</p>');
    $('#department_hidden_status').val(status);
  } else if (status == 'undo') {
    $('#exampleModalLabel').html('Undo Record');
    $('.modal-body').html('<p>Are you sure you want to undo your record?</p>');
    $('#department_hidden_status').val(status);
  }
  $('#department_hidden_id').val(department_id);
}
$('#delete_button').click(function () {
  var department_hidden_id = $('#department_hidden_id').val();
  var status = $('#department_hidden_status').val();
  $.post('department-ajax.php?action=delete_record', {
    department_id: department_hidden_id,
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
  var page = $('#department_page').val();
  var status = $('#department_status').val();
  if (page == 'edit' && status == 1) {
    $('#department_form input').attr('readonly', 'readonly');
    $('#department_form textarea').attr('readonly', 'readonly');
    $('#department_form select').attr('disabled', true);
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