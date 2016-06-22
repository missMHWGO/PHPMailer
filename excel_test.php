<?php

require_once 'phpexcel/PHPExcel.php';
header("Content-type: text/html; charset=utf-8");

$filename = "contact.xls";
$objReader = PHPExcel_IOFactory::createReaderForFile($filename);
$objPHPExcel = $objReader->load($filename);
$objPHPExcel->setActiveSheetIndex(0);
$date = $objPHPExcel->getActiveSheet()->getCell('C5')->getValue();
echo $date;

?>