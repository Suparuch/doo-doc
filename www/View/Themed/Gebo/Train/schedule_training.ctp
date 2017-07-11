<script>
  function edit(id) {
    var editData;
    $.ajax({
      method: "POST",
      url: "edit_schedule",
      data: "id=" + id,
      success: function(result) {
        editData = result[0][0];
        fillInput();
      },
      dataType: "json"
    });

    function fillInput() {
      $("#editID").val(editData['id']);
      $("#editUnit").val(editData['unit']);
      $("#editProof").val(editData['proof']);
      $("#editTask").val(editData['task']);
      $("#editUnitTrained").val(editData['unittrained']);
      if (editData['base'] == "base") {
        $("#editBase").attr("checked", "checked");
        $("#editFromDateBase").val(editData['fromdatebase']);
        $("#editToDateBase").val(editData['todatebase']);

        //Clear Data to OutBade
        $("#editFromDateOutBase").val('');
        $("#editToDateOutBase").val('');
        $("#editLocation").val('');
        $("#editOutBase").attr("checked");

      } else {
        //Clear Data to Base
        $("#editBase").attr("checked");
        $("#editFromDateBase").val('');
        $("#editToDateBase").val('');

        $("#editOutBase").attr("checked", "checked");
        $("#editLocation").val(editData['location']);
        $("#editFromDateOutBase").val(editData['fromdateoutbase']);
        $("#editToDateOutBase").val(editData['todateoutbase']);



      }
      $("#editNote").val(editData['note']);

    }
  }
  select = 1;

  function selectAll() {
    if (select == 1) {
      $("input.selectID").attr("checked", "checked")
      select = 0;
    } else {
      $("input.selectID").attr("checked", false)
      select = 1;
    }
  }

  function deleteSelect() {
    if (confirm("คุณต้องการลบหรือไม่")) {
      $("#delete").submit();
    }

  }


  function deleteID(id) {
    if (confirm("คุณต้องการลบหรือไม่")) {
      $.ajax({
        method: 'post',
        url: 'delete_schedule',
        data: 'id=' + id,
        success: function() {
          location.reload();
        }
      });
    }
  }
</script>
<style>
    table.table thead tr th {
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
                            ระบบงานฝึกศึกษา &gt;&gt; ตารางกำหนดการฝึก
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <a href="#" style="color:green;">ตารางกำหนดการฝึก</a>
    <a href="/Train/reportResult" style="color:green;">แบบสรุปรายงานผลการฝึก</a>
</div>
<div style="text-align: center;">
    <?= $this->Form->create() ?>
    <p>
    <h3>ตารางกำหนดการฝึก</h3>
    </p>
    <div>
        <p>
            <label>หน่วยจัดการฝึก <input type="text" name="unit">
            </label>
        </p>
        <p>
            <label>หลักฐาน คำสั่งการฝึกของหน่วยที่จัดการฝึก <input type="text" name="proof">
            </label>
        </p>
    </div>
    <div>
        <button type="submit" class="btn btn-primary">ค้นหา</button>
        <button type="reset" class="btn btn-primary">ยกเลิก</button>
    </div>
    <?= $this->Form->end() ?>
</div>
<div class="btn-group" style="margin-top: 20px;">
    <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span></button>
    <ul class="dropdown-menu">
        <li class="hideme mm_1_add" style="display: list-item;"><a href="/Train/addScheduleTraining"><i class="splashy-add"></i> เพิ่ม </a></li>
        <li class="hideme mm_1_delete delete" style="display: list-item;"><a style="cursor:pointer" onclick="deleteSelect()" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a></li>
</div>
<table class="table table-bordered tablesorter" style="margin-top: 10px;">
    <thead>
    <tr>
        <th rowspan="2" style="text-align: center;"><input type="checkbox" onclick="selectAll()"></th>
        <th rowspan="2" style="text-align: center;">ลำดับ</th>
        <th rowspan="2" style="text-align: center;">หน่วยจัดการฝึก</th>
        <th rowspan="2" style="text-align: center;">หลักฐาน คำสั่งการฝึกของหน่วยที่จัดการฝึก</th>
        <th rowspan="2" style="text-align: center;">งานการฝึก</th>
        <th rowspan="2" style="text-align: center;">หน่วยรับการฝึก</th>
        <th colspan="2" style="text-align: center;">กำหนดการฝึก (ว./ด./ป.)</th>
        <th rowspan="2" style="text-align: center;">หมายเหตุ</th>
        <th rowspan="2" style="text-align: center;"></th>
    </tr>
    <tr>
        <th style="text-align: center;">ในที่ตั้ง</th>
        <th style="text-align: center;">นอกที่ตั้ง/พื้นที่ฝึก</th>
    </tr>
    </thead>
    <tbody>
    <?php
    echo $this->Form->create(null,array('url'=> array('controller'=>'Train','action' => 'delete_schedule'),'id'=>'delete'));
    $No = 1;
    // var_dump($data);
    foreach($data as $row){
        echo "
              <tr>
                  <td style='text-align: center'>
                      <input type='checkbox' name='id[]' class='selectID' value=".$row[0]['id'].">
                  </td>
                  <td>
                      $No
                  </td>
                  <td>
                      ".$row[0]['unit']."
                  </td>
                  <td>
                      ".$row[0]['proof']."
                  </td>
                  <td>
                      ".$row[0]['task']."
                  </td>
                  <td>
                      ".$row[0]['unittrained']."
                  </td>
          ";
        if($row[0]['base']=="base"){
            $fromDate = $this->DateFormat->formatDateThai($row[0]['fromdatebase']);
            $toDate = $this->DateFormat->formatDateThai($row[0]['todatebase']);
            echo "
                  <td>
                      ตั้งแต่ $fromDate ถึง $toDate
                  </td>
                  <td>
                  </td>
              ";
        }
        if($row[0]['base']=="outbase"){
            $fromDate = $this->DateFormat->formatDateThai($row[0]['fromdateoutbase']);
            $toDate = $this->DateFormat->formatDateThai($row[0]['todateoutbase']);
            $location = $row[0]['location'];
            echo "
                  <td></td>
                  <td>สถานที่ $location <br>
                      ตั้งแต่ $fromDate ถึง $toDate
                  </td>
              ";
        }
        echo "
          <td>
              ".$row[0]['note']."
          </td>
          <td>
              <a href='#editModal' data-toggle='modal' onclick='edit(".$row[0]['id'].")'><i class='icon-pencil'></i> </a>
              <a href='' onclick='deleteID(".$row[0]['id'].")'><i class='icon-trash'></i></a>
          </td>
          </tr>
              
          ";
        $No++;
    }
    echo $this->Form->end();

    ?>
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="editModal" style="width: inherit; top: 40px; left: inherit; display: none; ">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit</h4>
            </div>
            <div class="modal-body" style="min-height: 500px">
                <div>
                    <?= $this->Form->create(null,array('url'=> array('controller'=>'Train','action' => 'ajaxEdit_schedule'))) ?>
                    <input type="hidden" value="" id="editID" name="id">
                    <div style="text-align: center;">
                        <div class="box-title center">
                            <h2 class="heading">
                                ตารางกำหนดการฝึก
                            </h2>
                        </div>
                        <div class="center">
                            <label>หน่วยจัดการฝึก <input type="text" name="unit" id="editUnit"></label>
                            <label> หลักฐาน คำสั่งการฝึกของหน่วยที่จัดการฝึก <input type="text" name="proof" id="editProof"></label>
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
                                    <td><input type="text" name="task" id="editTask"></td>
                                    <td><input type="text" name="unittrained" id="editUnitTrained"></td>
                                    <td><label class="radio"><input type="radio" name="base" value="base" id="editBase">ในที่ตั้งฝึก</label>
                                        <label>ตั้งแต่ <input type="text" class="date"  name="fromdatebase" id="editFromDateBase"> </label>
                                        <label>ถึง <input type="text" class="date"  name="todatebase" id="editToDateBase"></label>
                                    </td>
                                    <td><label class="radio"><input type="radio" name="base" value="outbase" id="editOutBase">นอกที่ตั้งฝึก <input type="text" name="location" id="editLocation"></label>
                                        <label>ตั้งแต่ <input type="text" class="date"  name="fromdateoutbase" id="editFromDateOutBase"> </label>
                                        <label>ถึง <input type="text" class="date"  name="todateoutbase" id="editToDateOutBase"></label>
                                    </td>
                                    <td>
                                        <input type="text" name="note" id="editNote">
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
                                    <input type="text" name="name2">
                                </div>
                                <div>
                                    <label style="display: inline;">ตำแหน่ง</label>
                                    <input type="text" id="" name="position">
                                </div>
                            </div>
                        </div>
                        <div style="font-size: 18px; margin-top: 30px">
                            <div class="span1" style="display:inline-block; "><b><u>หมายเหตุ</u></b></div>
                            <div class="span8" style="display:inline-block">ยศ.ทบ.กำหนดให้ทุกหน่วย<b>งดการส่งสำเนาคำสั่งการฝึก</b>ของหน่วยที่ต้องจัดส่งให้ ยศ.ทบ. โดยเปลี่ยนแปลงเป็นจัดส่ง<b>กำหนดการฝึก</b>ตามแบบฟอร์มขั้นต้นนี้แทน สำหรับระยะเวลาจัดส่งไม่เปลี่ยนแปลง คือ ก่อนเริ่มห้วงการฝึกอย่างน้อย
                                15 วัน</div>
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
</div>
<script>
  $(".date").focus(function() {
    $('.date').datepicker();
  });
  $(".date").blur(function() {
    // $('.date').datepicker('hide');
  });

</script>