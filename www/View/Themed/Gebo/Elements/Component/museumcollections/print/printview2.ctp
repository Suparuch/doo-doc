<?php

ini_set('memory_limit', '2048M');
set_time_limit(4000);
error_reporting(0);

$body = '';
$style = '
<style type="text/css">

ul {list-style-type: none; padding-left:0;}
body, input, textarea,table { font-family: thsarabun;font-size:16pt;  }

.table-content{
    border-collapse:collapse;width:100%;
}
.table-content th{
    padding:5px;
    text-align:center;
}
.table-content td{
    padding:5px;
    text-align:center;
}
.txtbold{font-weight:bold;}
.coldata{word-wrap:break-word;}

table.page_header {width:99%;border: none;top: 0cm;border-collapse:collapse;margin-left:20px;margin-right:20px;padding-top:11px;}
table.page_footer {width: 100%; border: none; padding: 2mm}
    
</style>
';

//------------------------------------------------------------------------------------------------------------------

$header = '
    <page_header>
        <table class="page_header">
            <tr>
                <td style="width: 100%; text-align: center;font-family:thsarabun;font-size:20pt;font-weight:bold;">                    
                    <span style="font-size:23pt;font-weight:bold;color:#ff0000;">&nbsp;</span>
                </td>
             </tr>
             <tr>
                <td style="text-align:center;padding-top:15px;font-size:20pt;font-weight:bold;">
                    ทะเบียนวัตถุพิพิธภัณฑ์ของ'.$Museum.'
                </td>
             </tr>
             <tr>
             <td style="height:12px;"></td>
            </tr>
        </table>
</page_header>
';

//------------------------------------------------------------------------------------------------------------------

$body = '<table class="table-content" border="1" style="margin:0px !important;padding:0px !important;">';
$body .= '
<tr style="background:#efefef;">
			<th style="width:2%">ลำดับ</th>
			<th style="width:4%">เลขประจำ<br/>วัตถุ</th>
			<th style="width:4%">เลขอื่นที่ใช้</th>
                        <th style="width:7%">ชื่อวัตถุ</th>
                        <th style="width:15%">ลักษณะวัตถุ</th>
                        <th style="width:8%">ประโยชน์ที่ใช้</th>
                        <th style="width:6%">สมัย/แบบ<br/>ศิลปวัตถุ</th>
                        <th style="width:3%">พ.ศ.ที่ขึ้น<br/>ทะเบียน</th>
                        <th style="width:5%">หมวดวัตถุ</th>
                        <th style="width:3%">ชนิดวัตถุ</th>
                        <th style="width:3%">ขนาด(ซม.)</th>
                        <th style="width:3%">สภาพ</th>
                        <th style="width:5%">ประวัติที่มา</th>
                        <th style="width:3%">วันที่<br/>รับเข้า<br/>วัตถุ</th>
                        <th style="width:4%">ผู้รับ</th>
                        <th style="width:5%">เลขประจำภาพ</th>
                        <th style="width:5%">ที่เก็บ</th>
                        <th style="width:4%">ผู้บันทึก</th>
                        <th style="width:3%">วันที่บันทึก</th>
                        <th style="width:8%">หมายเหตุ</th>
		</tr>
';

$rowNumm = 1;
foreach ($MuseumCollections as $MuseumCollection) {
    $body .= '<tr>';
    $body .= '  <td style="width:2%;" valign="top" class="coldata">'.$this->TextUtil->thainumDigit($rowNumm).'</td>';
    $body .= '  <td style="width:4%;" valign="top" class="coldata">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_no"]).'</td>';
    $body .= '  <td style="width:4%;" valign="top" class="coldata">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_old_no"]).'</td>';
    $body .= '  <td style="width:7%;" valign="top" class="coldata">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_name"]).'</td>';
    $body .= '  <td style="width:15%;word-wrap:break-word;;" valign="top" class="coldata">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_nature"]).'</td>';
    $body .= '  <td style="width:8%;" valign="top" class="coldata">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_useful"]).'</td>';
    $body .= '  <td style="width:6%;" valign="top" class="coldata">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_style"]).'</td>';
    $body .= '  <td style="width:3%;" valign="top" class="coldata">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_dc_register"]).'</td>';
    $body .= '  <td style="width:5%;" valign="top" class="coldata">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_category"]).'</td>';
    $body .= '  <td style="width:3%;" valign="top" class="coldata">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_type"]).'</td>';
    $body .= '  <td style="width:3%;" valign="top" class="coldata">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_dimension"]).'</td>';
    $body .= '  <td style="width:3%;" valign="top" class="coldata">'.(($MuseumCollection["MuseumCollection"]["mc_condition"]=="0")?"ชำรุด":"สมบูรณ์").'</td>';
    $body .= '  <td style="width:5%;" valign="top" class="coldata">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_history"]).'</td>';
    $body .= '  <td style="width:3%;" valign="top" class="coldata">';
    $receiverDate = (!empty($MuseumCollection['MuseumCollection']['mc_receiver_date'])) ? $this->DateFormat->formatDateThai($MuseumCollection['MuseumCollection']['mc_receiver_date'], array('Y' => 'Y')) : "";
    $receiverDate = $this->TextUtil->thainumDigit($receiverDate);
    $body .= $receiverDate;
    $body .= '  </td>';
    $body .= '  <td style="width:4%;" valign="top" class="coldata">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_receiver"]).'</td>';
    $body .= '  <td style="width:5%;" valign="top" class="coldata">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_photo_no"]).'</td>';
    $body .= '  <td style="width:5%;" valign="top" class="coldata">';
    $body .= $this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_location"]);
    if($MuseumCollection["MuseumCollection"]["mc_closet_no"] != "")
        $body .= " ตู้เลขที่ ".$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_closet_no"]);
    $body .= '  </td>';
    $body .= '  <td style="width:4%;" valign="top" class="coldata">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_record"]).'</td>';
    $body .= '  <td style="width:3%;" valign="top" class="coldata">';
    $recordDate = (!empty($MuseumCollection['MuseumCollection']['mc_record_date'])) ? $this->DateFormat->formatDateThai($MuseumCollection['MuseumCollection']['mc_record_date'], array('Y' => 'Y')) : "";
    $recordDate = $this->TextUtil->thainumDigit($recordDate);
    $body .= $recordDate;
    $body .= '  </td>';
    $body .= '  <td style="width:8%;" valign="top" class="coldata">'.$this->TextUtil->thainumDigit($MuseumCollection["MuseumCollection"]["mc_remark"]).'</td>';
    $body .= '</tr>';
    
    $rowNumm++;
}

$body .= '</table>';


//------------------------------------------------------------------------------------------------------------------

$footer = '<page_footer style="font-family:thsarabun;font-size:13pt;">
                <table class="page_footer">
                    <tr>
                        <td style="width: 100%; text-align: right;font-size:12pt;">
                            หน้า [[page_cu]] ของ [[page_nb]] หน้า
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 100%; text-align: center;font-size:23pt;color:#ff0000;font-weight:bold;">
                        &nbsp;
                        </td>
                    </tr>
                </table>
            </page_footer>';





$html = '<page backtop="28mm" backbottom="18mm" backleft="5mm" backright="5mm">' . $header . $footer . $style . $body . '</page>';


if (isset($_GET['debug']) && $_GET['debug'] == 1) {
    echo $html;
    die();
}

// -------------------------------

require_once(dirname(__FILE__) . '/../../../../../../../webroot/libs/html2pdf/html2pdf.class.php');

try {
    $html2pdf = new HTML2PDF('L', 'A1', 'en', true, 'UTF-8', array(5, 5, 5, 5));

    $html2pdf->pdf->SetDisplayMode('fullpage');

    $html2pdf->pdf->SetFont('thsarabun', '', 16); 
    $html2pdf->writeHTML($html);
    $html2pdf->Output('Memorandum.pdf');
    exit;
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}