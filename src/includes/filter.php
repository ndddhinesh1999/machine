<?php
$url = $_SERVER['PHP_SELF'];
$array = explode('/', $url);

$autonomous_name = isset($_REQUEST['search_autonomous_name']) ? $_REQUEST['search_autonomous_name'] : '';
$from_date = isset($_REQUEST['from_date']) ? $_REQUEST['from_date'] : '';
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : '';
$search_status = isset($_REQUEST['autonomous_search_status']) ? $_REQUEST['autonomous_search_status'] : '';
$company_id = isset($_REQUEST['search_company_id']) ? $_REQUEST['search_company_id'] : '';
if (array_search('preventive', $array)) { ?>
    <form action="index.php" method="POST" autocomplete="off">
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">Filler</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="row">

                    <div class="col-md-6">
                        <label class="form-label" for="search_from_date">From Date </label>
                        <input type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="DD/MM/YYYY" value="<?= $from_date ?>" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="search_to_date">To Date </label>
                        <input type="text" name="to_date" id="to_date" class="form-control datepicker" placeholder="DD/MM/YYYY" value="<?= $to_date ?>" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="search_autonomous_name">Label</label>
                        <input type="text" name="search_autonomous_name" id="search_autonomous_name" class="form-control " value="<?= $autonomous_name ?>" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="autonomous_search_status">Status</label>
                        <select name="autonomous_search_status" id="autonomous_search_status" class="form-select">
                            <option value="active" <?php if ($search_status == 'active') { ?>selected <?php } ?>>Active</option>
                            <option value="inactive" <?php if ($search_status == 'inactive') { ?>selected <?php } ?>>In Active</option>
                            <option value="1" <?php if ($search_status == '1') { ?>selected <?php } ?>>Deleted</option>
                        </select>
                    </div>
                </div><br>
                <div class="d-flex justify-content-center gap-2">
                    <input name="search" type="submit" class="btn btn-primary" id="search" value="Search" title="Search" />
                    <input name="view_all" type="button" class="btn btn-success" id="view_all" onclick="location.href='index.php'" title="Display All" value="Display All" />
                </div>
            </div>
        </div>
    </form>
<?php } elseif (array_search('breakdown', $array)) { ?>
    <form action="index.php" method="POST" autocomplete="off">
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">Filler</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="row">

                    <div class="col-md-6">
                        <label class="form-label" for="search_from_date">From Date </label>
                        <input type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="DD/MM/YYYY" value="<?= $from_date ?>" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="search_to_date">To Date </label>
                        <input type="text" name="to_date" id="to_date" class="form-control datepicker" placeholder="DD/MM/YYYY" value="<?= $to_date ?>" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="search_autonomous_name">Label</label>
                        <input type="text" name="search_autonomous_name" id="search_autonomous_name" class="form-control " value="<?= $autonomous_name ?>" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="autonomous_search_status">Status</label>
                        <select name="autonomous_search_status" id="autonomous_search_status" class="form-select">
                            <option value="active" <?php if ($search_status == 'active') { ?>selected <?php } ?>>Active</option>
                            <option value="inactive" <?php if ($search_status == 'inactive') { ?>selected <?php } ?>>In Active</option>
                            <option value="1" <?php if ($search_status == '1') { ?>selected <?php } ?>>Deleted</option>
                        </select>
                    </div>
                </div><br>
                <div class="d-flex justify-content-center gap-2">
                    <input name="search" type="submit" class="btn btn-primary" id="search" value="Search" title="Search" />
                    <input name="view_all" type="button" class="btn btn-success" id="view_all" onclick="location.href='index.php'" title="Display All" value="Display All" />
                </div>
            </div>
        </div>
    </form>
<?php } elseif (array_search('history-card', $array)) { ?>
    <form action="index.php" method="POST" autocomplete="off">
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">Filler</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="row">

                    <div class="col-md-6">
                        <label class="form-label" for="search_from_date">From Date </label>
                        <input type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="DD/MM/YYYY" value="<?= $from_date ?>" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="search_to_date">To Date </label>
                        <input type="text" name="to_date" id="to_date" class="form-control datepicker" placeholder="DD/MM/YYYY" value="<?= $to_date ?>" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="search_autonomous_name">Label</label>
                        <input type="text" name="search_autonomous_name" id="search_autonomous_name" class="form-control " value="<?= $autonomous_name ?>" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="autonomous_search_status">Status</label>
                        <select name="autonomous_search_status" id="autonomous_search_status" class="form-select">
                            <option value="active" <?php if ($search_status == 'active') { ?>selected <?php } ?>>Active</option>
                            <option value="inactive" <?php if ($search_status == 'inactive') { ?>selected <?php } ?>>In Active</option>
                            <option value="1" <?php if ($search_status == '1') { ?>selected <?php } ?>>Deleted</option>
                        </select>
                    </div>
                </div><br>
                <div class="d-flex justify-content-center gap-2">
                    <input name="search" type="submit" class="btn btn-primary" id="search" value="Search" title="Search" />
                    <input name="view_all" type="button" class="btn btn-success" id="view_all" onclick="location.href='index.php'" title="Display All" value="Display All" />
                </div>
            </div>
        </div>
    </form>
<?php }
