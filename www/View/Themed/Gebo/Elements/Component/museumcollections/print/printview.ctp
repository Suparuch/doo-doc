<?php

ini_set('memory_limit', '2048M');
set_time_limit(4000);
error_reporting(0);

$body = '';
$style = '
<style type="text/css">


/* Custom CSS code */
table {width:100%;border-spacing:0; border-collapse: collapse;}
ul {list-style-type: none; padding-left:0;}
/*body, input, textarea { font-family:TH SarabunPSK; font-size:12px; }*/
body, input, textarea { font-family: Tahoma, CordiaUPC; font-size: 11px; !important ; }
body { color:#464648; margin:2cm 1.5cm;
 }
h2 { color:#535255; font-size:16pt; font-weight:normal; line-height:1.2em; border-bottom:1px solid #DB4823; }
h3 { color:#ff0000; font-size:16pt; font-weight:bold; margin-bottom: 0em}
h4 { color:#9A9A9A; font-size:8pt; font-weight:normal; margin-bottom: 0em}

table th{padding:10px 0px 5px 0px}
table th.left,
table td.left { text-align:left; }
table th.center,
table td.center { text-align:center; }
table th.right,
table td.right { text-align:right; }

tr.border_top_header th {
  border-top:0.5pt solid black;
  padding-top :6px;
}

tr.border_bottom_header th{
  border-bottom:0.5pt solid black;
  padding-bottom :1px;
  height :0px;
}

tr.row_head_body td{
  height :0px;
}

tr.row_body td{
  padding-top :5px;
  padding-bottom :5px;
}

tr.row_comment td{
	line-height:30px;
}
.row_comment{
	line-height:20px;
}
tr.page_footer td {
  color:#000; font-size:8pt; font-weight:normal; margin-bottom: 0em
}

.section { margin-bottom: 1em; }
.logo { text-align: right; }
.logo-images { weight:90px;height:90px; }


.table-content{
    border-collapse:collapse;
}
.table-content tr td{
    text-align:center;
    padding:8px 5px 8px 5px;
}
</style>
';

//------------------------------------------------------------------------------------------------------------------


$header = '
<table border="0">
	<tr><td style="text-align:center;"><h3>&nbsp;</h3></td></tr>
</table>

<table>
	<tr>
		<td style="text-align:center;font-size:16px;padding:20px 0px 20px 0px;font-weight:bold;">ทะเบียนวัตถุพิพิธภัณฑ์ของ'.$Museum.'</td>
	</tr>
</table>
';
//------------------------------------------------------------------------------------------------------------------

$body = '<table class="table-content" border="1" style=";margin:0px !important;padding:0px !important;">';
$body .= '
<tr style="background:#efefef;">
			<td style="">ลำดับ</th>
			<td style="">เลขประจำ<br/>วัตถุ</th>
			<td style="">เลขอื่นที่เคยใช้</th>
                        <td style="">ชื่อวัตถุ</th>
                        <td style="width:500px;">ลักษณะวัตถุ</th>
                        <td style="">ประโยชน์ที่ใช้</th>
                        <td style="">สมัย/แบบ<br/>ศิลปวัตถุ</th>
                        <td style="">พ.ศ.ที่ขึ้น<br/>ทะเบียน</th>
                        <td style="">หมวดวัตถุ</th>
                        <td style="">ชนิดวัตถุ</th>
                        <td style="">ขนาด(ซม.)</th>
                        <td style="">สภาพ</th>
                        <td style="">ประวัติที่มา</th>
                        <td style="">วันที่<br/>รับวัตถุ<br/>เข้า</th>
                        <td style="">ผู้รับ</th>
                        <td style="">เลขประจำภาพ</th>
                        <td style="">ที่เก็บ</th>
                        <td style="">ผู้บันทึก</th>
                        <td style="">วันที่บันทึก</th>
                        <td style="">หมายเหตุ</th>
		</tr>
';

$rowNumm = 1;
foreach ($MuseumCollections as $MuseumCollection) {
    $body .= '<tr>';
    $body .= '  <td style="width:45px;">'.$this->TextUtil->thainumDigit($rowNumm).'</td>';
    $body .= '  <td style="width:;">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_no"]).'</td>';
    $body .= '  <td style="width:;">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_old_no"]).'</td>';
    $body .= '  <td style="width:;">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_name"]).'</td>';
    $body .= '  <td style="width:;">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_nature"]).'</td>';
    $body .= '  <td style="width:;">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_useful"]).'</td>';
    $body .= '  <td style="width:;">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_style"]).'</td>';
    $body .= '  <td style="width:;">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_dc_register"]).'</td>';
    $body .= '  <td style="width:;">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_category"]).'</td>';
    $body .= '  <td style="width:;">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_type"]).'</td>';
    $body .= '  <td style="width:;">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_dimension"]).'</td>';
    $body .= '  <td style="width:;">'.(($MuseumCollection["MuseumCollection"]["mc_condition"]=="0")?"ชำรุด":"สมบูรณ์").'</td>';
    $body .= '  <td style="width:;">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_history"]).'</td>';
    $body .= '  <td style="width:;">';
    $receiverDate = (!empty($MuseumCollection['MuseumCollection']['mc_receiver_date'])) ? $this->DateFormat->formatDateThai($MuseumCollection['MuseumCollection']['mc_receiver_date'], array('Y' => 'Y')) : "";
    $receiverDate = $this->TextUtil->thainumDigit($receiverDate);
    $body .= $receiverDate;
    $body .= '  </td>';
    $body .= '  <td style="width:;">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_receiver"]).'</td>';
    $body .= '  <td style="width:;">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_photo_no"]).'</td>';
    $body .= '  <td style="width:;">';
    $body .= $this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_location"]);
    if($MuseumCollection["MuseumCollection"]["mc_closet_no"] != "")
        $body .= " ตู้เลขที่ ".$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_closet_no"]);
    $body .= '  </td>';
    $body .= '  <td style="width:;">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_record"]).'</td>';
    $body .= '  <td style="width:;">';
    $recordDate = (!empty($MuseumCollection['MuseumCollection']['mc_record_date'])) ? $this->DateFormat->formatDateThai($MuseumCollection['MuseumCollection']['mc_record_date'], array('Y' => 'Y')) : "";
    $recordDate = $this->TextUtil->thainumDigit($recordDate);
    $body .= $recordDate;
    $body .= '  </td>';
    $body .= '  <td style="width:;">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_remark"]).'</td>';
    $body .= '</tr>';
    
    $rowNumm++;
}

$body .= '</table>';

//------------------------------------------------------------------------------------------------------------------
$footer = '<table>
	<tr class="page_footer">
		<td align="right">
			หน้า  {PAGENO} ของ  {nbpg} หน้า ' . str_repeat('&nbsp;', 25) . '
		</td>
	</tr>
	<tr>
		<td><center><h3>&nbsp;</h3></center></td>
	</tr>
</table>';

$html = $style . $body;
if (isset($_GET['debug']) && $_GET['debug'] == 1) {
    echo $header . $html . $footer;
    die();
}
//max 58
/**/
//==============================================================
//==============================================================
//==============================================================

include("libs/mpdf/mpdf.php");

//$mpdf=new mPDF('th', 'A4', '0', 'THSaraban',15, 15, 15, 15, 8, 8); 
//$mpdf = new mPDF('th', 'A4', '0', 'THSaraban', 15, 10, 45, 25, 10, 10);
$mpdf = new mPDF('th', 'A3-L', '0', 'THSaraban', 5, 5, 38, 20, 10, 10);

$mpdf->SetBasePath('https://doo-mis.zicure.com/');

$mpdf->debug = true;
$mpdf->ignore_invalid_utf8 = true;
$mpdf->showWatermarkText = true;
$mpdf->simpleTables = true;
$mpdf->packTableData = true;
//$mpdf->WriteHTML('<watermarktext content="สำเนา" alpha="0.1" />');

$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($html);

//$mpdf->AddPage();
//$mpdf->WriteHTML($html);
//$mpdf->AddPage();
//$mpdf->WriteHTML($html);
//$mpdf->AddPage();
//$mpdf->WriteHTML($html);
//$mpdf->Output('D:\xampp\htdocs\afkair.local\office\app\webroot\files\Quotations/testcake.pdf');
$mpdf->Output();
exit;
?>