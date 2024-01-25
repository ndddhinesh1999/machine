function check_user_name() {
    var user_name = $('#user_name').val();
    if (user_name != '') {
        $.get('ajax.php?action=check_user_name', { user_name: user_name }, function (response) {
            if (response == 1) {
                $('#user_name').attr('class', 'form-control is-valid');
                $('.name_success').html("User name verified");
            } else {
                $('#user_name').val("");
                $('#user_name').attr('class', 'form-control is-invalid');
                $('.name_fail').html("Please enter your correct user name.");
            }
        });
    } else {
        $('.name_fail').html("Please enter your user name");
        $('#user_name').attr('class', 'form-control is-invalid');
    }
}

