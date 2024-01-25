<?php
include '../../includes/config.php';
include '../../includes/utility_function.php';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
if ($action == 'get_colom') {
    $table_name = $_REQUEST['table_name'];
    $array_data = array();
    if (!empty($table_name)) {
        $select_colom = "SHOW COLUMNS FROM  $table_name ";
        list($colum_count, $colum_data) = selectRows($select_colom);
        if ($colum_count > 0) {
            if (!empty($colum_data) && $colum_data != NULL) {
                $array_data[] = $colum_data;
            }
        }
    }
    $ajaxData = '';
    if (empty($array_data[0])) {
        echo 1;
        exit;
    }
    $ajaxData .= ' <div class="table-responsive mt-3"><div class="d-flex justify-content-end"><button type="button" class="btn btn-primary" onclick="add_row("modify")"><i class="bi bi-database-fill-gear"></i></button></div><table class="table" style="width:100%;" id="db_table">
    <thead>
    <tr>
        <th><input type="checkbox" id="db_checkbox" class="form-check-input" onclick="toggle()"></th>
        <th>Si No</th>
        <th>Field Name</th>
        <th>Type</th>
        <th>Length</th>
        <th>Default</th>
        </tr>
    </thead>
    <tbody>';
    $i = 1;
    if (count($array_data[0]) > 0) {
        foreach ($array_data[0] as $data) {
            if (!empty($data['Type'])) {
                $type = preg_replace('/[^A-Za-z\-]/', '', $data['Type']);
                $length = preg_replace('/[^0-9]/', '', $data['Type']);
            } else {
                $type = '';
                $length = '';
            }

            $ajaxData .= '<tr>
            <td> <input type="checkbox" name="field[]" value="' . $data['Field'] . '" id="db_modify' . $i . '" onclick="toggle_db(' . $i . ')"  class="form-check-input db_checkbox"></td>
                    <td> ' . $i . '</td>
                    <td>
                    <input type="text" value="' . $data['Field'] . '" name="field_name[]" disabled id="field_name' . $i . '" class="form-control db_form' . $i . ' db_select_all">
                    <input type="hidden" value="' . $data['Field'] . '" name="hidden_field_name[]" disabled id="hidden_field_name' . $i . '"  class="form-control db_form' . $i . ' db_select_all">
                    </td>
                    <td> 
                    <select name="type[]" disabled id="type' . $i . '" class="form-select db_form' . $i . ' db_select_all">
                    <option value="">-Select-</option>';
            foreach ($db_data_type as $key => $value) {
                $selected = ($key == $type) ? 'selected' : '';
                $ajaxData .= '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
            }
            $ajaxData .= '</select>
                   
                    <input type="hidden" value="' . $type . '" name="hidden_type[]" disabled id="hidden_type' . $i . '" class="form-control db_form' . $i . ' db_select_all">
                    </td>
                    <td> 
                    <input type="text" value="' . $length . '" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="length[]" disabled id="length' . $i . '" class="form-control db_form' . $i . ' db_select_all">
                    <input type="hidden" value="' . $length . '" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="hidden_length[]" disabled id="hidden_length' . $i . '" class="form-control db_form' . $i . ' db_select_all">
                    </td>
                    <td> 
                    <input type="text" value="' . $data['Default'] . '" name="default[]" disabled id="default' . $i . '" class="form-control db_form' . $i . ' db_select_all">
                    <input type="hidden" value="' . $data['Default'] . '" name="hidden_default[]" disabled id="hidden_default' . $i . '" class="form-control db_form' . $i . ' db_select_all">
                    </td>
                </tr>';

            $i++;
        }
    }
    $ajaxData .=    '</tbody>
</table><div class="d-flex justify-content-end"><button type="submit" name="update_db"
 class="btn btn-success" id="update_db">Save</button></div></div>';
    echo $ajaxData;
    exit;
}
if ($action == 'get_type') {
    $array = '<option value=""> Select </option>';
    foreach ($db_data_type as $key => $value) {
        $array .= '<option value="' . $key . '">' . $value . '</option>';
    }
    echo $array;
    exit;
}
if ($action == 'check_table_name') {
    $table_name = $_REQUEST['table_name'];
    $select_colom = "SHOW COLUMNS FROM  $table_name ";
    list($colum_count, $colum_data) = selectRows($select_colom);
    if ($colum_count > 0) {
       echo 1;exit;
    }
}
