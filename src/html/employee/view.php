<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= PROJECT_TITLE ?> - Employee</title>
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
                <div class="page-title">
                    <h1>Employee</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/home/">Home</a></li>
                            <li class="breadcrumb-item active">Employee</li>
                        </ol>
                    </nav>
                </div>

                <?php if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'add') { ?>
                    <div class="col-lg-12 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Basic Employee Details</h5>
                                <small class="text-muted float-end">Add Employee</small>
                            </div>
                            <div class="card-body">

                                <form action="index.php" method="POST" name="employee_form" id="employee_form" autocomplete="off" class="needs-validation" novalidate>
                                    <div class="row row-gap-3">
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                                            <div class="col-md-4">
                                                <label class="form-label" for="employee_company_id"><span class="text-danger">*</span> Company</label>
                                                <select name="employee_company_id" id="employee_company_id" class="form-select" required onchange="get_branch();">
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($listCompany as $data) { ?>
                                                        <option value="<?= $data['company_id']; ?>"><?= $data['company_code'] . ' - ' . $data['company_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a company.
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin' || $_SESSION[SESS . 'session_admin_users_level'] == 'company') { ?>
                                            <div class="col-md-4">
                                                <label class="form-label" for="employee_branch_id"><span class="text-danger">*</span> Branch</label>
                                                <select name="employee_branch_id" id="employee_branch_id" class="form-select" required>
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
                                        <?php } ?>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_name"><span class="text-danger">*</span> Name</label>
                                            <input type="text" name="employee_name" id="employee_name" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter employee name.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_date_of_birth"><span class="text-danger">*</span> Date Of Birth</label>
                                            <input type="text" name="employee_date_of_birth" id="employee_date_of_birth" class="form-control datepicker" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_gender"><span class="text-danger">*</span> Gender</label>
                                            <select name="employee_gender" id="employee_gender" class="form-select" required>
                                                <option value="">-Select-</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_designation_id">Designation</label>
                                            <select name="employee_designation_id" id="employee_designation_id" class="form-select">
                                                <option value="">-Select-</option>
                                                <?php foreach ($listDesignation as $list) { ?>
                                                    <option value="<?= $list['designation_id']; ?>"><?= $list['designation_name']; ?></option>
                                                <?php    } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_department_id">Department</label>
                                            <select name="employee_department_id" id="employee_department_id" class="form-select">
                                                <option value="">-Select-</option>
                                                <?php foreach ($listDepartment as $get_data) { ?>
                                                    <option value="<?= $get_data['department_id']; ?>"><?= $get_data['department_name']; ?></option>
                                                <?php    } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_contact_no"><span class="text-danger">*</span> Contact No</label>
                                            <input type="text" name="employee_contact_no" id="employee_contact_no" class="form-control" maxlength="10" value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required onblur="checkmobilelength(0);">
                                            <div class="invalid-feedback user_number">
                                                Please enter 10 digits mobile no
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_email">Email</label>
                                            <input type="email" name="employee_email" id="employee_email" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_date_of_join"><span class="text-danger">*</span> Date Of Join</label>
                                            <input type="text" name="employee_date_of_join" id="employee_date_of_join" class="form-control datepicker" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_address">Address</label>
                                            <textarea name="employee_address" id="employee_address" class="form-control" style="height: 30px;"></textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_register_status">Register Status</label>
                                            <select name="employee_register_status" id="employee_register_status" class="form-select">
                                                <option value="">-Select-</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_scan_status">Scan Status</label>
                                            <select name="employee_scan_status" id="employee_scan_status" class="form-select">
                                                <option value="">-Select-</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_lock_status">Lock Status / Days</label>
                                            <select name="employee_lock_status" id="employee_lock_status" class="form-select" onchange="show_lock_days();">
                                                <option value="">-Select-</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 lock_days" style="display: none;">
                                            <label class="form-label" for="employee_lock_days">Lock Days</label>
                                            <input type="text" name="employee_lock_days" id="employee_lock_days" class="form-control" value="" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        </div>
                                    </div>
                                    <div class="mt-5 d-flex justify-content-center gap-3">
                                        <input type="hidden" name="employee_page" id="employee_page" value="add">
                                        <input type="hidden" name="employee_status" id="employee_status" value="">
                                        <input name="add_employee" type="submit" class="btn btn-primary" id="add_employee" value="Save" title="Save" />
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
                                <h5 class="mb-0">Basic Employee Details</h5>
                                <small class="text-muted float-end">Edit Employee</small>
                            </div>
                            <div class="card-body">

                                <form action="index.php" method="POST" name="employee_form" id="employee_form" autocomplete="off" class="needs-validation" novalidate>
                                    <div>
                                        <input type="hidden" name="company_id" id="company_id" value="<?= $edit_employee['employee_company_id'] ?>">
                                        <input type="hidden" name="user_level" id="user_level" value="<?= $_SESSION[SESS . 'session_admin_users_level'] ?>">
                                    </div>
                                    <div class="row row-gap-3">
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                                            <div class="col-md-4">
                                                <label class="form-label" for="employee_company_id"><span class="text-danger">*</span> Company</label>
                                                <select name="employee_company_id" id="employee_company_id" class="form-select" required onchange="get_branch();check_employee()">
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($listCompany as $data) { ?>
                                                        <option value="<?= $data['company_id']; ?>" <?= ($data['company_id'] == $edit_employee['employee_company_id']) ? 'selected' : ''; ?>><?= $data['company_code'] . ' - ' . $data['company_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a company.
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin' || $_SESSION[SESS . 'session_admin_users_level'] == 'company') { ?>
                                            <div class="col-md-4">
                                                <label class="form-label" for="employee_branch_id"><span class="text-danger">*</span> Branch</label>
                                                <select name="employee_branch_id" id="employee_branch_id" class="form-select" required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($listBranch as $get) { ?>
                                                        <option value="<?= $get['branch_id']; ?>" <?= ($get['branch_id'] == $edit_employee['employee_branch_id']) ? 'selected' : ''; ?>><?= $get['branch_code'] . ' - ' . $get['branch_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a branch.
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_code">Code</label>
                                            <input type="text" name="employee_code" id="employee_code" class="form-control" value="<?= $edit_employee['employee_code']; ?>" readonly>
                                            <div class="invalid-feedback error_messge">
                                                Please enter code.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_name"><span class="text-danger">*</span> Name</label>
                                            <input type="text" name="employee_name" id="employee_name" value="<?= $edit_employee['employee_name']; ?>" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please enter employee name.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_date_of_birth"><span class="text-danger">*</span> Date Of Birth</label>
                                            <input type="text" name="employee_date_of_birth" id="employee_date_of_birth" value="<?= $edit_employee['employee_date_of_birth']; ?>" class="form-control datepicker" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_gender">Gender</label>
                                            <select name="employee_gender" id="employee_gender" class="form-select">
                                                <option value="">-Select-</option>
                                                <option value="male" <?= ($edit_employee['employee_gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                                                <option value="female" <?= ($edit_employee['employee_gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_designation_id">Designation</label>
                                            <select name="employee_designation_id" id="employee_designation_id" class="form-select">
                                                <option value="">-Select-</option>
                                                <?php foreach ($listDesignation as $list) { ?>
                                                    <option value="<?= $list['designation_id']; ?>" <?= ($list['designation_id'] == $edit_employee['employee_designation_id']) ? 'selected' : ''; ?>><?= $list['designation_name']; ?></option>
                                                <?php    } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_department_id">Department</label>
                                            <select name="employee_department_id" id="employee_department_id" class="form-select">
                                                <option value="">-Select-</option>
                                                <?php foreach ($listDepartment as $get_data) { ?>
                                                    <option value="<?= $get_data['department_id']; ?>" <?= ($get_data['department_id'] == $edit_employee['employee_department_id']) ? 'selected' : ''; ?>><?= $get_data['department_name']; ?></option>
                                                <?php    } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_contact_no"><span class="text-danger">*</span> Contact No</label>
                                            <input type="text" name="employee_contact_no" id="employee_contact_no" class="form-control" maxlength="10" value="<?= $edit_employee['employee_contact_no']; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onblur="checkmobilelength(<?= $edit_employee['employee_id']; ?>);">
                                            <div class="invalid-feedback user_number">
                                                Please enter 10 digits mobile no
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_email">Email</label>
                                            <input type="email" name="employee_email" id="employee_email" class="form-control" value="<?= $edit_employee['employee_email']; ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_date_of_join">Date Of Join</label>
                                            <input type="text" name="employee_date_of_join" id="employee_date_of_join" value="<?= $edit_employee['employee_date_of_join']; ?>" class="form-control datepicker" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_address">Address</label>
                                            <textarea name="employee_address" id="employee_address" class="form-control" style="height: 30px;"><?= $edit_employee['employee_address']; ?></textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_register_status">Register Status</label>
                                            <select name="employee_register_status" id="employee_register_status" class="form-select">
                                                <option value="">-Select-</option>
                                                <option value="1" <?= ($edit_employee['employee_register_status'] == '1') ? 'selected' : ''; ?>>Yes</option>
                                                <option value="0" <?= ($edit_employee['employee_register_status'] == '0') ? 'selected' : ''; ?>>No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_scan_status">Scan Status</label>
                                            <select name="employee_scan_status" id="employee_scan_status" class="form-select">
                                                <option value="">-Select-</option>
                                                <option value="1" <?= ($edit_employee['employee_scan_status'] == '1') ? 'selected' : ''; ?>>Yes</option>
                                                <option value="0" <?= ($edit_employee['employee_scan_status'] == '0') ? 'selected' : ''; ?>>No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_lock_status">Lock Status / Days</label>
                                            <select name="employee_lock_status" id="employee_lock_status" class="form-select" onchange="show_lock_days();">
                                                <option value="">-Select-</option>
                                                <option value="1" <?= ($edit_employee['employee_lock_status'] == '1') ? 'selected' : ''; ?>>Yes</option>
                                                <option value="0" <?= ($edit_employee['employee_lock_status'] == '0') ? 'selected' : ''; ?>>No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="employee_face_data">Clear Face Data</label>
                                            <select name="employee_face_data" id="employee_face_data" class="form-select">
                                                <option value="">-Select-</option>
                                                <option value="1" <?= ($edit_employee['employee_clear_face_data'] == '1') ? 'selected' : ''; ?>>Yes</option>
                                                <option value="0" <?= ($edit_employee['employee_clear_face_data'] == '0') ? 'selected' : ''; ?>>No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 lock_days" style="display: <?= ($edit_employee['employee_lock_status'] == 1) ? '' : 'none'; ?>">
                                            <label class="form-label" for="employee_lock_days">Lock Days</label>
                                            <input type="text" name="employee_lock_days" id="employee_lock_days" class="form-control" value="<?= $edit_employee['employee_lock_days']; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                        </div>
                                    </div>

                                    <div class="mt-5 d-flex justify-content-center gap-3">
                                        <input type="hidden" name="employee_id" id="employee_id" value="<?= $edit_employee['employee_id']; ?>">
                                        <?php if ($edit_employee['employee_deleted_status'] != 1) { ?>
                                            <input name="update_employee" type="submit" class="btn btn-primary" id="update_employee" value="Save" title="Save" />
                                            <input type="reset" value="Reset" class="btn btn-outline-secondary" title="Reset" />
                                        <?php } ?>
                                        <input type="hidden" name="employee_page" id="employee_page" value="edit">
                                        <input type="hidden" name="employee_status" id="employee_status" value="<?= $edit_employee['employee_deleted_status'] ?>">
                                        <input type="button" value="Back" class="btn btn-secondary" onclick="location.href='<?= ($_SESSION[SESS . 'session_admin_users_level'] != 'employee') ? 'index.php' : '../profile/index.php' ?>'" title="Back">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php } else {  ?>
                    <?php
                    $company_id = isset($_REQUEST['search_company_id']) ? $_REQUEST['search_company_id'] : '';
                    $branch_id = isset($_REQUEST['search_branch_id']) ? $_REQUEST['search_branch_id'] : '';

                    $department_id = isset($_REQUEST['search_department_id']) ? $_REQUEST['search_department_id'] : '';
                    $designation_id = isset($_REQUEST['search_designation_id']) ? $_REQUEST['search_designation_id'] : '';

                    $employee_name = isset($_REQUEST['search_employee_name']) ? $_REQUEST['search_employee_name'] : '';
                    $search_status = isset($_REQUEST['search_employee_status']) ? $_REQUEST['search_employee_status'] : '';
                    $search_get_branch = search_get_branch($company_id);
                    ?>
                    <div class="col-xl">
                        <div class="card mb-4">
                            <form action="index.php" method="POST" name="employee_form" id="employee_form" autocomplete="off">
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
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin' || $_SESSION[SESS . 'session_admin_users_level'] == 'company') { ?>
                                            <div class="flex-column col-md-3">
                                                <label class="form-label" for="search_department_id">Department </label>
                                                <select name="search_department_id" id="search_department_id" class="form-select">
                                                    <option value=""> - Select - </option>
                                                    <?php foreach ($listDepartment as $get) { ?>
                                                        <option value="<?= $get['department_id']; ?>" <?= ($department_id == $get['department_id']) ? 'selected' : '' ?>><?= $get['department_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                            </div>
                                        <?php } ?>
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin' || $_SESSION[SESS . 'session_admin_users_level'] == 'company') { ?>
                                            <div class="flex-column col-md-3">
                                                <label class="form-label" for="search_designation_id">Designation </label>
                                                <select name="search_designation_id" id="search_designation_id" class="form-select">
                                                    <option value=""> - Select - </option>
                                                    <?php foreach ($listDesignation as $get) { ?>
                                                        <option value="<?= $get['designation_id']; ?>" <?= ($designation_id == $get['designation_id']) ? 'selected' : '' ?>><?= $get['designation_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                            </div>
                                        <?php } ?>
                                        <div class="flex-column col-md-3">
                                            <label class="form-label" for="search_employee_name">Name </label>
                                            <input type="text" name="search_employee_name" id="search_employee_name" class="form-control" value="<?= $employee_name; ?>" />
                                        </div>
                                        <div class="flex-column col-md-3">
                                            <label class="form-label" for="search_employee_status">Status</label>
                                            <select name="search_employee_status" id="search_employee_status" class="form-select">
                                                <option value="active" <?php if ($search_status == 'active') { ?>selected <?php } ?>>Active</option>
                                                <option value="inactive" <?php if ($search_status == 'inactive') { ?>selected <?php } ?>>In Active</option>
                                                <option value="1" <?php if ($search_status == '1') { ?>selected <?php } ?>>Deleted</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="d-flex justify-content-center gap-2 mt-3">
                                        <input name="search" type="submit" class="btn btn-primary" id="search" value="Search" title="Search" />
                                        <input name="view_all" type="button" class="btn btn-success" id="view_all" onclick="location.href='index.php'" title="Display All" value="Display All" />
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
                            <form action="index.php" method="POST" name="employee_form" id="employee_form" autocomplete="off">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <caption class="ms-4">
                                        List of Information
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Employee Code </th>
                                            <th>Employee Name </th>
                                            <th>Employee Mobile No </th>
                                            <th>Department</th>
                                            <th>Designation</th>
                                            <!-- <th>Login Details</th> -->
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
                                        if ($listEmployee) {
                                            foreach ($listEmployee as $value) {     ?>
                                                <tr>
                                                    <td><?php echo $sno++; ?></td>
                                                    <td><?= ($value['employee_code']); ?></td>
                                                    <td><?= ucfirst($value['employee_name']); ?></td>
                                                    <td><?= $value['employee_contact_no']; ?></td>
                                                    <td><?= ($value['department_name']) ? ucfirst($value['department_name']) : ''; ?></td>
                                                    <td><?= (!empty($value['designation_name'])) ? ucfirst($value['designation_name']) : ''; ?></td>
                                                    <!-- <td>
                                                        <i class="bi bi-eye fs-4 btn btn-primary" style="border-radius: 50%;" data-bs-toggle="modal" data-bs-target="#user_level_modal"></i>
                                                    </td> -->
                                                    <?php if ($search_status != 1) { ?>
                                                        <td>
                                                            <i class="bi bi-pencil-square" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&employee_id=<?= $value['employee_id']; ?>'"></i>
                                                        </td>
                                                        <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['employee_id']; ?>,'delete');"><i class="bi bi-trash" style="cursor: pointer;color:red"></i></span>
                                                        </td>
                                                    <?php } else { ?>
                                                        <td>
                                                            <i class="bi bi-eye fs-5" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&employee_id=<?= $value['employee_id']; ?>'"></i>
                                                        </td>
                                                        <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['employee_id']; ?>,'undo');"><i class="bi bi-arrow-counterclockwise fs-5" style="cursor: pointer;color:green"></i></span>
                                                        </td>
                                                    <?php  } ?>

                                                </tr>
                                        <?php }
                                        }  ?>
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
                    <input type="hidden" name="employee_hidden_id" id="employee_hidden_id" value="">
                    <input type="hidden" name="employee_hidden_status" id="employee_hidden_status" value="">
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

    <div class="modal fade" id="user_level_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <p>User Name :</p>
                        <p>User Password :</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    

    <script src="<?= PROJECT_PATH ?>/src/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/js/sidebarmenu.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/js/app.min.js"></script>
    <!-- <script src="<?= PROJECT_PATH ?>/src/assets/libs/apexcharts/dist/apexcharts.min.js"></script> -->
    <script src="<?= PROJECT_PATH ?>/src/assets/libs/simplebar/dist/simplebar.js"></script>
    <!-- <script src="<?= PROJECT_PATH ?>/src/assets/js/dashboard.js"></script> -->
    <script src="<?= PROJECT_PATH ?>/src/assets/jquery/jquery.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/jquery/jquery-ui.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/DataTable/datatables.min.js"></script>
    <script src="employee-function.js"></script>
    <?php
    if (isset($_REQUEST['msg'])) {
        if ($_REQUEST['msg'] == 1) {
            $msg = 'Employee Created successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 2) {
            $msg = 'Employee Updated successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 3) {
            $msg = 'Employee Deleted successfully';
            $color = 'success';
        } else if ($_REQUEST['msg'] == 4) {
            $msg = 'Please fill all required fields';
            $color = 'warning';
        } else if ($_REQUEST['msg'] == 5) {
            $msg = 'Mobile No Already Created';
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