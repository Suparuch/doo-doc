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
	<a href="value">การประเมินค่าการจัดการฝึก</a>|
	<a href="suggest">ปัญหาข้อขัดข้องและข้อเสนอแนะ</a>|
	<a href="result">สรุปบทเรียนจากการฝึก</a>
	</h4>
</div>

<div class="box-title" style="margin-top: 20px;">
	<h3 class="heading">
		ประเมินค่าการจัดการฝึก
	</h3>
</div>
<? $this->Form->create(); ?>
<div>
	<label>การบรรลุวัตถุประสงค์การฝึก</label>
	<div>
		<label><input type="radio" name="purpose" value="1">บรรลุวัตถุประสงค์</label>
	</div>
	<div>
		<label style="display: inline-block;"><input type="radio" name="purpose" value="0">ไม่บรรลุวัตถุประสงค์ : </label>
		<div style="display: inline-block;"><textarea name="purposeNote"></textarea></div>
	</div>
</div>

<div>
	<label>การบรรลุรายการกิจเฉพาะเป็นบุคคลเป็นหน่วย</label>
	<div>
		<label><input type="radio" name="purposeUnit" value="1">บรรลุวัตถุประสงค์</label>
	</div>
	<div>
		<label style="display: inline-block;"><input type="radio" name="purposeUnit" value="0">ไม่บรรลุ เนื่องจาก : </label>
		<div style="display: inline-block;"><textarea name="purposeUnitNote"></textarea></div>
	</div>
</div>

<div>
	<label>ข้อดีที่ควรชมเชย พร้อมเหตุผลประกอบ</label>
	<div>
		<label><input type="radio" name="recommend" value="1">บรรลุวัตถุประสงค์</label>
	</div>
	<div>
		<label style="display: inline-block;"><input type="radio" name="recommend" value="0">ไม่บรรลุ เนื่องจาก : </label>
		<div style="display: inline-block;"><textarea name="recommendNote"></textarea></div>
	</div>
</div>

<div>
	<label>ข้อบกพร่องที่ควรแก้ไข พร้อมเหตุผลประกอบ</label>
	<div>
		<label><input type="radio" name="problem" value="1">บรรลุวัตถุประสงค์</label>
	</div>
	<div>
		<label style="display: inline-block;"><input type="radio" name="problem" value="0">ไม่บรรลุ เนื่องจาก : </label>
		<div style="display: inline-block;"><textarea name="problem"></textarea></div>
	</div>
</div>
<div style="text-align: center;">
	<button type="submit">บันทึก</button>
	<button type="reset">ยกเลิก</button>
</div>

<?= $this-Form->end() ?>