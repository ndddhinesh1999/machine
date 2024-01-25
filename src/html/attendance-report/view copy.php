<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= PROJECT_TITLE ?> - Attendance Report</title>
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
                    <h1>Attendance Report</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/home/">Home</a></li>
                            <li class="breadcrumb-item active">Attendance Report</li>
                        </ol>
                    </nav>
                </div>
                <?php
                $company_id = isset($_REQUEST['search_company_id']) ? $_REQUEST['search_company_id'] : '';
                $branch_id = isset($_REQUEST['search_branch_id']) ? $_REQUEST['search_branch_id'] : '';

                $department_id = isset($_REQUEST['search_department_id']) ? $_REQUEST['search_department_id'] : '';
                $designation_id = isset($_REQUEST['search_designation_id']) ? $_REQUEST['search_designation_id'] : '';

                $employee_name = isset($_REQUEST['search_employee_name']) ? $_REQUEST['search_employee_name'] : '';
                $from_date = isset($_REQUEST['search_from_date']) ? $_REQUEST['search_from_date'] : '';
                $to_date = isset($_REQUEST['search_to_date']) ? $_REQUEST['search_to_date'] : '';

                $search_get_branch = search_get_branch($company_id);
                ?>

                <div class="card mb-4">
                    <form action="index.php" method="POST" name="department_form" id="department_form" autocomplete="off">
                        <div class="card-body container-bg">
                            <div class="row">
                                <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                                    <div class="col-md-3 mt-2">
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
                                    <div class="col-md-3 mt-2">
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
                                    <div class="col-md-3 mt-2">
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
                                    <div class="col-md-3 mt-2">
                                        <label class="form-label" for="search_designation_id">Designation </label>
                                        <select name="search_designation_id" id="search_designation_id" class="form-select">
                                            <option value=""> - Select - </option>
                                            <?php foreach ($listDesignation as $get) { ?>
                                                <option value="<?= $get['designation_id']; ?>" <?= ($designation_id == $get['designation_id']) ? 'selected' : '' ?>><?= $get['designation_name']; ?></option>
                                            <?php    } ?>
                                        </select>
                                    </div>
                                <?php } ?>
                                <div class="col-md-3 mt-2">
                                    <label class="form-label" for="search_employee_name">Name </label>
                                    <input type="text" name="search_employee_name" id="search_employee_name" class="form-control" value="<?= $employee_name; ?>" />
                                </div>
                                <div class="col-md-3 mt-2">
                                    <label class="form-label" for="search_from_date">Form Date</label>
                                    <input type="text" name="search_from_date" id="search_from_date" placeholder="DD/MM/YYY" class="form-control datepicker" readonly>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <label class="form-label" for="search_to_date">To Date</label>
                                    <input type="text" name="search_to_date" id="search_to_date" placeholder="DD/MM/YYY" class="form-control datepicker" readonly>
                                </div>

                                <div class="col-md-3 mt-2 d-flex align-items-center gap-2 mt-4">
                                    <input name="search" type="submit" class="btn btn-primary" id="search" value="Search" title="Search" />
                                    <input name="view_all" type="button" class="btn btn-success" id="view_all" onclick="location.href='index.php'" title="Display All" value="Display All" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>



                <div class="card">
                    <div class="table-responsive text-wrap">
                        <!-- <tr>
                            <td align="right"><a class="excel" href="excel.php?from_date=<?= $from_date; ?>&search_branch_id=<?= $branch_id; ?>&to_date=<?= $to_date; ?>&employee_id=<?= 1 ?>" title="Download Excel"><i class="bi bi-file-earmark-excel " style="font-size: 20pt;"> </i></a> </td>
                        </tr> -->
                        <form action="index.php" method="POST" name="department_form" id="department_form" autocomplete="off">
                            <table class="datatable">
                                <caption class="ms-4">
                                    List of Information
                                </caption>
                                <thead>
                                    <tr>
                                        <!-- <th>S.No</th>
                                        <th>Employee ID</th>
                                        <th>Branch</th>
                                        <th>Employee Name</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Time</th> -->

                                        <th width="5%">S.No</th>
                                        <th width="10%">Emp ID</th>
                                        <th width="10%">Branch</th>
                                        <th width="10%">Emp Name</th>
                                        <th width="10%">Designation</th>
                                        <th width="10%">Date</th>
                                        <th width="10%">In Log</th>
                                        <th width="10%">In Location</th>
                                        <th width="10%">Out Log</th>
                                        <th width="10%">Out Location</th>
                                        <th width="10%">All Log View </th>

                                    </tr>
                                </thead>
                                <tbody>



                                    <?php
                                    if (!empty($listAttendanceReport)) {
                                        $k    = 0;
                                        foreach ($listAttendanceReport as $result) {
                                            //$getResult = get_attendance($result['user_master_id'],$_REQUEST['at_date']);
                                    ?>
                                            <tr class="odd gradeX">
                                                <td width="5%"><?php echo ($k + 1); ?></td>
                                                <td width="10%"><?php echo $result['employee_no']; ?></td>
                                                <td width="10%"><?php echo $result['branch_name']; ?></td>
                                                <td width="10%"><?php echo $result['employee_name']; ?></td>
                                                <td width="10%"><?php echo $result['designation_name']; ?></td>
                                                <td width="10%"><?php echo dateGeneralFormat($result['attendance_detail_date']); ?></td>
                                                <td width="10%"><?php echo $result['in_time']; ?></td>
                                                <td width="10%">
                                                    <p class="box" title="<?php echo $result['attendance_detail_location']; ?>"><?php echo $result['attendance_detail_location']; ?></p>
                                                </td>
                                                <td width="10%"><?php echo $result['out_time']; ?></td>
                                                <td width="10%">
                                                    <p class="box" title="<?php echo $result['attendance_detail_location_out']; ?>"><?php echo $result['attendance_detail_location_out']; ?>
                                                    <p>
                                                </td>
                                                <td width="10%"><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $k ?>"><i class="bi bi-eye"></button></i> </td>

                                            </tr>
                                    <?php $k++;
                                        }
                                    }
                                    ?>



                                    <!-- <?php
                                            $sno = 1;
                                            if ($listAttendance) {
                                                foreach ($listAttendance as $value) { ?>
                                            <tr>
                                                <td><?= $sno++; ?></td>
                                                <td><?= $result['employee_code']; ?></td>
                                                <td><?= $result['branch_name']; ?></td>
                                                <td><?= $result['employee_name']; ?></td>
                                                <td><?= $result['department_name']; ?></td>
                                                <td><?= $result['designation_name']; ?></td>
                                                <td><?= dateGeneralFormat($result['attendance_detail_date']); ?></td>
                                                <td><?= $result['attendance_detail_location']; ?></td>
                                                <td><?= $result['attendance_detail_time']; ?></td>
                                            </tr>
                                    <?php }
                                            } ?> -->

                                </tbody>
                            </table>

                            <?php
                            $j = 0;
                            foreach ($listAttendanceReport as $record) { ?>
                                <div class="modal fade modal-lg" id="staticBackdrop<?= $j ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Date : <?= dateGeneralFormat($record['attendance_detail_date']) ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table id="mytable" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>S.no</th>
                                                            <th>Log Time</th>
                                                            <th>location</th>
                                                        </tr>
                                                    </thead>
                                                    <?php foreach ($record['all_log'] as $gate_date) {
                                                    ?>
                                                        <tr>
                                                            <td><?= ($gate_date['Sno'] + 1) ?></td>
                                                            <td><?= $gate_date['punchTime'] ?></td>
                                                            <td><?= $gate_date['punchLocation'] ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            </div>
                                            <!-- <div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
												<button type="button" class="btn btn-primary">Understood</button>
											</div> -->
                                        </div>
                                    </div>
                                </div>

                            <?php
                                $j++;
                            } ?>
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
    <script src="attendance-report-fuction.js"></script>
</body>

</html>