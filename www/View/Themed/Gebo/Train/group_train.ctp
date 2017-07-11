<script>
    function edit(id) {
        var editData;
        $.ajax({
            method: "POST",
            url: "edit_group",
            data: "id=" + id,
            success: function(result) {
                editData = result[0][0];
                fillInput(editData);
            },
            dataType: "json"
        });

        function fillInput(editData) {
            $("#editID").val(id);
            $("#editUnit").val(editData['unit']);
            $("#editBelongto").val(editData['belongto']);
            $("#editSpecific").val(editData['specific']);
            $("#editTime").val(editData['train_time']);
            $("#editDate").val(editData['train_date']);
            $("#editTeacher").val(editData['teacher']);
            $("#editHeadUnit").val(editData['headUnit']);
            $("#editHead").val(editData['head']);
            $("#editProblem").val(editData['problem']);
            $("#editNote").val(editData['note']);

            var course = Array("ชุดยิง", "หมู่", "หมวด", "กองร้อย", "กองพัน");
            var i;
            for (i = 0; i < course.length; i++) {
                if (course[i] == editData['course']) {
                    $("#course" + (i + 1)).attr("checked", "checked");
                }
            }
            var subject = Array("ดำเนินกลยุทธ", "การยิงสนับสนุน", "การข่าวกรอง", "ความคล่องแคล่ว", "การป้องกันภัยทางอากาศ", "การช่วยรบ", "การควบคุมบัญชา");
            for (i = 1; i <= subject.length; i++) {
                if (subject[i - 1] == editData['subject']) {
                    $("#subject" + (i)).attr("checked", "checked");
                }
            }

            if (editData['result'] == "1") {
                $("#editResult1").attr("checked", "checked");
            } else {
                $("#editResult0").attr("checked", "checked");
            }
        }
    }

    function deleteID(id) {
        if (confirm("คุณต้องการลบข้อมูลนี้หรือไม่")) {
            $.ajax({
                method: "POST",
                url: "delete_group",
                data: "id=" + id,
                success: function() {
                    location.reload();
                }
            });
        }
    }
    var select = 0;

    function selectAll() {
        select++;
        if (select == 1) {
            $("input:checkbox.checkSelect").attr("checked", "checked");
            select = 2;
        } else {
            $("input:checkbox.checkSelect").attr("checked", null);
            select = 0;
        }
    }

    function deleteSelect() {
        if (confirm("คุณต้องการลบข้อมูลนี้หรือไม่")) {
            $("#delete").submit();
        }
    }
</script>

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
                            ระบบงานฝึกศึกษา >> การจัดการฝึก ข้อมูลแบบบันทึกผลเป็นหน่วย
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <a href="/Train/index" style="color:green;">ข้อมูลแบบบันทึกผลเป็นบุคคล</a>
    <a href="#" style="color:green;">ข้อมูลแบบบันทึกผลเป็นหน่วย</a>
</div>
<div style="text-align: center;">
    <p>
        <h3>
            ข้อมูลแบบบันทึกผลเป็นหน่วย
        </h3>
    </p>
</div>
<?php echo $this->Form->create(); ?>
<div>
    <table style="text-align: right;margin-left: auto;margin-right: auto;">
        <tbody>
            <tr>
                <td>
                    หน่วย :
                </td>
                <td>
                    <?php
                        echo $this->Form->input('unit', array(
                        'label' => false,
                        'div' => false,
                        'class' => 'span12',
                        'default' => "หน่วย ",
                        'style' => 'width:100%',
                        'options' => $Units,
                        'empty' => 'หน่วย'
                        ));
                    ?>
                </td>
                <td>
                    ผบ.หน่วย :
                </td>
                <td>
                    <input type="text" name="headUnit">
                </td>
            </tr>
            <tr>
                <td>
                    ยศ :
                </td>
                <td>
                    <?php
                        echo $this->Form->input('rank', array(
                        'label' => false,
                        'div' => false,
                        'class' => 'span12',
                        'style' => 'width:100%',
                        'default' => "ยศ",
                        'options' => $Ranks,
                        'empty' => 'ยศ'
                        ));
                    ?>
                </td>
                <td>
                    ชื่อ :
                </td>
                <td>
                    <input type="text" name="name">
                </td>
                <td>
                    หน่วยขึ้นตรง :
                </td>
                <td>
                        <?php
                            echo $this->Form->input('belongTo', array(
                            'label' => false,
                            'div' => false,
                            'class' => 'span12',
                            'style' => 'width:100%',
                            'default' => "หน่วย",
                            'options' => $Units,
                            'empty' => 'หน่วย'
                            ));
                        ?>
                </td>
            </tr>
            <tr>
                <td>
                    การฝึก/หลักสูตร :
                </td>
                <td>
                    <select name="course">
                        <option value=" ">หลักสูตร</option>
                        <option value="ชุดยิง">ชุดยิง</option>
                        <option value="หมู่">หมู่</option>
                        <option value="หมวด">หมวด</option>
                        <option value="กองร้อย">กองร้อย</option>
                        <option value="กองพัน">กองพัน</option>
                    </select>
                </td>
                <td>
                    เรื่อง/วิชาที่ทำการฝึก :
                </td>
                <td>
                    <select name="subject">
                     <option value=" ">วิชาที่ทำการฝึก</option>
                     <option value="ดำเนินกลยุทธ">ดำเนินกลยุทธ</option>
                     <option value="การยิงสนับสนุน">การยิงสนับสนุน</option>
                     <option value="การข่าวกรอง">การข่าวกรอง</option>
                     <option value="ความคล่องแคล่ว">ความคล่องแคล่ว</option>
                     <option value="การป้องกันภัยทางอากาศ">การป้องกันภัยทางอากาศ</option>
                     <option value="การช่วยรบ">การช่วยรบ</option>
                     <option value="การควบคุมบัญชา">การควบคุมบัญชา</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    กิจเฉพาะ :
                </td>
                <td>
                    <input type="text" name="specific">
                </td>
                <td>
                    ครั้งที่ :
                </td>
                <td>
                    <input type="text" name="time">
                </td>
                <td>
                    ว-ด-ป :
                </td>
                <td>
                    <input type="text" name="date" class="date">
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="" style="text-align: center;">
    <button type="submit" class="btn btn-primary">ค้นหา</button>
    <button type="reset" class="btn btn-primary">ยกเลิก</button>
</div>
<?php echo $this->Form->end(); ?>
<div class="btn-group">
    <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span></button>
    <ul class="dropdown-menu">
        <li class="hideme mm_1_add" style="display: list-item;"><a href="/Train/addGroupTrain"><i class="splashy-add"></i> เพิ่ม </a></li>
        <li class="hideme mm_1_delete delete" style="display: list-item;"><a style="cursor:pointer" onclick="deleteSelect()" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
</div>
<table class="table table-bordered tablesorter" style="margin-top: 20px;">
    <thead>
        <tr>
            <th style="text-align:center; width:50px;" class="header" rowspan="3">
                <input type="checkbox" onclick="selectAll()">
            </th>
            <th class="header headerSortDown" style="text-align: center;width:50px;" rowspan="3">ลำดับ</th>
            <th class="header headerSortDown" style="text-align: center;width:50px;" rowspan="3">กิจเฉพาะ</th>
            <th class="header" rowspan="3" style="text-align: center;width:50px; vertical-align: middle;">การฝึก/หลักสูตร</th>
            <th class="header" rowspan="3" style="text-align: center;width:50px; vertical-align: middle;">เรื่อง/วิชาที่ทำการฝึก</th>
            <th class="header" style="text-align: center;" colspan="6">การประเมินผล</th>
            <th class="header" rowspan="3">ปัญหาข้อขัดคล้อง</th>
            <th class="header" rowspan="3">หมายเหตุ</th>
            <th class="header" rowspan="3" style="width: 35px">
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
        <?php
        if(count($data)==0){
            echo "<tr>
            <td colspan='13' style='text-align:center'>ไม่พบข้อมูล</td>
            </tr>";
        }
        echo  $this->Form->create(null,array('url'=> array('controller'=>'Train','action' => 'delete_group'),'id'=>'delete')) ;
        $count = 1;
            foreach ($data as $row) {
                ?>
            <tr>
                <td style="text-align:center;">
                    <input type="checkbox" class="checkSelect" name="check[]" value="<?=$row[0]['id']?>">
                </td>
                <td>
                    <?= $count ?>
                </td>
                <td>
                    <?= $row[0]['specific'] ?>
                </td>
                <td>
                    <?= $row[0]['course']?>
                </td>
                <td>
                    <?= $row[0]['subject']?>
                </td>
                <td>
                    <?= $row[0]['train_time'] ?>
                </td>
                <td>
                    <?php
                            $sqldate = strtotime( $row['0']['train_date']);
                            $data = date("d-m-Y", $sqldate);
                            echo $data;
                     ?>
                </td>
                <?php if($row[0]['result']=='1') echo "<td> &#10003</td><td></td>";
                    else{
                        echo "<td></td><td> &#10003</td>";
                    }
                    ?>
                <td>
                    <?= $row[0]['teacher'] ?>
                </td>
                <td>
                    <?= $row[0]['head'] ?>
                </td>
                <td>
                    <?= $row[0]['problem'] ?>
                </td>
                <td>
                    <?= $row[0]['note'] ?>
                </td>
                <td>
                    <a data-toggle="modal" href="#editModal" onclick="edit(<?= $row[0]['id'] ?>)" style="display: inline;"><i class="icon-pencil"></i></a>
                    <a style="display: inline;" href="#" onclick="deleteID(<?= $row[0]['id'] ?>)"><i class="icon-trash"></i></a>
                </td>
            </tr>
            <?php
                    $count++;
            }
            echo $this->Form->end();
        ?>

    </tbody>
</table>

<div class="modal fade" id="editModal" style="width: 1691px; top: 40px; left: 280px; display: none; ">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit</h4>
            </div>
            <div class="modal-body" style="min-height: 500px">
                <div style="text-align: center;">

                    <?= $this->Form->create(null,array('url'=> array('controller'=>'Train','action' => 'ajaxEdit_group'))) ?>
                        <input type="hidden" value="" id="editID" name="id">
                        <label>แบบบันทึกผลเป็นหน่วย</label>

                        <div>
                            <div style="display: inline;">
                                <label style="display: inline;">หน่วย</label>
                                <input type="text" name="unit" id="editUnit">
                            </div>
                            <div style="display: inline;">
                                <label style="display: inline;">ผบ.หน่วย</label>
                                <input type="text" name="headUnit" id="editHeadUnit" placeholder="ยศ-ชื่อ">
                            </div>
                            <div style="display: inline;">
                                <label style="display: inline;">เป็นหน่วยขึ้นตรงของ</label>
                                <input type="text" name="belongto" id="editBelongto" placeholder="เหนือขึ้นไปถึงระดับ กรม หรือเทียบเท่า">
                            </div>
                        </div>
                        <div>
                            <label style="display: inline-block;">การฝึกตามระเบียบและหลักสูตรการฝึกเป็นหน่วย</label>
                            <div style="display: inline-block;">
                                <label class="radio inline">
                                            <input type="radio" id="course1" name="course" value="ชุดยิง">ชุดยิง</label>
                                <label class="radio inline">
                                            <input type="radio" id="course2" name="course" value="หมู่">หมู่</label>
                                <label class="radio inline">
                                            <input type="radio" id="course3" name="course" value="หมวด">หมวด</label>
                                <label class="radio inline">
                                            <input type="radio" id="course4" name="course" value="กองร้อย">กองร้อย</label>
                                <label class="radio inline">
                                            <input type="radio" id="course5" name="course" value="กองพัน">กองพัน</label>
                            </div>
                        </div>
                        <div style="">
                            <div class="span2">
                                <label>เรื่อง/วิชาที่ทำการฝึก</label>
                            </div>
                            <div class="span5" style="margin-left: -20px;">
                                <label class="radio inline">
                                            <input type="radio" id="subject1" name="subject" value="ดำเนินกลยุทธ">ดำเนินกลยุทธ</label>
                                <label class="radio inline">
                                            <input type="radio" id="subject2" name="subject" value="การยิงสนับสนุน">การยิงสนับสนุน</label>
                                <label class="radio inline">
                                            <input type="radio" id="subject3" name="subject" value="การข่าวกรอง">การข่าวกรอง</label>
                                <label class="radio inline">
                                            <input type="radio" id="subject4" name="subject" value="ความคล่องแคล่ว">ความคล่องแคล่ว</label>
                                <br>
                                <label class="radio inline">
                                            <input type="radio" id="subject5" name="subject" value="การป้องกันภัยทางอากาศ">การป้องกันภัยทางอากาศ</label>
                                <label class="radio inline">
                                            <input type="radio" id="subject6" name="subject" value="การช่วยรบ">การช่วยรบ</label>
                                <label class="radio inline">
                                            <input type="radio" id="subject7" name="subject" value="การควบคุมบัญชา">การควบคุมบัญชา</label>
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
                                    <th class="header" rowspan="3" style="width: 35px">
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
                                        <input type="text" id="editSpecific" class="span1" name="specific">
                                    </td>
                                    <td>
                                        <input type="text" id="editTime" name="time" class="span1">
                                    </td>
                                    <td>
                                        <input type="text" id="editDate" name="date" class="date span1">
                                    </td>
                                    <td>
                                        <input type="radio" id="editResult1" name="result" value="1">
                                    </td>
                                    <td>
                                        <input type="radio" id="editResult0" name="result" value="0">
                                    </td>
                                    <td>
                                        <input type="text" id="editTeacher" name="teacher" class="span3">
                                    </td>
                                    <td>
                                        <input type="text" id="editHead" name="head" class="span3">
                                    </td>
                                    <td>
                                        <input type="text" id="editProblem" name="problem" class="span3">
                                    </td>
                                    <td>
                                        <input type="text" id="editNote" name="note" class="span3">
                                    </td>
                                    <td></td>
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
                                    <input type="text" name="name2">
                                </div>
                                <div>
                                    <label style="display: inline;">ตำแหน่ง</label>
                                    <input type="text" id="" name="position">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="center" style="text-align: center;">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                    <button type="reset" class="btn btn-primary" data-dismiss="modal">ยกเลิก</button>
                </div>
                <?= $this->Form->end() ?>

            </div>
        </div>
        <div class="modal-footer">
        </div>
    </div>
</div>

<script>
    $(document).read(function() {
        $(".date").focus(function() {
            $('.date').datepicker();
        });
    });
</script>