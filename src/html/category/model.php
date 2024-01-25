<?php

function search_get_branch($company_id)
{
    $select = "SELECT branch_id,branch_name,branch_code FROM  branches WHERE branch_deleted_status = 0 AND branch_company_id = '" . $company_id . "' ";
    list($num_row, $records) = selectRows($select);
    return $records;
}
function listCompany()
{
    $where = "WHERE company_deleted_status =0";

    $select = "SELECT company_id,company_code,company_name FROM   company
     $where  ORDER BY  company_id   DESC ";
    // echo $select;die;
    list($count, $result) = selectRows($select);
    return $result;
}

function listBranch()
{
    $where = "WHERE branch_deleted_status =0";

    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $where .= " AND branch_id > 0 ";
    } else {
        $where .= " AND branch_company_id = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "' ";
    }

    $select = "SELECT branch_id,branch_name,branch_code
    FROM   branches
    $where  ORDER BY  branch_id  DESC ";
    // echo $select;die;
    list($count, $result) = selectRows($select);
    return $result;
}

function listcategory()
{
    // Search tds record form database table
    $where = " WHERE category_id > 0 ";

    if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
        $where .= " AND category_id  > 0 ";
    } else if ($_SESSION[SESS . 'session_admin_users_level'] == 'company') {
        $where .= " AND category_company_id  = '" . $_SESSION[SESS . 'session_admin_users_company_id'] . "'  ";
    }

    if (!empty($_REQUEST['search_category_name'])) {
        $where .= " AND  category_name LIKE '%" . $_REQUEST['search_category_name'] . "%' ";
    }

    if (!empty($_REQUEST['search_company_id'])) {
        $where .= " AND category_company_id  = '" . $_REQUEST['search_company_id'] . "'  ";
    }



    if (!empty($_REQUEST['category_search_status'])) {
        if ($_REQUEST['category_search_status'] == 1) {
            $where .= " AND category_deleted_status='" . $_REQUEST['category_search_status'] . "' ";
        } else {
            $where .= " AND category_active_status='" . $_REQUEST['category_search_status'] . "' AND category_deleted_status = 0 ";
        }
    } else {
        $where .= "AND category_active_status='active' AND category_deleted_status = 0 ";
    }

    $select = "SELECT category_id,category_name,category_active_status
                                     FROM   categorys
                                    $where  ORDER BY  category_id   DESC ";
    // echo $select;die;
    list($count, $result) = selectRows($select);
    return $result;
}


function insertcategory()
{


    if (isset($_POST['add_category'])) {



        $category_name = dataValidation($_POST['category_name']);
        $ip       = getRealIpAddr();
        $uniq_id =    generateUniqId();
        if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
            $company_id = dataValidation($_POST['company_id']);
            $branch_id = dataValidation($_POST['branch_id']);
        } else {
            $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
            $branch_id = $_SESSION[SESS . 'session_admin_users_branch_id'];
        }




        $get_category = "SELECT  category_name FROM   categorys  WHERE category_deleted_status=0 AND  category_company_id ='" . $company_id . "' 
        AND category_name = '" . $category_name . "' ";
        list($num_row, $record_select) = selectRows($get_category);
        // Checking required fields
        $request_fields = ((!empty($category_name)));

        if ($num_row == 0) {
            if (!empty($request_fields)) {
                // category insert into categoryes table
                $insert_category = "INSERT INTO categorys  SET 
				  category_name='" . $category_name . "',
            
                  category_company_id='" . $company_id . "',
				  category_uniq_id='" . $uniq_id . "',													
				  category_added_by='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				  category_added_on=UNIX_TIMESTAMP(NOW()),
				  category_added_ip='" . $ip . "'";
                insert($insert_category);

                header("Location:" . PROJECT_PATH . "src/html/category/index.php?page=add&msg=1");
                exit();
            }
        } else {

            header("Location:" . PROJECT_PATH . "src/html/category/index.php?page=add&msg=5");
            exit();
        }
    }
}

function editcategory()
{
    if (isset($_GET['category_id'])) {
        $edit_category = "SELECT  category_id ,category_name,category_company_id,category_active_status,category_deleted_status
					    FROM    categorys  
						WHERE  category_id ='" . dataValidation($_GET['category_id']) . "'";
        // echo $edit_category;die;
        list($count, $result) = selectRow($edit_category);
        return $result;
    }
}

function updatecategory()
{
    if (isset($_POST['update_category'])) {

        $category_name = dataValidation($_POST['category_name']);
        $category_id  = dataValidation($_POST['category_id']);
        $category_active_status = dataValidation($_POST['category_active_status']);
        $ip       = getRealIpAddr();
        if ($_SESSION[SESS . 'session_admin_users_level'] == 'admin') {
            $company_id = dataValidation($_POST['company_id']);
            $branch_id = dataValidation($_POST['branch_id']);
        } else {
            $company_id = $_SESSION[SESS . 'session_admin_users_company_id'];
            $branch_id = $_SESSION[SESS . 'session_admin_users_branch_id'];
        }

        $get_category = "SELECT  category_name FROM   categorys  WHERE category_deleted_status=0 AND  category_company_id ='" . $company_id . "' 
        AND category_name = '" . $category_name . "' 
        AND category_id != '" . $category_id . "' ";


        list($num_row, $record_select) = selectRows($get_category);
        // Checking required fields
        $request_fields = ((!empty($category_name)));

        if ($num_row == 0) {
            if (!empty($request_fields)) {
                // category insert into categoryes table
                $update_category = "UPDATE categorys  SET 
				  category_name='" . $category_name . "',
                  category_company_id='" . $company_id . "',
				  category_active_status='" . $category_active_status . "',													
				  category_modified_by='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
				  category_modified_on=UNIX_TIMESTAMP(NOW()),
				  category_modified_ip='" . $ip . "' WHERE category_id = '" . $category_id . "' ";
                update($update_category);
                header("Location:" . PROJECT_PATH . "src/html/category/index.php?page=edit&category_id=$category_id&msg=2");
                exit();
            }
        } else {
            header("Location:" . PROJECT_PATH . "src/html/category/index.php?page=edit&category_id=$category_id&msg=5");
            exit();
        }
    }
}
