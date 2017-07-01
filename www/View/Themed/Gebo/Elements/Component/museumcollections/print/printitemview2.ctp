<?php

ini_set('memory_limit', '2048M');
set_time_limit(4000);
error_reporting(0);

// -------------------------------
$body = '';
$style = '
<style type="text/css">

/*table {width:100%;border-spacing:0; border-collapse: collapse;}*/
ul {list-style-type: none; padding-left:0;}
body, input, textarea,table { font-family: thsarabun;font-size:15pt;  }

.table-content{
    border-collapse:collapse;width:100%;
}
.table-content td{
    padding:5px;
}
.txtbold{font-weight:bold;}
.coldata{word-wrap:break-word;}

table.page_header {width: 100%; border: none;padding: 2mm; top: 1cm;}
table.page_footer {width: 100%; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}
    
</style>
';

//------------------------------------------------------------------------------------------------------------------


$header = '
    <page_header>
<table class="page_header">
            <tr>
                <td style="width: 100%; text-align: center;font-family:thsarabun;font-size:20pt;font-weight:bold;">
                    ทะเบียนโบราณวัตถุ ศิลปวัตถุ
                </td>
            </tr>
        </table>
</page_header>
';
//------------------------------------------------------------------------------------------------------------------

$body = '
<table class="table-content" border="1" style="width:100%;">
	<tr>
		<td style="width:20%;" class="txtbold" valign="top">หน่วย</td>
		<td class="coldata" style="width:30%;" valign="top">' . $this->TextUtil->thainumDigit($default['mc_museum']) . '</td>
		<td style="width:20%" class="txtbold" valign="top">พ.ศ.ที่ขึ้นทะเบียน</td>
		<td class="coldata" style="width:30%;" valign="top">' . $this->TextUtil->thainumDigit($default['mc_dc_register']) . '</td>
	</tr>
		<tr>
		<td class="txtbold" valign="top">เลขทะเบียน</td>
		<td class="coldata" style="width:30%;" valign="top">' . $this->TextUtil->thainumDigit($default['mc_no']) . '</td>
		<td class="txtbold" valign="top">หมวดวัตถุ</td>
		<td class="coldata" style="width:30%;">' . $this->TextUtil->thainumDigit($default['mc_category']) . '</td>
	</tr>
		<tr>
		<td class="txtbold" valign="top">ชื่อวัตถุ</td>
		<td class="coldata" style="width:30%;" valign="top">' . $this->TextUtil->thainumDigit($default['mc_name']) . '</td>
		<td class="txtbold" valign="top">ชนิดวัตถุ</td>
		<td class="coldata" style="width:30%;" valign="top">' . $this->TextUtil->thainumDigit($default['mc_type']) . '</td>
	</tr>
	<tr>
		<td class="txtbold" valign="top">สมัย/แบบศิลปะ</td>
		<td class="coldata" style="width:30%;">' .$this->TextUtil->thainumDigit($default['mc_style']) . '</td>
		<td class="txtbold" valign="top">ขนาด(ซ.ม.)</td>
		<td class="coldata" style="width:30%;" valign="top">' . $this->TextUtil->thainumDigit($default['mc_dimension']) . '</td>
	</tr>

	<tr>
		<td valign="top" class="txtbold">ภาพวัตถุ</td>
		<td colspan="3">';

$photo = '';

if (count($TableAttachFiles) > 0) {
    $photo .= "<table border='0' style='width:100%;min-height:100px;'><tr>";

    foreach ($TableAttachFiles as $TableAttachFile) {
        if ($TableAttachFile['TableAttachFile']['id'] == $default['mc_file_id']) {
            $photo .= "<td valign='top' width='180'>";
            $photo .= '<img src="files/museum_collections/' . $TableAttachFile['TableAttachFile']['file_name'] . '" style="width:200px;" />';
            $photo .= "</td><td valign='top' width='240'>";
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
		<td colspan="3" class="coldata" style="width:80%">' . $this->TextUtil->thainumDigit($default['mc_nature']) . '</td>
	</tr>
	<tr>
		<td valign="top" class="txtbold">ประวัติวัตถุ</td>
		<td colspan="3" class="coldata" style="width:80%;padding:0px;">
                
                    <table border="1" style="width:100%;border-collapse:collapse;margin:0px;">
                        <tr>
                            <td style="width:20%;border-top:none;border-bottom:none;border-left:none;">วันที่รับเข้าวัตถุ</td>
                            <td style="width:30%;border-top:none;border-bottom:none;">
                            ';
        

$receiverDate = (!empty($default['mc_receiver_date'])) ? $this->DateFormat->formatDateThai($default['mc_receiver_date'], array('Y' => 'Y')) : "";
$receiverDate = $this->TextUtil->thainumDigit($receiverDate);
$body .= $receiverDate;

$body .= '                            
                            </td>
                            <td style="width:13%;border-top:none;border-bottom:none;">ผู้รับเข้า</td>
                            <td style="width:37%;border-top:none;border-bottom:none;border-right:none;">'.$this->TextUtil->thainumDigit($default['mc_receiver']).'</td>
                        </tr>
                    </table>
		</td>
	</tr>
	<tr>
		<td valign="top"></td>
		<td colspan="3" class="coldata" style="width:80%">' . $this->TextUtil->thainumDigit($default['mc_history']) . '</td>
	</tr>
	<tr>
		<td valign="top" class="txtbold">สภาพวัตถุ</td>
		<td colspan="3" class="coldata" style="width:80%">' . (($default["mc_condition"] == "0") ? "ชำรุด" : "สมบูรณ์") . '</td>
	</tr>
	<tr>
		<td valign="top" class="txtbold">สถานที่เก็บวัตถุ</td>
		<td colspan="3" class="coldata" style="width:80%">';
$body .= $this->TextUtil->thainumDigit($default["mc_location"]);
if ($default["mc_closet_no"] != "")
    $body .= " ตู้เลขที่ " . $this->TextUtil->thainumDigit($default["mc_closet_no"]);
$body .= '
                </td>
	</tr>
	<tr>
		<td valign="top" class="txtbold">หมายเหตุ</td>
		<td colspan="3" class="coldata" style="width:80%">' . $this->TextUtil->thainumDigit($default['mc_remark']) . '</td>
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
$footer = '<page_footer></page_footer>';

$html = '<page backtop="18mm" backbottom="4mm" backleft="10mm" backright="10mm" style="font-size: 16pt">' . $header . $style . $body . $footer . '</page>';



if (isset($_GET['debug']) && $_GET['debug'] == 1) {
    echo $html;
    die();
}

// -------------------------------

require_once(dirname(__FILE__) . '/../../../../../../../webroot/libs/html2pdf/html2pdf.class.php');

try {
    $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8', array(10, 20, 10, 10));



    $html2pdf->pdf->SetDisplayMode('fullpage');

    $html2pdf->pdf->SetFont('thsarabun', '', 16); //ภาษาไทยใช้ได้
    $html2pdf->writeHTML($html);
    $html2pdf->Output('ItemCard.pdf');
    exit;
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}