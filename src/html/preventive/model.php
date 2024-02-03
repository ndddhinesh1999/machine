<?php


function CreateData()
{

    $ip = getRealIpAddr();
    for ($i = 0; $i < count($_POST['description']); $i++) {
        $uniq_id =    generateUniqId();

        $image = $_FILES['file']['name'][$i];
        $imageArr = explode('.', $image); //first index is file name and second index file type
        $rand = rand(10000, 99999);
        $newImageName = $imageArr[0] . $rand . '.' . $imageArr[1];
        $uploadPath = PROJECT_PATH . "src/assets/images/files/" . $newImageName;
        $isUploaded = move_uploaded_file($_FILES["file"]["tmp_name"][$i], $uploadPath);
        if ($isUploaded)
            echo 'successfully file uploaded';
        else
            echo 'something went wrong';




        $insert = "INSERT INTO maintanances  SET 
        maintanance_uniq_id = '" . $uniq_id . "',
        maintanance_user_id = '" . $_POST['user_id'] . "',
        maintanance_name  = '" . $_POST['description'][$i] . "',
        maintanance_file_path ='" . $uploadPath . "' ,
        maintanance_branch_id='1',
        maintanance_company_id='1',												
        maintanance_added_by='" . $_SESSION[SESS . 'session_admin_users_id'] . "',
        maintanance_added_on=UNIX_TIMESTAMP(NOW()),
        maintanance_added_ip ='" . $ip . "'";
        insert($insert);
    }
    header("location:index.php");
    exit;
}

function actively()
{
    $select = "SELECT * FROM activitys
    WHERE activity_active_status='active' AND activity_deleted_status=0";
    list($row, $result) = selectRows($select);
    $array = array();
    $i = 0;
    foreach ($result as $record) {
        $array[$i]['activity_name'] = $record['activity_name'];
        $select1 = "SELECT * FROM activity_details
        WHERE activity_detail_active_status='active' AND activity_detail_deleted_status=0 AND activity_detail_activity_id='" . $record['activity_id'] . "'";
        list($row, $result1) = selectRows($select1);
        $array1 = array();
        $j = 0;
        foreach ($result1 as $record1) {
            $array1[$j]['activity_detail_name'] = $record1['activity_detail_name'];
            $array1[$j]['activity_details_plan'] = $record1['activity_details_plan'];
            $j++;
        }
        $array[$i]['details'] = $array1;
        $i++;
    }
 return $array;
}
