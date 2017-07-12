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
	<a href="manage">การจัดกำลังเข้าทำการฝึก</a>|
	<a href="support">การสนับสนุน</a>|
	<a href="#">การประเมินค่าการจัดการฝึก</a>|
	<a href="suggest">ปัญหาข้อขัดข้องและข้อเสนอแนะ</a>|
	<a href="result">สรุปบทเรียนจากการฝึก</a>
	</h4>
</div>

<div class="box-title" style="margin-top: 20px;">
	<h3 class="heading">
		ประเมินค่าการจัดการฝึก
	</h3>
</div>
<?= $this->Form->create() ?>
<div style="margin-left: 100px">
	<div>
		<label>การบรรลุวัตถุประสงค์</label>
		<div>
			<label><input type="radio" name="purpose" value="1">บรรลุวัตถุประสงค์</label>
			<label><input type="radio" name="purpose" value="0">ไม่บรรลุวัตถุประสงค์</label>
		</div>
	</div>
	<div>
		<label>การบรรลุรายการกิจเฉพาะเป็นบุคคลเป็นหน่วย</label>
		<div>
			<label><input type="radio" name="purposePerson" value="1">บรรลุวัตถุประสงค์</label>
			<label><input type="radio" name="purposePerson" value="0">ไม่บรรลุวัตถุประสงค์</label>
		</div>
	</div>
	<div>
		<label>ข้อดีที่ควรชมเชย พร้อมประกอบเหตุผล</label>
		<div>
			<label><input type="radio" name="recommend" value="1">บรรลุวัตถุประสงค์</label>
			<label><input type="radio" name="recommend" value="0">ไม่บรรลุวัตถุประสงค์</label>
		</div>
	</div>
	<div>
		<label>ข้อบคพล่องที่ควรแก้ไข พร้อมประกอบเหตุผล</label>
		<div>
			<label><input type="radio" name="problem" value="1">บรรลุวัตถุประสงค์</label>
			<label><input type="radio" name="problem" value="0">ไม่บรรลุวัตถุประสงค์</label>
		</div>
	</div>
	<div>
		<button type="submit" class="btn btn-primary">ค้นหา</button>
		<button type="reset" class="btn btn-primary">ยกเลิก</button>
	</div>
</div>
<?= $this->Form->end() ?>
<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li class="hideme mm_1_add" style="display: list-item;"><a href="/reportTraining/addValue"><i class="splashy-add"></i> เพิ่ม </a></li>
                                <li class="hideme mm_1_delete delete" style="display: list-item;"><a style="cursor:pointer" onclick="" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
</div>

<table class="table table-bordered tablesorter">
	<thead>
		<tr>
			<th rowspan="2"></th>
			<th rowspan="2">ลำดับ</th>
			<th colspan="2">การบรรลุวัตถุประสงค์การฝึก</th>
			<th colspan="2">การบรรลุวัตถุประสงค์เฉพาะกิจ</th>
			<th colspan="2">ข้อดีที่ควรชม</th>
			<th colspan="2">ข้อบกพร่องที่ควรแก้ไข</th>
			<th rowspan="2"></th>
		</tr>
		<tr>
			<th>บรรลุ</th>
			<th>ไม่บรรลุ เนื่องจาก</th>
			<th>บรรลุ</th>
			<th>ไม่บรรลุ เนื่องจาก</th>
			<th>บรรลุ</th>
			<th>ไม่บรรลุ เนื่องจาก</th>
			<th>บรรลุ</th>
			<th>ไม่บรรลุ เนื่องจาก</th>
		</tr>
	</thead>
</table>