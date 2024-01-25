<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= PROJECT_TITLE ?> - Log In</title>
    <link rel="shortcut icon" type="image/png" href="<?= PROJECT_PATH; ?>/src/assets/images/logos/company-logo.svg" />
    <link rel="stylesheet" href="src/assets/css/styles.min.css" />
    <style>
        body {
            /* background: linear-gradient(#396afc, #2948ff); */
            background-image: url("https://i.pinimg.com/originals/9b/a0/c4/9ba0c4c51d0cc77e2ff7befb057f2981.jpg");
            background-size: cover;
            background-position: bottom;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="<?= PROJECT_PATH; ?>index.php" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="<?= PROJECT_PATH; ?>/src/assets/images/logos/company-logo.svg" width="70" alt="">
                                </a>
                                <form action="index.php" method="post" name="log_in_form" id="log_in_form" autocomplete="off">
                                    <div class="mb-3">
                                        <label for="user_name" class="form-label">User Name</label>
                                        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter your user name" onblur="" aria-describedby="nameHelp">
                                        <div class="invalid-feedback name_fail"></div>
                                        <div class="valid-feedback name_success"></div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="user_password" class="form-label">Password</label>
                                        <input type="password" placeholder="Enter your user password" class="form-control" name="user_password" id="user_password">
                                        <div class="invalid-feedback password_fail"></div>
                                        <div class="valid-feedback password_success"></div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="user_financial_year" class="form-label">Financial Year</label>
                                        <select name="user_financial_year" id="user_financial_year" class="form-select">
                                            <?php foreach ($financial_years as $list_financial_years) {  ?>
                                                <option value="<?= $list_financial_years['financial_year_id'] ?>"> <?= $list_financial_years['financial_year_from'] . '-' . $list_financial_years['financial_year_to'] ?></option>
                                            <?php }  ?>
                                        </select>
                                    </div>

                                    <input type="submit" name="admin_users_login" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="Sing In">

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="src/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="function.js"></script>
    <script src="src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <?php if (isset($_REQUEST['msg'])) {
        if ($_REQUEST['msg'] == 1) { ?>
            <script>
                function alert() {
                    $('#user_name').attr('class', 'form-control is-invalid');
                    $('.name_fail').html("Please enter your correct user name.");
                }
                alert();
            </script>


        <?php  } else if ($_REQUEST['msg'] == 2) { ?>
            <script>
                function alert() {
                    $('#user_password').attr('class', 'form-control is-invalid');
                    $('.password_fail').html("Please enter your correct user password.");
                }
                alert();
            </script>
        <?php  } else if ($_REQUEST['msg'] == 3) { ?>
            <script>
                function alert() {
                    $('#user_name').attr('class', 'form-control is-invalid');
                    $('.name_fail').html("Please enter your user name.");
                    $('#user_password').attr('class', 'form-control is-invalid');
                    $('.password_fail').html("Please enter your user password.");
                }
                alert();
            </script>
        <?php    } else if ($_REQUEST['msg'] == '') { ?>
            <script>
                function alert() {
                    $('#user_name').attr('class', 'form-control is-valid');
                    $('.name_success').html("User name verified");
                    $('#user_password').attr('class', 'form-control is-valid');
                    $('.password_success').html("User password verified");
                }
                alert();
            </script>
    <?php    }
    }

    ?>



</body>

</html>