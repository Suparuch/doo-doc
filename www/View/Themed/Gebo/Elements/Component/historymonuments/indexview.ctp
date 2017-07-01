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
                <form action="../../HistoryMonuments" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    <input type="hidden" name="offset" value="0">





                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">ชื่ออนุสาวรีย์ : </label>
                            <div class="controls">
                                <input type="text" name='txtHmName' value="<?php echo (isset($default) && $default['txtHmName'] != '') ? $default['txtHmName'] : ''; ?>">
                            </div>
                        </div>                        
                        <div class="span6">
                            <label for="textfield" class="control-label">ส่วนราชการ : </label>
                            <div class="controls">
                                <select name="ddlUnit"  data-placeholder="" class="chzn_a input-xlarge" >
                                    <option id="ui_slider3_sel" value="0">--- ทั้งหมด ---</option>
                                    <?php foreach ($Units as $key => $Unit) { ?>
                                        <option value="<?php echo $key; ?>"><?php echo $Unit; ?></option>
                                    <?php } ?>
                                </select>        
                                <script>
                                    $('select[name="ddlUnit').val('<?php echo (isset($default) && $default['ddlUnit'] != '0') ? $default['ddlUnit'] : '0'; ?>');
                                </script>
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <div class="span12">
                            <label for="textfield" class="control-label">ตั้งอยู่ที่ค่าย : </label>
                            <div class="controls">
                                <input type="text" name='txtHmLocationUnit' value="<?php echo (isset($default) && $default['txtHmLocationUnit'] != '') ? $default['txtHmLocationUnit'] : ''; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="span12">
                            <label for="textfield" class="control-label">ตั้งอยู่ที่หน่วย : </label>
                            <div class="controls">
                                <input type="text" name='txtHmLocationUnit' value="<?php echo (isset($default) && $default['txtHmLocationUnit'] != '') ? $default['txtHmLocationUnit'] : ''; ?>">
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
                                    <a href="#myModal2" onclick="addHistoryMonument();" data-toggle="modal"  data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">
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
                                <th style="text-align: center;width:50px;"><input type="checkbox" class="toggle" onclick="toggleHistoryMonument(this);"></th>
                                <th style="text-align: center;width:50px;">ลำดับ</th>
                                <th style="text-align: left;">ชื่ออนุสาวรีย์</th>
                                <th style="text-align: left;">สถานที่ตั้ง</th>
                                <th style="text-align: left;width:200px;">ไฟล์แนบ</th>
                                <th style="text-align: center;width:80px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($HistoryMonuments)) { ?>
                                <?php
                                $rowNo = 1;
                                foreach ($HistoryMonuments as $HistoryMonument) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" name="HistoryMonumentID[]" value="<?php echo $HistoryMonument['HistoryMonument']['id']; ?>">
                                        </td>  
                                        <td style="text-align: center;"><?php echo $rowNo; ?></td>
                                        <td style=""><?php echo $HistoryMonument['HistoryMonument']['hm_name']; ?></td>
                                         <td style=""><?php echo $HistoryMonument['HistoryMonument']['hm_location_camp']; ?></td>
                                        <td>
                                            <?php
                                            $whereConditions = array();
                                            $whereConditions['deleted'] = 'N';
                                            $whereConditions['file_table_name'] = 'HistoryMonuments';
                                            $whereConditions['file_table_key'] = $HistoryMonument['HistoryMonument']['id'];
                                            $conditions = array('limit' => 100,
                                                'order' => array('id' => 'asc'),
                                                'conditions' => $whereConditions
                                            );

                                            $TableAttachFile = ClassRegistry::init('TableAttachFile');
                                            $modelFiles = $TableAttachFile->find('all', $conditions);

                                            if (count($modelFiles) > 0) {
                                                echo "<ul>";
                                                foreach ($modelFiles as $row) {
                                                    echo "<li><a href='/files/history_monuments/" . $row["TableAttachFile"]["file_name"] . "' target='_blank'>" . $row["TableAttachFile"]["file_original_name"] . "</a></li>";
                                                }
                                                echo "</ul>";
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a data-toggle="modal"  class="add_rows_simple hideme mm_1_edit" data-backdrop="static" href="#myModal2" onclick="editHistoryMonument('<?php echo $HistoryMonument['HistoryMonument']['id']; ?>');" style="display: inline;"><i class="icon-pencil"></i></a>
                                            <a href="#" class="delete add_rows_simple hideme mm_1_delete" value="<?php echo (string) $HistoryMonument['HistoryMonument']['id']; ?>" style="display: inline;"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $rowNo++;
                                }
                                ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="6" style="text-align:center;">
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
    function toggleHistoryMonument(source)
    {
        var checkboxes = document.getElementsByName('HistoryMonumentID[]');
        for (var i in checkboxes)
        {
            checkboxes[i].checked = source.checked;
        }
    }

    function addHistoryMonument() {
        $('#customModal2').html('');
        $('#customModalHeader2').html('สร้างประวัติอนุสารีย์');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HistoryMonuments/form", function (data) {
            $('#customModal2').html(data);
        });
    }

    function editHistoryMonument(id) {
        $('#customModal2').html('');
        $('#customModalHeader2').html('แก้ไขข้อมูลประวัติอนุสารีย์');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HistoryMonuments/form/" + id, function (data) {
            $('#customModal2').html(data);
        });
    }

    function deleteHistoryMonument(id) {
        var ids = [];
        if (id != null) {
            ids.push(id);
        }
        else
            ids = getChecks();

        if (ids.length != 0) {
            if (confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")) {
                var url = "../../HistoryMonuments/delete";
                $.post(url, {
                    ids: ids,
                }, function (data) {

                    if (data.status == "SUCCESS") {
                        window.location = "../../HistoryMonuments";
                    } else {
                        alert("การลบข้อมูลล้มเหลว");
                    }
                }, "json");
            }
        } else
            alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
    }

    function getChecks() {
        var checkboxes = $("[name='HistoryMonumentID[]']");
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
        deleteHistoryMonument(id);
    });


</script>