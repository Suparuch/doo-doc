<?php

?>
<script type="text/javascript">
    function edit(id) {
        var editData;
        $.ajax({
            method: "POST",
            url: "edit_person",
            data: "id=" + id,
            success: function(result) {
                editData = result[0][0];
                fillInput(editData);
            },
            dataType: "json"
        });

        function fillInput(editData) {
            console.log(editData);
            $("#editID").val(id);
            $("#editFirstName").val(editData['first_name']);
            $("#editLastName").val(editData['last_name']);
            $("#editPosition").val(editData['position']);
            $("#editExpert").val(editData['expert']);
            $("#editBelongto").val(editData['belongto']);
            editCourse(editData['course']);
            $("#editSubject").val(editData['subject']);
            $("#editSpecific").val(editData['specific']);
            $("#editTime").val(editData['train_time']);
            $("#editDate").val(editData['train_date']);
            if (editData['result'] == "1") {
                $("#editResult1").attr("checked", "checked");
            } else if (editData['result'] == '0') {
                $("#editResult2").attr("checked", "checked");
            }
            $("#editTeacher").val(editData['teacher']);
            $("#editHead").val(editData['head']);
            $("#editProblem").val(editData['problem']);
            $("#editNote").val(editData['note']);

        }

        function editCourse(course) {
            if (course == "1") {
                $("#editCourse1").attr("checked", "checked");
            } else if (course == "2") {
                $("#editCourse2").attr("checked", "checked");
            } else if (course == "3") {
                $("#editCourse3").attr("checked", "checked");
            } else if (course == "4") {
                $("#editCourse4").attr("checked", "checked");
            } else if (course == "5") {
                $("#editCourse5").attr("checked", "checked");
            } else if (course == "6") {
                $("#editCourse6").attr("checked", "checked");
            } else if (course == "7") {
                $("#editCourse7").attr("checked", "checked");
            }
        }

    }

    function deleteID(id) {
        if (confirm("คุณต้องการลบข้อมูลนี้หรือไม่")) {
            $.ajax({
                method: 'POST',
                url: 'delete_person',
                data: 'id=' + id,
                success: function() {
                    location.reload();
                }
            });
        }
    }


    select = 0;

    function selectAll() {
        select++;
        if (select == 2) {
            select = 0;
        }
        if (select == 1) {
            $('input:checkbox.checkboxID').attr("checked", "checked");
        }
        if (select == 0) {
            $('input:checkbox.checkboxID').attr("checked", null);
        }
    }

    function deletePerson() {
        if (confirm("คุณต้องการลบข้อมูลนี้หรือไม่")) {
            $("#delete").submit();
        }
    }
</script>

<div id="jCrumbs" class="breadCrumb module">
    <div style="overflow:hidden; position:relative; width: 967px;">
        <div>
            <ul style="width: 5000px;">
                <li class="first">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="last">
                    ระบบงานฝึกศึกษา >> การจัดการฝึก ข้อมูลแบบบันทึกผลเป็นบุคคล
                </li>
            </ul>
        </div>
    </div>
</div>

<div>
    <a href="#" style="color:green;">ข้อมูลแบบบันทึกผลเป็นบุคคล</a>
    <a href="/doo-doc/www/Train/groupTrain" style="color:green;">ข้อมูลแบบบันทึกผลเป็นหน่วย</a>
</div>
<div style="text-align: center">
    <p>
        <h3>
            ข้อมูลแบบบันทึกผลเป็นบุคคล
        </h3>
    </p>
</div>

<div class="container">
    <?php echo $this->Form->create(); ?>
    <div class="">
        <div class="control-group">
            <div class="span1">
                    <label style="display: inline;">ยศ</label>
                    <div style="display: inline;">
                        <?php
                        echo $this->Form->input('rank', array(
                        'label' => false,
                        'div' => false,
                        'style' => 'width:50px',
                        'class' => 'span12',
                        'options' => $Ranks,
                        'empty' => 'ยศ'
                        ));
                        ?>
                    </div>
            </div>
            <div class="span3">
                <label class="control-label" style="display: inline-block">ชื่อ :</label>
                <div class="controls" style="display: inline-block">
                    <input type="text" name="first_name">
                </div>
            </div>
            <div class="span3">
                <label class="control-label" style="display: inline-block">นามสกุล :</label>
                <div class="controls" style="display: inline-block">
                    <input type="text" name="last_name" style="width: 100%">
                </div>
            </div>
            
            <div class="span3">
                <label class="control-label" style="display: inline-block">ตำแหน่ง :</label>
                <div class="control" style="display: inline-block">
                    <input type="text" name="position" id="position" style="width: 100px">
                </div>
            </div>
        </div>
    </div>
    <div class="control-group">
        <div class="span3">
            <label class="control-label" style="display: inline-block">สังกัด :</label>
            <div class="control" style="display: inline-block">
                <input type="text" name="belongto" style="width: 100px">
            </div>
        </div>
        <div class="span3">
            <label style="display: inline;">ชกท</label>
            <div style="display: inline;">
                <input type="text" class="span2" name="expert" id="">
            </div>
        </div>
        <div class="span4">
            <label class="control-label" style="display: inline-block;">การฝึก/หลักสูตร :</label>
            <div class="control" style="display: inline-block;">
                <select name="course" style="width: 150px" id="">
                    <option value=" ">หลักสูตร</option>
                    <option value="1">การฝึกทหารใหม่</option>
                    <option value="2">การฝึกทหารใหม่เฉพาะเจ้าหน้าที่</option>
                    <option value="3">การฝึกครูทหารใหม่</option>
                    <option value="4">การฝึกสิบตรีกองประจำการ</option>
                    <option value="5">การฝึกตามหน้าที่</option>
                    <option value="6">ตาม ชกท.ของเหล่าต่างๆ</option>
                    <option value="7">การฝึกบิน ฯลฯ</option>
                    <option value="-">อื่นๆ</option>
                </select>
            </div>
        </div>
    </div>
    <div class="control-group">
        <div class="span3" style="">
            <label class="control-label" style="display: inline-block;">ครั้งที่ :</label>
            <div class="control" style="display: inline-block;">
                <input type="text" name="train_time">
            </div>
        </div>
        
    </div>
    <div class="control-group">
    <div class="span3">
            <label class="control-label" style="display: inline-block;">ว-ด-ป :</label>
            <div class="control" style="display: inline-block;">
                <input type="text" name="train_date" class="date">
            </div>
        </div>
        <div class="span4">
            <label class="control-label" style="display: inline-block;">เรื่อง/วิชาที่ทำการฝึก :</label>
            <div style="display: inline-block;">
                <input type="text" name="subject">
            </div>
        </div>
        <div class="span10 text-center">
            <button type="submit" class="btn btn-primary">ค้นหา</button>
            <button type="reset" class="btn btn-primary">ยกเลิก</button>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
<!-- Single button -->


<div class="btn-group">
    <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        <li class="hideme mm_1_add" style="display: list-item;"><a href="/Train/addPersonTrain"><i class="splashy-add"></i> เพิ่ม </a>
        </li>
        <li class="hideme mm_1_delete delete" style="display: list-item;"><a style="cursor:pointer" onclick="deletePerson()" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a>
        </li>
</div>
<?= $this->Form->create(null,array('url'=> array('controller'=>'Train','action' => 'delete_person'),'id'=>'delete')) ?>
    <table class="table table-bordered tablesorter">
        <thead>
            <tr>
                <th style="text-align: center;width:50px; vertical-align: middle;" class="header" rowspan="3">
                    <input type="checkbox" onclick="selectAll()" class="toggle">
                </th>
                <th class="header headerSortDown" style="text-align: center;width:50px; vertical-align: middle;" rowspan="3">ลำดับ</th>
                <th class="header headerSortDown" style="text-align: center;width:50px; vertical-align: middle;" rowspan="3">กิจเฉพาะ</th>
                <th class="header" style="text-align: center;width:50px; vertical-align: middle;" rowspan="3">การฝึก/หลักสูตร </th>
                <th class="header" style="text-align: center;width:50px; vertical-align: middle;" rowspan="3">เรื่อง/วิชาที่ทำการฝึก</th>
                <th class="header" style="text-align: center;" colspan="12">การประเมินผล</th>
                <th class="header" rowspan="3" style="vertical-align: middle;">ปัญหา/ข้อขัดข้อง</th>
                <th class="header" rowspan="3" style="vertical-align: middle;">หมายเหตุ</th>
                <th class="header" rowspan="3"/>
            </tr>
            <tr>
                <th class="header" style="text-align: center;width:70px;" rowspan="">ครั้งที่</th>
                <th class="header" style="text-align: center;width:70px;" rowspan="">ว-ด-ป</th>
                <th class="header" style="text-align: center;" colspan="2">ผลการประเมิน</th>
                <th class="header" style="text-align: center;" rowspan="1" colspan="6">ยศ ชื่อ ตำแหน่ง ชกท สังกัด ของผู้รับประเมินผล</th>
                <th class="header" style="text-align: center;width:200px;" colspan="2">ยศ ชื่อ ตำแหน่ง ของผู้ประเมินผลและข้อคิดเห็น</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th class="header">ผ่าน</th>
                <th class="header">ไม่ผ่าน</th>
                <th class="header">ยศ</th>
                <th class="header">ชื่อ</th>
                <th class="header">นามสกุล</th>
                <th class="header">ตำแหน่ง</th>
                <th class="header">ชกท</th>
                <th class="header">สังกัดใน</th>
                <th class="header">ครูฝึก/ผบช.โดยตรง</th>
                <th class="header">ผบช.ตามลำดับชั้นเหนือขึ้นไป 1 ระดับ</th>
            </tr>
        </thead>
        <tbody class="table-body">
            <?php if(count($data)==0 ){ ?>
            <tr>
                <td colspan="12" style="text-align:center;">
                    ไม่พบข้อมูลที่ตรงกัน
                </td>
            </tr>
            <?php } else{ $count=1 ; foreach ($data as $row) { 
                $row['0']['rank']
            ?>
            <tr>
                <td style="text-align:center;">
                    <input type="checkbox" name="id[]" class="checkboxID" value="<?= $row['0']['id'] ?>">
                </td>
                <td>
                    <?=$count; ?>
                </td>
                <td>
                    <?=$row[ '0'][ 'specific'] ?>
                </td>
                <td>
                    <?php
                     $course = $row[ '0'][ 'course'] ;
                     if($course == 1){echo "การฝึกทหารใหม่";}
                     elseif($course == 2){echo "การฝึกทหารใหม่เฉพาะเจ้าหน้าที่";}
                     elseif($course == 3){echo "การฝึกครูทหารใหม่";}
                     elseif($course == 4){echo "การฝึกสิบตรีกองประจำการ";}
                     elseif($course == 5){echo "การฝึกตามหน้าที่";}
                     elseif($course == 6){echo "ตาม ชกท.ของเหล่าต่างๆ";}
                     elseif($course == 7){echo "การฝึกบิน ฯลฯ";}
                    ?>
                </td>
                <td>
                    <?=$row[ '0'][ 'subject'] ?>
                </td>
                <td>
                    <?=$row[ '0'][ 'train_time'] ?>
                </td>
                <td>
                    <?php if(!empty($row['0']['train_date']))
                        echo $this->DateFormat($row['0']['train_date']);
                    ?>
                </td>
                <?php if($row[ '0'][ 'result']=="0" ){ echo "<td></td><td>&#10003</td>"; } else{ echo "<td>&#10003</td><td></td>"; } ?>
                <td>
                    <?= $row['0']['rank'] ?>
                </td>
                <td>
                    <?=$row[ '0'][ 'first_name']?>
                </td>
                <td>
                    <?=$row[ '0'][ 'last_name']?>
                </td>
                <td>
                    <?=$row[ '0'][ 'position'] ?>
                </td>
                <td>
                    <?=$row[ '0'][ 'expert'] ?>
                </td>
                <td>
                    <?=$row[ '0'][ 'belongto'] ?>
                </td>
                <td>
                    <?=$row[ '0'][ 'teacher']?>
                </td>
                <td>
                    <?=$row[ '0'][ 'head']?>
                </td>
                <td>
                    <?=$row[ '0'][ 'problem']?>
                </td>
                <td>
                    <?=$row[ '0'][ 'note']?>
                </td>
                <td>
                    <a data-toggle="modal" href="#editModal" onclick="edit(<?= $row['0']['id'] ?>)" style="display: inline;"><i class="icon-pencil"></i></a>
                    <a style="display: inline;" href="#" onclick="deleteID(<?= $row['0']['id'] ?>)"><i class="icon-trash"></i></a>
                </td>


            </tr>
            <?php $count++; } } ?>
        </tbody>
    </table>
    <?=$this->Form->end() ?>

        <!-- Modal -->
        <div class="modal fade" id="editModal" style="width: 1691px; top: 40px; left: 280px; display: none; ">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Edit</h4>
                    </div>
                    <div class="modal-body" style="min-height: 500px">
                        <div>
                            <?=$this->Form->create(null,array('url'=> array('controller'=>'Train','action' => 'ajaxEdit_person'))) ?>
                                <input type="hidden" value="" id="editID" name="TrainPerson[id]">
                                <div style="text-align: center;">
                                    <div>
                                        <label>แบบบันทึกผลเป็นบุคคล</label>
                                    </div>
                                    <div style="text-align: left;">
                                        <div style="display: inline;">
                                            <label style="display: inline;">ยศ</label>
                                            <div style="display: inline;">
                                                <?php
                                                echo $this->Form->input('rank', array(
                                                'label' => false,
                                                'div' => false,
                                                'style' => 'width:50px',
                                                'class' => 'span12',
                                                'options' => $Ranks,
                                                'empty' => 'ยศ'
                                                ));
                                                ?>
                                            </div>
                                        </div>
                                        <div style="display: inline;">
                                            <label style="display: inline;">ชื่อ</label>
                                            <div style="display: inline;">
                                                <input type="text" name="TrainPerson[first_name]" id="editFirstName">
                                            </div>
                                        </div>
                                        <div style="display: inline;">
                                            <label style="display: inline;">นามสกุล</label>
                                            <div style="display: inline;">
                                                <input type="text" name="TrainPerson[last_name]" id="editLastName">
                                            </div>
                                        </div>

                                        <div style="display: inline;">
                                            <label style="display: inline;">ตำแหน่ง</label>
                                            <div style="display: inline;">
                                                <input type="text" class="span2" name="TrainPerson[position]" id="editPosition">
                                            </div>
                                        </div>
                                        <div style="display: inline;">
                                            <label style="display: inline;">ชกท</label>
                                            <div style="display: inline;">
                                                <input type="text" class="span2" name="TrainPerson[expert]" id="editExpert">
                                            </div>
                                        </div>
                                        <div style="display: inline;">
                                            <label style="display: inline;">สังกัด</label>
                                            <div style="display: inline;">
                                                <input type="text" name="TrainPerson[belongto]" id="editBelongto">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: left;">
                                        <div class="span3" style="display: inline-block;">
                                            <label style="">การฝึกตามระเบียบและหลักสูตรการฝึก</label>
                                        </div>
                                        <div class="" style="display: inline-block; margin-left: -40px">
                                            <label class="radio inline">
                                                <input type="radio" id="editCourse1" name="TrainPerson[course]" value="1">การฝึกทหารใหม่</label>
                                            <label class="radio inline">
                                                <input type="radio" id="editCourse2" name="TrainPerson[course]" value="2">การฝึกทหารใหม่เฉพาะเจ้าหน้าที่</label>
                                            <label class="radio inline">
                                                <input type="radio" id="editCourse3" name="TrainPerson[course]" value="3">การฝึกครูทหารใหม่</label>
                                            <br>
                                            <label class="radio inline">
                                                <input type="radio" id="editCourse4" name="TrainPerson[course]" value="4">การฝึกสิบตรีกองประจำการ</label>
                                            <label class="radio inline">
                                                <input type="radio" id="editCourse5" name="TrainPerson[course]" value="5">การฝึกตามหน้าที่</label>
                                            <label class="radio inline">
                                                <input type="radio" id="editCourse6" name="TrainPerson[course]" value="6">ตาม ชกท.ของเหล่าต่างๆ</label>
                                            <label class="radio inline">
                                                <input type="radio" id="editCourse7" name="TrainPerson[course]" value="7">การฝึกบิน ฯลฯ </label>
                                        </div>
                                    </div>
                                    <div style="text-align: left;">
                                        <label class="inline" style="display: inline;">เรื่อง/วิชาที่ทำการฝึก</label>
                                        <div class="inline" style="display: inline;">
                                            <input type="text" name="TrainPerson[subject]" id="editSubject">
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered tablesorter">
                                    <thead>
                                        <tr>
                                            <th class="header headerSortDown" style="text-align: center;width:50px;" rowspan="3">ลำดับ</th>
                                            <th class="header headerSortDown" style="text-align: center;width:50px;" rowspan="3">กิจเฉพาะ</th>
                                            <th class="header" style="text-align: center;" colspan="6">การประเมินผล</th>
                                            <th class="header" rowspan="3">ปัญหาข้อขัดคล้อง</th>
                                            <th class="header" rowspan="3">หมายเหตุ</th>
                                            <th class="header" rowspan="3">
                                                </>
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
                                            <td>1</td>
                                            <td>
                                                <input type="text" class="span1" id="editSpecific" name="TrainPerson[specific]">
                                            </td>
                                            <td>
                                                <input type="text" name="TrainPerson[time]" id="editTime" class="span1">
                                            </td>
                                            <td>
                                               <input type="text" class="date" id="editDate" name="TrainPerson[date]" class="span1">
                                            </td>
                                            <td>
                                                <input type="radio" name="TrainPerson[result]" id="editResult1" value="1">
                                            </td>
                                            <td>
                                                <input type="radio" name="TrainPerson[result]" id="editResult2" value="0">
                                            </td>
                                            <td>
                                                <input type="text" name="TrainPerson[teacher]" id="editTeacher" class="span2">
                                            </td>
                                            <td>
                                                <input type="text" name="TrainPerson[head]" id="editHead" class="span2">
                                            </td>
                                            <td>
                                                <input type="text" name="TrainPerson[problem]" id="editProblem" class="span2">
                                            </td>
                                            <td>
                                                <input type="text" name="TrainPerson[note]" id="editNote" class="span2">
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div>
                                    <label><u>หมายเหตุ</u> การบันทึกผลการฝึกบุคคล ให้ทำสำเนาบันทึกหลักฐานไว้ที่หน่วยบังคับบัญชาขึ้นไปถึงระดับกองร้อยหรือเทียบเท่า</label>
                                    <div style="text-align: right;">
                                        <div style="text-align: left;">
                                            <label>ตรวจความถูกต้อง</label>
                                            <div>
                                                <label style="display: inline;">ชื่อ</label>
                                                <input type="text" id="editName2" name="TrainPerson[name2]">
                                            </div>
                                            <div>
                                                <label style="display: inline;">ตำแหน่ง</label>
                                                <input type="text" id="editPosition2" name="TrainPerson[position2]">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="center" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary">บันทึก</button>
                                    <button type="reset" class="btn btn-primary" data-dismiss="modal">ยกเลิก</button>
                                </div>
                                <?=$this->Form->end() ?>

                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>



        <script>
            var position=[];
            $( window ).on( "load", function(){
                $.ajax({
                        url: "getPosition",
                        dataType: "json",
                        success: function( data ) {
                            for(var x in data){
                                position.push(data[x])
                            }
                                position.splice(0, 1);
                            $("#position").autocomplete({
                                source: position,
                                minLength: 2
                            });
                            $("#editPosition").autocomplete({
                                source: position,
                                minLength: 2
                            });
                        }
                    });
                    
            } );
            $(".date").focus(function() {
                $('.date').datepicker();
            });
        </script>