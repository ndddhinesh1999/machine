$(document).ready(function () {
  $(".datepicker").datepicker({
    inline: true,
    dateFormat: 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    yearRange: '-70:+70'
  });
});

function get_branch() {
  var company_id = $('#company_id').val();
  $.get('machine-ajax.php?action=get_branch', { company_id: company_id }, function (response) {
    $('#branch_id').html(response);
  });
}
$(document).ready(function () {
  $('#example').DataTable();
});
function search_get_branch() {
  var company_id = $('#search_company_id').val();
  $.get('machine-ajax.php?action=get_branch', { company_id: company_id }, function (response) {
    $('#search_branch_id').html(response);
  });
}

function delete_record(machine_id, status) {
  if (status == 'delete') {
    $('#exampleModalLabel').html('Delete Record');
    $('.modal-body').html('<p>Are you sure you want to delete your record?</p>');
    $('#machine_hidden_status').val(status);
  } else if (status == 'undo') {
    $('#exampleModalLabel').html('Undo Record');
    $('.modal-body').html('<p>Are you sure you want to undo your record?</p>');
    $('#machine_hidden_status').val(status);
  }
  $('#machine_hidden_id').val(machine_id);
}
$('#delete_button').click(function () {
  var machine_hidden_id = $('#machine_hidden_id').val();
  var status = $('#machine_hidden_status').val();
  $.post('machine-ajax.php?action=delete_record', {
    machine_id: machine_hidden_id,
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
  var page = $('#machine_page').val();
  var status = $('#machine_status').val();
  if (page == 'edit' && status == 1) {
    $('#machine_form input').attr('readonly', 'readonly');
    $('#machine_form textarea').attr('readonly', 'readonly');
    $('#machine_form select').attr('disabled', true);
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

$(function () {
    
  let params = new URLSearchParams(location.search);
  var id = params.get('machine_id');
  var page = params.get('page');
  if (id > 0 || page == 'add') {
    $('#exampleModalMachine').modal('hide');

  } else {
    $('#exampleModalMachine').modal('show');
  }
});

$('#submit-button').click(function () {
  var machine_hidden_id = $('#machine_select').val();
  $('#exampleModalMachine').modal('hide');


});
// function d() {
//   window.location.href = 'index.php';
// }
// function f() {
//   console.log("f");
// }