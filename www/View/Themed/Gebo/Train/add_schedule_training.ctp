<?php ?>
<style>
    .center {
        text-align: center;
    }
    
    .table thead th {
        text-align: center;
        vertical-align: middle;
    }
</style>
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
                            ระบบงานฝึกศึกษา &gt;&gt; สร้างผลตารางกำหนดการฝึก
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <a style="color: green;" href="#">ตารางกำหนดการฝึก</a>|
    <a style="color: green;" href="reportResult">รายงานสรุปผลการฝึก</a>
</div>
<div class="box-title center">
    <h2 class="heading">
        ตารางกำหนดการฝึก
    </h2>
</div>
<?= $this->Form->create() ?>
    <div class="center">
        <label>หน่วยจัดการฝึก <input type="text" name="unit"></label>
        <label> หลักฐาน คำสั่งการฝึกของหน่วยที่จัดการฝึก <input type="text" name="proof"></label>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" class="center">
                        ลำดับ
                    </th>
                    <th rowspan="2" class="center">
                        งานการฝึก
                    </th>
                    <th rowspan="2" class="center">
                        หน่วยเข้ารับการฝึก
                    </th>
                    <th colspan="2" class="center">
                        กำหนดการฝึก (ว./ด./ป.)
                    </th>
                    <th rowspan="2" class="center">
                        หมายเหตุ
                    </th>
                </tr>
                <tr>
                    <th>ในที่ตั้ง</th>
                    <th>นอกที่ตั้ง/พื้นที่ฝึก</th>
                </tr>
            </thead>
            <tbody class="tbody">
                <tr>
                    <td>1</td>
                    <td><input type="text" name="task1"></td>
                    <td><input type="text" name="unittrained1"></td>
                    <td><label class="radio"><input type="radio" name="base1" value="base">ในที่ตั้งฝึก</label>
                        <label>ตั้งแต่ <input type="text" class="date"  name="fromdatebase1"> </label>
                        <label>ถึง <input type="text" class="date"  name="todatebase1"></label>
                    </td>
                    <td><label class="radio"><input type="radio" name="base1" value="outbase">นอกที่ตั้งฝึก <input type="text" name="location1"></label>
                        <label>ตั้งแต่ <input type="text" class="date"  name="fromdateoutbase1"> </label>
                        <label>ถึง <input type="text" class="date"  name="todateoutbase1"></label>
                    </td>
                    <td>
                        <input type="text" name="note1">
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><input type="text" name="task2"></td>
                    <td><input type="text" name="unittrained2"></td>
                    <td><label class="radio"><input type="radio" name="base2" value="base">ในที่ตั้งฝึก</label>
                        <label>ตั้งแต่ <input type="text" class="date"  name="fromdatebase2"> </label>
                        <label>ถึง <input type="text" class="date"  name="todatebase2"></label>
                    </td>
                    <td><label class="radio"><input type="radio" name="base2" value="outbase">นอกที่ตั้งฝึก <input type="text" name="location2"></label>
                        <label>ตั้งแต่ <input type="text" class="date"  name="fromdateoutbase2"> </label>
                        <label>ถึง <input type="text" class="date"  name="todateoutbase2"></label>
                    </td>
                    <td>
                        <input type="text" name="note2">
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><input type="text" name="task3"></td>
                    <td><input type="text" name="unittrained3"></td>
                    <td><label class="radio"><input type="radio" name="base3" value="base">ในที่ตั้งฝึก</label>
                        <label>ตั้งแต่ <input type="text" class="date"  name="fromdatebase3"> </label>
                        <label>ถึง <input type="text" class="date"  name="todatebase3"></label>
                    </td>
                    <td><label class="radio"><input type="radio" name="base3" value="outbase">นอกที่ตั้งฝึก <input type="text" name="location3"></label>
                        <label>ตั้งแต่ <input type="text" class="date"  name="fromdateoutbase3"> </label>
                        <label>ถึง <input type="text" class="date"  name="todateoutbase3"></label>
                    </td>
                    <td>
                        <input type="text" name="note3">
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><input type="text" name="task4"></td>
                    <td><input type="text" name="unittrained4"></td>
                    <td><label class="radio"><input type="radio" name="base4" value="base">ในที่ตั้งฝึก</label>
                        <label>ตั้งแต่ <input type="text" class="date"  name="fromdatebase4"> </label>
                        <label>ถึง <input type="text" class="date"  name="todatebase4"></label>
                    </td>
                    <td><label class="radio"><input type="radio" name="base4" value="outbase">นอกที่ตั้งฝึก <input type="text" name="location4"></label>
                        <label>ตั้งแต่ <input type="text" class="date"  name="fromdateoutbase4"> </label>
                        <label>ถึง <input type="text" class="date"  name="todateoutbase4"></label>
                    </td>
                    <td>
                        <input type="text" name="note4">
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><input type="text" name="task5"></td>
                    <td><input type="text" name="unittrained5"></td>
                    <td><label class="radio"><input type="radio" name="base5" value="base">ในที่ตั้งฝึก</label>
                        <label>ตั้งแต่ <input type="text" class="date"  name="fromdatebase5"> </label>
                        <label>ถึง <input type="text" class="date"  name="todatebase5"></label>
                    </td>
                    <td><label class="radio"><input type="radio" name="base5" value="outbase">นอกที่ตั้งฝึก <input type="text" name="location5"></label>
                        <label>ตั้งแต่ <input type="text" class="date"  name="fromdateoutbase5"> </label>
                        <label>ถึง <input type="text" class="date"  name="todateoutbase5"></label>
                    </td>
                    <td>
                        <input type="text" name="note3">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <div style="text-align: right;">
            <label>ตรวจถูกต้อง</label>
            <div>
                <label style="display: inline;">ลงชื่อ</label>
                <input type="text" name="checkName">
            </div>
            <div>
                <label style="display: inline;">ตำแหน่ง</label>
                <input type="text" id="" name="checkPosition">
            </div>
        </div>
    </div>
    <div class="center">
        <button type="submit" class="btn btn-primary">บันทึก</button>
        <button type="reset" onclick="window.location.href='scheduleTraining'" class="btn btn-primary">ยกเลิก</button>
    </div>
    <div style="font-size: 18px; margin-top: 30px">
        <div class="span1" style="display:inline-block; "><b><u>หมายเหตุ</u></b></div>
        <div class="span8" style="display:inline-block">ยศ.ทบ.กำหนดให้ทุกหน่วย<b>งดการส่งสำเนาคำสั่งการฝึก</b>ของหน่วยที่ต้องจัดส่งให้ ยศ.ทบ. โดยเปลี่ยนแปลงเป็นจัดส่ง<b>กำหนดการฝึก</b>ตามแบบฟอร์มขั้นต้นนี้แทน สำหรับระยะเวลาจัดส่งไม่เปลี่ยนแปลง คือ ก่อนเริ่มห้วงการฝึกอย่างน้อย 15 วัน</div>
    </div>
    <?= $this->Form->end() ?>
        <script>
            $(".date").focus(function() {
                $('.date').datepicker();
            });
            $(".date").blur(function() {
                $('.date').datepicker('hide');
            });
        </script>