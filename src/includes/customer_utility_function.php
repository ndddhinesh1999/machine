<?php

function hrLogPush($logId)
{

	$selectAttendance = "SELECT attendance_detail_date, attendance_detail_time, employee_name, 
	                     department_name, attendance_detail_datetime FROM attendance_detail 
	                     LEFT JOIN employees ON employee_id  = attendance_detail_emp_id
	                     LEFT JOIN departments ON department_id = employee_department_id 
						 WHERE attendance_detail_id = '" . $logId . "' ";

	list($row_att, $result) = selectRow($selectAttendance);

	if ($row_att > 0) {

		$dateTime = $result['attendance_detail_datetime'];

		$headers = array(
			"Content-Type: application/json",
			"Ocp-Apim-Trace: true",
			"Ocp-Apim-Subscription-Key: 28823e548f644fbdbdffd0e5990630d8"
		);

		$postData = '{
	                	"deviceID": "' . $result['department_name'] . '",
	                	"deviceSerialno": "' . $result['department_name'] . '",
	                	"employeeID": "' . $result['employee_name'] . '",
	                	"date": "' . $result['attendance_detail_date'] . '",
				    	"time": "' . $result['attendance_detail_time'] . '",
	                	"modeofPunch": "MobilePunch",
	                	"modeofAttn": "IN",
	                	"ip": "10.25.50.192"
	                }';

		// echo $postData;exit;


		$url = "https://ltceip4Prod.azure-api.net/Wms4Attn/SaveAttendanceFromDevice";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$season_data = curl_exec($ch);

		if (curl_errno($ch)) {
			//print "Error: " . curl_error($ch) . '***';
		}
		curl_close($ch);

		$json = json_decode($season_data);

		$select_logs = "SELECT * FROM hrlogs WHERE hrlogs_log_id = $logId";
		list($row_log, $result_log) = selectRow($select_logs);

		if (isset($json->isSuccess) && ($json->isSuccess == 'Y' || $json->outputMessage == 'Already Entry Available')) {

			if ($row_log > 0) {
				$update = "UPDATE hrlogs SET 
		                   hrlogs_pushed_status = 'completed',
					       hrlogs_log_msg='" . json_encode($season_data) . "'
		                   WHERE hrlogs_log_id='" . $logId . "' ";
				update($update);
			} else {
				$insert = "INSERT INTO hrlogs SET 
				           hrlogs_log_id='" . $logId . "',
				           hrlogs_emp_code='" . $result['employee_name'] . "',
				           hrlogs_pushed_for = '" . $dateTime . "' ,
				           hrlogs_pushed_status = 'completed',
				           hrlogs_log_msg = '" . json_encode($season_data)  . "'";
				insert($insert);
			}
		} else {

			if ($row_log == 0) {
				$insert = "INSERT INTO hrlogs SET 
		                   hrlogs_log_id='" . $logId . "',
					       hrlogs_emp_code='" .  $result['employee_name'] . "',
		                   hrlogs_pushed_for = '" . $dateTime . "' ,
		                   hrlogs_pushed_status = 'pending',
					       hrlogs_log_msg = '" . json_encode($season_data)  . "'";
				insert($insert);
			} else {
				$update = "UPDATE hrlogs SET 
			               hrlogs_pushed_status = 'pending',
			               hrlogs_log_msg = '" . json_encode($season_data)  . "'
			               WHERE  hrlogs_log_id='" . $logId . "' ";
				update($update);
			}
		}

		if (empty($json)) {

			return curl_error($ch);
		} else {
			return $json;
		}
	}
}
