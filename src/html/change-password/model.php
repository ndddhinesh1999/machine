<?php 

function changePassword()
{
    if (isset($_POST['change_password'])) {
        $old_pass    = $_POST['old_password'];
        $con_old = md5($old_pass);
        $user_new_pass  = $_POST['new_password'];
        $con_new_old = md5($user_new_pass);
        $user_con_pass  = $_POST['confirm_password'];

        if (!empty($old_pass) && !empty($user_new_pass) && !empty($user_con_pass)) {
            if ($user_new_pass == $user_con_pass) {
                $select_user = "SELECT *  
                                          FROM  admin_users 
                                          WHERE admin_users_id= '" . $_SESSION[SESS . 'session_admin_users_id'] . "' 
                                          AND admin_users_password = '" . $con_old . "' AND admin_users_active_status    = 'active'
                                          AND admin_users_delete_status    = 0";
                list($count_user, $record_user) = selectRow($select_user);
                // echo $select_user;
                // exit;
                if ($count_user > 0) {
                    $update_password = "UPDATE admin_users SET 
                    admin_users_password        ='" . $con_new_old . "' ,
                    admin_users_pass             = '" . $user_new_pass . "',
                    admin_users_modified_by     ='" . $_SESSION[SESS . 'session_admin_users_id'] . "'
                    WHERE admin_users_id        ='" . $_SESSION[SESS . 'session_admin_users_id'] . "' ";

                    $ids = update($update_password);
                    if ($ids) {

                        header('Location:index.php?&msg=1');
                        exit();
                    }
                } else {

                    header('Location:index.php');
                    exit();
                }
            } else {
                header('Location:index.php');
                exit();
            }
        }
    }
}
