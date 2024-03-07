<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= PROJECT_TITLE ?> - breakdown</title>
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
                <div class="d-flex justify-content-between">
                    <div class="page-title">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/home/">Home</a></li>
                                <li class="breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/machine/">Machine</a></li>
                                <li class="breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/machine-details/index.php?type=<?= isset($_REQUEST['type']) ? $_REQUEST['type'] : '' ?>&m_id=<?= $machine['machine_id'] ?>"><?= $machine['machine_name'] ?></a></li>
                                <li class="breadcrumb-item active">Breakdown</li>
                            </ol>
                        </nav>
                    </div>
                    <h4>Breakdown</h4>
                </div>
                <?php if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'add') { ?>
                    <div class="col-lg-12 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><?= $machine['machine_name'] ?></h5>
                                <small class="text-muted float-end">ADD</small>
                            </div>
                            <div class="card-body">
                                <form action="index.php" method="POST" name="breakdown_form" id="breakdown_form" autocomplete="off" class="needs-validation" enctype="multipart/form-data" novalidate>
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
                                            <label class="form-label breakdown_date" for="breakdown_date">Breakdown date</label>
                                            <input name="breakdown_date" id="breakdown_date" class="form-control datepicker" required>
                                            <div class="invalid-feedback">
                                                Please enter Breakdown date.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label nature_of_prob" for="nature_of_prob">Nature of Problem</label>
                                            <input name="nature_of_prob" id="nature_of_prob" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter Nature of Problem.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label downtime_from" for="downtime_from">Downtime - From</label>
                                            <input type="datetime-local" name="downtime_from" id="downtime_from" class="form-control " required>
                                            <div class="invalid-feedback">
                                                Please enter From Downtime Date.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label downtime_to" for="downtime_to">Downtime - To</label>
                                            <input type="datetime-local" name="downtime_to" id="downtime_to" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter To Downtime Date.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label breakdown_root_cause" for="breakdown_root_cause">Root Cause</label>
                                            <input name="breakdown_root_cause" id="breakdown_root_cause" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter Root Cause.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label breakdown_action_taken" for="breakdown_action_taken">Action Taken/Planned</label>
                                            <input name="breakdown_action_taken" id="breakdown_action_taken" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter Action Taken.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label breakdown_spare" for="breakdown_spare">Spare Changed / Purchased</label>
                                            <input name="breakdown_spare" id="breakdown_spare" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter Spare Changes.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label attend_by" for="attend_by">Attended By</label>
                                            <input name="attend_by" id="attend_by" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter Spare Changes.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label bfr_breakdown_descript" for="bfr_breakdown_descript">Before Breakdown - Description</label>
                                            <input name="bfr_breakdown_descript" id="bfr_breakdown_descript" class="form-control " required>
                                            <div class="invalid-feedback">
                                                Please enter Before Breakdown Desc.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label bfr_breakdown_img" for="bfr_breakdown_img">Before Breakdown - Image</label>

                                            <input type="file" name="bfr_breakdown_img" id="bfr_breakdown_img" class="form-control" accept="image/*" required>
                                            <div class="invalid-feedback">
                                                Please Choose Before Breakdown Image.
                                            </div>
                                        </div>
                                        <div class="col-md-4"> </div>
                                        <div class="col-md-4">
                                            <label class="form-label aft_breakdown_descript" for="aft_breakdown_descript">After Breakdown - Description</label>
                                            <input name="aft_breakdown_descript" id="aft_breakdown_descript" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter After Breakdown Desc.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label aft_breakdown_img" for="aft_breakdown_img">After Breakdown - Image</label>

                                            <input type="file" name="aft_breakdown_img" id="aft_breakdown_img" class="form-control" accept="image/*" required>
                                            <div class="invalid-feedback">
                                                Please choose After Breakdown Image.
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mt-5 d-flex justify-content-center gap-3">
                                        <input type="hidden" name="breakdown_page" id="breakdown_page" value="add">
                                        <input type="hidden" name="breakdown_status" id="breakdown_status" value="">
                                        <input name="add_breakdown" type="submit" class="btn btn-primary" id="add_breakdown" value="Save" title="Save" />
                                        <input type="reset" value="Reset" class="btn btn-outline-secondary" title="Reset" />
                                        <input type="button" value="Back" class="btn btn-secondary" onclick="location.href='<?= PROJECT_PATH ?>src/html/machine-details/index.php?type= <?= isset($_REQUEST['type']) ? $_REQUEST['type'] : '' ?>&m_id=<?= $machine['machine_id'] ?>'" title="Back">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } else if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'edit') { ?>

                    <div class="col-lg-12 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><?= $edit_breakdown['machine_name'] ?></h5>
                                <small class="text-muted float-end">EDIT</small>
                            </div>

                            <div class="card-body">
                                <form action="index.php" method="POST" name="breakdown_form" id="breakdown_form" autocomplete="off" class="needs-validation" enctype="multipart/form-data" novalidate>
                                    <div class="row">
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                                            <div class="col-md-3">
                                                <label class="form-label company_id" for="company_id">Company</label>
                                                <select name="company_id" id="company_id" class="form-select" required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($listCompany as $data) { ?>
                                                        <option value="<?= $data['company_id']; ?>" <?= ($data['company_id'] == $edit_breakdown['breakdown_company_id']) ? 'selected' : '' ?>><?= $data['company_code'] . ' - ' . $data['company_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a company.
                                                </div>
                                            </div>
                                        <?php    } ?>

                                        <div class="col-md-4">
                                            <label class="form-label machine_name" for="machine_name">Machine Name</label>
                                            <input name="machine_name" id="machine_name" class="form-control" value="<?= $edit_breakdown['machine_name'] ?>" required readonly>
                                            <input type="hidden" name="machine_id" id="machine_id" class="form-control" value="<?= $edit_breakdown['year_breakdown_machine_id'] ?>" required>

                                            <div class="invalid-feedback">
                                                Please enter Machine Name.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label breakdown_date" for="breakdown_date">Breakdown date</label>
                                            <input name="breakdown_date" id="breakdown_date" class="form-control datepicker" value="<?= dateGeneralFormat($edit_breakdown['year_breakdown_date']) ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter Breakdown date.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label nature_of_prob" for="nature_of_prob">Nature of Problem</label>
                                            <input name="nature_of_prob" id="nature_of_prob" class="form-control" value="<?= $edit_breakdown['year_breakdown_problem'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter Nature of Problem.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label downtime_from" for="downtime_from">Downtime - From</label>
                                            <input type="datetime-local" name="downtime_from" id="downtime_from" class="form-control " value="<?= date('Y-m-d', strtotime($edit_breakdown['year_breakdown_downtime_from'])) . 'T' . date('H:i', strtotime($edit_breakdown['year_breakdown_downtime_from'])) ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter From Downtime Date.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label downtime_to" for="downtime_to">Downtime - To</label>
                                            <input type="datetime-local" name="downtime_to" id="downtime_to" class="form-control" value="<?= date('Y-m-d', strtotime($edit_breakdown['year_breakdown_downtime_to'])) . 'T' . date('H:i', strtotime($edit_breakdown['year_breakdown_downtime_to'])) ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter To Downtime Date.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label breakdown_root_cause" for="breakdown_root_cause">Root Cause</label>
                                            <input name="breakdown_root_cause" id="breakdown_root_cause" class="form-control" value="<?= $edit_breakdown['year_breakdown_root_case'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter Root Cause.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label breakdown_action_taken" for="breakdown_action_taken">Action Taken/Planned</label>
                                            <input name="breakdown_action_taken" id="breakdown_action_taken" class="form-control" value="<?= $edit_breakdown['year_breakdown_planned'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter Action Taken.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label breakdown_spare" for="breakdown_spare">Spare Changed / Purchased</label>
                                            <input name="breakdown_spare" id="breakdown_spare" class="form-control" value="<?= $edit_breakdown['year_breakdown_purchase'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter Spare Changes.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label attend_by" for="attend_by">Attended By</label>
                                            <input name="attend_by" id="attend_by" class="form-control" value="<?= $edit_breakdown['year_breakdown_attended_by'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter Spare Changes.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label bfr_breakdown_descript" for="bfr_breakdown_descript">Before - Description</label>
                                            <textarea name="bfr_breakdown_descript" id="bfr_breakdown_descript" class="form-control " cols="30" rows="2" required><?= $edit_breakdown['year_breakdown_before_text'] ?></textarea>
                                            <div class="invalid-feedback">
                                                Please enter Before Desc.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label bfr_breakdown_img" for="bfr_breakdown_img">Before - Image</label>
                                            <?php $required = empty($edit_breakdown['year_breakdown_before_image']) ? 'required' : '' ?>

                                            <input type="file" name="bfr_breakdown_img" id="bfr_breakdown_img" class="form-control" value="<?= $edit_breakdown['year_breakdown_before_image'] ?>" $required>
                                            <div class="invalid-feedback">
                                                Please Choose Before Image.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <?php $required = empty($edit_breakdown['year_breakdown_before_image']) ? 'required' : '' ?>

                                            <label class="form-label aft_breakdown_img" for="aft_breakdown_img">Before - Image Preview</label><br>
                                            <div id="image-preview-dialog-before" style="display: none;">
                                                <img class="preview_image" src="<?= $edit_breakdown['year_breakdown_before_image'] ?>" alt="Image Preview">
                                            </div>
                                            <img class="preview-trigger-before" style="width: 100px;" src="<?= $edit_breakdown['year_breakdown_before_image'] ?>" alt="Image Preview">

                                            <input type="hidden" name="before_image" id="before_image" class="textbox" value="<?= $edit_breakdown['year_breakdown_before_image'] ?> " />
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label aft_breakdown_descript" for="aft_breakdown_descript">After - Description</label>
                                            <textarea name="aft_breakdown_descript" id="aft_breakdown_descript" class="form-control" cols="30" rows="2" required><?= $edit_breakdown['year_breakdown_after_text'] ?></textarea>
                                            <div class="invalid-feedback">
                                                Please enter After Desc.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <?php $required = empty($edit_breakdown['year_breakdown_after_image']) ? 'required' : '' ?>
                                            <label class="form-label aft_breakdown_img" for="aft_breakdown_img">After - Image</label>
                                            <input type="file" name="aft_breakdown_img" id="aft_breakdown_img" class="form-control" value="<?= $edit_breakdown['year_breakdown_after_image'] ?>" $required>
                                            <div class="invalid-feedback">
                                                Please choose After Image.
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <?php $required = empty($edit_breakdown['year_breakdown_after_image']) ? 'required' : '' ?>

                                            <label class="form-label aft_breakdown_img" for="aft_breakdown_img">After - Image Preview</label><br>
                                            <div id="image-preview-dialog-after" style="display: none;">
                                                <img class="preview_image" src="<?= $edit_breakdown['year_breakdown_after_image'] ?>" alt="Image Preview">
                                            </div>
                                            <img class="preview-trigger-after" style="width: 100px;" src="<?= $edit_breakdown['year_breakdown_after_image'] ?>" alt="Image Preview">

                                            <input type="hidden" name="after_image" id="after_image" class="textbox" value="<?= $edit_breakdown['year_breakdown_after_image'] ?> " />
                                        </div>

                                        <div class="mt-5 d-flex justify-content-center gap-3">
                                            <input type="hidden" name="year_breakdown_id" id="year_breakdown_id" value="<?= $edit_breakdown['year_breakdown_id'] ?>">
                                            <?php if ($edit_breakdown['year_breakdown_deleted_status'] != 1) { ?>
                                                <input name="update_breakdown" type="submit" class="btn btn-primary" id="update_breakdown" value="Save" title="Save" />
                                                <input type="reset" value="Reset" class="btn btn-outline-secondary" title="Reset" />
                                            <?php } ?>
                                            <input type="hidden" name="breakdown_page" id="breakdown_page" value="edit">
                                            <input type="hidden" name="breakdown_status" id="breakdown_status" value="<?= $edit_breakdown['year_breakdown_deleted_status'] ?>">
                                            <!-- <input type="button" value="Back" class="btn btn-secondary" onclick="location.href='index.php'" title="Back"> -->
                                            <input type="button" value="Back" class="btn btn-secondary" onclick="location.href='index.php?type= <?= isset($_REQUEST['type']) ? $_REQUEST['type'] : '' ?>&m_id=<?= $machine['machine_id'] ?>'" title="Back">
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php } else {  ?>

                    <?php
                    $breakdown_name = isset($_REQUEST['search_breakdown_name']) ? $_REQUEST['search_breakdown_name'] : '';
                    $search_status = isset($_REQUEST['breakdown_search_status']) ? $_REQUEST['breakdown_search_status'] : '';
                    $company_id = isset($_REQUEST['search_company_id']) ? $_REQUEST['search_company_id'] : '';
                    require "../../includes/filter.php";
                    ?>


                    <div class="card p-2">
                        <div class="d-flex justify-content-between">
                            <!-- <button class="btn btn-primary mx-2 my-2" onclick="location.href='index.php?page=add'">Add</button> -->
                            <button class="btn btn-danger mx-2 my-2" title="PDF" onclick="location.href='pdf.php?from_date=<?= $from_date ?>&to_date=<?= $to_date ?>'"><i class="bi bi-file-pdf"></i>PDF</button>
                            <button class="btn btn-dark mx-2 my-2" title="Filter" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="bi bi-filter-left"></i>Filter</button>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <form action="index.php" method="POST" name="breakdown_form" id="breakdown_form" autocomplete="off">
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
                                                <!-- <th>Delete</th> -->
                                            <?php } else { ?>
                                                <th>View</th>
                                                <th>Undo </th>
                                            <?php  } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sno = 1;
                                        if ($list_breakdown) {
                                            foreach ($list_breakdown as $value) {
                                        ?>
                                                <tr>
                                                    <td><?= $sno++; ?></td>
                                                    <td><?= dateGeneralFormat($value['year_breakdown_date']); ?></td>
                                                    <td><?= ucfirst($value['year_breakdown_problem']); ?></td>
                                                    <?php if ($search_status != 1) { ?>
                                                        <td>
                                                            <i class="bi bi-pencil-square" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&year_breakdown_id=<?= $value['year_breakdown_id']; ?>'"></i>
                                                        </td>
                                                        <!-- <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['year_breakdown_id']; ?>,'delete');"><i class="bi bi-trash" style="cursor: pointer;color:red"></i></span>
                                                        </td> -->
                                                    <?php } else { ?>
                                                        <td>
                                                            <i class="bi bi-eye fs-5" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&year_breakdown_id=<?= $value['year_breakdown_id']; ?>'"></i>
                                                        </td>
                                                        <!-- <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['year_breakdown_id']; ?>,'undo');"><i class="bi bi-arrow-counterclockwise fs-5" style="cursor: pointer;color:green"></i></span>
                                                        </td> -->
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
                    <input type="hidden" name="breakdown_hidden_id" id="breakdown_hidden_id" value="">
                    <input type="hidden" name="breakdown_hidden_status" id="breakdown_hidden_status" value="">
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
    <script src="breakdown-function.js"></script>
    <script src="../../assets/js/from-to-date.js"></script>

    <?php

    if (isset($_REQUEST['msg'])) {
        if ($_REQUEST['msg'] == 1) {
            $msg = 'breakdown Created successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 2) {
            $msg = 'breakdown Updated successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 3) {
            $msg = 'breakdown Deleted successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 4) {
            $msg = 'Please fill all required fields';
            $color = 'warning';
        } else if ($_REQUEST['msg'] == 5) {
            $msg = 'breakdown Name Already Created';
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