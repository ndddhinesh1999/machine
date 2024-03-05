<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= PROJECT_TITLE ?> - machine</title>
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
                                <li class="breadcrumb-item active">Machine</li>
                            </ol>
                        </nav>
                    </div>
                    <h3>Machine</h3>
                </div>
                <?php if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'add') { ?>
                    <div class="col-lg-12 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Machine Details</h5>
                                <small class="text-muted float-end">Add Machine</small>
                            </div>
                            <div class="card-body">
                                <form action="index.php" method="POST" name="machine_form" id="machine_form" autocomplete="off" class="needs-validation" enctype="multipart/form-data" novalidate>
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
                                            <label class="form-label machine_name" for="machine_name">Machine Type</label>
                                            <?php if (isset($_REQUEST['type']) && !empty($_REQUEST['type'])) { ?>

                                                <input type="text" name="machine_type_name" id="machine_type_name" class="form-control" required value=" <?= $machine_type_detail['category_name'] ?>" readonly>
                                                <input type="hidden" name="machine_type" id="machine_type" class="form-control" required value=" <?= $machine_type_detail['category_id'] ?>" readonly>
                                            <?php      } else { ?>
                                                <select name="machine_type" id="machine_type" class="form-select" required aria-readonly="readonly">
                                                    <option value="">SELECT</option>
                                                    <?php foreach ($category as $get_data) { ?>
                                                        <option value="<?= $get_data['category_id'] ?>" <?= (isset($_REQUEST['type']) && $_REQUEST['type'] == $get_data['category_id']) ? 'selected' : '' ?>><?= $get_data['category_name'] ?></option>
                                                    <?php   } ?>
                                                </select>
                                            <?php }  ?>

                                            <div class="invalid-feedback">
                                                Please enter machine type.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_name" for="machine_name">Machine Name</label>
                                            <input name="machine_name" id="machine_name" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter machine name.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label machine_name" for="machine_name">Machine Name</label>
                                            <input name="machine_name" id="machine_name" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter machine name.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label macine_model" for="macine_model">Machine Model</label>
                                            <input name="macine_model" id="macine_model" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter machine model.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_system" for="machine_system">Machine System</label>
                                            <input name="machine_system" id="machine_system" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter machine system.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_sno" for="machine_sno">Machine Serial Number</label>
                                            <input name="machine_sno" id="machine_sno" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter machine sno.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_number" for="machine_number">Machine Number</label>
                                            <input name="machine_number" id="machine_number" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter machine number.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_manufac_year" for="machine_manufac_year">Year Of Manufacture (month,year)</label>
                                            <input type="month" name="machine_manufac_year" id="machine_manufac_year" class="form-control" required>

                                            <!-- <select name="machine_manufac_year" id="machine_manufac_year" class="form-control" required>
                                                <?php
                                                // Assuming you want a range of years, for example, from 2020 to 2030
                                                $startYear = date('Y') - 72;
                                                $endYear = date('Y');

                                                for ($year = $endYear; $year >= $startYear; $year--) {
                                                    echo "<option value=\"$year\">$year</option>";
                                                }
                                                ?>
                                            </select> -->

                                            <div class="invalid-feedback">
                                                Please enter manufacture year.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_location" for="machine_location">Location</label>
                                            <input name="machine_location" id="machine_location" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter location.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_prev_maintanance" for="machine_prev_maintanance">Previouslt Maintanance Done</label>
                                            <input name="machine_prev_maintanance" id="machine_prev_maintanance" class="form-control datepicker" datepicker required>
                                            <div class="invalid-feedback">
                                                Please enter prev maintanance.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_planned_maintanance" for="machine_planned_maintanance">Planned Maintanance</label>
                                            <input name="machine_planned_maintanance" id="machine_planned_maintanance" class="form-control datepicker" required>
                                            <div class="invalid-feedback">
                                                Please enter planned maintanance.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_x_axis" for="machine_x_axis">X-axis</label>
                                            <input name="machine_x_axis" id="machine_x_axis" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter x-axis.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_y_axis" for="machine_y_axis">Y-axis</label>
                                            <input name="machine_y_axis" id="machine_y_axis" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter y-axis.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_z_axis" for="machine_z_axis">Z-axis</label>
                                            <input name="machine_z_axis" id="machine_z_axis" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter z-axis.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_tools_storage_capacity" for="machine_tools_storage_capacity">Tool Storage Capacity</label>
                                            <input name="machine_tools_storage_capacity" id="machine_tools_storage_capacity" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter tool storage capacity.
                                            </div>
                                        </div>

                                        <div class="col-md-6" style="margin-bottom:25px ">
                                            <label class="form-label machine_img" for="machine_img">Machine Image</label>
                                            <input type="file" name="machine_img" id="machine_img" class="form-control" onchange="readURL(this);" accept="image/png, image/jpeg" required>
                                        </div>
                                        <div class="col-md-4" style="margin-bottom:25px ">
                                            <img style="max-width: 100px; max-height:100px; object-fit: contain;" id="blah" src="" alt="" />

                                        </div>
                                    </div>
                                    <div class="mt-5 d-flex justify-content-center gap-3">
                                        <input type="hidden" name="machine_page" id="machine_page" value="add">
                                        <input type="hidden" name="machine_status" id="machine_status" value="">
                                        <input name="add_machine" type="submit" class="btn btn-primary" id="add_machine" value="Save" title="Save" />
                                        <input type="reset" value="Reset" class="btn btn-outline-secondary" title="Reset" />
                                        <input type="button" value="Back" class="btn btn-secondary" onclick="location.href='index.php?type=<?= isset($_REQUEST['type']) ? $_REQUEST['type'] : '' ?>'" title="Back">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } else if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'edit') { ?>

                    <div class="col-lg-12 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">machine Details</h5>
                                <small class="text-muted float-end">Edit machine</small>
                            </div>
                            <div class="card-body">
                                <form action="index.php" method="POST" name="machine_form" id="machine_form" autocomplete="off" class="needs-validation" enctype="multipart/form-data" novalidate>
                                    <div class="row">
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                                            <div class="col-md-3">
                                                <label class="form-label company_id" for="company_id">Company</label>
                                                <select name="company_id" id="company_id" class="form-select" required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($listCompany as $data) { ?>
                                                        <option value="<?= $data['company_id']; ?>" <?= ($data['company_id'] == $edit_machine['machine_company_id']) ? 'selected' : '' ?>><?= $data['company_code'] . ' - ' . $data['company_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a company.
                                                </div>
                                            </div>

                                        <?php    } ?>
                                        <div class="col-md-4">
                                            <label class="form-label machine_name" for="machine_name">Machine Type</label>
                                            <select name="machine_type" id="machine_tpe" class="form-select" required>
                                                <option value="">SELECT</option>
                                                <?php foreach ($category as $get_data) { ?>
                                                    <option value="<?= $get_data['category_id'] ?>" <?= ($edit_machine['machine_type'] == $get_data['category_id']) ? 'selected' : '' ?>><?= $get_data['category_name'] ?></option>
                                                <?php   } ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please enter machine type.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_name" for="machine_name">Machine Name</label>
                                            <input name="machine_name" id="machine_name" class="form-control" value="<?= $edit_machine['machine_name'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter machine name.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label macine_model" for="macine_model">Machine Model</label>
                                            <input name="macine_model" id="macine_model" class="form-control" value="<?= $edit_machine['machine_model'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter machine model.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_system" for="machine_system">Machine System</label>
                                            <input name="machine_system" id="machine_system" class="form-control" value="<?= $edit_machine['machine_system'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter machine system.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_sno" for="machine_sno">Machine Serial Number</label>
                                            <input name="machine_sno" id="machine_sno" class="form-control" value="<?= $edit_machine['machine_serial_number'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter machine sno.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_number" for="machine_number">Machine Number</label>
                                            <input name="machine_number" id="machine_number" class="form-control" value="<?= $edit_machine['machine_number'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter machine number.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_manufac_year" for="machine_manufac_year">Year Of Manufacture</label>
                                            <!-- <input name="machine_manufac_year" id="machine_manufac_year" class="form-control" value="<?= $edit_machine['machine_year_of_manufacture'] ?>" required> -->

                                            <select name="machine_manufac_year" id="machine_manufac_year" class="form-control" value="<?= $edit_machine['machine_year_of_manufacture'] ?>" required>
                                                <?php
                                                // Assuming you want a range of years, for example, from 2020 to 2030
                                                $startYear = date('Y') - 72;
                                                $endYear = date('Y');

                                                for ($year = $endYear; $year >= $startYear; $year--) {
                                                    echo "<option value=\"$year\">$year</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please enter manufacture year.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_location" for="machine_location">Location</label>
                                            <input name="machine_location" id="machine_location" class="form-control" value="<?= $edit_machine['machine_location'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter location.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_prev_maintanance" for="machine_prev_maintanance">Previouslt Maintanance Done</label>
                                            <input name="machine_prev_maintanance" type="text" id="machine_prev_maintanance" class="form-control datepicker" value="<?= $edit_machine['machine_previously_maintanance'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter prev maintanance.
                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <label class="form-label machine_planned_maintanance" for="machine_planned_maintanance">Planned Maintanance</label>
                                            <input name="machine_planned_maintanance" id="machine_planned_maintanance" class="form-control datepicker" value="<?= $edit_machine['machine_planned_maintanance'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter planned maintanance.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_x_axis" for="machine_x_axis">X-axis</label>
                                            <input name="machine_x_axis" id="machine_x_axis" class="form-control" value="<?= $edit_machine['machine_x_axis'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter x-axis.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_y_axis" for="machine_y_axis">Y-axis</label>
                                            <input name="machine_y_axis" id="machine_y_axis" class="form-control" value="<?= $edit_machine['machine_y_axis'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter y-axis.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_z_axis" for="machine_z_axis">Z-axis</label>
                                            <input name="machine_z_axis" id="machine_z_axis" class="form-control" value="<?= $edit_machine['machine_z_axis'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter z-axis.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label machine_tools_storage_capacity" for="machine_tools_storage_capacity">Tool Storage Capacity</label>
                                            <input name="machine_tools_storage_capacity" id="machine_tools_storage_capacity" class="form-control" value="<?= $edit_machine['machine_total_storage_capacity'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter storage capacity.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="machine_active_status">Status</label>
                                            <select name="machine_active_status" id="machine_active_status" class="form-control">
                                                <option value="active" <?php if ($edit_machine['machine_active_status'] == 'active') { ?>selected <?php } ?>>Active</option>
                                                <option value="inactive" <?php if ($edit_machine['machine_active_status'] == 'inactive') { ?>selected <?php } ?>>In Active</option>
                                            </select>
                                        </div>

                                        <div class="col-md-5" style="margin-top:25px ">
                                            <label class="form-label machine_img" for="machine_img">Machine Image</label>
                                            <input type="file" name="machine_img" id="machine_img" class="form-control">
                                        </div>

                                        <?php if ($edit_machine['machine_image'] != '') { ?>
                                            <div class="col-md-5">
                                                <!-- image_preview -->
                                                <!-- <label>Image Preview</label><br> --><br>
                                                <img class="preview-trigger" style="width: 100px;" src="<?= PROJECT_PATH . 'src/' . $edit_machine['machine_image'] ?>" alt="Image Preview">

                                                <div id="image-preview-dialog" style="display: none;">
                                                    <img class="preview_image" src="<?= PROJECT_PATH . 'src/' . $edit_machine['machine_image'] ?>" alt="Image Preview">
                                                </div>

                                                <input name="file_name" type="hidden" value="../uploads/monthly_calender/<?= $edit_machine['machine_image'] ?>">
                                                <input type="hidden" name="machine_image" id="machine_image" class="textbox" value="<?= $edit_machine['machine_image'] ?> " />
                                            </div>
                                        <?php } ?>


                                    </div>


                                    <br>

                                    <div class="mt-5 d-flex justify-content-center gap-3">
                                        <input type="hidden" name="machine_id" id="machine_id" value="<?= $edit_machine['machine_id'] ?>">
                                        <?php if ($edit_machine['machine_deleted_status'] != 1) { ?>
                                            <input name="update_machine" type="submit" class="btn btn-primary" id="update_machine" value="Save" title="Save" />
                                            <input type="reset" value="Reset" class="btn btn-outline-secondary" title="Reset" />
                                        <?php } ?>
                                        <input type="hidden" name="machine_page" id="machine_page" value="edit">
                                        <input type="hidden" name="machine_status" id="machine_status" value="<?= $edit_machine['machine_deleted_status'] ?>">
                                        <input type="button" value="Back" class="btn btn-secondary" onclick="location.href='index.php'" title="Back">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php } else {  ?>

                    <?php
                    $machine_name = isset($_REQUEST['search_machine_name']) ? $_REQUEST['search_machine_name'] : '';
                    $search_status = isset($_REQUEST['machine_search_status']) ? $_REQUEST['machine_search_status'] : '';
                    $company_id = isset($_REQUEST['search_company_id']) ? $_REQUEST['search_company_id'] : '';

                    ?>


                    <div class="col-xl">
                        <div class="card mb-4">
                            <form action="index.php" method="POST" name="machine_form" id="machine_form" autocomplete="off">
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
                                            <label class="form-label" for="search_machine_name">Machine Name </label>
                                            <input type="text" name="search_machine_name" id="search_machine_name" class="form-control" value="<?= $machine_name ?>" />
                                        </div>
                                        <div class="flex-column col-md-3">
                                            <label class="form-label" for="machine_search_status">Status</label>
                                            <select name="machine_search_status" id="machine_search_status" class="form-select">
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
                            <button class="btn btn-danger mx-2 my-2" title="PDF" onclick="location.href='pdf.php?'"><i class="bi bi-file-pdf"></i>PDF</button>
                            <button class="btn btn-primary mx-2 my-2" onclick="location.href='index.php?page=add&type=<?= isset($_REQUEST['type']) ? $_REQUEST['type'] : '' ?>'">Add</button>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <form action="index.php" method="POST" name="machine_form" id="machine_form" autocomplete="off">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <caption class="ms-4">
                                        List of Information
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th>S No.</th>
                                            <th>Machine Name</th>
                                            <th>Status</th>
                                            <th>Entry</th>
                                            <?php if ($search_status != 1) { ?>
                                                <!-- <th>Edit</th> -->
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
                                        if ($list_machine) {
                                            foreach ($list_machine as $value) {
                                        ?>
                                                <tr>
                                                    <td><?= $sno++; ?></td>
                                                    <td><?= ucfirst($value['machine_name']); ?></td>
                                                    <td><?= $value['machine_active_status'] ?></td>
                                                    <td><i class="bi bi-plus-circle-fill fs-6" style="cursor: pointer;color:blue;" onclick="location.href='../machine-details/index.php?type=<?= isset($_REQUEST['type']) ? $_REQUEST['type'] : '' ?>&id=<?= $value['machine_id'] ?>'"></i></td>
                                                    <?php if ($search_status != 1) { ?>
                                                        <!-- <td>
                                                            <i class="bi bi-pencil-square fs-6" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&machine_id=<?= $value['machine_id']; ?>'"></i>
                                                        </td> -->
                                                        <!-- <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['machine_id']; ?>,'delete');"><i class="bi bi-trash fs-6" style="cursor: pointer;color:red"></i></span>
                                                        </td> -->
                                                    <?php } else { ?>
                                                        <td>
                                                            <i class="bi bi-eye fs-6" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&machine_id=<?= $value['machine_id']; ?>'"></i>
                                                        </td>
                                                        <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['machine_id']; ?>,'undo');"><i class="bi bi-arrow-counterclockwise fs-6" style="cursor: pointer;color:green"></i></span>
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
    <?php
    // print_r($_REQUEST);exit;
    if (empty($_REQUEST['type'])) { ?>
        <!-- Machine modal -->
        <div class="modal fade" data-bs-keyboard="false" data-bs-backdrop="static" id="exampleModalMachine" tabindex="-1" aria-labelledby="exampleModalMachineLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="index.php" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalMachineLabel">Machine</h5>
                        </div>
                        <div class="modal-body">
                            <label for="color">Machine Type:</label>

                            <select name="type" id="type" class="form-select" required>
                                <option value="">SELECT</option>
                                <?php foreach ($category as $list) {  ?>
                                    <option value="<?= $list['category_id'] ?>"> <?= $list['category_name'] ?></option>
                                <?php }  ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="javascript:window.location.href='<?= PROJECT_PATH . 'src/html/home/' ?>';">Close</button>
                            <button type="summit" class="btn btn-primary" name="type_submit" id="type_submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php  } ?>
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
                    <input type="hidden" name="machine_hidden_id" id="machine_hidden_id" value="">
                    <input type="hidden" name="machine_hidden_status" id="machine_hidden_status" value="">
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
    <script src="machine-function.js"></script>

    <script>
        $(document).ready(function() {
            // Attach click event to the image with the 'preview-trigger' class
            $('.preview-trigger').on('click', function() {
                // Show the image preview dialog
                $('#image-preview-dialog').show();
            });

            // Close the image preview dialog when clicking outside the image
            $('#image-preview-dialog').on('click', function() {
                $(this).hide();
            });
        });
    </script>
    <?php

    if (isset($_REQUEST['msg'])) {
        if ($_REQUEST['msg'] == 1) {
            $msg = 'machine Created successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 2) {
            $msg = 'machine Updated successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 3) {
            $msg = 'machine Deleted successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 4) {
            $msg = 'Please fill all required fields';
            $color = 'warning';
        } else if ($_REQUEST['msg'] == 5) {
            $msg = 'machine Name Already Created';
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

            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    <?php } ?>

</body>

</html>