<style type="text/css">
    table.table thead tr th {
        text-align: center;
    }
</style>
<script>
    function edit(id) {
        $.ajax({
            method: 'post',
            url: 'edit_report',
            data: 'result_id=' + id,
            success: function(data) {
                fillData(data[0][0]);
            },
            dataType: 'json'
        });

        function fillData(data) {
            $("#editID").val(data['result_id']);
            $("#editTitle").val(data['title']);
            $("#editUnit").val(data['unit']);
            $("#editSuggestion").val(data['suggestion']);
            $("#editNote").val(data['note']);
        }

    }

    function deleteID(id) {
        if (confirm("คุณต้องการลบข้อมูลนี้หรือไม่")) {
            $.ajax({
                method: 'post',
                url: 'delete_result',
                data: 'result_id=' + id,
                success: function(result) {
                    location.reload();
                },
                error: function(err) {
                    console.log(err);
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

    function deleqteSelect() {
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
                            ระบบงานฝึกศึกษา &gt;&gt; แบบสรุปรายงานผลการฝึก
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <a href="/Train/scheduleTraining" style="color:green;">ตารางกำหนดการฝึก</a>
    <a href="/Train/reportResult" style="color:green;">แบบสรุปรายงานผลการฝึก</a>
</div>
<div style="text-align:center;">
    <h3>
        แบบสรุปรายงานสรุปผลการฝึก
    </h3>
</div>
<br>
<?=$this->Form->create() ?>
    <div style="text-align: center">
        <label>รายการ/งานการฝึก
            <input type="text" name="title">
        </label>
        <div class="">
            <button type="submit" class="btn btn-primary">ค้นหา</button>
            <button type="reset" class="btn btn-primary">ยกเลิก</button>
        </div>
    </div>
    <?=$this->Form->end() ?>
        <div class="btn-group" style="margin-top: 20px;">
            <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li class="hideme mm_1_add" style="display: list-item;"><a href="/Train/add_report_result"><i class="splashy-add"></i> เพิ่ม </a>
                </li>
                <li class="hideme mm_1_delete delete" style="display: list-item;"><a style="cursor:pointer" onclick="deleqteSelect()" data-tableid="smpl_tbl"><i class="icon-trash"></i> ลบ </a>
                </li>
        </div>

        <table class="table table-bordered tablesorter" style="margin-top: 20px;">
            <thead>
                <tr>
                    <th rowspan="2">
                        <input type="checkbox" onclick="selectAll()">
                    </th>
                    <th style="text-align:center">ลำดับ</th>
                    <th style="text-align:center">รายการ/งานการฝึก</th>
                    <th style="text-align:center">
                        <div>หน่วยที่ทำการฝึก</div>
                        <div>(นามหน่วยและจำนวนหน่วย)</div>
                    </th>
                    <th style="text-align:center">ปัญหาข้อขัดข้องและข้อเสนอแนะ</th>
                    <th style="text-align:center">หมายเหตุ</th>
                    <th rowspan="2"></th>
                </tr>
            </thead>
            <tbody>
                <?=$this->Form->create(null,array('url'=> array('controller'=>'Train','action' => 'delete_result'),'id'=>'delete')) ?>
                    <?php if(count($data)==0 ){ ?>
                    <tr>
                        <td colspan="12" style="text-align:center;">
                            ไม่พบข้อมูลที่ตรงกัน
                        </td>
                    </tr>
                    <?php } else{ $count=1 ; foreach ($data as $row) { ?>
                    <tr>
                        <td style="text-align: center;">
                            <input type="checkbox" class="checkboxID" name='result_id[]' value="<?= $row[0]['result_id'] ?>">
                        </td>
                        <td>
                            <?=$count; ?>
                        </td>
                        <td>
                            <?=$row[0][ 'title']?>
                        </td>
                        <td>
                            <?=$row[0][ 'unit']?>
                        </td>
                        <td>
                            <?=$row[0][ 'suggestion'] ?>
                        </td>
                        <td>
                            <?=$row[0][ 'note'] ?>
                        </td>
                        <td>
                            <a data-toggle="modal" href="#editModal" onclick="edit(<?= $row[0]['result_id'] ?>)" style="display: inline;"><i class="icon-pencil"></i></a>
                            <a style="display: inline;" href="#" onclick="deleteID(<?= $row[0]['result_id'] ?>)"><i class="icon-trash"></i></a>
                        </td>
                    </tr>
                    <?php $count++; } } ?>
                    <?=$this->Form->end() ?>
            </tbody>

        </table>

        <div class="modal fade" id="editModal" style="width: 1691px; top: 40px; left: 280px; display: none; ">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Edit</h4>
                    </div>
                    <div class="modal-body" style="min-height: 500px">
                        <table class="table table-bordered tablesorter" style="margin-top: 20px;">
                            <thead>
                                <tr>
                                    <th rowspan="2"></th>
                                    <th style="text-align:center">ลำดับ</th>
                                    <th style="text-align:center">รายการ/งานการฝึก</th>
                                    <th style="text-align:center">
                                        <div>หน่วยที่ทำการฝึก</div>
                                        <div>(นามหน่วยและจำนวนหน่วย)</div>
                                    </th>
                                    <th style="text-align:center">ปัญหาข้อขัดข้องและข้อเสนอแนะ</th>
                                    <th style="text-align:center">หมายเหตุ</th>
                                    <th rowspan="2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?=$this->Form->create(null,array('url'=> array('controller'=>'Train','action' => 'ajaxEdit_result'))) ?>
                                    <tr>
                                        <td>
                                            <input type="hidden" id="editID" name="result_id">
                                        </td>
                                        <td>1</td>
                                        <td>
                                            <input type="text" name="title" id="editTitle" class="span2">
                                        </td>
                                        <td>
                                            <input type="text" name="unit" id="editUnit" class="span2">
                                        </td>
                                        <td>
                                            <input type="text" name="suggestion" id="editSuggestion" class="span2">
                                        </td>
                                        <td>
                                            <input type="text" name="note" id="editNote" class="span2">
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
                            <button type="reset" class="btn btn-primary" onclick="" data-dismiss="modal">ยกเลิก</button>
                        </div>
                        <?=$this->Form->end() ?>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>