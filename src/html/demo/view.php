<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= PROJECT_TITLE ?> - Department</title>
    <link rel="shortcut icon" type="image/png" href="<?= PROJECT_PATH; ?>/src/assets/images/logos/company-logo.svg" />
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/libs/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/css/styles.min.css" />
    <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/css/styles.css" />
    <link href="<?= PROJECT_PATH ?>/src/assets/DataTable/datatables.min.css" rel="stylesheet" />
</head>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Muli&display=swap");

    :root {
        --line-border-fill: #3498db;
        --line-border-empty: #e0e0e0;
        --progress-zIndex: -1;
    }

    * {
        box-sizing: border-box;
    }

    body {
        align-items: center;
        background-color: var(--bg-color);
        display: flex;
        font-family: "Muli", sans-serif;
        height: 100vh;
        justify-content: center;
        margin: 0;
        overflow: hidden;
    }

    .contaienr {
        text-align: center;
    }

    .progress-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
        max-width: 100%;
        position: relative;
        width: 350px;
    }

    .progress-container::before {
        background-color: var(--line-border-empty);
        content: "";
        height: 4px;
        left: 0;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 100%;
        z-index: var(--progress-zIndex);
    }

    .progress {
        background-color: var(--line-border-fill);
        height: 4px;
        left: 0;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        transition: 0.4s ease;
        width: 0%;
        z-index: var(--progress-zIndex);
    }

    .circle {
        align-items: center;
        background-color: #fff;
        border: 3px solid #e0e0e0;
        border-radius: 50%;
        color: #999;
        display: flex;
        height: 30px;
        justify-content: center;
        transition: 0.4 ease;
        width: 30px;
    }

    .circle.active {
        border-color: var(--line-border-fill);
    }

    .btn {
        background-color: var(--line-border-fill);
        border: 0;
        border-radius: 6px;
        color: #fff;
        cursor: pointer;
        font-family: inherit;
        font-size: 14px;
        margin: 5px;
        padding: 8px 30px;
    }

    .btn:active {
        transform: scale(0.98);
    }

    .btn:focus {
        outline: 0;
    }

    .btn:disabled {
        background-color: var(--line-border-empty);
        cursor: not-allowed;
    }
</style>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

        <?php include '../../includes/side-nav.php'; ?>

        <!--  Main wrapper -->
        <div class="body-wrapper">

            <?php include '../../includes/header.php'; ?>

            <div class="container-fluid">
                <div class="page-title">
                    <h1>Department</h1>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= PROJECT_PATH ?>src/html/home/">Home</a></li>
                            <li class="breadcrumb-item active">Department</li>
                        </ol>
                    </nav>
                </div>
                <?php if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'add') { ?>
                    <div class="contaienr">
                        <div class="progress-container">
                            <div class="progress" id="progress"></div>
                            <div class="circle active">1</div>
                            <div class="circle">2</div>
                            <div class="circle">3</div>
                            <div class="circle">4</div>
                        </div>
                        <button class="btn" id="prev" disabled>Prev</button>
                        <button class="btn" id="next">Next</button>
                    </div>
                <?php } else if (isset($_REQUEST['page']) && $_REQUEST['page'] == 'edit') { ?>

                    <div class="col-lg-12 d-flex align-items-strech">
                        <div class="card w-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Department Details</h5>
                                <small class="text-muted float-end">Edit Department</small>
                            </div>
                            <div class="card-body">
                                <form action="index.php" method="POST" name="department_form" id="department_form" autocomplete="off" class="needs-validation" novalidate>
                                    <div class="row">
                                        <?php if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') { ?>
                                            <div class="col-md-3">
                                                <label class="form-label company_id" for="company_id">Company</label>
                                                <select name="company_id" id="company_id" class="form-select" required>
                                                    <option value="">-Select-</option>
                                                    <?php foreach ($listCompany as $data) { ?>
                                                        <option value="<?= $data['company_id']; ?>" <?= ($data['company_id'] == $edit_department['department_company_id']) ? 'selected' : '' ?>><?= $data['company_code'] . ' - ' . $data['company_name']; ?></option>
                                                    <?php    } ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a company.
                                                </div>
                                            </div>

                                        <?php    } ?>
                                        <div class="col-md-3">
                                            <label class="form-label department_name" for="department_name">Department Name</label>
                                            <input name="department_name" id="department_name" class="form-control" value="<?= $edit_department['department_name'] ?>" required>
                                            <div class="invalid-feedback">
                                                Please enter department name.
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" for="department_active_status">Status</label>
                                            <select name="department_active_status" id="department_active_status" class="form-control">
                                                <option value="active" <?php if ($edit_department['department_active_status'] == 'active') { ?>selected <?php } ?>>Active</option>
                                                <option value="inactive" <?php if ($edit_department['department_active_status'] == 'inactive') { ?>selected <?php } ?>>In Active</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mt-5 d-flex justify-content-center gap-3">
                                        <input type="hidden" name="department_id" id="department_id" value="<?= $edit_department['department_id'] ?>">
                                        <?php if ($edit_department['department_deleted_status'] != 1) { ?>
                                            <input name="update_department" type="submit" class="btn btn-primary" id="update_department" value="Save" title="Save" />
                                            <input type="reset" value="Reset" class="btn btn-outline-secondary" title="Reset" />
                                        <?php } ?>
                                        <input type="hidden" name="department_page" id="department_page" value="edit">
                                        <input type="hidden" name="department_status" id="department_status" value="<?= $edit_department['department_deleted_status'] ?>">
                                        <input type="button" value="Back" class="btn btn-secondary" onclick="location.href='index.php'" title="Back">
                                    </div>
                                </form>
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
                                            <th>Department Name</th>
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
                                        if ($list_department) {
                                            foreach ($list_department as $value) {
                                        ?>
                                                <tr>
                                                    <td><?= $sno++; ?></td>
                                                    <td><?= ucfirst($value['department_name']); ?></td>
                                                    <td><?php if ($value['department_active_status'] == 'active') {
                                                            echo "Active";
                                                        } else {
                                                            echo "Inactive";
                                                        } ?></td>

                                                    <?php if ($search_status != 1) { ?>
                                                        <td>
                                                            <i class="bi bi-pencil-square" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&department_id=<?= $value['department_id']; ?>'"></i>
                                                        </td>
                                                        <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['department_id']; ?>,'delete');"><i class="bi bi-trash" style="cursor: pointer;color:red"></i></span>
                                                        </td>
                                                    <?php } else { ?>
                                                        <td>
                                                            <i class="bi bi-eye fs-5" style="cursor: pointer;color:blue;" onclick="location.href='index.php?page=edit&department_id=<?= $value['department_id']; ?>'"></i>
                                                        </td>
                                                        <td>
                                                            <span data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="delete_record(<?= $value['department_id']; ?>,'undo');"><i class="bi bi-arrow-counterclockwise fs-5" style="cursor: pointer;color:green"></i></span>
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


    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- <script src="<?= PROJECT_PATH ?>/src/assets/libs/jquery/dist/jquery.min.js"></script> -->
    <!-- <script src="<?= PROJECT_PATH ?>/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="<?= PROJECT_PATH ?>/src/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="<?= PROJECT_PATH ?>/src/assets/js/dashboard.js"></script> -->
    <!-- <script src="<?= PROJECT_PATH ?>/src/assets/jquery/jquery.js"></script> -->
    <!-- <script src="<?= PROJECT_PATH ?>/src/assets/jquery/jquery-ui.js"></script> -->
    <!-- <script src="<?= PROJECT_PATH ?>/src/assets/DataTable/datatables.min.js"></script> -->
    <!-- <script src="department-function.js"></script> -->
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
            const progress = document.querySelector("#progress");
            const prev = document.querySelector("#prev");
            const next = document.querySelector("#next");
            const circles = document.querySelectorAll(".circle");

            let currentActive = 1;

            next.addEventListener("click", () => {
                currentActive++;
                alert('sd');
                if (currentActive > circles.length) {
                    currentActive = circles.length;
                }

                update();
            });

            prev.addEventListener("click", () => {
                currentActive--;

                if (currentActive < 1) {
                    currentActive = 1;
                }

                update();
            });

            function update() {
                circles.forEach((circle, idx) => {
                    if (idx < currentActive) {
                        circle.classList.add("active");
                    } else {
                        circle.classList.remove("active");
                    }
                });

                const actives = document.querySelectorAll(".active");

                progress.style.width =
                    ((actives.length - 1) / (circles.length - 1)) * 100 + "%";

                if (currentActive === 1) {
                    prev.disabled = true;
                } else if (currentActive === circles.length) {
                    next.disabled = true;
                } else {
                    prev.disabled = false;
                    next.disabled = false;
                }
            }
        </script>
    <?php } ?>

</body>

</html>