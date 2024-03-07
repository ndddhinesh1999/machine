<?php
include "../../includes/config.php";
include "../../includes/utility_function.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$path = substr(ACTIVE_PATH, 0, 9);
if ($path == 'localhost') {
    require_once __DIR__ . '../../../includes/Mpdf/autoload.php';
} else {
    require_once __DIR__ . '/vendor/autoload.php';
}

$mpdf = new \Mpdf\Mpdf();

require "model.php";
$file_name = 'Machine Detail';
$machine = machine_detail();
$get = editmachine();

$listCompany = listCompany();

$mpdf->SetHTMLHeader();

$mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="33%">{DATE j-m-Y}</td>
        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right;">' . $file_name . '</td>
    </tr>
</table>');

include 'pdf-view.php';

$template = ob_get_contents();
$stylesheet = file_get_contents(PROJECT_PATH . "/src/assets/css/pdf-table-style.css");
ob_end_clean();
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($template, \Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->Output($file_name . date("d/m/Y") . '.pdf', 'I');

// $mpdf->WriteHTML('Hello World');

$mpdf->Output();
