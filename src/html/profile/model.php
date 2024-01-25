<?php



function upload_image()
{
    $user_id                    = $_SESSION[SESS . 'session_admin_users_id'];
    $image                      = $_FILES['user_img']['name'];
    $tmp_name                   = $_FILES['user_img']['tmp_name'];
    $current_date               = date('Y-m-d');
    if (!empty($image)) {
        $file_rename       = preg_replace('/[^a-zA-Z0-9]/s', '-', $user_id . date('YmdHis'));
        $file_extn       = explode('.', $image);
        $file_new_name   = $file_rename . '.' . end($file_extn);
        $base_path = '../../assets/images/profile/';
        $folder_name = $base_path . date('Y', strtotime(dateDatabaseFormat($current_date))) . '/' . date('F', strtotime(dateDatabaseFormat($current_date)));

        if (!file_exists($folder_name)) {
            mkdir($folder_name, 0777, true);
        }
        $target_file = $folder_name . '/' . $file_new_name;
        $file_extns       = substr($target_file, 3);

        if (move_uploaded_file($tmp_name, $target_file)) {
            $upload_data = $file_extns;
        }
    } else {
        $upload_data = $_POST['old_user_img'];
    }


    $update_image = "UPDATE admin_users SET 
        admin_users_image = '" . $upload_data . "'
        WHERE admin_users_id = '" . $_SESSION[SESS . 'session_admin_users_id'] . "' ";
    // echo $update_image;exit;
    $id = update($update_image);
    if ($id > 0) {
        header("Location:index.php?&msg=1");
    } else {
        header("Location:index.php");
    }
}
