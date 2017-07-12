<div id="jCrumbs" class="breadCrumb module">
    <div style="overflow:hidden; position:relative; width: 967px;">
        <div>
            <div style="overflow:hidden; position:relative; width: 967px;">
                <div>
                    <ul style="width: 5000px;">
                        <li class="first">
                            <a href="#"><i class="icon-home"></i></a>
                        </li>
                        <li class="last">
                            ระบบงานฝึกศึกษา &gt;&gt; สร้าง แบบรายงานผลการฝึกของหน่วยจัดการฝึก ใหม่
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<div class="box-title" style="margin-top: 20px; text-align: center;">
    <h3 class="heading">
    สร้าง แบบรายงานผลการฝึกของหน่วยจัดการฝึก ใหม่
  </h3>
</div>
<?= $this->Form->create() ?>
    <div>
        <div style="">
            <label style="display: inline;">1.&nbsp;&nbsp;หลักสูตรการฝึก : </label>
            <input type="text" name="course">
        </div>
        <div style="">
            <label style="display: inline;">2.&nbsp;&nbsp;หน่วย : </label>
            <input type="text" name="unit">
            <label style="display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;ที่ตั้งหน่วย :</label>
            <input type="text" name="locationunit">
        </div>
        <div>
            <label style="display: inline;">3.&nbsp;&nbsp;วัตถุประสงค์การฝึก :</label>
            <input type="text" name="purpose">
        </div>
        <div style="">
            <div style="display: inline;">
                <label style="display: inline;">4.&nbsp;&nbsp;ช่วงเวลาการฝึก ตั้งแต่ : </label>
                <input type="text" class="date" name="fromdatetrain" style="width: 90px">
            </div>
            <div style="display: inline;">
                <label style="display: inline;">&nbsp;&nbsp;ถึง :</label>
                <input type="text" class="date" name="todatetrain" style="width: 90px">
            </div>
            <div style="display: inline;">
                <label style="display: inline;">&nbsp;&nbsp;รวมจำนวนวันที่ทำการฝึก :</label>
                <input type="text" name="countdaytrain">
                <label style="display: inline;">&nbsp;วัน</label>
            </div>
        </div>
    </div>
    <div style="margin-left:20px">
        <div style="">
            <label style="display: inline;">4.1 การฝึกในหน่วยที่ตั้งหน่วย สถานที่ : </label>
            <input type="text" name="basetrain">
        </div>
        <div style="display: inline;">
            <label style="display: inline;">ตั้งแต่ :&nbsp;</label>
            <input type="text" class="date" name="fromdatebase" style="width: 90px">
        </div>
        <div style="display: inline;">
            <label style="display: inline;">ถึง : </label>
            <input type="text" class="date" name="todatebase" style="width: 90px">
        </div>
        <div style="display: inline;">
            <label style="display: inline;">รวมจำนวนที่ทำการฝึก</label>
            <input type="text" name="countdatebase">
            <label style="display: inline;">วัน</label>
        </div>
    </div>
    <div style="margin-left:20px">
        <div style="">
            <label style="display: inline;">4.2 การฝึกนอกหน่วยที่ตั้งหน่วย</label>
            <label style="display: inline;">สถานที่ : </label>
            <input type="text" name="outbaselocation">
        </div>
        <div style="display: inline;">
            <label style="display: inline;">ตั้งแต่ : </label>
            <input type="text" class="date" name="fromdateoutbase" style="width: 90px">
        </div>
        <div style="display: inline;">
            <label style="display: inline;">ถึง : </label>
            <input type="text" class="date" name="todateoutbase" style="width: 90px">
        </div>
        <div style="display: inline;">
            <label style="display: inline;">รวมจำนวนที่ทำการฝึก</label>
            <input type="text" name="countdayoutbase">
            <label style="display: inline;">วัน</label>
        </div>
    </div>
    <div style="margin-left:20px">
        <div style="">
            <label style="display: inline;">4.3 การตรวจสอบประเมินผลการฝึก </label>
            <label style="display: inline;">สถานที่ : </label>
            <input type="text" name="resultlocation">
        </div>
        <div style="display: inline;">
            <label style="display: inline;">ตั้งแต่ : </label>
            <input type="text" class="date" name="fromdateresult" style="width: 90px">
        </div>
        <div style="display: inline;">
            <label style="display: inline;">ถึง : </label>
            <input type="text" class="date" name="todateresult" style="width: 90px">
        </div>
        <div style="display: inline;">
            <label style="display: inline;">รวมจำนวนที่ทำการฝึก</label>
            <input type="text" name="countdayresult">
            <label style="display: inline;">วัน</label>
        </div>
    </div>
    </br>
    <div>
        <label style="display: inline;">5. เรื่องที่ทำการฝึก : </label>
        <div>
            <label style="display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.1 รายการกิจเฉพาะบุคคล (ให้ลงรายการกิจเฉพาะเป็นบุคคลที่ทำการฝึก) : </label>
            <input type="text" name="onlypersonlist">
        </div>
        <div>
            <label style="display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.2 รายการกิจเฉพาะหน่วย (ให้ลงรายการกิจเฉพาะเป็นบุคคลที่ทำการฝึก) : </label>
            <input type="text" name="onlyunitlist">
        </div>
        <div>
            <label style="display: inline;">6. &nbsp;&nbsp;พื้นที่ทำการฝึก :</label>
            <input type="text" name="location">
        </div>
        <div>
            <label style="display: inline;">7. &nbsp;&nbsp;การจัดกำลังเข้าทำการฝึก :</label>
        </div>
    </div>
    </br>
    <table class="table table-bordered tablesorter">
        <thead>
            <tr>
                <th class="header headerSortDown" style="text-align: center;width:50px;" rowspan="2">ลำดับ</th>
                <th class="header" style="text-align: center;" rowspan="2">รายการ</th>
                <th class="header" style="text-align: center;" colspan="3">จำนวน</th>
                <th class="header" rowspan="2">หมายเหตุ</th>
            </tr>
            <tr>
                <th class="header" style="text-align: center;">น.</th>
                <th class="header" style="text-align: center;">ส.</th>
                <th class="header" style="text-align: center;">พล.</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>
                    <label style="display: inline;">&nbsp;&nbsp;ส่วนอำนวยการฝึก</label>
                </td>
                <td>
                    <input type="text" name="n1" style="width:94%">
                </td>
                <td>
                    <input type="text" name="s1" style="width:94%">
                </td>
                <td>
                    <input type="text" name="pl1" style="width:94%">
                </td>
                <td>
                    <input type="text" name="note1" style="width:94%">
                </td>
                <tbody>
            </tr>
            <tr>
                <td>2</td>
                <td>
                    <label style="display: inline;">&nbsp;&nbsp;ชุดครูฝึก</label>
                </td>
                <td>
                    <input type="text" name="n2" style="width:94%">
                </td>
                <td>
                    <input type="text" name="s2" style="width:94%">
                </td>
                <td>
                    <input type="text" name="pl2" style="width:94%">
                </td>
                <td>
                    <input type="text" name="note2" style="width:94%">
                </td>
                <tbody>
            </tr>
            <tr>
                <td>3</td>
                <td>
                    <label style="display: inline;">&nbsp;&nbsp;ส่วนรับการฝึก/ผู้รับฝึก</label>
                </td>
                <td>
                    <input type="text" name="n3" style="width:94%">
                </td>
                <td>
                    <input type="text" name="s3" style="width:94%">
                </td>
                <td>
                    <input type="text" name="pl3" style="width:94%">
                </td>
                <td>
                    <input type="text" name="note3" style="width:94%">
                </td>
                <tbody>
            </tr>
            <tr>
                <td>4</td>
                <td>
                    <label style="display: inline;">&nbsp;&nbsp;ข้าศึกสมมติ</label>
                </td>
                <td>
                    <input type="text" name="n4" style="width:94%">
                </td>
                <td>
                    <input type="text" name="s4" style="width:94%">
                </td>
                <td>
                    <input type="text" name="pl4" style="width:94%">
                </td>
                <td>
                    <input type="text" name="note4" style="width:94%">
                </td>
                <tbody>
            </tr>
            <tr>
                <td></td>
                <td>
                    <label style="display: inline; text-align: center;">รวม</label>
                </td>
                <td></td>
                <td></td>
                <td> </td>
                <td></td>
                <tbody>
            </tr>
    </table>
    <!-- //******* 8. การสนับสนุนการฝึก  **********// -->
    <div>
        <div>
            <label style="display: inline;">8. &nbsp;&nbsp;การสนับสนุนการฝึก :</label>
        </div>
        <div>
            <label style="display: inline; margin-left: 20px;">8.1 อาวุธ/ยุทโธปกรณ์/ยานพาหนะ</label>
            <input type="text" name="weapon">
        </div>
        <div>
            <label style="display: inline; margin-left: 20px;">8.2 สป.3 (เบนซิน/ดีเซล/สป.3(อ.))</label>
            <input type="text" name="vehicle">
        </div>
        <div>
            <label style="display: inline; margin-left: 20px;">8.3 สป.5 (สาย สพ. / สาย วศ.)</label>
            &nbsp;&nbsp;
            <input type="text" name="support5">
        </div>
        </br>
        <div>
            <label style="display: inline; margin-left: 20px;">8.4 เป้า</label>
            &nbsp;&nbsp;
            <input type="text" name="target" style="center;">
        </div>
        <div>
            <label style="display: inline; margin-left: 20px;">8.5 งบประมาณ (เบี้ยเลี้ยง, เงินเพิ่มพิเศษพลทหาร, ค่าเช่าที่พัก, ค่าเครื่องช่วยฝึกสิ้นเปลืองและอื่นๆ)</label>
            <input type="text" name="allowance" style="center;">&nbsp;&nbsp;บาท
            <div>
                <div>
                    <label style="display: inline; margin-left: 20px;">8.6 อื่นๆ</label>
                    &nbsp;&nbsp;
                    <input type="text" name="other" style="center;">
                    <div>
                    </div>
                    <!-- //******* End 8.การสนับสนุนการฝึก  **********// -->
                    <!-- //******** 9.การประเมินค่าจัดการฝึก (โดยหน่วยจัดการฝึก) -->
                    <div>
                        <div>
                            <label style="display: inline;">9. &nbsp;&nbsp;การประเมินค่าจัดการฝึก (โดยหน่วยจัดการฝึก) :</label>
                        </div>
                        <div>
                            <label style="display: inline; margin-left: 20px;">9.1 การบรรลุวัตถุประสงค์การฝึก (หรือไม่/อย่างไร)</label>
                            <input type="text" name="resultpurpose" style="center;">
                        </div>
                        <div>
                            <label style="display: inline; margin-left: 20px;">9.2 การบรรลุรายการกิจเฉพาะเป็นบุคคลและเป็นหน่วย (หรือไม่/อย่างไร)</label>
                            <input type="text" name="unitandperson" style="center;">
                        </div>
                        <div>
                            <label style="display: inline; margin-left: 20px;">9.3 ข้อดีที่ควรชมเชย พร้อมเหตุผลประกอบ</label>
                            <input type="text" name="good" style="center;">
                        </div>
                        </br>
                        <div>
                            <label style="display: inline; margin-left: 20px;">9.4 ข้อบกพร่องที่ควรแก้ไข พร้อมเหตุผลประกอบ</label>
                            <input type="text" name="bad" style="center;">
                        </div>
                    </div>
                    <!-- //******** end 9.การประเมินค่าจัดการฝึก (โดยหน่วยจัดการฝึก) -->
                    <!-- //******** 10.ปัญหาข้อขัดข้องและข้อเสนอแนะ -->
                    <div>
                        <div>
                            <label style="display: inline;">10. &nbsp;&nbsp;ปัญหาข้อขัดข้องและข้อเสนอแนะ :</label>
                            <input type="text" name="problem" style="center;">
                        </div>
                    </div>
                    <!-- //******** end 10.การประเมินค่าจัดการฝึก (โดยหน่วยจัดการฝึก) -->
                    <!-- //******** license  *******//-->
                    <!--11.สรุปบทเรียน-->
                    <div>
                        <label for="">11. สรุปบทเรียนจากการฝึก</label>
                        <div style="margin-left:10px">
                            <div>
                                <label style="display: inline;">11.1 &nbsp;&nbsp;เหตุการณ์สำคัญ/การฝึกที่สำคัญ :</label>
                                <input type="text" name="specialEvent" style="center;">
                            </div>
                            <div>
                                <label style="display: inline;">11.2 &nbsp;&nbsp;สถานการณ์/สภาพการณ์/เหตุการณ์ :</label>
                                <input type="text" name="situation" style="center;">
                            </div>
                            <div>
                                <label style="display: inline;">11.3 &nbsp;&nbsp;การวิเคราห์สถานการณ์/การวิเคราะห์เหตุการณ์ :</label>
                                <input type="text" name="analyze" style="center;">
                            </div>
                            <div>
                                <label style="display: inline;">11.4 &nbsp;&nbsp;การปฏิบัติของฝ่ายตรงข้าม :</label>
                                <input type="text" name="enemy" style="center;">
                            </div>
                            <div>
                                <label style="display: inline;">11.5 &nbsp;&nbsp;การปฏิบัติของฝ่ายเรา :</label>
                                <input type="text" name="our" style="center;">
                            </div>
                            <div>
                                <label style="display: inline;">11.6 &nbsp;&nbsp;วิเคราะห์การปฏิบัติของฝ่ายตรงข้าม (ข้าศึกสมมติ) (บทเรียนการปฏิบัติของฝ่ายตรงข้าม) </label>
                                <div>
                                    <label style="display: inline;">11.6.1 จุดอ่อน</label>
                                    <input type="text" name="enemyweakness">

                                    <label style="display: inline;">11.6.2 จุดแข็ง</label>
                                    <input type="text" name="enemystrength">
                                </div>
                                <div>
                                    <label style="display: inline;">11.6.3 อุปสรรค</label>
                                    <input type="text" name="enemyblock">

                                    <label style="display: inline;">11.6.4 โอกาส</label>
                                    <input type="text" name="enemychance">
                                </div>
                            </div>
                            <div>
                                <label style="display: inline;">11.7 &nbsp;&nbsp;วิเคราะห์การปฏิบัติของฝ่ายเรา (บทเรียนการบฎิบัติของฝ่ายเรา) </label>
                                <div>
                                    <label style="display: inline;">11.7.1 จุดอ่อน</label>
                                    <input type="text" name="ourweakness">

                                    <label style="display: inline;">11.7.2 จุดแข็ง</label>
                                    <input type="text" name="ourstrength">
                                </div>
                                <div>
                                    <label style="display: inline;">11.7.3 อุปสรรค</label>
                                    <input type="text" name="ourblock">

                                    <label style="display: inline;">11.7.4 โอกาส</label>
                                    <input type="text" name="ourchance">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="">แนวทางการปรับปรุงแก้ไข</label>
                            <input type="text" name="improve">
                        </div>
                    </div>
                    <!--11.สรุปบทเรียน-->
                    <div>
                        <div style="text-align: right;">
                            <div style="">
                                <label>ตรวจความถูกต้อง</label>
                                <div style="margin-top: 10px;">
                                    <label style="display: inline;">(ลงชื่อ)</label>
                                    <input type="text" name="name2">
                                </div>
                                <div>
                                    <label style="display: inline;">ตำแหน่ง</label>
                                    <input type="text" name="position2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //******** end license ******//-->
                </div>
            </div>
        </div>

        <div style="text-align: center; margin-top: 40px;">
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <button type="reset" onclick="window.location.href='index'" class="btn btn-primary">ยกเลิก</button>
        </div>
    </div>
    <?= $this->Form->end() ?>

        <script>
            $(".date").focus(function() {
                $('.date').datepicker();
            });
        </script>