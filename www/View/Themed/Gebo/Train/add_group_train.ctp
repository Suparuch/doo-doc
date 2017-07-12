
<style>
    table.table thead tr th{
        text-align: center;
        vertical-align : middle;
    }
</style>
<?= $this->Form->create() ?>
<div style="text-align: center;">
    <h3>
    <label>แบบบันทึกผลเป็นหน่วย</label>
    </h3>
</div>
<div>
    <div style="display: inline;">
        <label style="display: inline;">หน่วย</label>
        <div style="display: inline;">
            <?php
                echo $this->Form->input('unit', array(
                'label' => false,
                'div' => false,
                'class' => 'span12',
                'style' => 'width:100px',
                'options' => $Units,
                'empty' => 'หน่วย'
                ));
            ?>
        </div>
    </div>
    <div style="display: inline;">
        <label style="display: inline;">ยศ</label>
        <div style="display: inline;">
            <?php
                echo $this->Form->input('rank', array(
                'label' => false,
                'div' => false,
                'class' => 'span12',
                'style' => 'width:80px',
                'options' => $Ranks,
                'empty' => 'ยศ'
                ));
            ?>
        </div>
    </div>
    <div style="display: inline;">
        <label style="display: inline;">ผบ.หน่วย</label>
        <input type="text" name="" class="headUnit" placeholder="ชื่อ">
    </div>
    <div style="display: inline;">
        <label style="display: inline;">เป็นหน่วยขึ้นตรงของ</label>
        <div style="display: inline;">
            <?php
                echo $this->Form->input('belongTo', array(
                'label' => false,
                'div' => false,
                'class' => 'span12',
                'style' => 'width:100px',
                'options' => $Units,
                'empty' => 'หน่วย'
                ));
            ?>
        </div>
    </div>
</div>
<div>
    <label style="display: inline-block;">การฝึกตามระเบียบและหลักสูตรการฝึกเป็นหน่วย</label>
    <div style="display: inline-block;">
        <label class="radio inline"><input type="radio" onclick="addCourse('ชุดยิง')" name="" value="ชุดยิง">ชุดยิง</label>
        <label class="radio inline"><input type="radio" onclick="addCourse('หมู่')" name="" value="หมู่">หมู่</label>
        <label class="radio inline"><input type="radio" onclick="addCourse('หมวด')" name="" value="หมวด">หมวด</label>
        <label class="radio inline"><input type="radio" onclick="addCourse('กองร้อย')" name="" value="กองร้อย">กองร้อย</label>
        <label class="radio inline"><input type="radio" onclick="addCourse('กองพัน')" name="" value="กองพัน">กองพัน</label>
    </div>
</div>
<div style="">
    <div class="span2">
        <label>เรื่อง/วิชาที่ทำการฝึก</label>    
    </div>
    <div class="span5" style="margin-left: -20px;">
        <label class="radio inline"><input type="radio" onclick="addSubject('ดำเนินกลยุทธ')" name="" value="ดำเนินกลยุทธ">ดำเนินกลยุทธ</label>
        <label class="radio inline"><input type="radio" onclick="addSubject('การยิงสนับสนุน')" name="" value="การยิงสนับสนุน">การยิงสนับสนุน</label>
        <label class="radio inline"><input type="radio" onclick="addSubject('การข่าวกรอง')" name="" value="การข่าวกรอง">การข่าวกรอง</label>
        <label class="radio inline"><input type="radio" onclick="addSubject('ความคล่องแคล่ว')" name="" value="ความคล่องแคล่ว">ความคล่องแคล่ว</label>
        <br>
        <label class="radio inline"><input type="radio" onclick="addSubject('การป้องกันภัยทางอากาศ')" name="" value="การป้องกันภัยทางอากาศ">การป้องกันภัยทางอากาศ</label>
        <label class="radio inline"><input type="radio" onclick="addSubject('การช่วยรบ')" name="" value="การช่วยรบ">การช่วยรบ</label>
        <label class="radio inline"><input type="radio" onclick="addSubject('การควบคุมบัญชา')" name="" value="การควบคุมบัญชา">การควบคุมบัญชา</label>
    </div>
</div>
<div></div>
<table class="table table-bordered tablesorter">
    <thead>
    <tr>
        <th class="header headerSortDown" style="text-align: center;width:50px;" rowspan="3">ลำดับ</th>
        <th class="header headerSortDown" style="text-align: center;width:50px;" rowspan="3">กิจเฉพาะ</th>
        <th class="header" style="text-align: center;" colspan="6">การประเมินผล</th>
        <th class="header" rowspan="3">ปัญหาข้อขัดคล้อง</th>
        <th class="header" rowspan="3">หมายเหตุ</th>
        <th class="header" rowspan="3" style="width: 35px"></>
    </tr>
    <tr>
        <th class="header" style="text-align: center;width:70px;" rowspan="">ครั้งที่</th>
        <th class="header" style="text-align: center;width:70px;" rowspan="">ว-ด-ป</th>
        <th class="header" style="text-align: center;" colspan="2">ผลการประเมิน</th>
        <th class="header" style="text-align: center;width:200px;" colspan="2">ยศ ชื่อ ตำแหน่ง ของผู้ประเมินผลและข้อคิดเห็น</th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th class="header">ผ่าน</th>
        <th class="header">ไม่ผ่าน</th>
        <th class="header">ครูฝึก/ผบช.โดยตรง</th>
        <th class="header">ผบช.ตามลำดับชั้นเหนือขึ้นไป 1 ระดับ</th>
    </tr>
    </thead>
    <tbody>
       <tr>
        <div style="display:none">
            <input type="text" name="unit1" class="unit">
            <input type="text" name="headUnit1" class="headUnit">
            <input type="text" name="belongto1" class="belongto">
            <input type="text" name="course1" class="course">
            <input type="text" name="subject1" class="subject">
        </div>
           <td>1</td>
           <td><input type="text" name="specific1" class="span1"></td>
           <td><input type="text" name="time1" class="span1"></td>
           <td><input type="text" name="date1" class="date span1"></td>
           <td><input type="radio" name="result1" value="1"></td>
           <td><input type="radio" name="result1" value="0"></td>
           <td><input type="text" name="teacher1" class="span3"></td>
           <td><input type="text" name="head1" class="span3"></td>
           <td><input type="text" name="problem1" class="span3"></td>
           <td><input type="text" name="note1" class="span3"></td>
       </tr>
       <tr>
        <div style="display:none">
            <input type="text" name="unit2" class="unit">
            <input type="text" name="headUnit2" class="headUnit">
            <input type="text" name="belongto2" class="belongto">
            <input type="text" name="course2" class="course">
            <input type="text" name="subject2" class="subject">
        </div>
           <td>2</td>
           <td><input type="text" name="specific2" class="span1"></td>
           <td><input type="text" name="time2" class="span1"></td>
           <td><input type="text" name="date2" class="date span1"></td>
           <td><input type="radio" name="result2" value="1"></td>
           <td><input type="radio" name="result2" value="0"></td>
           <td><input type="text" name="teacher2" class="span3"></td>
           <td><input type="text" name="head2" class="span3"></td>
           <td><input type="text" name="problem2" class="span3"></td>
           <td><input type="text" name="note2" class="span3"></td>
       </tr>
       <tr>
        <div style="display:none">
            <input type="text" name="unit3" class="unit">
            <input type="text" name="headUnit3" class="headUnit">
            <input type="text" name="belongto3" class="belongto">
            <input type="text" name="course3" class="course">
            <input type="text" name="subject3" class="subject">
        </div>
           <td>3</td>
           <td><input type="text" name="specific3" class="span1"></td>
           <td><input type="text" name="time3" class="span1"></td>
           <td><input type="text" name="date3" class="date span1"></td>
           <td><input type="radio" name="result3" value="1"></td>
           <td><input type="radio" name="result3" value="0"></td>
           <td><input type="text" name="teacher3" class="span3"></td>
           <td><input type="text" name="head3" class="span3"></td>
           <td><input type="text" name="problem3" class="span3"></td>
           <td><input type="text" name="note3" class="span3"></td>
       </tr>
       <tr>
        <div style="display:none">
            <input type="text" name="unit4" class="unit">
            <input type="text" name="headUnit4" class="headUnit">
            <input type="text" name="belongto4" class="belongto">
            <input type="text" name="course4" class="course">
            <input type="text" name="subject4" class="subject">
        </div>
           <td>4</td>
           <td><input type="text" name="specific4" class="span1"></td>
           <td><input type="text" name="time4" class="span1"></td>
           <td><input type="text" name="date4" class="date span1"></td>
           <td><input type="radio" name="result4" value="1"></td>
           <td><input type="radio" name="result4" value="0"></td>
           <td><input type="text" name="teacher4" class="span3"></td>
           <td><input type="text" name="head4" class="span3"></td>
           <td><input type="text" name="problem4" class="span3"></td>
           <td><input type="text" name="note4" class="span3"></td>
       </tr>
       <tr>
        <div style="display:none">
            <input type="text" name="unit5" class="unit">
            <input type="text" name="headUnit5" class="headUnit">
            <input type="text" name="belongto5" class="belongto">
            <input type="text" name="course5" class="course">
            <input type="text" name="subject5" class="subject">
        </div>
           <td>5</td>
           <td><input type="text" name="specific5" class="span1"></td>
           <td><input type="text" name="time5" class="span1"></td>
           <td><input type="text" name="date5" class="date span1"></td>
           <td><input type="radio" name="result5" value="1"></td>
           <td><input type="radio" name="result5" value="0"></td>
           <td><input type="text" name="teacher5" class="span3"></td>
           <td><input type="text" name="head5" class="span3"></td>
           <td><input type="text" name="problem5" class="span3"></td>
           <td><input type="text" name="note5" class="span3"></td>
       </tr>
    </tbody>
</table>
<div>
    <div>
    <label><u>หมายเหตุ</u> การบันทึกผลการฝึกเป็นหน่วย ให้ทำสำเนาบันทึกหลักฐานไว้ที่หน่วยบังคับบัญชาเหนือขึ้นไป 2 ระดับ</label>
    </div>
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
<div>
    <button type="submit" class="btn btn-primary">บันทึก</button>
    <button type="reset" onclick="window.location='/Train/groupTrain'" class="btn btn-primary">ยกเลิก</button>
</div>
<?= $this->Form->end() ?>

<script>
	$(".date").focus(function(){
		$('.date').datepicker();
	});

    $(".unit").keyup(function(){
        var value = $(".unit").val();
        $(".unit").val(value);
    });
    $(".headUnit").keyup(function(){
        var value = $(".headUnit").val();
        $(".headUnit").val(value);
    });
    $(".belongto").keyup(function(){
        var value = $(".belongto").val();
        $(".belongto").val(value);
    });
    function addCourse(course){
        var value = course;
        $(".course").val(value);
    }
    function addSubject(subject){
        var value = subject;
        $(".subject").val(value);
    }
</script>
