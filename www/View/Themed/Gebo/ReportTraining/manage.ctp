<div id="jCrumbs" class="breadCrumb module">
    <div style="overflow:hidden; position:relative; width: 967px;"><div><div style="overflow:hidden; position:relative; width: 967px;"><div><ul style="width: 5000px;">
                <li class="first">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="last">
                    ระบบงานฝึกศึกษา &gt;&gt; รายงานผลการฝึกของหน่วยจัดการฝึก
                </li>
            </ul></div></div></div></div>
</div>
<div>
<h3>
	<a href="/Train">ตารางกำหนดการฝึก</a>|
	<a href="#">รายงานผลการฝึกของหน่วยจัดการฝึก</a>|
	<a href="">รายงานสรุปผลการฝึก</a>
	</h3>
</div>

<div style="margin-top: 10px;">
<h4>
	<a href="index">ข้อมูลการฝึก</a>|
	<a href="#">การจัดกำลังเข้าทำการฝึก</a>|
	<a href="support">การสนับสนุน</a>|
	<a href="value">การประเมินค่าการจัดการฝึก</a>|
	<a href="suggest">ปัญหาข้อขัดข้องและข้อเสนอแนะ</a>|
	<a href="result">สรุปบทเรียนจากการฝึก</a>
	</h4>
</div>

<div class="box-title" style="margin-top: 20px;">
	<h3 class="heading">
		ข้อมูลการฝึก
	</h3>
</div>
<?= $this->Form->create() ?>
<div>
	<div style="display: inline-block;">
		<label>รายการ</label>
		<input type="text" name="list">
	</div>
	<label style="display: inline-block;">จำนวน</label>
		
		<div style="display: inline-block">
			<label style="">น</label>
			<input type="text" name="count" style="width: 100px;">
		</div>
		<div style="display: inline-block;">
			<label>ส</label>
			<input type="text" name="count2" style="width: 100px;">
		</div>
		<div style="display: inline-block;">
			<label>พล.</label>
			<input type="text" name="count3" style="width: 100px;">
		</div>
		<div style="display: inline-block;">
			<label>หมายเหตุ</label>
			<input type="text" name="note" style="width: 100px;">
		</div>
	<div style="text-align: center;">
		<button type="submit" class="btn btn-primary">ค้นหา</button>
		<button type="button" class="btn btn-primary"><a href="addManage">เพิ่มรายการ</a></button>
		<button type="reset" class="btn btn-primary">ยกเลิก</button>
	</div>
</div>
<?= $this->Form->end() ?>
<table class="table table-bordered tablesorter">
	<thead>
	<tr>
		<th rowspan="2"></th>
		<th rowspan="2">ลำดับ</th>
		<th rowspan="2">รายการ</th>
		<th colspan="3">จำนวน</th>
		<th rowspan="2">หมายเหตุ</th>
		<th rowspan="2"></th>
	</tr>
	<tr>
		<th>น.</th>
		<th>ส.</th>
		<th>พล.</th>
	</tr>
	</thead>
</table>