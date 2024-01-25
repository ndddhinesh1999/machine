<?php
require_once('../../includes/utility_function.php');
require_once('../../includes/config.php');

require_once 'model.php';


error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
 

if (PHP_SAPI == 'cli')
	die('This Report should only be run from a Web Browser');

	
/** Include PHPExcel */
require_once  '../../includes/PHPExcel/Classes/PHPExcel.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator('')
	->setLastModifiedBy('')
	->setTitle("Office 2007 XLSX Test Document")
	->setSubject("Office 2007 XLSX Test Document")
	->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
	->setKeywords("office 2007 openxml php")
	->setCategory("Report file");



$styleArray = array(
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	)
);


$row = 2;

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . $row . ":" . 'G' . $row);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $row, PROJECT_NAME);

$objPHPExcel->getActiveSheet()->getStyle('A' . $row)->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(0)->getStyle('A' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$row = $row + 1;

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . $row . ":" . 'G' . $row);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $row, 'AppLogReport for  ' . $_REQUEST['from_date'] . ' To ' . $_REQUEST['to_date']);

$objPHPExcel->getActiveSheet()->getStyle('A' . $row)->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(0)->getStyle('A' . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$row = $row + 1;



$row++;

$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
$objPHPExcel->setActiveSheetIndex(0)

	->setCellValue('A' . $row, 'Sl No')
	->setCellValue('B' . $row, 'DATE')
	->setCellValue('C' . $row, 'EMP ID')
	->setCellValue('D' . $row, 'BRANCH')
	->setCellValue('E' . $row, 'NAME')
	->setCellValue('F' . $row, 'DESIGNATION')
    ->setCellValue('G' . $row, 'IN TIME')
    ->setCellValue('H' . $row, 'OUT TIME');



$arr = createDateRangeArray(dateDatabaseFormat($_REQUEST['from_date']), dateDatabaseFormat($_REQUEST['to_date']));

$objPHPExcel->getActiveSheet()->getStyle('A' . $row . ":" . $cl . $row)->applyFromArray($styleArray);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A' . $row . ":" . $cl . $row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$row = $row + 1;

$cl = 'I';

$col_cnt = 1;


$col_cnt = $col_cnt + 1;

							


$start = $row;

$objPHPExcel->getActiveSheet()->freezePane('I' . $row);

$conn = $connection;
$db = DATABASE;
require_once 'model.php';
//$arr_data = listEmployee();
$arr_data = listAppAttendanceReport();



$date = "";

if (count($arr_data) > 0) {
	$s_no = 1;
	foreach ($arr_data as $record_payroll) {
		
		if ($date != $record_payroll['attendance_detail_date']) {
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $row++, dateGeneralFormat($record_payroll['attendance_detail_date']));
			$date = $record_payroll['attendance_detail_date'];
		}
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A' . $row, $s_no)
			->setCellValue('B' . $row, dateGeneralFormat($record_payroll['attendance_detail_date']))
			->setCellValue('C' . $row, ucwords($record_payroll['employee_no']))
			->setCellValue('D' . $row, ucwords($record_payroll['branch_name']))
			->setCellValue('E' . $row, ucwords($record_payroll['employee_name']))
			->setCellValue('F' . $row, ucwords($record_payroll['designation_name']))
			->setCellValue('G' . $row, ucwords($record_payroll['in_time']))
			->setCellValue('H' . $row, ucwords($record_payroll['out_time']));

	
		$cl = 'I';
		// $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ":" . $cl . $row)->applyFromArray($styleArray);
		$row = $row + 1;
		$s_no = $s_no + 1;
	}
}

$row = $row + 3;




for ($i = 1, $j = 'B'; $i <= $col_cnt; $i++, $j++) {
	$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($j)->setAutoSize(true);
}





// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('AppLogReport');
$output_file_name = "AppLogReport.xlsx";


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);



// Save Excel 2007 file
#echo date('H:i:s') . " Write to Excel2007 format\n";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
// We'll be outputting an excel file
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// It will be called file.xls
header('Content-Disposition: attachment; filename="AppLogReport.xlsx"');
$objWriter->save('php://output');
exit;
