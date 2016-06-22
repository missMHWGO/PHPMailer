<?php
	require_once 'phpexcel/PHPExcel.php';
	header("Content-type: text/html; charset=utf-8");

	$filename = "contact2.xls";
	$objReader = PHPExcel_IOFactory::createReaderForFile($filename);
	$objPHPExcel = $objReader->load($filename);

	$column = 'C';
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
		$lastRow = $worksheet->getHighestRow();
		for ($row = 2; $row <= $lastRow; $row++) {
		    $cell = $worksheet->getCell($column.$row);
		    if ($cell != "") {
		    	echo $cell.'<br>';
		    }
		}
	}
	

	
?>
