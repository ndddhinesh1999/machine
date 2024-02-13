<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= PROJECT_TITLE ?> - historycard</title>
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
                    <h1>History Card</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/home/">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/machine/index.php?type=<?= isset($_REQUEST['type']) ? $_REQUEST['type'] : '' ?>">Machine</a></li>
                            <li class=" breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/machine-details/index.php?id=<?= $machine['machine_id'] ?>"><?= $machine['machine_name'] ?></a></li>
                            <li class="breadcrumb-item active">historycard</li>
                        </ol>
                    </nav>
                </div>
                <?php if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'add') { ?>
                    <div class="col-lg-12 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">History Card Details</h5>
                                <small class="text-muted float-end">Add History Card</small>
                            </div>
                            <div class="card-body">
                                <form action="index.php" method="POST" name="historycard_form" id="historycard_form" autocomplete="off" class="needs-validation" enctype="multipart/form-data" novalidate>
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



                                        <div class="col-md-4">
                                            <label class="form-label machine_name" for="machine_name">Machine Name</label>
                                            <input name="machine_name" id="machine_name" class="form-control" value="<?= $machine['machine_name'] ?>" ; required readonly>
                                            <input type="hidden" name="machine_id" id="machine_id" class="form-control" value="<?= $machine['machine_id'] ?>" required readonly>

                                            <div class="invalid-feedback">
                                                Please enter Machine Name.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label date" for="date">Date</label>
                                            <input name="date" id="date" class="form-control datepicker" required>
                                            <div class="invalid-feedback">
                                                Please enter date.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label nature_of_prob" for="nature_of_prob">Nature of Problem</label>
                                            <input name="nature_of_prob" id="nature_of_prob" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter Nature of Problem.
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="form-label historycard_action_taken" for="historycard_action_taken">Action Taken/Planned</label>
                                            <textarea name="action_taken" id="action_taken" class="form-control" required rows="2"> </textarea>
                                            <div class="invalid-feedback">
                                                Please enter Action Taken.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label attend_by" for="attend_by">Attended By</label>
                                            <input name="attend_by" id="attend_by" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter Spare Changes.
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label bfr_historycard_img" for="bfr_historycard_img">Before Image</label>

                                            <input type="file" name="before_image" id="before_image" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please Choose Before historycard Image.
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label aft_historycard_img" for="aft_historycard_img">After Image</label>

                                            <input type="file" name="after_image" id="after_image" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please choose After historycard Image.
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mt-5 d-flex justify-content-center gap-3">
                                        <input type="hidden" name="historycard_page" id="historycard_page" value="add">
                                        <input type="hidden" name="historycard_status" id="historycard_status" value="">
                                        <input name="add_historycard" type="submit" class="btn btn-primary" id="add_historycard" value="Save" title="Save" />
                                        <input type="reset" value="Reset" class="btn btn-outline-secondary" title="Reset" />
                                        <input type="button" value="Back" class="btn btn-secondary" onclick="location.href='index.php'" title="Back">
                                    </div>
                                    <div class="mt-5 d-flex justify-content-between gap-3">
                                        <input type="button" value="< Preventive" class="btn btn-warning" onclick="location.href='../preventive/index?page=add'" title="Preventive">
                                        <input type="button" value="History Card >" class="btn btn-success" onclick="location.href='../history_card/index?page=add'" title="History Card">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } else if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'edit') { ?>

                    <div class="col-lg-12 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">History Card Details</h5>
                                <small class="text-muted float-end">Edit History Card</small>
                            </div>

                            <div class="card-body">
                                <form action="index.php" method="POST" name="historycard_form" id="historycard_form" autocomplete="off" class="needs-validation" enctype="multipart/form-data" novalidate>
                                    <div class="row">
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                                            <div class="col-md-3">
                                                <label class="form-label company_id" for="company_id">Company</label>
                                                <select name="company_id" id="company_id" class="form-select" required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($listCompany as $data) { ?>
                                                        <option value="<?= $data['company_id']; ?>" <?= ($data['company_id'] == $edit_history_card['historycard_company_id']) ? 'selected' : '' ?>><?= $data['company_code'] . ' - ' . $data['company_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a company.
                                                </div>
                                            </div>
                                        <?php    } ?>

                                        <div class="col-md-4">
                                            <label class="form-label machine_name" for="machine_name">Machine Name</label>
                                            <input name="machine_name" id="machine_name" class="form-control" value="<?= $edit_history_card['machine_name'] ?>" required readonly>
                                            <input type="hidden" name="machine_id" id="machine_id" class="form-control" value="<?= $edit_history_card['history_card_machine_id'] ?>" required>

                                            <div class="invalid-feedback">
                                                Please enter Machine Name.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label historycard_date" for="historycard_date"> date</label>
                                            <input name="date" id="date" class="form-control datepicker" value="<?= dateGeneralFormat($edit_history_card['history_card_date']) ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter historycard date.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label nature_of_prob" for="nature_of_prob">Nature of Problem</label>
                                            <input name="nature_of_prob" id="nature_of_prob" class="form-control" value="<?= $edit_history_card['history_card_problem'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter Nature of Problem.
                                            </div>
                                        </div>




                                        <div class="col-md-8">
                                            <label class="form-label historycard_action_taken" for="historycard_action_taken">Action Taken/Planned</label>
                                            <textarea name="action_taken" id="action_taken" class="form-control" required><?= $edit_history_card['history_card_planned'] ?></textarea>
                                            <div class="invalid-feedback">
                                                Please enter Action Taken.
                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <label class="form-label attend_by" for="attend_by">Attended By</label>
                                            <input name="attend_by" id="attend_by" class="form-control" value="<?= $edit_history_card['history_card_attended_by'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter Spare Changes.
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label bfr_historycard_img" for="bfr_historycard_img">Before - Image</label>
                                            <?php $required = empty($edit_history_card['history_card_before_image']) ? 'required' : '' ?>

                                            <input type="file" name="before_image" id="before_image" class="form-control" value="<?= $edit_history_card['history_card_before_image'] ?>" $required>
                                            <div class="invalid-feedback">
                                                Please Choose Before Image.
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <?php $required = empty($edit_history_card['history_card_after_image']) ? 'required' : '' ?>
                                            <label class="form-label aft_historycard_img" for="aft_historycard_img">After - Image</label>
                                            <input type="file" name="after_image" id="after_image" class="form-control" value="<?= $edit_history_card['history_card_after_image'] ?>" $required>
                                            <div class="invalid-feedback">
                                                Please choose After Image.
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $required = empty($edit_history_card['history_card_before_image']) ? 'required' : '' ?>

                                            <label class="form-label aft_historycard_img" for="aft_historycard_img">Before - Image Preview</label><br>
                                            <div id="image-preview-dialog-before" style="display: none;">
                                                <img class="preview_image" src="<?= $edit_history_card['history_card_before_image'] ?>" alt="Image Preview">
                                            </div>
                                            <img class="preview-trigger-before" style="width: 100px;" src="<?= $edit_history_card['history_card_before_image'] ?>" alt="Image Preview">

                                            <input type="hidden" name="before_image" id="before_image" class="textbox" value="<?= $edit_history_card['history_card_before_image'] ?> " />
                                        </div>
                                        <div class="col-md-6">
                                            <?php $required = empty($edit_history_card['history_card_after_image']) ? 'required' : '' ?>

                                            <label class="form-label aft_historycard_img" for="aft_historycard_img">After - Image Preview</label><br>
                                            <div id="image-preview-dialog-after" style="display: none;">
                                                <img class="preview_image" src="<?= $edit_history_card['history_card_after_image'] ?>" alt="Image Preview">
                                            </div>
                                            <img class="preview-trigger-after" style="width: 100px;" src="<?= $edit_history_card['history_card_after_image'] ?>" alt="Image Preview">

                                            <input type="hidden" name="after_image" id="after_image" class="textbox" value="<?= $edit_history_card['history_card_after_image'] ?> " />
                                        </div>

                                        <div class="mt-5 d-flex justify-content-center gap-3">
                                            <input type="hidden" name="history_card_id" id="history_card_id" value="<?= $edit_history_card['history_card_id'] ?>">
                                            <?php if ($edit_history_card['history_card_active_status'] != 1) { ?>
                                                <input name="update_historycard" type="submit" class="btn btn-primary" id="update_historycard" value="Save" title="Save" />
                                                <input type="reset" value="Reset" class="btn btn-outline-secondary" title="Reset" />
                                            <?php } ?>
                                            <input type="hidden" name="historycard_page" id="historycard_page" value="edit">
                                            <input type="hidden" name="historycard_status" id="historycard_status" value="<?= $edit_history_card['history_card_active_status'] ?>">
                                            <input type="button" value="Back" class="btn btn-secondary" onclick="location.href='index.php'" title="Back">
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php } else {  ?>

                    <?php
                    $historycard_name = isset($_REQUEST['search_historycard_name']) ? $_REQUEST['search_historycard_name'] : '';
                    $search_status = isset($_REQUEST['historycard_search_status']) ? $_REQUEST['historycard_search_status'] : '';
                    $company_id = isset($_REQUEST['search_company_id']) ? $_REQUEST['search_company_id'] : '';

                    ?>


                    <div class="col-xl">
                        <div class="card mb-4">
                            <form action="index.php" method="POST" name="historycard_form" id="historycard_form" autocomplete="off">
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
                                            <label class="form-label" for="">From Date </label>
                                            <input type="text" name="from_date" id="from_date" class="form-control datepicker" value="<?= $historycard_name ?>" />
                                        </div>
                                        <div class="flex-column col-md-3">
                                            <label class="form-label" for="">To Date </label>
                                            <input type="text" name="to_date" id="to_date" class="form-control datepicker" value="<?= $historycard_name ?>" />
                                        </div>
                                        <!-- <div class="flex-column col-md-3">
                                            <label class="form-label" for="historycard_search_status">Status</label>
                                            <select name="historycard_search_status" id="historycard_search_status" class="form-select">
                                                <option value="active" <?php if ($search_status == 'active') { ?>selected <?php } ?>>Active</option>
                                                <option value="inactive" <?php if ($search_status == 'inactive') { ?>selected <?php } ?>>In Active</option>
                                                <option value="1" <?php if ($search_status == '1') { ?>selected <?php } ?>>Deleted</option>
                                            </select>
                                        </div> -->

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
                            <form action="index.php" method="POST" name="historycard_form" id="historycard_form" autocomplete="off">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <caption class="ms-4">
                                        List of Information
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th>S No.</th>
                                            <th>Date</th>
                                            <th>Problem</th>

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
                                        if ($list_history_card) {
                                            foreach ($list_history_card as $value) {
                                        ?>
                                                <tr>
                                                    <td><?= $sno++; ?></td>
                                                    <td><?= $value['history_card_date']; ?></td>
                                                    <td><?= ucfirst($value['history_card_problem']); ?></td>
                                                    <?php if ($search_status != 1) { ?>
                                                        <td>
                                                            <i class="bi bi-pencil-square" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&history_card_id=<?= $value['history_card_id']; ?>'"></i>
                                                        </td>
                                                        <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['history_card_id']; ?>,'delete');"><i class="bi bi-trash" style="cursor: pointer;color:red"></i></span>
                                                        </td>
                                                    <?php } else { ?>
                                                        <td>
                                                            <i class="bi bi-eye fs-5" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&history_card_id=<?= $value['history_card_id']; ?>'"></i>
                                                        </td>
                                                        <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['history_card_id']; ?>,'undo');"><i class="bi bi-arrow-counterclockwise fs-5" style="cursor: pointer;color:green"></i></span>
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
                    <input type="hidden" name="historycard_hidden_id" id="historycard_hidden_id" value="">
                    <input type="hidden" name="historycard_hidden_status" id="historycard_hidden_status" value="">
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
    <script src="<?= PROJECT_PATH ?>/src/jquery/external/jquery/jquery.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/DataTime/jquery.datetimepicker.full.min.js"></script>
    <script src="historycard-function.js"></script>

    <?php

    if (isset($_REQUEST['msg'])) {
        if ($_REQUEST['msg'] == 1) {
            $msg = 'historycard Created successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 2) {
            $msg = 'historycard Updated successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 3) {
            $msg = 'historycard Deleted successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 4) {
            $msg = 'Please fill all required fields';
            $color = 'warning';
        } else if ($_REQUEST['msg'] == 5) {
            $msg = 'historycard Name Already Created';
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
    <script>
        function machineName() {
            $('#machine_name').autocomplete({
                source: "get-data.php?action=MachineName",
                minLength: 0,
                select: function(evt, ui) {

                    document.getElementById('machine_id').value = ui.item.id;
                },
                change: function(event, ui) {
                    if (!ui.item) {
                        $(event.target).val("");
                        $('machine_id').val("");
                    }
                }
            });
        }


        $(document).ready(function() {
            // Attach click event to the image with the 'preview-trigger' class
            $('.preview-trigger-before').on('click', function() {
                // Show the image preview dialog
                $('#image-preview-dialog-before').show();
            });

            // Close the image preview dialog when clicking outside the image
            $('#image-preview-dialog-before').on('click', function() {
                $(this).hide();
            });
        });
        $(document).ready(function() {
            // Attach click event to the image with the 'preview-trigger' class
            $('.preview-trigger-after').on('click', function() {
                // Show the image preview dialog
                $('#image-preview-dialog-after').show();
            });

            // Close the image preview dialog when clicking outside the image
            $('#image-preview-dialog-after').on('click', function() {
                $(this).hide();
            });
        });
        jQuery('#datetimepicker').datetimepicker();
    </script>
</body>

</html>