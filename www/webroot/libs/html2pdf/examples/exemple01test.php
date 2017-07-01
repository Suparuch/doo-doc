<?php

ini_set('memory_limit', '2048M');
set_time_limit(4000);
error_reporting(0);


//require_once(dirname(__FILE__) . '/../html2pdf.class.php');
require_once(dirname(__FILE__) . '/../html2pdf.class.php');

$html2pdf = new HTML2PDF('L', 'A4', 'en');

$x = dirname(__FILE__) . '/../html2pdf.class.php';

$html2pdf->pdf->SetDisplayMode('fullpage');

$html2pdf->pdf->SetFont('thsarabun', '', 33); //ภาษาไทยใช้ได้
$html2pdf->writeHTML('<page style="font-family:thsarabun;font-size:33px;">'.$x.'</page>');
$html2pdf->Output('mydoc.pdf');
