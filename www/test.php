<?php
require_once('C:/wamp/www/bend/PHPExcelReader/PHPExcel/IOFactory.php');
$inputFileName = 'C:\wamp\bend\file_storage\AMRL Equipment Calibrations\2015 Equipment Calibrations\2015 Aggregate Calibration Sheets.xlsx';  // File to read
echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}


echo '<hr />';
echo "<pre>";
$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

echo '<input type="text" name="filepath" placeholder="FILEPATH">';
echo '<input type="submit" name="file">';

foreach($sheetData as $rec)
{
	print_r($rec);
}

?>
