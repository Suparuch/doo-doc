<?php

ini_set('memory_limit', '2048M');
set_time_limit(4000);
error_reporting(0);


$body = '';
$style = '
<style type="text/css">

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

table.page_header {width:681px; border: none;top: 0cm;border-collapse:collapse;margin-left:37px;margin-right:36px;padding-top:11px;}
table.page_footer {width: 740px; border: none; padding: 2mm}
    
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
                <td style="text-align:center;padding-top:15px;font-size:18pt;font-weight:bold;">
                    วันนี้ในอดีต
                </td>
             </tr>
             <tr>
             <td style="height:12px;"></td>
            </tr>
             <tr>
                <td>                      
                    <table border="1" style="border-collapse:collapse;margin:0px !important;padding:0px !important;text-align:center;">
                        <tr style="background:#efefef;">
                            <th style="width:20%;padding:2px;">วัน เดือน ปี</th>
                            <th style="width:50%;">เหตุการณ์</th>
                            <th style="width:30%;">หลักฐาน</th>
                        </tr>
                    </table>  
                </td>                
            </tr>
        </table>
</page_header>
';

//------------------------------------------------------------------------------------------------------------------

$body = '<table class="table-content" border="1" style=";margin:0px !important;padding:0px !important;">';

foreach ($PastEvents as $PastEvent) {
    $body .= '<tr>';
    $body .= '  <td style="width:20%;text-align:center;" class="coldata">';

    $datePeriod = '';
    $datePeriod = (!empty($PastEvent['PastEvent']['event_date'])) ? $this->DateFormat->formatDateThai($PastEvent['PastEvent']['event_date']) : "";
    $datePeriod = $this->TextUtil->thainumDigit($datePeriod);
    $body .= $datePeriod;

    $body .= '</td>';
    $body .= '  <td style="width:50%;" valign="top" class="coldata">' . $this->TextUtil->thainumDigit($PastEvent['PastEvent']['event_name']) . '</td>';
    $body .= '  <td style="width:30%;" valign="top" class="coldata">' . $this->TextUtil->thainumDigit($PastEvent['PastEvent']['evidence']) . '</td>';
    $body .= '</tr>';
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

$html = '<page backtop="35mm" backbottom="18mm" backleft="10mm" backright="10mm">' . $header . $footer . $style . $body . '</page>';


if (isset($_GET['debug']) && $_GET['debug'] == 1) {
    echo $html;
    die();
}

// -------------------------------

require_once(dirname(__FILE__) . '/../../../../../../../webroot/libs/html2pdf/html2pdf.class.php');

try {
    $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8', array(5, 5, 5, 5));

    $html2pdf->pdf->SetDisplayMode('fullpage');

    $html2pdf->pdf->SetFont('thsarabun', '', 16); 
    $html2pdf->writeHTML($html);
    $html2pdf->Output('Memorandum.pdf');
    exit;
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}