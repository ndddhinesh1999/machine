

function show_alert() {
  var toastElList = [].slice
    .call(document.querySelectorAll('.toast'));
  var toastList = toastElList.map(function (toastEl) {
    return new bootstrap.Toast(toastEl)
  })
  toastList.forEach(toast => toast.show())
}

function checkpass() {
  var password = $('#old_password').val();

  $.get('change-password-ajax.php', {
    password: password
  }, function (data) {

    if (data == 1) {
      $('#old_password').attr('class', 'form-control is-invalid');
      $('.error_message').html('Your old password wrong');
      $('#old_password').val("");
    }
    if (data == 2) {
      $('#old_password').attr('class', 'form-control is-valid');
    }
    if (data == 3) {
      $('#old_password').attr('class', 'form-control is-invalid');
      $('.error_message').html('Please enter your old password');
    }
  });
}

function myFunction() {
  var new_pass = document.getElementById('new_password').value;
  var confirm_pass = document.getElementById('confirm_password').value;
  if (new_pass == confirm_pass) {
    $('#roles').attr('class', 'toast align-items-center text-white bg-');
    return true;
  } else if (new_pass != confirm_pass) {
    $('.toast-body').html('New & Old Password Not Matching');
    $('#roles').attr('class', 'toast align-items-center text-white bg-danger');
    show_alert();
    return false;
  }
}
$('#new_pass').on('click', function () {
  var x = document.getElementById("new_password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
});

$('#con_pass').on('click', function () {
  var x = document.getElementById("confirm_password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
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