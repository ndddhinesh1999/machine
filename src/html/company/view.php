<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= PROJECT_TITLE ?> - Company</title>
    <link rel="shortcut icon" type="image/png" href="<?= PROJECT_PATH; ?>/src/assets/images/logos/company-logo.svg" />
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/css/styles.min.css" />
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/libs/bootstrap-icons/font/bootstrap-icons.css">
    <link href="<?= PROJECT_PATH ?>/src/assets/jquery/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/css/styles.css" />
    <link href="<?= PROJECT_PATH ?>/src/assets/DataTable/datatables.min.css" rel="stylesheet" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

        <?php include '../../includes/side-nav.php'; ?>

        <!--  Main wrapper -->
        <div class="body-wrapper">

            <?php include '../../includes/header.php'; ?>
            <div class="container-fluid">
                <!--  Row 1 -->
                <div class="page-title">
                    <h1>Company</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/home/">Home</a></li>
                            <li class="breadcrumb-item active">Company</li>
                        </ol>
                    </nav>
                </div>
                <?php if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'add') { ?>
                    <div class="col-lg-12 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Company Details</h5>
                                <small class="text-muted float-end">Add Company</small>
                            </div>
                            <div class="card-body">
                                <form action="index.php" method="POST" name="company_form" id="company_form" autocomplete="off" class="needs-validation" novalidate>
                                    <div class="row row-gap-3">
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_name"><span class="text-danger">*</span> Company Name</label>
                                            <input name="company_name" id="company_name" class="form-control" onblur="check_company_name(0);" required>
                                            <div class="invalid-feedback error_message">
                                                Please enter company name.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_email"><span class="text-danger">*</span> Email</label>
                                            <input type="email" name="company_email" id="company_email" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter email.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_contact_no"><span class="text-danger">*</span> Contact No</label>
                                            <input type="text" name="company_contact_no" id="company_contact_no" onblur="checkmobilelength();" class="form-control" required onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10">
                                            <div class="invalid-feedback">
                                                Please enter 10 digits mobile no
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_owner_name">Owner Name</label>
                                            <input type="text" name="company_owner_name" id="company_owner_name" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_owner_contact_no">Owner Contact No</label>
                                            <input type="text" name="company_owner_contact_no" id="company_owner_contact_no" onblur="checkmobilelength1();" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10">
                                            <div class="invalid-feedback">
                                                Please enter 10 digits mobile no
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_license_expiry_date">License Expiry Date</label>
                                            <input type="text" name="company_license_expiry_date" id="company_license_expiry_date" class="form-control datepicker" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_pin_code">Pin Code</label>
                                            <input type="text" name="company_pin_code" id="company_pin_code" minlength="6" maxlength="6" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_address">Address</label>
                                            <textarea name="company_address" id="company_address" class="form-control" style="height: 30px;"></textarea>
                                        </div>
                                    </div>
                                    <div class="mt-5 d-flex justify-content-center gap-3">
                                        <input type="hidden" name="company_page" id="company_page" value="add">
                                        <input type="hidden" name="company_status" id="company_status" value="">
                                        <input name="add_company" type="submit" class="btn btn-primary" id="add_company" value="Save" title="Save" />
                                        <input type="reset" value="Reset" class="btn btn-outline-secondary" title="Reset" />
                                        <input type="button" value="Back" class="btn btn-secondary" onclick="location.href='index.php'" title="Back">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } else if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'edit') { ?>
                    <div class="col-lg-12 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Company Details</h5>
                                <small class="text-muted float-end">Edit Company</small>
                            </div>
                            <div class="card-body">
                                <form action="index.php" method="POST" name="company_form" id="company_form" autocomplete="off" class="needs-validation" novalidate>
                                    <div class="row row-gap-3">
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_code">Company Code</label>
                                            <input name="company_code" id="company_code" class="form-control" value="<?= $edit_company['company_code']; ?>" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_name"><span class="text-danger">*</span> Company Name</label>
                                            <input name="company_name" id="company_name" class="form-control" onblur="check_company_name(<?= $edit_company['company_id']; ?>);" value="<?= $edit_company['company_name']; ?>" required>
                                            <div class="invalid-feedback error_message">
                                                Please enter company name.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_email"><span class="text-danger">*</span> Email</label>
                                            <input type="email" name="company_email" id="company_email" class="form-control" value="<?= $edit_company['company_email']; ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter email.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_contact_no"><span class="text-danger">*</span> Contact No</label>
                                            <input type="text" name="company_contact_no" id="company_contact_no" required onblur="checkmobilelength();" class="form-control" value="<?= $edit_company['company_contact_no']; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10">
                                            <div class="invalid-feedback">
                                                Please enter 10 digits mobile no
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_owner_name">Owner Name</label>
                                            <input type="text" name="company_owner_name" id="company_owner_name" class="form-control" value="<?= $edit_company['company_owner_name']; ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_owner_contact_no">Owner Contact No</label>
                                            <input type="text" name="company_owner_contact_no" id="company_owner_contact_no" onblur="checkmobilelength1();" value="<?= $edit_company['company_owner_contact_no']; ?>" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10">
                                            <div class="invalid-feedback">
                                                Please enter 10 digits mobile no
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_license_expiry_date">License Expiry Date</label>
                                            <input type="text" name="company_license_expiry_date" id="company_license_expiry_date" value="<?= dateGeneralFormat($edit_company['company_license_expiry_date']); ?>" class="form-control datepicker" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_pin_code">Pin Code</label>
                                            <input type="text" name="company_pin_code" id="company_pin_code" minlength="6" maxlength="6" value="<?= $edit_company['company_pin_code']; ?>" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_active">Status</label>
                                            <select name="company_active_status" id="company_active_status" class="form-control">
                                                <option value="active" <?php if ($edit_company['company_active_status'] == 'active') { ?>selected <?php } ?>>Active</option>
                                                <option value="inactive" <?php if ($edit_company['company_active_status'] == 'inactive') { ?>selected <?php } ?>>In Active</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="company_address">Address</label>
                                            <textarea name="company_address" id="company_address" class="form-control" style="height: 30px;"><?= $edit_company['company_address']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="mt-5 d-flex justify-content-center gap-3">
                                        <input type="hidden" name="company_id" id="company_id" value="<?= $edit_company['company_id']; ?>">
                                        <?php if ($edit_company['company_deleted_status'] != 1) { ?>
                                            <input name="update_company" type="submit" class="btn btn-primary" id="update_company" value="Save" title="Save" />
                                            <input type="reset" value="Reset" class="btn btn-outline-secondary" title="Reset" />
                                        <?php } ?>
                                        <input type="hidden" name="company_page" id="company_page" value="edit">
                                        <input type="hidden" name="company_status" id="company_status" value="<?= $edit_company['company_deleted_status'] ?>">
                                        <input type="button" value="Back" class="btn btn-secondary" onclick="location.href='index.php'" title="Back">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php } else {  ?>

                    <?php

                    $comapny_name = isset($_REQUEST['search_comapny_name']) ? $_REQUEST['search_comapny_name'] : '';
                    $search_status = isset($_REQUEST['comapny_search_status']) ? $_REQUEST['comapny_search_status'] : '';
                    ?>


                    <div class="col-xl">
                        <div class="card mb-4">
                            <form action="index.php" method="POST" name="company_form" id="company_form" autocomplete="off">
                                <div class="card-body container-bg">
                                    <div class="form-group d-flex flex-column flex-md-row flex-wrap align-items-md-end justify-content-center gap-3">

                                        <div class="flex-column col-md-3">
                                            <label class="form-label" for="search_comapny_name">Comapny Name </label>
                                            <input type="text" name="search_comapny_name" id="search_comapny_name" class="form-control" value="<?= $comapny_name ?>" />
                                        </div>
                                        <div class="flex-column col-md-3">
                                            <label class="form-label" for="comapny_search_status">Status</label>
                                            <select name="comapny_search_status" id="comapny_search_status" class="form-select">
                                                <option value="active" <?php if ($search_status == 'active') { ?>selected <?php } ?>>Active</option>
                                                <option value="inactive" <?php if ($search_status == 'inactive') { ?>selected <?php } ?>>In Active</option>
                                                <option value="1" <?php if ($search_status == '1') { ?>selected <?php } ?>>Deleted</option>
                                            </select>
                                        </div>

                                        <div class="d-flex justify-content-center gap-2">
                                            <input name="search" type="submit" class="btn btn-primary" id="search" value="Search" title="Search" />
                                            <input name="view_all" type="button" class="btn btn-success" id="view_all" onclick="location.href='index.php'" title="Display All" value="Display All" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>



                    <div class="card p-2">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary mx-2 my-2" onclick="location.href='index.php?page=add'">Add</button>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <form action="index.php" method="POST" name="company_form" id="company_form" autocomplete="off">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <caption class="ms-4">
                                        List of Information
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th>S No.</th>
                                            <th>Code</th>
                                            <th>Company Name</th>
                                            <th>Contact No</th>
                                            <th>Mail</th>
                                            <th>License Expiry</th>
                                            <th>Status</th>
                                            <?php if ($search_status != 1) { ?>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            <?php } else { ?>
                                                <th>View</th>
                                                <th>Undo </th>
                                            <?php  } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sno = 1;
                                        if ($list_company) {
                                            foreach ($list_company as $value) {
                                        ?>
                                                <tr>
                                                    <td><?= $sno++; ?></td>
                                                    <td><?= $value['company_code']; ?></td>
                                                    <td><?= ucfirst($value['company_name']); ?></td>
                                                    <td><?= ucfirst($value['company_contact_no']); ?></td>
                                                    <td><?= $value['company_email']; ?></td>
                                                    <td><?= dateGeneralFormat($value['company_license_expiry_date']); ?></td>
                                                    <td><?php if ($value['company_active_status'] == 'active') {
                                                            echo "Active";
                                                        } else {
                                                            echo "Inactive";
                                                        } ?></td>

                                                    <?php if ($search_status != 1) { ?>
                                                        <td>
                                                            <i class="bi bi-pencil-square" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&company_id=<?= $value['company_id']; ?>'"></i>
                                                        </td>
                                                        <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['company_id']; ?>,'delete');"><i class="bi bi-trash" style="cursor: pointer;color:red"></i></span>
                                                        </td>
                                                    <?php } else { ?>
                                                        <td>
                                                            <i class="bi bi-eye fs-5" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&company_id=<?= $value['company_id']; ?>'"></i>
                                                        </td>
                                                        <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['company_id']; ?>,'undo');"><i class="bi bi-arrow-counterclockwise fs-5" style="cursor: pointer;color:green"></i></span>
                                                        </td>
                                                    <?php  } ?>

                                                </tr>
                                        <?php }
                                        } ?>

                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>

                <?php } ?>



                <!-- footer -->
                <?php include '../../includes/footer.php'; ?>
            </div>
        </div>
    </div>

    <!-- Delete modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="company_hidden_id" id="company_hidden_id" value="">
                    <input type="hidden" name="company_hidden_status" id="company_hidden_status" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#exampleModal').modal('hide');">Close</button>
                    <button type="button" class="btn btn-primary" id="delete_button">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete success message  modal -->
    <div class="modal fade" id="success_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1"></h5>
                </div>
                <div class="modal-body1">
                    <div class="d-flex justify-content-center">
                        <p>The
                            <span id="record_name"></span> was <span id="record_status"></span>
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="location.href='index.php'">Close</button>
                </div>
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
    <script src="<?= PROJECT_PATH ?>/src/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/jquery/jquery.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/jquery/jquery-ui.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/DataTable/datatables.min.js"></script>
    <script src="company-function.js"></script>
    <?php
    if (isset($_REQUEST['msg'])) {
        if ($_REQUEST['msg'] == 1) {
            $msg = 'Company Created successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 2) {
            $msg = 'Company Updated successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 3) {
            $msg = 'Company Deleted successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 4) {
            $msg = 'Please fill all required fields';
            $color = 'warning';
        } else if ($_REQUEST['msg'] == 5) {
            $msg = 'Company Code Already Created';
            $color = 'danger';
        }
    }

    ?>

    <!-- Toasts -->
    <div class="toast-container position-absolute top-0 end-0 mt-3 mx-2" style="z-index: 10000;">
        <div class="toast align-items-center text-white bg-<?= $color ?> border-0" role="alert" aria-live="assertive" aria-atomic="true">
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