<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= PROJECT_TITLE ?> - autonomous</title>
    <link rel="shortcut icon" type="image/png" href="<?= PROJECT_PATH; ?>/src/assets/images/logos/company-logo.svg" />
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/libs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/css/styles.min.css" />
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/css/styles.css" />
    <link href="<?= PROJECT_PATH ?>/src/assets/DataTable/datatables.min.css" rel="stylesheet" />
    <link href="<?= PROJECT_PATH ?>/src/assets/jquery/jquery-ui.css" rel="stylesheet">
    <style>
        .preview_image {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            object-fit: contain;
            padding: 4rem;
        }
    </style>

</head>
<script>
    const stepper = document.querySelector('#stepper');
    new CDB.Stepper(stepper);
</script>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

        <?php include '../../includes/side-nav.php'; ?>

        <!--  Main wrapper -->
        <div class="body-wrapper">

            <?php include '../../includes/header.php'; ?>

            <div class="container-fluid">
                <div class="page-title">
                    <h1>Autonomous Weekly</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/home/">Home</a></li>
                            <li class="breadcrumb-item active">autonomous-weekly</li>
                        </ol>
                    </nav>
                </div>
                <?php if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'add') { ?>
                    <div class="col-lg-12 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Autonomous Weekly Details</h5>
                                <small class="text-muted float-end">Add autonomous Weekly</small>
                            </div>
                            <div class="card-body">
                                <form action="index.php" method="POST" name="autonomous_form" id="autonomous_form" autocomplete="off" class="needs-validation" enctype="multipart/form-data" novalidate>
                                    <div class="row">
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                                            <div class="col-md-4">
                                                <label class="form-label company_id" for="company_id">Company</label>
                                                <select name="company_id" id="company_id" class="form-select" required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($listCompany as $data) { ?>
                                                        <option value="<?= $data['company_id']; ?>"><?= $data['company_code'] . ' - ' . $data['company_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a company.
                                                </div>
                                            </div>

                                        <?php    } ?>
                                        <div class="col-md-2">
                                            <label class="form-label autonomous_date" for="autonomous_date">Date</label>
                                            <input name="autonomous_date" id="autonomous_date" value="<?= date('d/m/Y') ?>" class="form-control datepicker" required>
                                            <div class="invalid-feedback">
                                                Please enter autonomous date.
                                            </div>
                                        </div>

                                        <div class="row" style="margin-top: 15px;">

                                            <div class="col-md-3">
                                                <label class="form-label ">Label & Standard</label>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label ">Remarks</label>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label ">Before</label>

                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label ">After</label>

                                            </div>

                                        </div>

                                        <?php foreach ($listLabels as $get_data) { ?>

                                            <div class="row" style="margin-top: 15px;">

                                                <div class="row" style="margin-top: 15px;">

                                                    <div class="col-md-3">
                                                        <b> <?= $get_data['autonomou_lable_part'] . '.' ?></b>
                                                        <br>
                                                        <label> <?= $get_data['autonomou_lable_standard'] ?></label>
                                                        <input type="hidden" name="label_id[]" id="machine_id" value="<?= $get_data['autonomou_lable_id'] ?>" class="form-control" required>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <textarea name="autonomous_remark[]" id="autonomous_remark" class="form-control" cols="30" rows="3"> </textarea>

                                                        <div class="invalid-feedback">
                                                            Please enter autonomous remark.
                                                        </div>
                                                    </div>

                                      

                                                    <div class="col-md-3">

                                                        <input type="file" name="autonomous_img_bfr" id="autonomous_img_bfr" accept="image/*" class="form-control" required>
                                                        <div class="invalid-feedback">
                                                            Please Choose Before autonomous Image.
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">

                                                        <input type="file" name="autonomous_img[]" id="autonomous_img" accept="image/*" class="form-control" required>
                                                        <div class="invalid-feedback">
                                                            Please Choose Before autonomous Image.
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php } ?>
                                            <!-- <div class="col-md-4">
                                            <label class="form-label bfr_autonomous_descript" for="bfr_autonomous_descript">Before autonomous - Description</label>
                                            <input name="bfr_autonomous_descript" id="bfr_autonomous_descript" class="form-control " required>
                                            <div class="invalid-feedback">
                                                Please enter Before autonomous Desc.
                                            </div>
                                        </div> -->


                                            </div>
                                            <div class="mt-5 d-flex justify-content-center gap-3">
                                                <input type="hidden" name="autonomous_page" id="autonomous_page" value="add">
                                                <input type="hidden" name="autonomous_status" id="autonomous_status" value="">
                                                <input name="add_autonomous" type="submit" class="btn btn-primary" id="add_autonomous" value="Save" title="Save" />
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
                                <h5 class="mb-0">Autonomous Weekly Details</h5>
                                <small class="text-muted float-end">Edit autonomous Weekly</small>
                            </div>

                            <div class="card-body">
                                <form action="index.php" method="POST" name="autonomous_form" id="autonomous_form" autocomplete="off" class="needs-validation" enctype="multipart/form-data" novalidate>
                                    <div class="row">
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                                            <div class="col-md-3">
                                                <label class="form-label company_id" for="company_id">Company</label>
                                                <select name="company_id" id="company_id" class="form-select" required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($listCompany as $data) { ?>
                                                        <option value="<?= $data['company_id']; ?>" <?= ($data['company_id'] == $edit_autonomous['autonomous_company_id']) ? 'selected' : '' ?>><?= $data['company_code'] . ' - ' . $data['company_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a company.
                                                </div>
                                            </div>
                                        <?php    } ?>

                                        <div class="col-md-3">
                                            <label class="form-label autonomous_date" for="autonomous_date">Date</label>
                                            <input name="autonomous_date" id="autonomous_date" value="<?= !empty($edit_autonomous['dates']) ? dateGeneralFormat($edit_autonomous['dates']) : '00/00/0000'  ?>" class="form-control datepicker" required>
                                            <div class="invalid-feedback">
                                                Please enter autonomous date.
                                            </div>
                                        </div>

                                        <div class="row" style="margin-top: 15px;">

                                            <div class="col-md-3">
                                                <label class="form-label ">Label & Standard</label>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label ">Remark</label>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label ">Before</label>

                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label ">After</label>

                                            </div>
                                        </div>

                                        <?php foreach ($edit_autonomous['details'] as $get_data) { ?>

                                            <div class="row" style="margin-top: 15px;">

                                                
                                            <div class="col-md-3">
                                                    <b> <?= $get_data['label_part'] . '.'  ?></b>
                                                    <br>
                                                    <label> <?= $get_data['label_std'] ?></label>

                                                    <input type="hidden" name="label_id[]" id="machine_id" value="<?= $get_data['label_id'] ?>" class="form-control" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <textarea name="autonomous_remark[]" id="autonomous_remark" class="form-control" cols="30" rows="3"><?= $get_data['remark'] ?></textarea>

                                                    <div class="invalid-feedback">
                                                        Please enter autonomous remark.
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <?php $required = empty($get_data['files_bfr']) ? 'required' : ''; ?>

                                                    <input type="file" name="autonomous_img_bfr[]" id="autonomous_img_bfr" class="form-control" <?= $required ?> value="<?= $get_data['files_bfr']  ?>">
                                                    <div class="invalid-feedback">
                                                        Please Choose autonomous Before Image.
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <?php $required = empty($get_data['files']) ? 'required' : ''; ?>

                                                    <input type="file" name="autonomous_img[]" id="autonomous_img" class="form-control" value="<?= $get_data['files']  ?>" $required>
                                                    <div class="invalid-feedback">
                                                        Please Choose autonomous Image.
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>



                                        <div class="mt-5 d-flex justify-content-center gap-3">
                                            <input type="hidden" name="autonomous_id" id="autonomous_id" value="<?= $edit_autonomous['autonomous_id'] ?>">
                                            <?php if ($edit_autonomous['deleted_status'] != 1) { ?>
                                                <input name="update_autonomous" type="submit" class="btn btn-primary" id="update_autonomous" value="Save" title="Save" />
                                                <input type="reset" value="Reset" class="btn btn-outline-secondary" title="Reset" />
                                            <?php } ?>
                                            <input type="hidden" name="autonomous_page" id="autonomous_page" value="edit">
                                            <input type="hidden" name="autonomous_status" id="autonomous_status" value="<?= $edit_autonomous['deleted_status'] ?>">
                                            <input type="button" value="Back" class="btn btn-secondary" onclick="location.href='index.php'" title="Back">
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php } else {  ?>

                    <?php
                    $autonomous_name = isset($_REQUEST['search_autonomous_name']) ? $_REQUEST['search_autonomous_name'] : '';
                    $search_status = isset($_REQUEST['autonomous_search_status']) ? $_REQUEST['autonomous_search_status'] : '';
                    $company_id = isset($_REQUEST['search_company_id']) ? $_REQUEST['search_company_id'] : '';

                    ?>


                    <div class="col-xl">
                        <div class="card mb-4">
                            <form action="index.php" method="POST" name="autonomous_form" id="autonomous_form" autocomplete="off">
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
                                            <label class="form-label" for="search_autonomous_name">autonomous Name </label>
                                            <input type="text" name="search_autonomous_name" id="search_autonomous_name" class="form-control" value="<?= $autonomous_name ?>" />
                                        </div>
                                        <div class="flex-column col-md-3">
                                            <label class="form-label" for="autonomous_search_status">Status</label>
                                            <select name="autonomous_search_status" id="autonomous_search_status" class="form-select">
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
                            <form action="index.php" method="POST" name="autonomous_form" id="autonomous_form" autocomplete="off">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <caption class="ms-4">
                                        List of Information
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th>S No.</th>
                                            <th>Autonomous Date</th>
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
                                        if ($list_autonomous) {
                                            foreach ($list_autonomous as $value) {
                                        ?>
                                                <tr>
                                                    <td><?= $sno++; ?></td>
                                                    <td><?= dateGeneralFormat($value['autonomous_date']); ?></td>
                                                    <td><?php if ($value['autonomous_active_status'] == 'active') {
                                                            echo "Active";
                                                        } else {
                                                            echo "Inactive";
                                                        } ?></td>

                                                    <?php if ($search_status != 1) { ?>
                                                        <td>
                                                            <i class="bi bi-pencil-square" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&autonomous_id=<?= $value['autonomous_id']; ?>'"></i>
                                                        </td>
                                                        <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['autonomous_id']; ?>,'delete');"><i class="bi bi-trash" style="cursor: pointer;color:red"></i></span>
                                                        </td>
                                                    <?php } else { ?>
                                                        <td>
                                                            <i class="bi bi-eye fs-5" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&autonomous_id=<?= $value['autonomous_id']; ?>'"></i>
                                                        </td>
                                                        <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['autonomous_id']; ?>,'undo');"><i class="bi bi-arrow-counterclockwise fs-5" style="cursor: pointer;color:green"></i></span>
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
                    <input type="hidden" name="autonomous_hidden_id" id="autonomous_hidden_id" value="">
                    <input type="hidden" name="autonomous_hidden_status" id="autonomous_hidden_status" value="">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#exampleModal').modal('hide');">Close</button>
                    <button type="button" class="btn btn-primary" id="delete_button">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete success message  modal -->
    <div class="modal fade" id="success_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1"></h5>
                </div>
                <div class="modal-body1">
                    <div class="d-flex justify-content-center">
                        <p>The Recors Was
                            <span id="record_status"></span>
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
    <script src="autonomous-function.js"></script>

    <?php

    if (isset($_REQUEST['msg'])) {
        if ($_REQUEST['msg'] == 1) {
            $msg = 'autonomous Created successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 2) {
            $msg = 'autonomous Updated successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 3) {
            $msg = 'autonomous Deleted successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 4) {
            $msg = 'Please fill all required fields';
            $color = 'warning';
        } else if ($_REQUEST['msg'] == 5) {
            $msg = 'autonomous Name Already Created';
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