<?php

ini_set('memory_limit', '2048M');
set_time_limit(4000);
error_reporting(0);

$secretText = "";
switch ($con_secret) {
    case "9":
        $secretText = "ไม่ระบุ";
        break;
    case "1":
        $secretText = "ลับ";
        break;
    case "0":
        $secretText = "&nbsp;";
        break;
}



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
    padding:5px;
}
</style>
';

//------------------------------------------------------------------------------------------------------------------


$header = '
<table border="0">
	<tr><td style="text-align:center;"><h3>' . $secretText . '</h3></td></tr>
</table>

<table>
	<tr>
		<td style="text-align:center;font-size:16px;padding:20px 0px 20px 0px;font-weight:bold;">จดหมายเหตุ ทบ.<br/><div>เดือน ' . $con_month_name . ' ' . $con_year_th . '</div></td>
	</tr>
</table>
<table border="1" style="border-collapse:collapse;margin:0px !important;padding:0px !important;">
		<tr style="background:#efefef;">
			<th style="width:20%;">วัน,เดือน,ปี</th>
			<th style="width:60%;">เหตุการณ์</th>
			<th style="width:20%;">หลักฐาน</th>
		</tr>
</table>
';
//------------------------------------------------------------------------------------------------------------------

$body = '<table class="table-content" border="1" style=";margin:0px !important;padding:0px !important;">';

foreach ($Memorandums as $Memorandum) {
    $body .= '<tr>';
    $body .= '  <td style="width:20%;">';

    $datePeriod = '';
    if ($Memorandum['Memorandum']['memo_date_type'] == "D")
        $datePeriod = (!empty($Memorandum['Memorandum']['memo_date_start'])) ? $this->DateFormat->formatDateThai($Memorandum['Memorandum']['memo_date_start'], array('Y' => 'Y')) : "";
    else
        $datePeriod = ((!empty($Memorandum['Memorandum']['memo_date_start'])) ? $this->DateFormat->formatDateThai($Memorandum['Memorandum']['memo_date_start'], array('Y' => 'Y')) : "") . " - " . ((!empty($Memorandum['Memorandum']['memo_date_end'])) ? $this->DateFormat->formatDateThai($Memorandum['Memorandum']['memo_date_end'], array('Y' => 'Y')) : "");
    $datePeriod = $this->TextUtil->thainumDigit($datePeriod);
    $body .= $datePeriod;

    $body .= '</td>';
    $body .= '  <td style="width:60%;">' . $this->TextUtil->thainumDigit($Memorandum['Memorandum']['event']) . '</td>';
    $body .= '  <td style="width:20%;">' . $this->TextUtil->thainumDigit($Memorandum['Memorandum']['evidence']) . '</td>';
    $body .= '</tr>';
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
		<td><center><h3>' . $secretText . '</h3></center></td>
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
$mpdf = new mPDF('th', 'A4', '0', 'dejavusanscondensed', 15, 10, 46, 25, 10, 10);

$mpdf->SetBasePath('https://doo-mis.zicure.com/');
/*
$mpdf->debug = false;
$mpdf->ignore_invalid_utf8 = true;
$mpdf->showWatermarkText = true;
$mpdf->simpleTables = true;
$mpdf->packTableData = true;
$mpdf->cacheTables = true;*/
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