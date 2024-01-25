<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= PROJECT_TITLE ?> - Change Password</title>
    <link rel="shortcut icon" type="image/png" href="<?= PROJECT_PATH; ?>/src/assets/images/logos/company-logo.svg" />
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/libs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/css/styles.min.css" />
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/css/styles.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

        <?php include '../../includes/side-nav.php'; ?>

        <!--  Main wrapper -->
        <div class="body-wrapper">

            <?php include '../../includes/header.php'; ?>

            <div class="container-fluid">
                <div class="page-title">
                    <h1>Change Password</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/home/">Home</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-xl">
                    <div class="card mb-4">
                        <form action="index.php" method="POST" name="change_password_form" id="change_password_form" autocomplete="off" onsubmit=" return  myFunction()">
                            <div class="card-body container-bg">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label" for="search_employee_name">User Name </label>
                                        <input type="text" name="user_name" id="user_name" class="form-control" readonly value="<?= (!empty($_SESSION[SESS . 'session_admin_users_title'])) ? ucfirst($_SESSION[SESS . 'session_admin_users_title']) : ''; ?>" />
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" for="old_password">Current Password </label>
                                        <input type="text" name="old_password" id="old_password" class="form-control" placeholder="Current Password" value="" required onblur="checkpass();" />
                                        <div class="invalid-feedback error_message"> </div>
                                        <div class="valid-feedback">
                                            Password verified
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" for="new_password">New Password </label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="new_password" id="new_password" class="form-control" value="" placeholder="New Password" required />
                                            <span class="input-group-text"><i class="bi bi-eye" id="new_pass"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" for="confirm_password">Confirm Password </label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required value="" />
                                            <span class="input-group-text"><i class="bi bi-eye" id="con_pass"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center gap-2 mt-4">
                                    <input name="change_password" type="submit" class="btn btn-primary" id="change_password" value="Save" title="Save" />

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- footer -->
                <?php include '../../includes/footer.php'; ?>
            </div>
        </div>
    </div>
    <script src="<?= PROJECT_PATH ?>/src/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/js/sidebarmenu.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/js/app.min.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/js/dashboard.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/jquery/jquery.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/jquery/jquery-ui.js"></script>
    <script src="change-password-function.js"></script>
    <?php
    if (isset($_REQUEST['msg'])) {
        if ($_REQUEST['msg'] == 1) {
            $msg = 'Your Password Updated successfully';
            $color = 'success';
        }
    }

    ?>

    <!-- Toasts -->
    <div class="toast-container position-absolute top-0 end-0 mt-3 mx-2" style="z-index: 10000;">
        <div class="toast align-items-center text-white bg-<?= $color ?> border-0" id="roles" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?= $msg ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <?php if (isset($_REQUEST['msg'])) { ?>
        <script>
            function show_alert() {
                var toastElList = [].slice
                    .call(document.querySelectorAll('.toast'));
                var toastList = toastElList.map(function(toastEl) {
                    return new bootstrap.Toast(toastEl)
                })
                toastList.forEach(toast => toast.show())
            }
            show_alert();
        </script>
    <?php } ?>

</body>

</html>