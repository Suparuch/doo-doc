<script>
  function edit(id) {
    $.ajax({
      method: 'post',
      url: "edit_data",
      data: "id=" + id,
      success: function(data) {
        console.log(data);
        fillData(data[0][0]);
      },
      dataType: 'json'
    });

    function fillData(data) {
      $("#editID").val(data['id']);
      $("#editCourse").val(data['course']);
      $("#editUnit").val(data['unit'])
      $("#editLocationunit").val(data['locationunit']);
      $("#editPurpose").val(data['purpose']);
      $("#editFromdatetrain").val(data['fromdatetrain']);
      $("#editTodatetrain").val(data['todatetrain']);
      $("#editCountdaytrain").val(data['countdaytrain']);
      $("#editBasetrain").val(data['basetrain']);
      $("#editFromdatebase").val(data['fromdatebase']);
      $("#editTodatebase").val(data['todatebase']);
      $("#editCountdatebase").val(data['countdatebase']);
      $("#editOutbaselocation").val(data['outbaselocation']);
      $("#editFromdateoutbase").val(data['fromdateoutbase']);
      $("#editTodateoutbase").val(data['todateoutbase']);
      $("#editCountdayoutbase").val(data['countdayoutbase']);
      $("#editResultlocation").val(data['resultlocation']);
      $("#editFromdateresult").val(data['fromdateresult']);
      $("#editTodateresult").val(data['todateresult']);
      $("#editCountdayresult").val(data['countdayresult']);
      $("#editOnlypersonlist").val(data['onlypersonlist']);
      $("#editOnlyunitlist").val(data['onlyunitlist']);
      $("#editLocation").val(data['location']);
      $("#editN1").val(data['n1']);
      $("#editS1").val(data['s1']);
      $("#editPl1").val(data['pl1']);
      $("#editNote1").val(data['note1']);
      $("#editN2").val(data['n2']);
      $("#editS2").val(data['s2']);
      $("#editPl2").val(data['pl2']);
      $("#editNote2").val(data['note2']);
      $("#editN3").val(data['n3']);
      $("#editS3").val(data['s3']);
      $("#editPl3").val(data['pl3']);
      $("#editNote3").val(data['note3']);
      $("#editN4").val(data['n4']);
      $("#editS4").val(data['s4']);
      $("#editPl4").val(data['pl4']);
      $("#editNote4").val(data['note4']);
      $("#editWeapon").val(data['weapon']);
      $("#editVehicle").val(data['vehicle']);
      $("#editSupport5").val(data['support5']);
      $("#editTarget").val(data['target']);
      $("#editAllowance").val(data['allowance']);
      $("#editOther").val(data['other']);
      $("#editResultpurpose").val(data['resultpurpose']);
      $("#editUnitandperson").val(data['unitandperson']);
      $("#editGood").val(data['good']);
      $("#editBad").val(data['bad']);
      $("#editProblem").val(data['problem']);
      $("#editSpecialEvent").val(data['specialevent']);
      $("#editSituation").val(data['situation']);
      $("#editAnalyze").val(data['analyze']);
      $("#editEnemy").val(data['enemy']);
      $("#editOur").val(data['our']);
      $("#editEnemyweakness").val(data['enemyweakness']);
      $("#editEnemystrength").val(data['enemystrength']);
      $("#editEnemyblock").val(data['enemyblock']);
      $("#editEnemychance").val(data['enemychance']);
      $("#editOurweakness").val(data['ourweakness']);
      $("#editOurstrength").val(data['ourstrength']);
      $("#editOurblock").val(data['ourblock']);
      $("#editOurchance").val(data['ourchance']);
      $("#editImprove").val(data['improve']);
      $("#editEnemystrength").val(data['enemystrength']);
    }
  }

  function deleteID(id) {
    if (confirm("คุณต้องการลบข้อมูลนี้หรือไม่")) {
      $.ajax({
        method: "POST",
        url: "delete_report",
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
      $("input:checkbox.selectID").attr("checked", "checked");
      select = 2;
    } else {
      $("input:checkbox.selectID").attr("checked", null);
      select = 0;
    }
  }

  function deleteSelect() {
    if (confirm("คุณต้องการลบข้อมูลนี้หรือไม่")) {
      $("#delete").submit();
    }
  }
</script>
<style type="text/css">
    .table thead tr th {
        text-align: center;
        vertical-align: middle;
    }

    label,
    input {
        margin-left: 15px;
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
                            ระบบงานฝึกศึกษา &gt;&gt; รายงานผลการฝึกของหน่วยจัดการฝึก
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
</div>
<!--<a href="/reportTraining/manage">การจัดกำลังเข้าทำการฝึก</a>|-->

<div style="text-align:center;">
    <p>
    <h3>รายงานผลการฝึกของหน่วยจัดการฝึก</h3>
    </p>
</div>
<?= $this->Form->create() ?>
<div style="margin-top: 20px; text-align:left">
    <div>
        <div style="display: inline;">
            <label style="display: inline;">หลักสูตรการฝึก : </label>
            <input type="text" name="course">
        </div>
        <div style="display: inline;">
            <label style="display: inline;">หน่วย : </label>
            <input type="text" name="unit">
        </div>
        <div style="display: inline;">
            <label style="display: inline;">ที่ตั้งหน่วย : </label>
            <input type="text" name="locationunit">
        </div>
    </div>
    <div>
        <div style="display: inline;">
            <label style="display: inline;">ช่วงเวลาการฝึก : </label>
            <input type="text" class="date" name="fromdatetrain" style="width: 90px">
        </div>
        <div style="display: inline;">
            <label style="display: inline;">ถึง</label>
            <input type="text" class="date" name="todatetrain" style="width: 90px">
        </div><br>
        <div style="display: inline;">
            <label style="display: inline;">การฝึกในหน่วยที่ตั้งหน่วย : </label>
            <label style="display: inline;">สถานที่ : </label>
            <input type="text" name="basetrain">
        </div>
        <div style="display: inline;">
            <label style="display: inline;">ตั้งแต่ : </label>
            <input type="text" class="date" name="fromdatebase" style="width: 90px">
        </div>
        <div style="display: inline;">
            <label style="display: inline;">ถึง : </label>
            <input type="text" class="date" name="todatebase" style="width: 90px">
        </div><br>
    </div>
    <div>
        <div style="display: inline;">
            <label style="display: inline;">การฝึกนอกที่ตั้งหน่วย : </label>
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
        </div><br>
    </div>
    <div>
        <div style="display: inline;">
            <label style="display: inline;">การตรวจสอบประเมินผล : </label>
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
    </div>
    <div>
        <div style="display: inline;">
            <label style="display: inline;">ที่ทำการฝึก : </label>
            <label style="display: inline;">รายการเฉพาะบุคคล : </label>
            <input type="text" name="onlypersonlist">
            <label style="display: inline;">รายการกิจเฉพาะหน่วย : </label>
            <input type="text" name="onlyunitlist">
        </div>
        <div>
            <label style="display: inline;">พื้นที่ทำการฝึก : </label>
            <input type="text" name="location">
            <div>
                <button type="submit" class="btn btn-primary">ค้นหา</button>
                <button type="reset" class="btn btn-primary">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end() ?>
<div class="btn-group">
    <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span></button>
    <ul class="dropdown-menu">
        <li class="hideme mm_1_add" style="display: list-item;"><a href="/reportTraining/add"><i class="splashy-add"></i> เพิ่ม </a></li>
        <li class="hideme mm_1_delete delete" style="display: list-item;"><a style="cursor:pointer" onclick="deleteSelect()" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
</div>
<table class="table table-bordered tablesorter">
    <thead>
    <tr>
        <th rowspan="2"><input type="checkbox" onclick="selectAll()"></th>
        <th rowspan="2">ลำดับ</th>
        <th rowspan="2">หลักสูตรการฝึก</th>
        <th rowspan="2">หน่วย</th>
        <th rowspan="2">ที่ตั้งหน่วย</th>
        <th rowspan="2">วัตถุประสงค์การฝึก</th>
        <th rowspan="" colspan="3">การฝึก(ว./ด./ป.)</th>
        <th colspan="2">เรื่องที่ทำการฝึก</th>
        <th rowspan="2">พื้นที่ทำการฝึก</th>
        <th rowspan="2"></th>
    </tr>
    <tr>
        <th>ให้ที่ตั้งหน่วย สถานที่</th>
        <th>นอกที่ตั้งหน่วยสถานที่</th>
        <th>ประเมินการฝึกสถานที่</th>
        <th>รายการเฉพาะเป็นบุคคล</th>
        <th>รายการกิจเฉพาะเป็นหน่วย</th>
    </tr>
    </thead>
    <tbody>
    <?php
    echo $this->Form->create(null,array('url'=> array('controller'=>'ReportTraining','action' => 'delete_report'),'id'=>'delete'));
    $no = 1;
    if(count($data) == 0){
        echo "<tr><td colspan='14' style='text-align:center'>ไม่พบข้อมูล</td></tr>";
    }
    foreach ($data as $row){
        ?>
        <tr>
            <td style="text-align: center;">
                <input type="checkbox" class="selectID" name="id[]" value="<?= $row[0]['id']?>">
            </td>
            <td>
                <?= $no ?>
            </td>
            <td>
                <?= $row[0]['course'] ?>
            </td>
            <td>
                <?= $row[0]['unit'] ?>
            </td>
            <td>
                <?= $row[0]['locationunit'] ?>
            </td>
            <td>
                <?= $row[0]['purpose'] ?>
            </td>
            <td>
                สถานที่ :
                <?= $row[0]['basetrain']."<br>" ?> ตั้งแต่ :
                <?php
                $fromdatetrain = strtotime( $row[0]['fromdatebase']);
                $fromdatetrain = $this->DateFormat->formatDateThai($fromdatetrain);
                echo $fromdatetrain."<br> ถึง ";
                $todatetrain = strtotime( $row[0]['todatebase']);
                $todatetrain = $this->DateFormat->formatDateThai($todatetrain);
                echo $todatetrain;
                echo "<br>จำนวนวัน : ".$row[0]['countdatebase'];
                ?>
            </td>
            <td>
                สถานที่ :
                <?= $row[0]['outbaselocation']."<br>" ?> ตั้งแต่ :
                <?php
                $fromdatetrain = strtotime( $row[0]['fromdateoutbase']);
                $fromdatetrain = $this->DateFormat->formatDateThai($fromdatetrain);
                echo $fromdatetrain."<br> ถึง ";
                $todatetrain = strtotime( $row[0]['todateoutbase']);
                $todatetrain = $this->DateFormat->formatDateThai($todatetrain);
                echo $todatetrain;
                echo "<br> จำนวนวัน : ".$row[0]['countdayoutbase'];
                ?>
            </td>
            <td>
                สถานที่ :
                <?= $row[0]['resultlocation']."<br>" ?> ตั้งแต่ :
                <?php
                $fromdatetrain = strtotime( $row[0]['fromdateresult']);
                $fromdatetrain = $this->DateFormat->formatDateThai($fromdatetrain);
                echo $fromdatetrain."<br> ถึง ";
                $todatetrain = strtotime( $row[0]['todateresult']);
                $todatetrain = $this->DateFormat->formatDateThai($todatetrain);
                echo $todatetrain;
                echo "<br> จำนวนวัน : ".$row[0]['countdayresult'];
                ?>
            </td>
            <td>
                <?= $row[0]['onlypersonlist']?>
            </td>
            <td>
                <?= $row[0]['onlyunitlist']?>
            </td>
            <td>
                <?= $row[0]['location']?>
            </td>
            <td>
                <a data-toggle="modal" href="#editModal" onclick="edit(<?= $row[0]['id'] ?>)" style="display: inline;"><i class="icon-pencil"></i></a>
                <a style="display: inline;" href="#" onclick="deleteID(<?= $row[0]['id'] ?>)"><i class="icon-trash"></i></a>
            </td>
        </tr>
        <?
        $no++;
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

                <div>
                    <?= $this->Form->create(null,array('url'=> array('controller'=>'ReportTraining','action'=>'ajaxEdit_report'))) ?>
                    <input type="hidden" name="id" id="editID">
                    <div style="">
                        <label style="display: inline;">1.&nbsp;&nbsp;หลักสูตรการฝึก : </label>
                        <input type="text" name="course" id="editCourse">
                    </div>
                    <div style="">
                        <label style="display: inline;">2.&nbsp;&nbsp;หน่วย : </label>
                        <input type="text" name="unit" id="editUnit">
                        <label style="display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;ที่ตั้งหน่วย :</label>
                        <input type="text" name="locationunit" id="editLocationunit">
                    </div>
                    <div>
                        <label style="display: inline;">3.&nbsp;&nbsp;วัตถุประสงค์การฝึก :</label>
                        <input type="text" name="purpose" id="editPurpose">
                    </div>
                    <div style="">
                        <div style="display: inline;">
                            <label style="display: inline;">4.&nbsp;&nbsp;ช่วงเวลาการฝึก ตั้งแต่ : </label>
                            <input type="text" class="date" name="fromdatetrain" id="editFromdatetrain" style="width: 90px">
                        </div>
                        <div style="display: inline;">
                            <label style="display: inline;">&nbsp;&nbsp;ถึง :</label>
                            <input type="text" class="date" name="todatetrain" id="editTodatetrain" style="width: 90px">
                        </div>
                        <div style="display: inline;">
                            <label style="display: inline;">&nbsp;&nbsp;รวมจำนวนวันที่ทำการฝึก :</label>
                            <input type="text" name="countdaytrain" id="editCountdaytrain">
                            <label style="display: inline;">&nbsp;วัน</label>
                        </div>
                    </div>
                </div>
                <div style="margin-left:20px">
                    <div style="">
                        <label style="display: inline;">4.1 การฝึกในหน่วยที่ตั้งหน่วย สถานที่ : </label>
                        <input type="text" name="basetrain" id="editBasetrain">
                    </div>
                    <div style="display: inline;">
                        <label style="display: inline;">ตั้งแต่ :&nbsp;</label>
                        <input type="text" class="date" name="fromdatebase" id="editFromdatebase" style="width: 90px">
                    </div>
                    <div style="display: inline;">
                        <label style="display: inline;">ถึง : </label>
                        <input type="text" class="date" name="todatebase" id="editTodatebase" style="width: 90px">
                    </div>
                    <div style="display: inline;">
                        <label style="display: inline;">รวมจำนวนที่ทำการฝึก</label>
                        <input type="text" name="countdatebase" id="editCountdatebase">
                        <label style="display: inline;">วัน</label>
                    </div>
                </div>
                <div style="margin-left:20px">
                    <div style="">
                        <label style="display: inline;">4.2 การฝึกนอกหน่วยที่ตั้งหน่วย</label>
                        <label style="display: inline;">สถานที่ : </label>
                        <input type="text" name="outbaselocation" id="editOutbaselocation">
                    </div>
                    <div style="display: inline;">
                        <label style="display: inline;">ตั้งแต่ : </label>
                        <input type="text" class="date" name="fromdateoutbase" id="editFromdateoutbase" style="width: 90px">
                    </div>
                    <div style="display: inline;">
                        <label style="display: inline;">ถึง : </label>
                        <input type="text" class="date" name="todateoutbase" id="editTodateoutbase" style="width: 90px">
                    </div>
                    <div style="display: inline;">
                        <label style="display: inline;">รวมจำนวนที่ทำการฝึก</label>
                        <input type="text" name="countdayoutbase" id="editCountdayoutbase">
                        <label style="display: inline;">วัน</label>
                    </div>
                </div>
                <div style="margin-left:20px">
                    <div style="">
                        <label style="display: inline;">4.3 การตรวจสอบประเมินผลการฝึก </label>
                        <label style="display: inline;">สถานที่ : </label>
                        <input type="text" name="resultlocation" id="editResultlocation">
                    </div>
                    <div style="display: inline;">
                        <label style="display: inline;">ตั้งแต่ : </label>
                        <input type="text" class="date" name="fromdateresult" id="editFromdateresult" style="width: 90px">
                    </div>
                    <div style="display: inline;">
                        <label style="display: inline;">ถึง : </label>
                        <input type="text" class="date" name="todateresult" id="editTodateresult" style="width: 90px">
                    </div>
                    <div style="display: inline;">
                        <label style="display: inline;">รวมจำนวนที่ทำการฝึก</label>
                        <input type="text" name="countdayresult" id="editCountdayresult">
                        <label style="display: inline;">วัน</label>
                    </div>
                </div>
                </br>
                <div>
                    <label style="display: inline;">5. เรื่องที่ทำการฝึก : </label>
                    <div>
                        <label style="display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.1 รายการกิจเฉพาะบุคคล (ให้ลงรายการกิจเฉพาะเป็นบุคคลที่ทำการฝึก) : </label>
                        <input type="text" name="onlypersonlist" id="editOnlypersonlist">
                    </div>
                    <div>
                        <label style="display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.2 รายการกิจเฉพาะหน่วย (ให้ลงรายการกิจเฉพาะเป็นบุคคลที่ทำการฝึก) : </label>
                        <input type="text" name="onlyunitlist" id="editOnlyunitlist">
                    </div>
                    <div>
                        <label style="display: inline;">6. &nbsp;&nbsp;พื้นที่ทำการฝึก :</label>
                        <input type="text" name="location" id="editLocation">
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
                            <label style="display: inline;">&nbsp;&nbsp;ส่วยอำนวยการฝึก</label>
                        </td>
                        <td>
                            <input type="text" name="n1" id="editN1" class="span2">
                        </td>
                        <td>
                            <input type="text" name="s1" id="editS1" class="span2">
                        </td>
                        <td>
                            <input type="text" name="pl1" id="editPl1" class="span2">
                        </td>
                        <td>
                            <input type="text" name="note1" id="editNote1" class="span2">
                        </td>
                    <tbody>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>
                            <label style="display: inline;">&nbsp;&nbsp;ชุดครูฝึก</label>
                        </td>
                        <td>
                            <input type="text" name="n2" id="editN2" class="span2">
                        </td>
                        <td>
                            <input type="text" name="s2" id="editS2" class="span2">
                        </td>
                        <td>
                            <input type="text" name="pl2" id="editPl2" class="span2">
                        </td>
                        <td>
                            <input type="text" name="note2" id="editNote2" class="span2">
                        </td>
                    <tbody>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>
                            <label style="display: inline;">&nbsp;&nbsp;ส่วนรับการฝึก/ผู้รับฝึก</label>
                        </td>
                        <td>
                            <input type="text" name="n3" id="editN3" class="span2">
                        </td>
                        <td>
                            <input type="text" name="s3" id="editS3" class="span2">
                        </td>
                        <td>
                            <input type="text" name="pl3" id="editPl3" class="span2">
                        </td>
                        <td>
                            <input type="text" name="note3" id="editNote3" class="span2">
                        </td>
                    <tbody>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>
                            <label style="display: inline;">&nbsp;&nbsp;ข้าศึกสมมติ</label>
                        </td>
                        <td>
                            <input type="text" name="n4" id="editN4" class="span2">
                        </td>
                        <td>
                            <input type="text" name="s4" id="editS4" class="span2">
                        </td>
                        <td>
                            <input type="text" name="pl4" id="editPl4" class="span2">
                        </td>
                        <td>
                            <input type="text" name="note4" id="editNote4" class="span2">
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
                        <input type="text" name="weapon" id="editWeapon">
                    </div>
                    <div>
                        <label style="display: inline; margin-left: 20px;">8.2 สป.3 (เบนซิน/ดีเซล/สป.3(อ.))</label>
                        <input type="text" name="vehicle" id="editVehicle">
                    </div>
                    <div>
                        <label style="display: inline; margin-left: 20px;">8.3 สป.5 (สาย สพ. / สาย วศ.)</label> &nbsp;&nbsp;
                        <input type="text" name="support5" id="editSupport5">
                    </div>
                    </br>
                    <div>
                        <label style="display: inline; margin-left: 20px;">8.4 เป้า</label> &nbsp;&nbsp;
                        <input type="text" name="target" id="editTarget" style="center;">
                    </div>
                    <div>
                        <label style="display: inline; margin-left: 20px;">8.5 งบประมาณ (เบี้ยเลี้ยง, เงินเพิ่มพิเศษพลทหาร, ค่าเช่าที่พัก, ค่าเครื่องช่วยฝึกสิ้นเปลืองและอื่นๆ)</label>
                        <input type="text" name="allowance" id="editAllowance" style="center;">&nbsp;&nbsp;บาท
                        <div>
                            <div>
                                <label style="display: inline; margin-left: 20px;">8.6 อื่นๆ</label> &nbsp;&nbsp;
                                <input type="text" name="other" id="editOther" style="center;">
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
                                        <input type="text" name="resultpurpose" id="editResultpurpose" style="center;">
                                    </div>
                                    <div>
                                        <label style="display: inline; margin-left: 20px;">9.2 การบรรลุรายการกิจเฉพาะเป็นบุคคลและเป็นหน่วย (หรือไม่/อย่างไร)</label>
                                        <input type="text" name="unitandperson" id="editUnitandperson" style="center;">
                                    </div>
                                    <div>
                                        <label style="display: inline; margin-left: 20px;">9.3 ข้อดีที่ควรชมย พร้อมเหตุผลประกอบ</label>
                                        <input type="text" name="good" id="editGood" style="center;">
                                    </div>
                                    </br>
                                    <div>
                                        <label style="display: inline; margin-left: 20px;">9.4 ข้อบกพร่องที่ควรแก้ไข พร้อมเหตุผลประกอบ</label>
                                        <input type="text" name="bad" id="editBad" style="center;">
                                    </div>
                                </div>
                                <!-- //******** end 9.การประเมินค่าจัดการฝึก (โดยหน่วยจัดการฝึก) -->
                                <!-- //******** 10.ปัญหาข้อขัดข้องและข้อเสนอแนะ -->
                                <div>
                                    <div>
                                        <label style="display: inline;">10. &nbsp;&nbsp;ปัญหาข้อขัดข้องและข้อเสนอแนะ :</label>
                                        <input type="text" name="problem" id="editProblem" style="center;">
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
                                            <input type="text" name="specialevent" id="editSpecialEvent" style="center;">
                                        </div>
                                        <div>
                                            <label style="display: inline;">11.2 &nbsp;&nbsp;สถานการณ์/สภาพการณ์/เหตุการณ์ :</label>
                                            <input type="text" name="situation" id="editSituation" style="center;">
                                        </div>
                                        <div>
                                            <label style="display: inline;">11.3 &nbsp;&nbsp;การวิเคราห์สถานการณ์/การวิเคราะห์เหตุการณ์ :</label>
                                            <input type="text" name="analyze" id="editAnalyze" style="center;">
                                        </div>
                                        <div>
                                            <label style="display: inline;">11.4 &nbsp;&nbsp;การปฎิบัติของฝ่ายตรงข้าม :</label>
                                            <input type="text" name="enemy" id="editEnemy" style="center;">
                                        </div>
                                        <div>
                                            <label style="display: inline;">11.5 &nbsp;&nbsp;การปฎิบัติของฝ่ายเรา :</label>
                                            <input type="text" name="our" id="editOur" style="center;">
                                        </div>
                                        <div>
                                            <label style="display: inline;">11.6 &nbsp;&nbsp;วิเคราะห์การปฎิบัติของฝ่ายตรงข้าม (ข้าศึกสมมติ) (บทเรียนการบฎิบัติของฝ่ายตรงข้าม) </label>
                                            <div>
                                                <label style="display: inline;">11.6.1 จุดอ่อน</label>
                                                <input type="text" name="enemyweakness" id="editEnemyweakness">

                                                <label style="display: inline;">11.6.2 จุดแข็ง</label>
                                                <input type="text" name="enemystrength" id="editEnemystrength">
                                            </div>
                                            <div>
                                                <label style="display: inline;">11.6.3 อุปสรรค</label>
                                                <input type="text" name="enemyblock" id="editEnemyblock">

                                                <label style="display: inline;">11.6.4 โอกาศ</label>
                                                <input type="text" name="enemychance" id="editEnemychance">
                                            </div>
                                        </div>
                                        <div>
                                            <label style="display: inline;">11.7 &nbsp;&nbsp;วิเคราะห์การปฎิบัติของฝ่ายเรา (บทเรียนการบฎิบัติของฝ่ายเรา) </label>
                                            <div>
                                                <label style="display: inline;">11.7.1 จุดอ่อน</label>
                                                <input type="text" name="ourweakness" id="editOurweakness">

                                                <label style="display: inline;">11.7.2 จุดแข็ง</label>
                                                <input type="text" name="ourstrength" id="editOurstrength">
                                            </div>
                                            <div>
                                                <label style="display: inline;">11.7.3 อุปสรรค</label>
                                                <input type="text" name="ourblock" id="editOurblock">

                                                <label style="display: inline;">11.7.4 โอกาศ</label>
                                                <input type="text" name="ourchance" id="editOurchance">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">แนวทางการปรับปรุงแก้ไข</label>
                                        <input type="text" name="improve" id="editImprove">
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
  $(".date").focus(function() {
    $('.date').datepicker();
  });
  $(".date").blur(function() {
    $('.date').datepicker('hide');
  });
</script>