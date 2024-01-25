<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= PROJECT_TITLE ?> - Branch</title>
    <link rel="shortcut icon" type="image/png" href="<?= PROJECT_PATH; ?>/src/assets/images/logos/company-logo.svg" />
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/libs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/css/styles.min.css" />
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/css/styles.css" />
    <link href="<?= PROJECT_PATH ?>/src/assets/DataTable/datatables.min.css" rel="stylesheet" />
    <style>
        .custom-tooltip {
            --bs-tooltip-bg: var(--bs-danger);
        }
    </style>
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
                    <h1>Branch</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/home/">Home</a></li>
                            <li class="breadcrumb-item active">Branch</li>
                        </ol>
                    </nav>
                </div>

                <?php if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'add') { ?>
                    <div class="col-lg-12 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Branch Details</h5>
                                <small class="text-muted float-end">Add Branch</small>
                            </div>
                            <div class="card-body">
                                <form action="index.php" method="POST" name="branch_form" id="branch_form" autocomplete="off" class="needs-validation" novalidate>
                                    <div class="row row-gap-3">
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                                            <div class="col-md-4">
                                                <label class="form-label" for="company_id"><span class="text-danger">*</span> Company</label>
                                                <select name="company_id" id="company_id" class="form-select" required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($listCompany as $data) { ?>
                                                        <option value="<?= $data['company_id']; ?>"><?= $data['company_code'] . ' - ' . $data['company_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please enter branch code.
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-4">
                                            <label class="form-label" for="branch_name"><span class="text-danger">*</span> Branch Name</label>
                                            <input name="branch_name" id="branch_name" class="form-control" onblur="check_branch_name(<?= ($_SESSION[SESS . 'session_admin_users_company_id'] > 0) ? $_SESSION[SESS . 'session_admin_users_company_id'] : 0 ?>,0);" required>
                                            <div class="invalid-feedback error_message">
                                                Please enter branch name.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="branch_email"><span class="text-danger">*</span> Email</label>
                                            <input type="email" name="branch_email" id="branch_email" class="form-control" required>
                                            <div class="invalid-feedback error_messge_1">
                                                Please enter branch email.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="branch_contact_person">Contact Person</label>
                                            <input type="text" name="branch_contact_person" id="branch_contact_person" class="form-control">

                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="branch_contact_no"><span class="text-danger">*</span> Contact No</label>
                                            <input type="text" name="branch_contact_no" id="branch_contact_no" class="form-control" required onkeypress='return event.charCode >= 48 && event.charCode <= 57' onblur="checkmobilelength();" maxlength="10">
                                            <div class="invalid-feedback">
                                                Please enter 10 digits mobile no
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="branch_location">Contact Location</label>
                                            <input type="text" name="branch_location" id="branch_location" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="branch_pin_code">Pin Code</label>
                                            <input type="text" name="branch_pin_code" id="branch_pin_code" class="form-control" minlength="6" maxlength="6" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="branch_address">Address</label>
                                            <textarea name="branch_address" id="branch_address" style="height: 30px;" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="mt-5 d-flex justify-content-center gap-3">
                                        <input type="hidden" name="branch_page" id="branch_page" value="add">
                                        <input type="hidden" name="branch_id" id="branch_id" value="">
                                        <input name="add_branch" type="submit" class="btn btn-primary" id="add_branch" value="Save" title="Save" />
                                        <input type="hidden" name="branch_status" id="branch_status" value="">
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
                                <h5 class="mb-0">Branch Details</h5>
                                <small class="text-muted float-end">Edit Branch</small>
                            </div>
                            <div class="card-body">
                                <form action="index.php" method="POST" name="branch_form" id="branch_form" autocomplete="off" class="needs-validation" novalidate>
                                    <div class="row row-gap-3">
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                                            <div class="col-md-4">
                                                <label class="form-label" for="company_id"><span class="text-danger">*</span> Company</label>
                                                <select name="company_id" id="company_id" class="form-select" required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($listCompany as $data) { ?>
                                                        <option value="<?= $data['company_id']; ?>" <?= ($data['company_id'] == $edit_branch['branch_company_id']) ? 'selected' : '' ?>><?= $data['company_code'] . ' - ' . $data['company_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a company.
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-4">
                                            <label class="form-label" for="branch_code">Branch Code</label>
                                            <input name="branch_code" id="branch_code" class="form-control" value="<?= $edit_branch['branch_code'] ?>" readonly onblur="check_code(<?= ($_SESSION[SESS . 'session_admin_users_company_id'] > 0) ? $_SESSION[SESS . 'session_admin_users_company_id'] : 0 ?>,<?= $edit_branch['branch_id'] ?>);">
                                            <div class="invalid-feedback error_messge">
                                                Please enter branch code.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="branch_name"><span class="text-danger">*</span> Branch Name</label>
                                            <input name="branch_name" id="branch_name" class="form-control" value="<?= $edit_branch['branch_name'] ?>" onblur="check_branch_name(<?= ($_SESSION[SESS . 'session_admin_users_company_id'] > 0) ? $_SESSION[SESS . 'session_admin_users_company_id'] : 0 ?>,<?= $edit_branch['branch_id'] ?>);" required>
                                            <div class="invalid-feedback error_message">
                                                Please enter branch name.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="branch_email"><span class="text-danger">*</span> Email</label>
                                            <input type="email" name="branch_email" id="branch_email" class="form-control" value="<?= $edit_branch['branch_email'] ?>" required>
                                            <div class="invalid-feedback error_messge_1">
                                                Please enter branch email.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="branch_contact_person">Contact Person</label>
                                            <input type="text" name="branch_contact_person" id="branch_contact_person" value="<?= $edit_branch['branch_contact_person'] ?>" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="branch_contact_no"><span class="text-danger">*</span> Contact No</label>
                                            <input type="text" name="branch_contact_no" id="branch_contact_no" required value="<?= $edit_branch['branch_contact_no'] ?>" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onblur="checkmobilelength();" maxlength="10">
                                            <div class="invalid-feedback">
                                                Please enter 10 digits mobile no
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="branch_location">Contact Location</label>
                                            <input type="text" name="branch_location" id="branch_location" class="form-control" value="<?= $edit_branch['branch_location'] ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="branch_pin_code">Pin Code</label>
                                            <input type="text" name="branch_pin_code" id="branch_pin_code" minlength="6" maxlength="6" value="<?= $edit_branch['branch_pin_code'] ?>" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="branch_active_status">Status</label>
                                            <select name="branch_active_status" id="branch_active_status" class="form-control">
                                                <option value="active" <?php if ($edit_branch['branch_active_status'] == 'active') { ?>selected <?php } ?>>Active</option>
                                                <option value="inactive" <?php if ($edit_branch['branch_active_status'] == 'inactive') { ?>selected <?php } ?>>In Active</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="branch_address">Address</label>
                                            <textarea name="branch_address" id="branch_address" class="form-control"><?= $edit_branch['branch_address'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="mt-5 d-flex justify-content-center gap-3">
                                        <input type="hidden" name="branch_id" id="branch_id" value="<?= $edit_branch['branch_id'] ?>">
                                        <?php if ($edit_branch['branch_deleted_status'] != 1) { ?>
                                            <input name="update_branch" type="submit" class="btn btn-primary" id="update_branch" value="Save" title="Save" />
                                            <input type="reset" value="Reset" class="btn btn-outline-secondary" title="Reset" />
                                        <?php } ?>
                                        <input type="hidden" name="branch_page" id="branch_page" value="edit">
                                        <input type="hidden" name="branch_status" id="branch_status" value="<?= $edit_branch['branch_deleted_status'] ?>">
                                        <input type="button" value="Back" class="btn btn-secondary" onclick="location.href='index.php'" title="Back">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php } else {  ?>

                    <?php
                    $company_id = isset($_REQUEST['search_company_id']) ? $_REQUEST['search_company_id'] : '';
                    $branch_name = isset($_REQUEST['search_branch_name']) ? $_REQUEST['search_branch_name'] : '';
                    $search_status = isset($_REQUEST['branch_search_status']) ? $_REQUEST['branch_search_status'] : '';
                    ?>


                    <div class="col-xl">
                        <div class="card mb-4">
                            <form action="index.php" method="POST" name="branch_form" id="branch_form" autocomplete="off">
                                <div class="card-body container-bg">
                                    <div class="form-group d-flex flex-column flex-md-row flex-wrap align-items-md-end justify-content-center gap-3">
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                                            <div class="flex-column col-md-3">
                                                <label class="form-label" for="search_company_id">Company</label>
                                                <select name="search_company_id" id="search_company_id" class="form-select">
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($listCompany as $data) { ?>
                                                        <option value="<?= $data['company_id']; ?>" <?= ($company_id == $data['company_id']) ? 'selected' : '' ?>><?= $data['company_code'] . ' - ' . $data['company_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                            </div>
                                        <?php } ?>
                                        <div class="flex-column col-md-3">
                                            <label class="form-label" for="search_branch_name">Branch Name </label>
                                            <input type="text" name="search_branch_name" id="search_branch_name" class="form-control" value="<?= $branch_name ?>" />
                                        </div>
                                        <div class="flex-column col-md-3">
                                            <label class="form-label" for="branch_search_status">Status</label>
                                            <select name="branch_search_status" id="branch_search_status" class="form-select">
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
                            <form action="index.php" method="POST" name="branch_form" id="branch_form" autocomplete="off">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <caption class="ms-4">
                                        List of Information
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th>S No.</th>
                                            <th>Code</th>
                                            <th>Branch Name</th>
                                            <th>Location</th>
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
                                        if ($list_branch) {
                                            foreach ($list_branch as $value) {
                                        ?>
                                                <tr>
                                                    <td><?= $sno++; ?></td>
                                                    <td><?= $value['branch_code']; ?></td>
                                                    <td><?= ucfirst($value['branch_name']); ?></td>
                                                    <td><?= ucfirst($value['branch_location']); ?></td>
                                                    <td><?php if ($value['branch_active_status'] == 'active') {
                                                            echo "Active";
                                                        } else {
                                                            echo "Inactive";
                                                        } ?></td>
                                                    <?php if ($search_status != 1) { ?>
                                                        <td>
                                                            <i class="bi bi-pencil-square" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&branch_id=<?= $value['branch_id']; ?>'"></i>
                                                        </td>
                                                        <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['branch_id']; ?>,'delete');"><i class="bi bi-trash" style="cursor: pointer;color:red"></i></span>
                                                        </td>
                                                    <?php } else { ?>
                                                        <td>
                                                            <i class="bi bi-eye fs-5" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&branch_id=<?= $value['branch_id']; ?>'"></i>
                                                        </td>
                                                        <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['branch_id']; ?>,'undo');"><i class="bi bi-arrow-counterclockwise fs-5" style="cursor: pointer;color:green"></i></span>
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
                    <input type="hidden" name="branch_hidden_id" id="branch_hidden_id" value="">
                    <input type="hidden" name="branch_hidden_status" id="branch_hidden_status" value="">
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
    <script src="<?= PROJECT_PATH ?>/src/assets/jquery/jquery.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/jquery/jquery-ui.js"></script>
    <script src="branch-function.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/DataTable/datatables.min.js"></script>
    <?php if (isset($_REQUEST['msg'])) {
        if ($_REQUEST['msg'] == 1) {
            $msg = 'Branch Created successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 2) {
            $msg = 'Branch Updated successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 3) {
            $msg = 'Branch Deleted successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 4) {
            $msg = 'Please fill all required fields';
            $color = 'warning';
        } else if ($_REQUEST['msg'] == 5) {
            $msg = 'Branch Code Already Created';
            $color = 'danger';
        } else if ($_REQUEST['msg'] == 6) {
            $msg = 'Branch Name Already Created';
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