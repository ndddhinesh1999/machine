<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= PROJECT_TITLE ?> - Development</title>
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
                <div class="d-flex justify-content-between">
                    <div class="page-title">

                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/home/">Home</a></li>
                                <li class="breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/machine/">Machine</a></li>
                                <li class="breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/machine-details/index.php?type= <?= isset($_REQUEST['type']) ? $_REQUEST['type'] : '' ?>&m_id=<?= $machine['machine_id'] ?>"><?= $machine['machine_name'] ?></a></li>
                                <li class="breadcrumb-item active">Preventive</li>
                            </ol>
                        </nav>
                    </div>
                    <h4>Preventive</h4>
                </div>
                <?php if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'add') { ?>
                    <div class="col-lg-12 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><?= $machine['machine_name'] ?></h5>
                                <small class="text-muted float-end">ADD</small>
                            </div>
                            <div class="card-body">

                                <div class="accordion" id="accordionExample">
                                    <form action="index.php" method="POST" name="department_form" id="department_form" autocomplete="off" class="needs-validation" enctype="multipart/form-data" novalidate>
                                        <div class="col-md-4">
                                            <!-- <label class="form-label machine_name" for="machine_name">Machine Name</label> -->
                                            <!-- <input name="machine_name" id="machine_name" class="form-control" value="<?= $machine['machine_name'] ?>" ; required readonly> -->
                                            <input type="hidden" name="machine_id" id="machine_id" class="form-control" value="<?= $machine['machine_id'] ?>" required readonly>

                                            <div class="invalid-feedback">
                                                Please enter Machine Name.
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label date" for="date">Date</label>
                                            <input name="date" id="date" value="<?= date('d/m/Y') ?>" class="form-control datepicker" required>
                                            <div class="invalid-feedback">
                                                Please enter date.
                                            </div>
                                        </div>
                                        <?php $i = 1;
                                        // echo "<pre>";
                                        // print_r($actively_details);
                                        // exit;
                                        foreach ($actively_details as $actively) { ?>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading<?= $i ?>">
                                                    <button class="accordion-button" type="button" id="expand_<?= $i ?>" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i ?>" aria-expanded="true" aria-controls="collapse<?= $i ?>">
                                                        <?php echo $actively['activity_name'];
                                                        $record = $actively['details']; ?>
                                                    </button>
                                                    <input type="hidden" name="activity_id[]" id="activity_id" value="<?= $actively['activity_id'] ?>">
                                                </h2>
                                                <div id="collapse<?= $i ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $i ?>" data-bs-parent="#accordionExample">
                                                    <!-- <form action="index.php" method="POST" enctype="multipart/form-data"> -->
                                                    <div class="accordion-body">
                                                        <div class="row mt-2">
                                                            <div class="col-3 p-0">
                                                                <label class="form-label">Activity & Plan</label>
                                                            </div>
                                                            <div class="col-3 p-0">
                                                                <label class="form-label">Remarks</label>
                                                            </div>
                                                            <div class="col-3 p-0">
                                                                <label class="form-label">Before File</label>
                                                            </div>
                                                            <div class="col-3 p-0">
                                                                <label class="form-label">After File</label>
                                                            </div>
                                                        </div>
                                                        <?php $j = 1;
                                                        foreach ($record as $details) { ?>
                                                            <div class="row mt-2">
                                                                <div class="col-3 p-0">
                                                                    <label class="form-label"><b><?= $details['activity_detail_name'] ?></b></label><br>
                                                                    <label class="form-label"> <b><?= $details['activity_details_plan'] ?></b></label>
                                                                    <input type="hidden" name="activity_detail_id<?= $actively['activity_id'] ?>[]" id="activity_detail_id" value="<?= $details['activity_detail_id'] ?>">
                                                                </div>
                                                                <div class="col-3 p-0">

                                                                    <div class="input-group">
                                                                        <textarea name="remarks<?= $actively['activity_id'] ?>[]" id="remarks<?= $j ?>" cols="30" rows="2" require></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3 p-0">
                                                                    <div class="input-group">
                                                                        <input type="file" name="before_image<?= $actively['activity_id'] ?>[]" id="before_image<?= $j ?>" class="form-control" accept="image/png, image/gif, image/jpeg" required>
                                                                        <!-- <div class="input-group-text">
                                                                            show
                                                                        </div> -->
                                                                    </div>
                                                                </div>
                                                                <div class="col-3 p-0">
                                                                    <div class="input-group">
                                                                        <input type="file" name="after_image<?= $actively['activity_id'] ?>[]" id="after_image<?= $j ?>" class="form-control" accept="image/png, image/gif, image/jpeg" required>
                                                                        <!-- <div class="input-group-text">
                                                                            show
                                                                        </div> -->
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        <?php $j++;
                                                        }
                                                        ?>
                                                          <button type="button" class="btn btn-primary mt-3" onclick="$('#expand_<?= $i+1 ?>').click()">Next</button>
                                                    </div>
                                                    <!-- <div class="accordion-footer d-flex justify-content-center gap-3 mb-2" style="background-color: #dfe7ff;padding: 10px;">
                                                        <input type="reset" class="btn btn-secondary">
                                                        <input type="submit" name="save" value="Save" class="btn btn-success">
                                                    </div> -->
                                                    <!-- </form> -->
                                                </div>
                                                
                                            </div><br>
                                        <?php $i++;
                                        }
                                        ?>
                                </div>
                                <div class="mt-5 d-flex justify-content-center gap-3">
                                    <input type="hidden" name="department_page" id="department_page" value="add">
                                    <input type="hidden" name="department_status" id="department_status" value="">
                                    <input name="save" type="submit" class="btn btn-primary" id="save" value="Save" title="Save" />
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
                                <h5 class="mb-0">Department Details</h5>
                                <small class="text-muted float-end">EDIT</small>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>

                <?php } else {  ?>

                    <?php
                    $department_name = isset($_REQUEST['search_department_name']) ? $_REQUEST['search_department_name'] : '';
                    $search_status = isset($_REQUEST['department_search_status']) ? $_REQUEST['department_search_status'] : '';
                    $company_id = isset($_REQUEST['search_company_id']) ? $_REQUEST['search_company_id'] : '';

                    ?>


                    <div class="col-xl">
                        <div class="card mb-4">
                            <form action="index.php" method="POST" name="department_form" id="department_form" autocomplete="off">
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
                                            <label class="form-label" for="search_department_name">Department Name </label>
                                            <input type="text" name="search_department_name" id="search_department_name" class="form-control" value="<?= $department_name ?>" />
                                        </div>
                                        <div class="flex-column col-md-3">
                                            <label class="form-label" for="department_search_status">Status</label>
                                            <select name="department_search_status" id="department_search_status" class="form-select">
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
                            <form action="index.php" method="POST" name="department_form" id="department_form" autocomplete="off">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <caption class="ms-4">
                                        List of Information
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th>S No.</th>
                                            <th>Date</th>

                                            <th>Edit</th>
                                            <th>Delete</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i = 1;
                                        foreach ($preventive_list as $get) {
                                        ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= $get['date'] ?></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        <?php } ?>
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
                    <input type="hidden" name="department_hidden_id" id="department_hidden_id" value="">
                    <input type="hidden" name="department_hidden_status" id="department_hidden_status" value="">
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
    <script src="preventive-function.js"></script>
    <?php

    if (isset($_REQUEST['msg'])) {
        if ($_REQUEST['msg'] == 1) {
            $msg = 'Department Created successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 2) {
            $msg = 'Department Updated successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 3) {
            $msg = 'Department Deleted successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 4) {
            $msg = 'Please fill all required fields';
            $color = 'warning';
        } else if ($_REQUEST['msg'] == 5) {
            $msg = 'Department Name Already Created';
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