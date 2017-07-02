<style type="text/css">
	th{
		text-align: center;
	}
</style>
<div id="jCrumbs" class="breadCrumb module">
    <div style="overflow:hidden; position:relative; width: 967px;"><div><div style="overflow:hidden; position:relative; width: 967px;"><div><ul style="width: 5000px;">
                <li class="first">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="last">
                    ระบบงานฝึกศึกษา &gt;&gt; สร้าง แบบสรุปรายงานผลการฝึก ใหม่
                </li>
            </ul></div></div></div></div>
</div>

<div class="box-title" style="text-align: center;">
    <h3 class="heading">
        สร้าง แบบสรุปรายงานผลการฝึก ใหม่
    </h3>
</div>
<?= $this->Form->create() ?>
<table class="table table-bordered tablesorter" style="margin-top: 20px;">
	<thead>
		<tr>
			<th rowspan="2"></th>
			<th style="text-align:center">ลำดับ</th>
			<th style="text-align:center">รายการ/งานการฝึก</th>
			<th style="text-align:center"><div>หน่วยที่ทำการฝึก</div><div>(นามหน่วยและจำนวนหน่วย)</div></th>
			<th style="text-align:center">ปัญหาข้อขัดข้องและข้อเสนอแนะ</th>
			<th style="text-align:center">หมายเหตุ</th>
			<th rowspan="2"></th>
		</tr>
	</thead>
     <tbody>
        <tr>
            <td></td>
            <td>1</td>
            <td>
                <input type="text" name="title1" class="span2">
            </td>
            <td>
                <input type="text" name="unit1" class="span2">
            </td>
            <td>
                <input type="text" name="suggestion1" class="span2">
            </td>
            <td>
                <input type="text" name="note1" class="span2">
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>2</td>
            <td>
                <input type="text" name="title2" class="span2">
            </td>
            <td>
                <input type="text" name="unit2" class="span2">
            </td>
            <td>
                <input type="text" name="suggestion2" class="span2">
            </td>
            <td>
                <input type="text" name="note2" class="span2">
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>3</td>
            <td>
                <input type="text" name="title3" class="span2">
            </td>
            <td>
                <input type="text" name="unit3" class="span2">
            </td>
            <td>
                <input type="text" name="suggestion3" class="span2">
            </td>
            <td>
                <input type="text" name="note3" class="span2">
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>4</td>
            <td>
                <input type="text" name="title4" class="span2">
            </td>
            <td>
                <input type="text" name="unit4" class="span2">
            </td>
            <td>
                <input type="text" name="suggestion4" class="span2">
            </td>
            <td>
                <input type="text" name="note4" class="span2">
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>5</td>
            <td>
                <input type="text" name="title5" class="span2">
            </td>
            <td>
                <input type="text" name="unit5" class="span2">
            </td>
            <td>
                <input type="text" name="suggestion5" class="span2">
            </td>
            <td>
                <input type="text" name="note5" class="span2">
            </td>
            <td></td>
        </tr>
    </tbody>

</table>

<div>
    <div style="text-align: right; margin-top: 100px;">
        <div style="">
            <label>ตรวจความถูกต้อง</label>
        <div>
            <label style="display: inline;">ชื่อ</label>
            <input type="text" name="name2">
        </div>
        <div>
            <label style="display: inline;">ตำแหน่ง</label>
            <input type="text" name="position2">
        </div>
        </div>

    </div>
</div>

<div class="center" style="text-align: center;">
    <button type="submit" class="btn btn-primary">บันทึก</button>
    <button type="reset" class="btn btn-primary" onclick="window.location='/Train/reportResult';return false;">ยกเลิก</button>
</div>

<?= $this->Form->create() ?>
