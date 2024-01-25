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
    <style>
        .text-ellipse {
            min-width: 50px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
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
                                    <input type="text" name="search_from_date" id="search_from_date" placeholder="DD/MM/YYY" class="form-control datepicker" value="<?= $from_date; ?>" readonly>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <label class="form-label" for="search_to_date">To Date</label>
                                    <input type="text" name="search_to_date" id="search_to_date" placeholder="DD/MM/YYY" class="form-control datepicker" value="<?= $to_date; ?>" readonly>
                                </div>

                                <div class="col-md-3 mt-2 d-flex align-items-center gap-2 mt-4">
                                    <input name="search" type="submit" class="btn btn-primary" id="search" value="Search" title="Search" />
                                    <input name="view_all" type="button" class="btn btn-success" id="view_all" onclick="location.href='index.php'" title="Display All" value="Display All" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>



                <div class="card p-3">
                    <div class="table-responsive text-wrap">
                        <!-- <tr>
                            <td align="right"><a class="excel" href="excel.php?from_date=<?= $from_date; ?>&search_branch_id=<?= $branch_id; ?>&to_date=<?= $to_date; ?>&employee_id=<?= 1 ?>" title="Download Excel"><i class="bi bi-file-earmark-excel " style="font-size: 20pt;"> </i></a> </td>
                        </tr> -->
                        <form action="index.php" method="POST" name="department_form" id="department_form" autocomplete="off">
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <!-- <caption class="ms-4">
                                        List of Information
                                    </caption> -->
                                    <thead>
                                        <tr>

                                            <th>S.No</th>
                                            <th>Branch</th>
                                            <th>Emp Name</th>
                                            <th>Date</th>
                                            <th>In Log</th>
                                            <th>In Location</th>
                                            <th>Out Log</th>
                                            <th>Out Location</th>
                                            <th>Duration</th>
                                            <th>All Log View </th>

                                        </tr>
                                    </thead>
                                    <tbody>



                                        <?php
                                        if (!empty($listAttendanceReport)) {
                                            $k    = 0;
                                            foreach ($listAttendanceReport as $result) {

                                        ?>
                                                <tr class="odd gradeX">
                                                    <td><?= ($k + 1); ?></td>
                                                    <td><?= $result['branch_name']; ?></td>
                                                    <td><?= $result['employee_name']; ?></td>
                                                    <td><?= dateGeneralFormat($result['attendance_detail_date']); ?></td>
                                                    <td><?= $result['in_time']; ?></td>

                                                    <td>
                                                        <p class="text-ellipse" title="<?= $result['location_in']; ?>"><?= $result['location_in']; ?></p>
                                                    </td>
                                                    <td><?php echo $result['out_time']; ?></td>
                                                    <td>
                                                        <p class="text-ellipse" title="<?= $result['location_out']; ?>"><?= $result['location_out']; ?>
                                                        <p>
                                                    </td>
                                                    <td><?= $result['duration']; ?></td>
                                                    <td><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $k ?>"><i class="bi bi-eye"></button></i> </td>

                                                </tr>
                                        <?php $k++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

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
                                                    <?php $s = 0;
                                                    foreach ($record['all_log'] as $gate_date) {
                                                    ?>
                                                        <tr>
                                                            <td><?= ($s + 1) ?></td>
                                                            <td><?= $gate_date['attendance_detail_time'] ?></td>
                                                            <td><?= $gate_date['attendance_detail_location'] ?></td>
                                                        </tr>
                                                    <?php $s++;
                                                    } ?>
                                                </table>
                                            </div>
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
    <script src="<?= PROJECT_PATH ?>/src/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/jquery/jquery.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/jquery/jquery-ui.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/DataTable/datatables.min.js"></script>
    <script src="attendance-report-fuction.js"></script>
</body>

</html>