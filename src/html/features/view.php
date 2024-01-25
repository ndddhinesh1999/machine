<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= PROJECT_TITLE ?> - Features</title>
    <link rel="shortcut icon" type="image/png" href="<?= PROJECT_PATH; ?>/src/assets/images/logos/company-logo.svg" />
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/libs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/css/styles.min.css" />
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/css/styles.css" />
    <style>
        input[type="checkbox"] {
            border: 1px solid #cfcdcd;
            cursor: pointer;
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
                    <h1>Features</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/home/">Home</a></li>
                            <li class="breadcrumb-item active">Features</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body container-bg">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-database-tab" data-bs-toggle="pill" data-bs-target="#pills-database" type="button" role="tab" aria-controls="pills-database" aria-selected="true">Data Base &nbsp;<i class="bi bi-database"></i></button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link " id="pills-create_table-tab" data-bs-toggle="pill" data-bs-target="#pills-create_table" type="button" role="tab" aria-controls="pills-create_table" aria-selected="true">Create Table &nbsp;<i class="bi bi-database-fill-gear"></i></button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link " id="pills-modify_database-tab" data-bs-toggle="pill" data-bs-target="#pills-modify_database" type="button" role="tab" aria-controls="pills-modify_database" aria-selected="true">Modify Table &nbsp;<i class="bi bi-database-fill-gear"></i></button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link " id="pills-history-tab" data-bs-toggle="pill" data-bs-target="#pills-history" type="button" role="tab" aria-controls="pills-history" aria-selected="false">Log In & DB History &nbsp;<i class="bi bi-box-arrow-in-right"></i></button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">Upload DB &nbsp;<i class="bi bi-database-fill-up"></i></button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link" onclick="location.href='index.php?download_file'">Download DB &nbsp;<i class="bi bi-database-fill-down"></i></button>
                                </li>

                            </ul>

                            <div class="tab-content mt-5" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-database" role="tabpanel" aria-labelledby="pills-database-tab">
                                    <form action="index.php" method="POST" name="features_form" id="features_form" autocomplete="off" onsubmit=" return  myFunction()">
                                        <div class="table-responsive">
                                            <table id="example" class="table" style="width:100%">
                                                <caption class="ms-4">
                                                    List of Information
                                                </caption>
                                                <thead>
                                                    <tr>
                                                        <th>S No.</th>
                                                        <th>Table Name</th>
                                                        <th>Data Count</th>
                                                        <th>Show Coloms</th>
                                                        <th>Truncate &emsp;<input type="checkbox" onclick="toggle_truncate(this.value);" id="truncate" class="form-check-input disable_truncate"></th>
                                                        <th>Drop &emsp;<input type="checkbox" onclick="toggle_drop(this.value);" id="drop" class="form-check-input disable_drop"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sno = 1;
                                                    $j = 0;
                                                    if ($showTable) {
                                                        foreach ($showTable as $value) {
                                                    ?>
                                                            <tr>
                                                                <td><?= $sno++; ?></td>
                                                                <td><?= $value['table_name']; ?></td>
                                                                <td><?= $value['row_count']; ?></td>
                                                                <td><i class="bi bi-eye fs-5" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $j; ?>"></i></td>
                                                                <td><input type="checkbox" name="truncate[]" value="<?= $value['table_name']; ?>" id="truncate_box<?= $j; ?>" class="form-check-input truncate  form_cheeck"></td>
                                                                <td><input type="checkbox" name="drop[]" value="<?= $value['table_name']; ?>" id="drop_box<?= $j; ?>" class="form-check-input drop  form_cheeck"></td>
                                                                <td>
                                                                    <div class="modal fade" id="exampleModal<?= $j; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel"><?= (!empty($value['table_name'])) ? ucfirst($value['table_name']) : ''; ?> &nbsp;Colom Details</h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="table-responsive">
                                                                                        <table class="table" style="width:100%;">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>Si No</th>
                                                                                                    <th>Field Name</th>
                                                                                                    <th>Type</th>
                                                                                                    <th>Default</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <?php $i = 1;
                                                                                                if (count($value['colom_name']) > 0) {
                                                                                                    foreach ($value['colom_name'] as $data) {
                                                                                                ?>
                                                                                                        <tr>
                                                                                                            <td><?= $i++; ?></td>
                                                                                                            <td>
                                                                                                                <?= $data['Field']; ?>
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <?= $data['Type']; ?>

                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <?= $data['Default']; ?>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                <?php $i++;
                                                                                                    }
                                                                                                } ?>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                    <?php $j++;
                                                        }
                                                    } ?>
                                                    <tr>
                                                        <td colspan="7" align="right"><input type="submit" class="btn btn-success" name="save_information" value="Save" id="save_information"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="pills-create_table" role="tabpanel" aria-labelledby="pills-create_table-tab">
                                    <form action="index.php" method="POST" name="features_form" id="features_form" autocomplete="off">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label class="form-label mx-3 my-2">Table Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control" name="create_table_name" id="create_table_name" onblur="check_table_name();">
                                                <div class="invalid-feedback">
                                                    Table name aldready exist
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="table-responsive mt-3">
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-primary" onclick="add_row('create')"><i class="bi bi-database-fill-gear"></i></button>
                                                </div>
                                                <table class="table" style="width:100%;" id="db_table">
                                                    <thead>
                                                        <tr>
                                                            <th><input type="checkbox" id="db_checkbox" class="form-check-input" onclick="toggle()"></th>
                                                            <th>Si No</th>
                                                            <th>Field Name</th>
                                                            <th>Type</th>
                                                            <th>Length</th>
                                                            <th>Default</th>
                                                            <th>Primary</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td> <input type="checkbox" name="field[]" value="" id="db_modify0" onclick="toggle_db(0)" class="form-check-input db_checkbox"></td>
                                                            <td>1</td>
                                                            <td>
                                                                <input type="text" value="" name="field_name[]" disabled id="field_name0" class="form-control db_form0 db_select_all">

                                                            </td>
                                                            <td>
                                                                <select name="type[]" disabled id="type0" class="form-select db_form0 db_select_all">
                                                                    <option value="">-Select-</option>';
                                                                    <?php foreach ($db_data_type as $key => $value) { ?>
                                                                        <option value="<?= $key ?>"><?= $value ?></option>
                                                                    <?php  } ?>
                                                                </select>


                                                            </td>
                                                            <td>
                                                                <input type="text" value="" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="length[]" disabled id="length0" class="form-control db_form0 db_select_all">

                                                            </td>
                                                            <td>
                                                                <input type="text" value="" name="default[]" disabled id="default0" class="form-control db_form0 db_select_all">

                                                            </td>
                                                            <td> <input type="checkbox" name="primary[]" value="" disabled onclick="primary_check(0);" id="primary0" class="form-check-input primary_key"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="d-flex justify-content-end"><button type="submit" name="create_tables" class="btn btn-success" id="create_tables">Save</button></div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <div class="tab-pane fade" id="pills-modify_database" role="tabpanel" aria-labelledby="pills-modify_database-tab">
                                    <?php $table_name = isset($_REQUEST['table_name']) ? $_REQUEST['table_name'] : '' ?>
                                    <form action="index.php" method="POST" name="features_form" id="features_form" autocomplete="off">
                                        <div class="row">
                                            <div class="col-md-6 d-flex justify-content-center">
                                                <label class="form-label mx-3 my-2">Table</label>
                                                <select class="form-select" name="table_name" id="table_name">
                                                    <option value="">-Select-</option>
                                                    <?php
                                                    foreach ($showTable as $data) { ?>
                                                        <option value="<?= $data['table_name'] ?>" <?= ($table_name == $data['table_name']) ? 'selected' : '' ?>><?= $data['table_name'] ?></option>
                                                    <?php  }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="coloms_div"></div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="pills-history" role="tabpanel" aria-labelledby="pills-history-tab"></div>
                            </div>


                        </div>


                    </div>
                </div>


                <!-- footer -->
                <?php include '../../includes/footer.php'; ?>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Data Base</h5>
                </div>
                <form action="index.php" method="POST" name="feature_form" id="feature_form" autocomplete="off" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="d-flex justify-content-between">
                            <span class="modal-title">Last upload date & time : <?= (!empty($getLastModifyer['update_date'])) ? $getLastModifyer['update_date'] : '' ?></span>
                            <span class="modal-title text-dark">Name : <?= (!empty($getLastModifyer['user_name'])) ? ucfirst($getLastModifyer['user_name']) : '' ?></span>
                        </div>
                        <div class="mt-3">
                            <input type="file" accept=".txt,.sql" name="database" id="database" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="$('#exampleModal').modal('hide')" data-dismiss="modal">Close</button>
                        <button type="submit" name="upload_data_base" class="btn btn-primary" id="submit">Upload</button>
                    </div>
                </form>
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
    <script src="features-functions.js"></script>
    <?php
    if (isset($_REQUEST['msg'])) {
        if ($_REQUEST['msg'] == 1) {
            $msg = '';
            $color = 'success';
        }
    }

    ?>

    <!-- Toasts -->
    <div class="toast-container position-absolute top-0 end-0 mt-3 mx-2" style="z-index: 10000;">
        <div class="toast align-items-center text-white bg-<?= $color ?> border-0" id="roles" role="alert" aria-live="assertive" aria-atomic="true">
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