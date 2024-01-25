<?php


function financialYears()
{
    $select_years = "SELECT financial_year_id, financial_year_from,	financial_year_to FROM financial_years WHERE financial_year_delete_status = 0 ORDER BY financial_year_from DESC";
    list($count, $result1) = selectRows($select_years);
    return $result1;
}

function adminUserAuthentication()
{
    // print_r($_POST);exit;

    $user_name       = dataValidation($_POST['user_name']);
    $user_password   = dataValidation($_POST['user_password']);
    $user_financial_year = dataValidation($_POST['user_password']);


    if (isset($_POST['admin_users_login'])) {
        $admin_users_user_name  = $_POST['user_name'];
        $admin_users_password  = $_POST['user_password'];
        $financial_year_id = $_POST['user_financial_year'];

        $select_financial_year = "SELECT financial_year_from, financial_year_to, 
        financial_year_form_date, 
        financial_year_to_date FROM financial_years 
        WHERE financial_year_id  = '" . ($financial_year_id) . "' 
        AND financial_year_delete_status    = 0";
        list($num_rows, $record_financial_year) = selectRow($select_financial_year);
        $_SESSION[SESS . 'session_admin_users_financial_year_id'] = ($financial_year_id);
        $_SESSION[SESS . 'session_financial_year_from_date'] = $record_financial_year['financial_year_form_date'];
        $_SESSION[SESS . 'session_financial_year_to_date'] = $record_financial_year['financial_year_to_date'];
        $not_empty = ((!empty($admin_users_user_name)) && (!empty($admin_users_password)) && (!empty($financial_year_id)));
        // Check all required fields
        if ($not_empty) {
            // Check users name validation
            $select_admin_users = "SELECT admin_users_id, admin_users_unique_id, admin_users_user_name, admin_users_title, admin_users_password, 
                                      admin_users_level,admin_users_employee_id,admin_users_company_id,admin_users_branch_id,admin_users_image   
                                FROM  admin_users 
                                WHERE admin_users_user_name = '" . $admin_users_user_name . "' 
                                AND admin_users_active_status    = 'active'
                                AND admin_users_delete_status    = 0";
            // echo $select_admin_users; exit;
            list($count_admin_users, $record_admin_users) = selectRow($select_admin_users);
            if ($count_admin_users == 1) {
                // echo $count_admin_users; exit;
                $admin_users_password    = md5($admin_users_password);
                $admin_users_db_password = ($record_admin_users['admin_users_password']);
                // Check password validation
                if ($admin_users_password == $admin_users_db_password) {
                    $_SESSION[SESS . 'session_admin_users_id']              = $record_admin_users['admin_users_id'];
                    $_SESSION[SESS . 'session_admin_users_unique_id']         = $record_admin_users['admin_users_unique_id'];
                    $_SESSION[SESS . 'admin_users_user_name']            = $record_admin_users['admin_users_user_name'];
                    $_SESSION[SESS . 'session_admin_users_level']           = $record_admin_users['admin_users_level'];
                    $_SESSION[SESS . 'session_admin_users_title']           = $record_admin_users['admin_users_title'];
                    $_SESSION[SESS . 'session_admin_users_employee_id']          = $record_admin_users['admin_users_employee_id'];
                    $_SESSION[SESS . 'session_admin_users_company_id']          = $record_admin_users['admin_users_company_id'];
                    $_SESSION[SESS . 'session_admin_users_branch_id']          = $record_admin_users['admin_users_branch_id'];
                    $_SESSION[SESS . 'session_admin_users_image']          = $record_admin_users['admin_users_image'];
                    header("Location:" . PROJECT_PATH . "src/html/home");
                    exit();
                } else {
                    header("Location:index.php?msg=2");
                    exit();
                }
            } else {
                header("Location:index.php?msg=1");
                exit();
            }
        } else {
            header("Location:index.php?msg=3");
            exit();
        }
    }
}
