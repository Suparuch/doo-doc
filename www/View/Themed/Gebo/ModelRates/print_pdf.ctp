<?php

ini_set('memory_limit', '2048M');
error_reporting(0);

$html = '
<style type="text/css">


/* Custom CSS code */
table {width:100%;border-spacing:0; border-collapse: collapse;}
ul {list-style-type: none; padding-left:0;}
body, input, textarea { font-family:TH SarabunPSK,sans-serif; font-size:9pt; }
body { color:#464648; margin:2cm 1.5cm; }
h2 { color:#535255; font-size:16pt; font-weight:normal; line-height:1.2em; border-bottom:1px solid #DB4823; }
h3 { color:#9A9A9A; font-size:12pt; font-weight:normal; margin-bottom: 0em}
h4 { color:#9A9A9A; font-size:8pt; font-weight:normal; margin-bottom: 0em}

table th.left,
table td.left { text-align:left; }
table th.center,
table td.center { text-align:center; }
table th.right,
table td.right { text-align:right; }


.section { margin-bottom: 1em; }
.logo { text-align: right; }
.logo-images { weight:90px;height:90px; }
</style>


		<div class="box-title">
			<h3>
				ตอนที่ 3 อัตรากำลังพล
			</h3>
		</div>
		<div class="box-content nopadding">

			<div class="tab-content tab-content-inline">
				<div id="inbox" class="tab-pane active">
					<div class="highlight-toolbar">

						<table class="table table-striped table-nomargin table-mail">
							<thead>
								<tr>
									<th rowspan="2">วรรค</th>
									<th rowspan="2">ลำดับ</th>
									<th rowspan="2">ตำแหน่ง</th>
									<th rowspan="2" class="left">ชั้นยศ</th>
									<th rowspan="2">เหล่า</th>
									<th rowspan="2">ชกท.</th>
									<th colspan="4">อัตราระดับความพร้อมรบ</th>
									<th rowspan="2">อาวุธ</th>
									<th rowspan="2">หมายเหตุ</th>
								</tr>
								<tr>
									<th>เต็ม</th>
									<th>ลด 1</th>
									<th>ลด 2</th>
									<th>โครง</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td class="center">01</td>
									<td class="center"></td>
									<td><b>กองบังคับการกองพัน</b></td>
									<td></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">01</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">02</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">03</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">04</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">05</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">06</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">07</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">08</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">09</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">10</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"><b>รวม</b></td>
									<td class="center"><b>10</b></td>
									<td class="center"><b>10</b></td>
									<td class="center" class="center"><b>6</b></td>
									<td class="center"><b>6</b></td>
									<td class="center"></td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center">02</td>
									<td class="center"></td>
									<td><b>กองบังคับการกองพัน</b></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
								<tr>
									<td class="center"></td>
									<td class="center">01</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">02</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">03</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">04</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">05</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">06</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">07</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">08</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">09</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">10</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"><b>รวม</b></td>
									<td class="center"><b>10</b></td>
									<td class="center"><b>10</b></td>
									<td class="center" class="center"><b>6</b></td>
									<td class="center"><b>6</b></td>
									<td class="center"></td>
									<td class="center"></td>
								</tr>

								<tr>
									<td class="center">03</td>
									<td class="center"></td>
									<td><b>กองบังคับการกองพัน</b></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">01</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">02</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">03</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">04</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">05</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">06</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">07</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">08</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">09</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">10</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"><b>รวม</b></td>
									<td class="center"><b>10</b></td>
									<td class="center"><b>10</b></td>
									<td class="center" class="center"><b>6</b></td>
									<td class="center"><b>6</b></td>
									<td class="center"></td>
									<td class="center"></td>
								</tr>

								<tr>
									<td class="center">04</td>
									<td class="center"></td>
									<td><b>กองบังคับการกองพัน</b></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">01</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">02</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">03</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">04</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">05</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">06</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">07</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">08</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">09</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center">10</td>
									<td>กองบังคับการกองพัน</td>
									<td>พ.ท.</td>
									<td class="center">ร.</td>
									<td class="center">1542</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">1</td>
									<td class="center">ปพ.</td>
									<td class="center"></td>
								</tr>
								<tr>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"></td>
									<td class="center"><b>รวม</b></td>
									<td class="center"><b>10</b></td>
									<td class="center"><b>10</b></td>
									<td class="center" class="center"><b>6</b></td>
									<td class="center"><b>6</b></td>
									<td class="center"></td>
									<td class="center"></td>
								</tr>

							</tbody>
						</table>
						<center>

					</div>
				</div>
			</div>
';


//==============================================================
//==============================================================
//==============================================================

include("/libs/mpdf/mpdf.php");

//$mpdf=new mPDF('th', 'A4', '0', 'THSaraban',15, 15, 15, 15, 8, 8); 
$mpdf=new mPDF('th', 'A4', '0', 'THSaraban',5, 5, 5, 5, 5, 5); 

$mpdf->showWatermarkText = true;
$mpdf->WriteHTML('<watermarktext content="สำเนา" alpha="0.1" />');
$mpdf->WriteHTML($html);
$mpdf->AddPage();
$mpdf->WriteHTML($html);
$mpdf->AddPage();
$mpdf->WriteHTML($html);
$mpdf->AddPage();
$mpdf->WriteHTML($html);
//$mpdf->Output('D:\xampp\htdocs\afkair.local\office\app\webroot\files\Quotations/testcake.pdf');
$mpdf->Output();
exit;

//==============================================================
//==============================================================
//==============================================================


?>