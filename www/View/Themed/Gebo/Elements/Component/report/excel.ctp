<?php
//ideafunction.com
 
//include ("Vendor/PHPExcel/PHPExcel.php");
App::import('Vendor', 'PHPExcel/PHPExcel');
// สร้าง object ของ Class  PHPExcel  ขึ้นมาใหม่
$objPHPExcel = new PHPExcel();
 
// กำหนดค่าต่างๆ
$objPHPExcel->getProperties()->setCreator("RTA");
$objPHPExcel->getProperties()->setLastModifiedBy("RTA");
$objPHPExcel->getProperties()->setTitle("บัญชีรายชื่อนายทหารสัญญาบัตรย้ายประเภท");
$objPHPExcel->getProperties()->setSubject("บัญชีรายชื่อนายทหารสัญญาบัตรย้ายประเภท");
$objPHPExcel->getProperties()->setDescription("บัญชีรายชื่อนายทหารสัญญาบัตรย้ายประเภท");

//Set Page
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

//Set Paper
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

//Page margins // กำหนดระยะขอบ
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.2); // กำหนดระยะขอบ บน
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.2); // กำหนดระยะขอบ ขวา
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.2); // กำหนดระยะขอบ ซ้าย
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.2); // กำหนดระยะขอบ ล่าง

//$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTop(array(1,4));

// เพิ่มข้อมูลเข้าใน Cell
$objPHPExcel->setActiveSheetIndex(0);
//------------------------------------------------------------------------
//Config Merge
$objPHPExcel->getActiveSheet()->mergeCells('A1:M1');
$objPHPExcel->getActiveSheet()->mergeCells('K2:L2');
$objPHPExcel->getActiveSheet()->mergeCells('B3:D3');

//Config Width
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(21);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(23);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(49);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(16);

//------------------------------------------------------------------------
//Header
//row1
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'บัญชีรายชื่อนายทหารสัญญาบัตรย้ายประเภทใน 1 ม.ค. 57');

//row2
$objPHPExcel->getActiveSheet()->SetCellValue('K2', 'ย้ายประเภทเป็น');

//row3');
$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'ลำดับ');
$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'ยศ - ชื่อ - สกุล');
//$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'ชื่อ');
//$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'นามกสุล');
$objPHPExcel->getActiveSheet()->SetCellValue('E3', 'วัน');
$objPHPExcel->getActiveSheet()->SetCellValue('F3', 'เดือน');
$objPHPExcel->getActiveSheet()->SetCellValue('G3', 'ปีเกิด');

$objPHPExcel->getActiveSheet()->SetCellValue('H3', 'เลขประจำตัว');
$objPHPExcel->getActiveSheet()->SetCellValue('I3', 'เหล่า');
$objPHPExcel->getActiveSheet()->SetCellValue('J3', 'ประเภทนายทหารสัญญาบัตร');
$objPHPExcel->getActiveSheet()->SetCellValue('K3', 'นายทหาร ');
$objPHPExcel->getActiveSheet()->SetCellValue('L3', 'นายทหาร ');
$objPHPExcel->getActiveSheet()->SetCellValue('M3', 'หมายเหตุ');

//row4
$objPHPExcel->getActiveSheet()->SetCellValue('K4', 'นอกราชการ');
$objPHPExcel->getActiveSheet()->SetCellValue('L4', 'พ้นราชการ');

//------------------------------------------------------------------------
//Data
for($i=5;$i<=100;$i++){

	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, $i);
	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, $i);
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, $i);
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, $i);
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, $i);
	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, $i);
	$objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, $i);
	$objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, $i);
	$objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, $i);
	$objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, $i);
	$objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, $i);
	$objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, $i);
	$objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, $i);

}
$row_count = $i-1;

$objPHPExcel->getActiveSheet()->SetCellValue('J'.($row_count+3), 'ตรวจถูกต้อง');
$objPHPExcel->getActiveSheet()->SetCellValue('J'.($row_count+5), '(                                          )');


//------------------------------------------------------------------------
//Config Font
$objPHPExcel->getActiveSheet()->getStyle("A1:M".($row_count+10))->getFont()
				//->setBold(true)
                                ->setName('AngsanaUPC')
                                ->setSize(17);
                                //->getColor()->setRGB('6F6F6F');
//Config vAlign
$objPHPExcel->getActiveSheet()->getStyle("A1:M".$row_count)->getAlignment()
				->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

//Config Align
$objPHPExcel->getActiveSheet()->getStyle("A1:M4")->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("A5:M".$row_count)->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle("A5:A".$row_count)->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("E5:I".$row_count)->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("J".($row_count+3).":J".($row_count+6))->getAlignment()
				->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

//Config Border
//$objPHPExcel->getActiveSheet()->getStyle("A5:M".$row_count)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
//$objPHPExcel->getActiveSheet()->getStyle("A2:J3")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_NONE);

$styleArray = array(
      //'font' => array(
      //  'name' => 'Arial',
      //  'size' => '8',
      //),
      'borders' => array(
        'left' => array(
          'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
        ),
        'right' => array(
          'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
        ),
        'bottom' => array(
          'style' => PHPExcel_Style_Border::BORDER_NONE,
        ), 
      ),
      //'fill' => array(
      //  'type' => PHPExcel_Style_Fill::FILL_SOLID,
      //  'startcolor' => array(
      //  'argb' => 'FFFFFFCC',
      //),
      //),
    );
$objPHPExcel->getActiveSheet()->getStyle("A2:A".$row_count)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle("B2:D".$row_count)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle("E2:G".$row_count)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle("H2:H".$row_count)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle("J2:J".$row_count)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle("K2:K".$row_count)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle("L2:L".$row_count)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle("M2:M".$row_count)->applyFromArray($styleArray);

$styleArray = array(
      'borders' => array(
        'top' => array(
          'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
        ),
      ),
    );
$objPHPExcel->getActiveSheet()->getStyle("A2:M2")->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle("A5:M5")->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle("K3:K3")->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle("L3:L3")->applyFromArray($styleArray);
$row_count++;
$objPHPExcel->getActiveSheet()->getStyle("A".$row_count.":M".$row_count)->applyFromArray($styleArray);

//Config Height
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(38);
//------------------------------------------------------------------------

// ตั้งชื่อ Sheet
$objPHPExcel->getActiveSheet()->setTitle('Sheet1');

$filename = iconv('UTF-8','TIS-620','บัญชีรายชื่อนายทหารสัญญาบัตรย้ายประเภท');
//------------------------------------------------------------------------
// บันทึกไฟล์ Excel 2007
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//$objWriter->save('files/ideafunction_phpexcel_demo1.xls'); //ชื่อไฟล์ เมื่อมีการเรียกไฟล์นี้ทำงานก็จะทำการสร้าง ไฟล์ไว้ใน ตำแหน่งของที่กำหนดชื่อไฟล์

header('Content-type: application/ms-excel;');
header('Content-Disposition: attachment; filename="'.$filename.'.xls"');
$objWriter->save('php://output');

//------------------------------------------------------------------------
// บันทึกไฟล์ Pdf
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');

//header('Content-type: application/pdf;');
//header('Content-Disposition: attachment; filename="'.$filename.'.pdf"');
//$objWriter->save('php://output');
//------------------------------------------------------------------------

//echo "สร้างเสร็จแล้วครับ<br/>";
//echo "<a href=\"ideafunction_phpexcel_demo1.xls\">DownloadFile</a>"
?>