<?php
//ideafunction.com
 
//include ("Vendor/PHPExcel/PHPExcel.php");
App::import('Vendor', 'PHPExcel/PHPExcel');
// สร้าง object ของ Class  PHPExcel  ขึ้นมาใหม่
$objPHPExcel = new PHPExcel();
 
// กำหนดค่าต่างๆ
$objPHPExcel->getProperties()->setCreator("www.ideafunction.com");
$objPHPExcel->getProperties()->setLastModifiedBy("www.ideafunction.com");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
 
// เพิ่มข้อมูลเข้าใน Cell
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->SetCellValue('B2', 'สวัสดีครับ B2');
$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'สวัสดีครับ B3');
$objPHPExcel->getActiveSheet()->SetCellValue('B4', 'สวัสดีครับ B4');
$objPHPExcel->getActiveSheet()->SetCellValue('B5', 'สวัสดีครับ B5');
 
// ตั้งชื่อ Sheet
$objPHPExcel->getActiveSheet()->setTitle('www.ideafunction.com');
 
// บันทึกไฟล์ Excel 2007
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('files/ideafunction_phpexcel_demo1.xls'); //ชื่อไฟล์ เมื่อมีการเรียกไฟล์นี้ทำงานก็จะทำการสร้าง ไฟล์ไว้ใน ตำแหน่งของที่กำหนดชื่อไฟล์
 
echo "สร้างเสร็จแล้วครับ<br/>";
echo "<a href=\"ideafunction_phpexcel_demo1.xls\">DownloadFile</a>"
?>