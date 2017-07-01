<?php

ini_set('memory_limit', '2048M');
error_reporting(0);

$style = '
<style type="text/css">


/* Custom CSS code */
table {width:100%;border-spacing:0; border-collapse: collapse;}
ul {list-style-type: none; padding-left:0;}
/*body, input, textarea { font-family:TH SarabunPSK; font-size:12px; }*/
body, input, textarea { font-family: Tahoma, CordiaUPC; font-size: 12px; !important ; }
body { color:#464648; margin:2cm 1.5cm; }
h2 { color:#535255; font-size:16pt; font-weight:normal; line-height:1.2em; border-bottom:1px solid #DB4823; }
h3 { color:#ff0000; font-size:16pt; font-weight:bold; margin-bottom: 0em}
h4 { color:#9A9A9A; font-size:8pt; font-weight:normal; margin-bottom: 0em}

table th.left,
table td.left { text-align:left; }
table th.center,
table td.center { text-align:center; }
table th.right,
table td.right { text-align:right; }

tr.border_top_header th {
  border-top:1pt solid black;
}

tr.border_bottom_header th{
  border-bottom:1pt solid black;
}

tr.page_footer td {
  color:#9A9A9A; font-size:8pt; font-weight:normal; margin-bottom: 0em
}

.section { margin-bottom: 1em; }
.logo { text-align: right; }
.logo-images { weight:90px;height:90px; }
</style>
';

$model_type_id = $ModelRates['ModelRate']['model_type_id'];
$model_code = empty($ModelRates['ModelRate']['code'])? '' : $ModelRates['ModelRate']['code'];
//$model_name = empty($ModelRates['ModelRate']['name'])? '' : $ModelRates['ModelRate']['name'];
$model_name = empty($ModelRates['ModelRate']['short_name'])? '' : $ModelRates['ModelRate']['short_name'];
$model_date = empty($ModelRates['ModelRate']['model_date'])? '' : '('.$this->DateFormat->formatDateThai($ModelRates['ModelRate']['model_date'],array('Y'=>'Short')).')';
$model_comment = empty($ModelRates['ModelRate']['comment'])? '' : $ModelRates['ModelRate']['comment'];
$command_code = empty($ModelRates['ModelRate']['command_user'])? '' : 'ที่ '. $ModelRates['ModelRate']['command_user'];
$command_date = empty($ModelRates['ModelRate']['command_user_date'])? '' : ' ลง '.$this->DateFormat->formatDateThai($ModelRates['ModelRate']['command_user_date'],array('Y'=>'Short'));

$model_type_name = $ModelTypeShorts[$model_type_id];

$model_name = $model_type_name .' '. $model_code . ' '. $model_name .' ' . $model_date;

$header = '
		<table>
		<tr>
			<td width=40px>
				<img src="img/logo/logo_print.jpg">
			</td>
			<td width=327px>
				ใช้ตามคำสั่ง ทบ. (เฉพาะ) ลับ<br><br>
				'.$command_code.$command_date.'
			</td>
			<td><h3>ลับ</h3></td>
		</tr>
		</table>

		<table>
		<tr>
			<td height="25px" width="30%">
				ตอนที่ 3 อัตรากำลังพล 
			</td>
			<td><center>
			<b>กองทัพบกไทย</b>
			</center>
		</td>
		<td width="30%" align="right">'.$model_name . '</td>
		</tr>
		</table>

		<table>
			<thead>
				<tr class="border_top_header">
					<th rowspan="2" width=30px>วรรค</th>
					<th rowspan="2" width=30px>ลำดับ</th>
					<th rowspan="2" width=162px>ตำแหน่ง</th>
					<th rowspan="2" width=51px>ชั้นยศ</th>
					<th rowspan="2" width=50px>เหล่า</th>
					<th rowspan="2" width=51px>ชกท.</th>
					<th colspan="4">อัตราระดับความพร้อมรบ</th>
					<th rowspan="2" width=52px>อาวุธ</th>
					<th rowspan="2" width=0px>หมายเหตุ</th>
				</tr>
				<tr>
					<th width=49px>เต็ม</th>
					<th width=49px>ลด 1</th>
					<th width=48px>ลด 2</th>
					<th width=49px>โครง</th>
				</tr>
				<tr class="border_bottom_header">
					<th colspan="12">

					</th>
				<tr>
			</thead>
		</table>
';

$body = '
		<table>

			<tbody>
				<tr>
					<td width=31px></td>
					<td width=30px></td>
					<td width=150px></td>
					<td width=50px></td>
					<td width=50px></td>
					<td width=50px></td>
					<td width=51px></td>
					<td width=51px></td>
					<td width=51px></td>
					<td width=51px></td>
					<td width=50px></td>
					<td width=103px></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">01</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">02</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">03</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">04</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">05</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">06</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">07</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">08</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">09</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">10</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="center"><b>รวม</b></td>
					<td class="center"><b>10</b></td>
					<td class="center"><b>10</b></td>
					<td class="center" class="center"><b>6</b></td>
					<td class="center"><b>6</b></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td class="center">02</td>
					<td></td>
					<td><b>กองบังคับการกองพัน</b></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				<tr>
					<td></td>
					<td class="center">01</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">02</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">03</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">04</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">05</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">06</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">07</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">08</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">09</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
<tr>
					<td></td>
					<td class="center">02</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">03</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">04</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">05</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">06</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">07</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">08</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">09</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">10</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="center"><b>รวม</b></td>
					<td class="center"><b>10</b></td>
					<td class="center"><b>10</b></td>
					<td class="center" class="center"><b>6</b></td>
					<td class="center"><b>6</b></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td class="center">02</td>
					<td></td>
					<td><b>กองบังคับการกองพัน</b></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				<tr>
					<td></td>
					<td class="center">01</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">02</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">03</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">04</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">05</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">06</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">07</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">08</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">09</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
<tr>
					<td></td>
					<td class="center">02</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">03</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">04</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">05</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">06</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">07</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">08</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">09</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">10</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="center"><b>รวม</b></td>
					<td class="center"><b>10</b></td>
					<td class="center"><b>10</b></td>
					<td class="center" class="center"><b>6</b></td>
					<td class="center"><b>6</b></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td class="center">02</td>
					<td></td>
					<td><b>กองบังคับการกองพัน</b></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				<tr>
					<td></td>
					<td class="center">01</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">02</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">03</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">04</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">05</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">06</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">07</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">08</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">09</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">10</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="center"><b>รวม</b></td>
					<td class="center"><b>10</b></td>
					<td class="center"><b>10</b></td>
					<td class="center" class="center"><b>6</b></td>
					<td class="center"><b>6</b></td>
					<td></td>
					<td></td>
				</tr>

				<tr>
					<td class="center">03</td>
					<td></td>
					<td><b>กองบังคับการกองพัน</b></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">01</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">02</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">03</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">04</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">05</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">06</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">07</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">08</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">09</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">10</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="center"><b>รวม</b></td>
					<td class="center"><b>10</b></td>
					<td class="center"><b>10</b></td>
					<td class="center" class="center"><b>6</b></td>
					<td class="center"><b>6</b></td>
					<td></td>
					<td></td>
				</tr>

				<tr>
					<td class="center">04</td>
					<td></td>
					<td><b>กองบังคับการกองพัน</b></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">01</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">02</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">03</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">04</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">05</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">06</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">07</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">08</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">09</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">10</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="center"><b>รวม</b></td>
					<td class="center"><b>10</b></td>
					<td class="center"><b>10</b></td>
					<td class="center" class="center"><b>6</b></td>
					<td class="center"><b>6</b></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">09</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">10</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="center"><b>รวม</b></td>
					<td class="center"><b>10</b></td>
					<td class="center"><b>10</b></td>
					<td class="center" class="center"><b>6</b></td>
					<td class="center"><b>6</b></td>
					<td></td>
					<td></td>
				</tr>

				<tr>
					<td class="center">04</td>
					<td></td>
					<td><b>กองบังคับการกองพัน</b></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">01</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">02</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">03</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">04</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">05</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">06</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">07</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">08</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">09</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">10</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="center"><b>รวม</b></td>
					<td class="center"><b>10</b></td>
					<td class="center"><b>10</b></td>
					<td class="center" class="center"><b>6</b></td>
					<td class="center"><b>6</b></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">09</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">10</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="center"><b>รวม</b></td>
					<td class="center"><b>10</b></td>
					<td class="center"><b>10</b></td>
					<td class="center" class="center"><b>6</b></td>
					<td class="center"><b>6</b></td>
					<td></td>
					<td></td>
				</tr>

				<tr>
					<td class="center">04</td>
					<td></td>
					<td><b>กองบังคับการกองพัน</b></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">01</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">02</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">03</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">04</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">05</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">06</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">07</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">08</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">09</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td class="center">10</td>
					<td>กองบังคับการกองพัน</td>
					<td class="center">พ.ท.</td>
					<td class="center">ร.</td>
					<td class="center">1542</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">1</td>
					<td class="center">ปพ.</td>
					<td></td>
				</tr>

			</tbody>
		</table>
		<center>
';

$footer = '
		<table>
		<tr class="page_footer">
			<td align="right">
				หน้า  {PAGENO} ของ  {nbpg} หน้า '. str_repeat('&nbsp;', 25) .'
			</td>
		</tr>
		<tr>
			<td><center><h3>ลับ</h3></center></td>
		</tr>
		</table>
';

$html = $style . $body;
//max 58

//==============================================================
//==============================================================
//==============================================================

include("libs/mpdf/mpdf.php");

//$mpdf=new mPDF('th', 'A4', '0', 'THSaraban',15, 15, 15, 15, 8, 8); 
$mpdf=new mPDF('th', 'A4', '0', 'THSaraban',15, 10, 45, 25, 10, 10); 

$mpdf->showWatermarkText = true;
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

//==============================================================
//==============================================================
//==============================================================


?>