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
/*body, input, textarea { font-family: TH SarabunPSK !important;  }*/
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
    border-collapse:collapse;width:100%;
}
.table-content td{
    padding:10px;
}
.txtbold{font-weight:bold;}
</style>
';

//------------------------------------------------------------------------------------------------------------------


$header = '
<table border="0">
	<tr><td style="text-align:center;"><h3>&nbsp;</h3></td></tr>
</table>

<table>
	<tr>
		<td style="text-align:center;font-size:16px;padding:20px 0px 20px 0px;font-weight:bold;">ทะเบียนโบราณวัตถุ ศิลปวัตถุ</td>
	</tr>
</table>
';
//------------------------------------------------------------------------------------------------------------------

$body = '
<table class="table-content" border="1">
	<tr>
		<td style="width:20%;" class="txtbold">หน่วย</td>
		<td style="width:30%">'.$this->TextUtil->thainumDigit($default['mc_museum']).'</td>
		<td style="width:20%" class="txtbold">พ.ศ.ที่ขึ้นทะเบียน</td>
		<td style="width:30%">' . $this->TextUtil->thainumDigit($default['mc_dc_register']) . '</td>
	</tr>
		<tr>
		<td class="txtbold">เลขทะเบียน</td>
		<td>' . $this->TextUtil->thainumDigit($default['mc_no']) . '</td>
		<td class="txtbold">หมวดวัตถุ</td>
		<td>' . $this->TextUtil->thainumDigit($default['mc_category']) . '</td>
	</tr>
		<tr>
		<td class="txtbold">ชื่อวัตถุ</td>
		<td>' . $this->TextUtil->thainumDigit($default['mc_name']) . '</td>
		<td class="txtbold">ชนิดวัสดุ</td>
		<td>' . $this->TextUtil->thainumDigit($default['mc_type']) . '</td>
	</tr>
	<tr>
		<td class="txtbold">สมัย/แบบศิลปะ</td>
		<td>' . $this->TextUtil->thainumDigit($default['mc_style']) . '</td>
		<td class="txtbold">ขนาด(ซ.ม.)</td>
		<td>' . $this->TextUtil->thainumDigit($default['mc_dimension']) . '</td>
	</tr>

	<tr>
		<td valign="top" class="txtbold">ภาพวัตถุ</td>
		<td colspan="3">';

$photo = '';

if (count($TableAttachFiles) > 0) {
    $photo .= "<table border='1' style='width:100%;'><tr>";
    
    
    
    
    foreach ($TableAttachFiles as $TableAttachFile) {
        if ($TableAttachFile['TableAttachFile']['id'] == $default['mc_file_id']) {
            $photo .= "<td valign='top'>";
            $photo .= '<img src="files/museum_collections/' . $TableAttachFile['TableAttachFile']['file_name'] . '" style="width:200px;" />';
            $photo .= "</td><td valign='top'>";
        }
    }
    foreach ($TableAttachFiles as $TableAttachFile) {
        if ($TableAttachFile['TableAttachFile']['id'] != $default['mc_file_id']) {
            $photo .= '<img src="files/museum_collections/' . $TableAttachFile['TableAttachFile']['file_name'] . '" style="width:110px;margin-right:10px;margin-bottom:10px;object-fit:cover;height:80px;" />';
        }
    }
    
    
    
    
    $photo .= "</td></tr></table>";
}

$body .= $photo;
$body .= '
            </td>
	</tr>
	<tr>
		<td valign="top" class="txtbold">เลขประจำภาพ</td>
		<td colspan="3">' . $this->TextUtil->thainumDigit($default['mc_photo_no']) . '</td>
	</tr>
	<tr>
		<td valign="top" class="txtbold">ลักษณะวัตถุ</td>
		<td colspan="3">' . $this->TextUtil->thainumDigit($default['mc_nature']) . '</td>
	</tr>
	<tr>
		<td valign="top" class="txtbold">ประวัติวัตถุ</td>
		<td colspan="3">
			วันที่รับเข้าวัตถุ : ';
$receiverDate = (!empty($default['mc_receiver_date'])) ? $this->DateFormat->formatDateThai($default['mc_receiver_date'], array('Y' => 'Y')) : "";
$receiverDate = $this->TextUtil->thainumDigit($receiverDate);
$body .= $receiverDate;

$body .= '
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        ผู้รับเข้า :  ' . $this->TextUtil->thainumDigit($default['mc_receiver']) . '
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
		<td valign="top"></td>
		<td colspan="3">'.$this->TextUtil->thainumDigit($default['mc_history']).'</td>
	</tr>
	<tr>
		<td valign="top" class="txtbold">สภาพวัตถุ</td>
		<td colspan="3">' . (($default["mc_condition"] == "0") ? "ชำรุด" : "สมบูรณ์") . '</td>
	</tr>
	<tr>
		<td valign="top" class="txtbold">สถานที่เก็บวัตถุ</td>
		<td colspan="3">';
$body .= $this->TextUtil->thainumDigit($default["mc_location"]);
if ($default["mc_closet_no"] != "")
    $body .= " ตู้เลขที่ " . $this->TextUtil->thainumDigit($default["mc_closet_no"]);
$body .= '
                </td>
	</tr>
	<tr>
		<td valign="top" class="txtbold">หมายเหตุ</td>
		<td colspan="3">' . $this->TextUtil->thainumDigit($default['mc_remark']) . '</td>
	</tr>
	<tr>
		<td class="txtbold">ผู้บันทึก</td>
		<td>' . $this->TextUtil->thainumDigit($default['mc_record']) . '</td>
		<td class="txtbold">วันที่บันทึก</td>
		<td>';
$recordDate = (!empty($default['mc_record_date'])) ? $this->DateFormat->formatDateThai($default['mc_record_date'], array('Y' => 'Y')) : "";
$recordDate = $this->TextUtil->thainumDigit($recordDate);
$body .= $recordDate;
$body .= '
            </td>
	</tr>
</table>
';


//------------------------------------------------------------------------------------------------------------------
$footer = '';

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
$mpdf = new mPDF('th', 'A4', '0', 'THSaraban', 20, 20, 35, 25, 10, 10);//TH SarabunPSK

$mpdf->SetBasePath('https://doo-mis.zicure.com/');

//$mpdf->debug = true;
//$mpdf->ignore_invalid_utf8 = true;
//$mpdf->showWatermarkText = true;
//$mpdf->simpleTables = true;
//$mpdf->packTableData = true;
//$mpdf->WriteHTML('<watermarktext content="สำเนา" alpha="0.1" />');
$mpdf->SetDefaultFont('THSaraban');
$mpdf->SetDefaultFontSize(11);

$mpdf->useDictionaryLBR = false;

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