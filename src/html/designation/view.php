<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= PROJECT_TITLE ?> - Designation</title>
    <link rel="shortcut icon" type="image/png" href="<?= PROJECT_PATH; ?>/src/assets/images/logos/company-logo.svg" />
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/libs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/css/styles.min.css" />
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
                <div class="page-title">
                    <h1>Designation</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/home/">Home</a></li>
                            <li class="breadcrumb-item active">Designation</li>
                        </ol>
                    </nav>
                </div>

                <?php if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'add') { ?>
                    <div class="col-lg-12 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Designation Details</h5>
                                <small class="text-muted float-end">Add Designation</small>
                            </div>
                            <div class="card-body">
                                <form action="index.php" method="POST" name="designation_form" id="designation_form" autocomplete="off" class="needs-validation" novalidate>
                                    <div class="row">
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                                            <div class="col-md-4">
                                                <label class="form-label" for="company_id">Company</label>
                                                <select name="company_id" id="company_id" class="form-select" required onchange="get_branch();">
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($listCompany as $data) { ?>
                                                        <option value="<?= $data['company_id']; ?>"><?= $data['company_code'] . ' - ' . $data['company_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a company.
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label" for="branch_id">Branch</label>
                                                <select name="branch_id" id="branch_id" class="form-select" required>
                                                    <option value="">-Select-</option>
                                                    <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                                                    <?php    } else { ?>
                                                        <?php foreach ($listBranch as $get) { ?>
                                                            <option value="<?= $get['branch_id']; ?>"><?= $get['branch_code'] . ' - ' . $get['branch_name']; ?></option>
                                                        <?php    } ?>
                                                    <?php    } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a branch.
                                                </div>
                                            </div>
                                        <?php    } ?>
                                        <div class="col-md-4">
                                            <label class="form-label" for="designation_name">Designation Name</label>
                                            <input name="designation_name" id="designation_name" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter designation name.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5 d-flex justify-content-center gap-3">
                                        <input type="hidden" name="designation_page" id="designation_page" value="add">
                                        <input type="hidden" name="designation_status" id="designation_status" value="">
                                        <input name="add_designation" type="submit" class="btn btn-primary" id="add_designation" value="Save" title="Save" />
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
                                <h5 class="mb-0">Designation Details</h5>
                                <small class="text-muted float-end">Edit Designation</small>
                            </div>
                            <div class="card-body">
                                <form action="index.php" method="POST" name="designation_form" id="designation_form" autocomplete="off" class="needs-validation" novalidate>
                                    <div class="row">
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                                            <div class="col-md-3">
                                                <label class="form-label" for="company_id">Company</label>
                                                <select name="company_id" id="company_id" class="form-select" required onchange="get_branch();">
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($listCompany as $data) { ?>
                                                        <option value="<?= $data['company_id']; ?>" <?= ($data['company_id'] == $edit_designation['designation_company_id']) ? 'selected' : '' ?>><?= $data['company_code'] . ' - ' . $data['company_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a company.
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="branch_id">Branch</label>
                                                <select name="branch_id" id="branch_id" class="form-select" required>
                                                    <option value="">-Select-</option>

                                                    <?php foreach ($listBranch as $get) { ?>
                                                        <option value="<?= $get['branch_id']; ?>" <?= ($get['branch_id'] == $edit_designation['designation_branch_id']) ? 'selected' : '' ?>><?= $get['branch_code'] . ' - ' . $get['branch_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a branch.
                                                </div>
                                            </div>
                                        <?php    } ?>
                                        <div class="col-md-3">
                                            <label class="form-label" for="designation_name">Designation Name</label>
                                            <input name="designation_name" id="designation_name" class="form-control" value="<?= $edit_designation['designation_name'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter designation name.
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" for="designation_active_status">Status</label>
                                            <select name="designation_active_status" id="designation_active_status" class="form-control">
                                                <option value="active" <?php if ($edit_designation['designation_active_status'] == 'active') { ?>selected <?php } ?>>Active</option>
                                                <option value="inactive" <?php if ($edit_designation['designation_active_status'] == 'inactive') { ?>selected <?php } ?>>In Active</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mt-5 d-flex justify-content-center gap-3">
                                        <input type="hidden" name="designation_id" id="designation_id" value="<?= $edit_designation['designation_id'] ?>">
                                        <?php if ($edit_designation['designation_deleted_status'] != 1) { ?>
                                            <input name="update_designation" type="submit" class="btn btn-primary" id="update_designation" value="Save" title="Save" />
                                            <input type="reset" value="Reset" class="btn btn-outline-secondary" title="Reset" />
                                        <?php } ?>
                                        <input type="hidden" name="designation_page" id="designation_page" value="edit">
                                        <input type="hidden" name="designation_status" id="designation_status" value="<?= $edit_designation['designation_deleted_status'] ?>">
                                        <input type="button" value="Back" class="btn btn-secondary" onclick="location.href='index.php'" title="Back">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php } else {  ?>

                    <?php
                    $designation_name = isset($_REQUEST['search_designation_name']) ? $_REQUEST['search_designation_name'] : '';
                    $search_status = isset($_REQUEST['designation_search_status']) ? $_REQUEST['designation_search_status'] : '';
                    $company_id = isset($_REQUEST['search_company_id']) ? $_REQUEST['search_company_id'] : '';
                    $branch_id = isset($_REQUEST['search_branch_id']) ? $_REQUEST['search_branch_id'] : '';
                    $search_get_branch = search_get_branch($company_id);
                    ?>


                    <div class="col-xl">
                        <div class="card mb-4">
                            <form action="index.php" method="POST" name="designation_form" id="designation_form" autocomplete="off">
                                <div class="card-body container-bg">
                                    <div class="form-group d-flex flex-column flex-md-row flex-wrap align-items-md-end justify-content-center gap-3">
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                                            <div class="flex-column col-md-3">
                                                <label class="form-label" for="search_company_id">Company</label>
                                                <select name="search_company_id" id="search_company_id" class="form-select" onchange="search_get_branch();">
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($listCompany as $data) { ?>
                                                        <option value="<?= $data['company_id']; ?>" <?= ($company_id == $data['company_id']) ? 'selected' : '' ?>><?= $data['company_code'] . ' - ' . $data['company_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                            </div>
                                        <?php } ?>
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin' || $_SESSION[SESS . 'session_admin_users_level'] == 'company') { ?>
                                            <div class="flex-column col-md-3">
                                                <label class="form-label" for="search_branch_id">Branch </label>
                                                <select name="search_branch_id" id="search_branch_id" class="form-select">
                                                    <option value=""> - Select - </option>
                                                    <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                                                        <?php foreach ($search_get_branch as $get) { ?>
                                                            <option value="<?= $get['branch_id']; ?>" <?= ($branch_id == $get['branch_id']) ? 'selected' : '' ?>><?= $get['branch_code'] . ' - ' . $get['branch_name']; ?></option>
                                                        <?php    } ?>
                                                    <?php    } else { ?>
                                                        <?php foreach ($listBranch as $get) { ?>
                                                            <option value="<?= $get['branch_id']; ?>" <?= ($branch_id == $get['branch_id']) ? 'selected' : '' ?>><?= $get['branch_code'] . ' - ' . $get['branch_name']; ?></option>
                                                        <?php    } ?>
                                                    <?php    } ?>
                                                </select>
                                            </div>
                                        <?php } ?>
                                        <div class="flex-column col-md-3">
                                            <label class="form-label" for="search_designation_name">Designation Name </label>
                                            <input type="text" name="search_designation_name" id="search_designation_name" class="form-control" value="<?= $designation_name ?>" />
                                        </div>
                                        <div class="flex-column col-md-3">
                                            <label class="form-label" for="designation_search_status">Status</label>
                                            <select name="designation_search_status" id="designation_search_status" class="form-select">
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
                            <form action="index.php" method="POST" name="designation_form" id="designation_form" autocomplete="off">
                                <table id="example" class="table table-striped" style="width:100%">

                                    <caption class="ms-4">
                                        List of Information
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th>S No.</th>
                                            <th>Designation Name</th>
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
                                        if ($list_designation) {
                                            foreach ($list_designation as $value) {
                                        ?>
                                                <tr>
                                                    <td><?= $sno++; ?></td>
                                                    <td><?= ucfirst($value['designation_name']); ?></td>
                                                    <td><?php if ($value['designation_active_status'] == 'active') {
                                                            echo "Active";
                                                        } else {
                                                            echo "Inactive";
                                                        } ?></td>
                                                    <?php if ($search_status != 1) { ?>
                                                        <td>
                                                            <i class="bi bi-pencil-square" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&designation_id=<?= $value['designation_id']; ?>'"></i>
                                                        </td>
                                                        <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['designation_id']; ?>,'delete');"><i class="bi bi-trash" style="cursor: pointer;color:red"></i></span>
                                                        </td>
                                                    <?php } else { ?>
                                                        <td>
                                                            <i class="bi bi-eye fs-5" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&designation_id=<?= $value['designation_id']; ?>'"></i>
                                                        </td>
                                                        <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['designation_id']; ?>,'undo');"><i class="bi bi-arrow-counterclockwise fs-5" style="cursor: pointer;color:green"></i></span>
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
                    <input type="hidden" name="designation_hidden_id" id="designation_hidden_id" value="">
                    <input type="hidden" name="designation_hidden_status" id="designation_hidden_status" value="">
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
    <script src="<?= PROJECT_PATH ?>/src/assets/DataTable/datatables.min.js"></script>
    <script src="designation-function.js"></script>
    <?php
    if (isset($_REQUEST['msg'])) {
        if ($_REQUEST['msg'] == 1) {
            $msg = 'Designation Created successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 2) {
            $msg = 'Designation Updated successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 3) {
            $msg = 'Designation Deleted successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 4) {
            $msg = 'Please fill all required fields';
            $color = 'warning';
        } else if ($_REQUEST['msg'] == 5) {
            $msg = 'Designation Name Already Created';
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