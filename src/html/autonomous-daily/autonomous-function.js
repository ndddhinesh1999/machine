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
  $.get('autonomous-ajax.php?action=get_branch', { company_id: company_id }, function (response) {
    $('#branch_id').html(response);
  });
}
$(document).ready(function () {
  $('#example').DataTable();
});
function search_get_branch() {
  var company_id = $('#search_company_id').val();
  $.get('autonomous-ajax.php?action=get_branch', { company_id: company_id }, function (response) {
    $('#search_branch_id').html(response);
  });
}
 
function delete_record(autonomous_id, status) {
  if (status == 'delete') {
    $('#exampleModalLabel').html('Delete Record');
    $('.modal-body').html('<p>Are you sure you want to delete your record?</p>');
    $('#autonomous_hidden_status').val(status);
  } else if (status == 'undo') {
    $('#exampleModalLabel').html('Undo Record');
    $('.modal-body').html('<p>Are you sure you want to undo your record?</p>');
    $('#autonomous_hidden_status').val(status);
  }
  $('#autonomous_hidden_id').val(autonomous_id);
}
$('#delete_button').click(function () {
  var autonomous_hidden_id = $('#autonomous_hidden_id').val();
  var status = $('#autonomous_hidden_status').val();
  $.post('autonomous-ajax.php?action=delete_record', {
    autonomous_id: autonomous_hidden_id,
    status: status
  }, function (data) {
    $('#exampleModal').modal('hide');
    if (data != 2) {
      if (status == 'delete') {
        $('#record_name').html('Record');
        $('#exampleModalLabel1').html('Delete Record');
        $('#record_status').html('deleted.');
        $('#success_modal').modal('show');
      } else if (status == 'undo') {
        $('#record_name').html('Record');
        $('#exampleModalLabel1').html('Undo Record');
        $('#record_status').html('restored.');
        $('#success_modal').modal('show');
      }
    }
  });
});

$(function () {
  var page = $('#autonomous_page').val();
  var status = $('#autonomous_status').val();
  if (page == 'edit' && status == 1) {
    $('#autonomous_form input').attr('readonly', 'readonly');
    $('#autonomous_form textarea').attr('readonly', 'readonly');
    $('#autonomous_form select').attr('disabled', true);
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

$(document).ready(function () {
  // Attach click event to the image with the 'preview-trigger' class
  $('.preview-trigger').on('click', function () {
    // Show the image preview dialog
    $('#image-preview-dialog').show();
  });

  // Close the image preview dialog when clicking outside the image
  $('#image-preview-dialog').on('click', function () {
    $(this).hide();
  });
});

$(document).on('keypress', '.textstring', function (event) {
  var regex = new RegExp("^[a-zA-Z \s]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});