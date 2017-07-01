<style type="text/css">
    #myModal2{
        /*        width:800px;
                margin-left:-400px;*/
    }
</style>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered box-color">

            <div class="box-content nopadding">
                <form action="../../HistoryOthers" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    <input type="hidden" name="offset" value="0">





                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">ชื่อเรื่อง : </label>
                            <div class="controls">
                                <input type="text" name='txtHoName' value="<?php echo (isset($default) && $default['txtHoName'] != '') ? $default['txtHoName'] : ''; ?>">
                            </div>
                        </div>                        
                        <div class="span6">
                            <label for="textfield" class="control-label">รูปแบบข้อมูล : </label>
                            <div class="controls">
                                <input type="text" name='txtHoFormat' value="<?php echo (isset($default) && $default['txtHoFormat'] != '') ? $default['txtHoFormat'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">ที่เก็บ : </label>
                            <div class="controls">
                                <input type="text" name='txtHoLocation' value="<?php echo (isset($default) && $default['txtHoLocation'] != '') ? $default['txtHoLocation'] : ''; ?>">
                            </div>
                        </div>                                                
                    </div>

                    <input type="hidden" name="offset" value="0">

                    <!--<button type="submit" class="btn btn-primary"></button>-->

                    <button id="<?php echo $pagination['model']; ?>-submit" type="submit" class="btn btn-primary add_rows_simple hideme mm_3_list" style="display: inline-block; "><?php echo __('ค้นหา'); ?></button>

                    <!--<button type="button" class="btn">Cancel</button>-->


                </form>
            </div>

            <div class="row-fluid">
                <div class="span4">
                    <div class="dt_actions span4">
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle">ดำเนินการ <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li class="hideme mm_13_add" style="display: list-item;">
                                    <a href="#myModal2" onclick="addHistoryOther();" data-toggle="modal"  data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">
                                        <i class="splashy-add"></i>เพิ่ม</a>
                                </li>

                                <li class='add_rows_simple hideme mm_3_delete'> <a href="#" class="delete" data-tableid="smpl_tbl" style="display: block;"><i class="icon-trash"></i> ลบ </a></li>

                            </ul>
                        </div>
                    </div>
                </div>


<!--                <div class="span8">
                    <div class="dataTables_filter" id="dt_gal_filter">
                        <label>
                            <form action="../../EDocument/index/150120132326915176" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                                <input name="name_th" style="width:400px;" value="" type="text" placeholder="เหตุการณ์ หลักฐาน">
                                <button id="Unit-submit" type="submit" class="btn btn-primary hideme mm_13_list" style="display: inline-block;">ค้นหา</button>
                                <input type="hidden" name="offset" value="0">
                            </form>
                        </label>						
                    </div>
                </div>-->
            </div>

            <div class="box-content nopadding">
                <div class="tab-content tab-content-inline">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:50px;"><input type="checkbox" class="toggle" onclick="toggleHistoryOther(this);"></th>
                                <th style="text-align: center;width:50px;">ลำดับ</th>
                                <th style="text-align: left;">ชื่อเรื่อง</th>
                                <th style="text-align: left;width:200px;">ไฟล์แนบ</th>
                                <th style="text-align: center;width:80px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($HistoryOthers)) { ?>
                                <?php
                                $rowNo = 1;
                                foreach ($HistoryOthers as $HistoryOther) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" name="HistoryOtherID[]" value="<?php echo $HistoryOther['HistoryOther']['id']; ?>">
                                        </td>  
                                        <td style="text-align: center;"><?php echo $rowNo; ?></td>
                                        <td style=""><?php echo $HistoryOther['HistoryOther']['ho_name']; ?></td>
                                        <td>
                                            <?php
                                            $whereConditions = array();
                                            $whereConditions['deleted'] = 'N';
                                            $whereConditions['file_table_name'] = 'HistoryOthers';
                                            $whereConditions['file_table_key'] = $HistoryOther['HistoryOther']['id'];
                                            $conditions = array('limit' => 100,
                                                'order' => array('id' => 'asc'),
                                                'conditions' => $whereConditions
                                            );

                                            $TableAttachFile = ClassRegistry::init('TableAttachFile');
                                            $modelFiles = $TableAttachFile->find('all', $conditions);

                                            if (count($modelFiles) > 0) {
                                                echo "<ul>";
                                                foreach ($modelFiles as $row) {
                                                    echo "<li><a href='/files/history_others/".$row["TableAttachFile"]["file_name"]."' target='_blank'>".$row["TableAttachFile"]["file_original_name"] . "</a></li>";
                                                }
                                                echo "</ul>";
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a data-toggle="modal"  class="add_rows_simple hideme mm_1_edit" data-backdrop="static" href="#myModal2" onclick="editHistoryOther('<?php echo $HistoryOther['HistoryOther']['id']; ?>');" style="display: inline;"><i class="icon-pencil"></i></a>
                                            <a href="#" class="delete add_rows_simple hideme mm_1_delete" value="<?php echo (string) $HistoryOther['HistoryOther']['id']; ?>" style="display: inline;"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $rowNo++;
                                }
                                ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="5" style="text-align:center;">
                                        ไม่พบข้อมูลที่ตรงกัน
                                    </td>
                                </tr>      
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

</div>

<script type="text/javascript">
    function toggleHistoryOther(source)
    {
        var checkboxes = document.getElementsByName('HistoryOtherID[]');
        for (var i in checkboxes)
        {
            checkboxes[i].checked = source.checked;
        }
    }

    function addHistoryOther() {
        $('#customModal2').html('');
        $('#customModalHeader2').html('สร้างข้อมูลประวัติศาสตร์อื่นๆ');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HistoryOthers/form", function (data) {
            $('#customModal2').html(data);
        });
    }

    function editHistoryOther(id) {
        $('#customModal2').html('');
        $('#customModalHeader2').html('แก้ไขข้อมูลข้อมูลประวัติศาสตร์อื่นๆ');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HistoryOthers/form/" + id, function (data) {
            $('#customModal2').html(data);
        });
    }

    function deleteHistoryOther(id) {
        var ids = [];
        if (id != null) {
            ids.push(id);
        }
        else
            ids = getChecks();

        if (ids.length != 0) {
            if (confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")) {
                var url = "../../HistoryOthers/delete";
                $.post(url, {
                    ids: ids,
                }, function (data) {

                    if (data.status == "SUCCESS") {
                        window.location = "../../HistoryOthers";
                    } else {
                        alert("การลบข้อมูลล้มเหลว");
                    }
                }, "json");
            }
        } else
            alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
    }

    function getChecks() {
        var checkboxes = $("[name='HistoryOtherID[]']");
        var ids = [];
        $.each(checkboxes, function (key, checkbox) {
            if (checkbox.checked === true) {
                ids.push(checkbox.value);
            }
        });
        return ids;
    }

    $(".delete").click(function () {
        var id = $(this).attr("value");
        deleteHistoryOther(id);
    });


</script>