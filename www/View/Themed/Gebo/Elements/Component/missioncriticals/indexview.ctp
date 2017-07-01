<?php
App::import("Model", "Area");
?>
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
                <form action="../../MissionCriticals" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    <input type="hidden" name="offset" value="0">

                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">ชั้นความลับ : </label>
                            <div class="controls">
                                <?php
                                $checked1 = "";
                                $checked0 = "";
                                if (isset($default)) {
                                    $checked1 = ($default['rdbSecret'] == "1") ? "checked='checked'" : "";
                                    $checked0 = ($default['rdbSecret'] == "0") ? "checked='checked'" : "";
                                } else {
                                    $checked0 = "checked='checked'";
                                }
                                ?>
                                <input name="rdbSecret" type="radio" value="1" checked="checked" <?php echo $checked1; ?>> ลับ 
                                &nbsp;&nbsp;&nbsp;
                                <input name="rdbSecret" type="radio" value="0" <?php echo $checked0; ?>> ไม่ลับ
                            </div>
                        </div>                        
                        <div class="span6">
                            <label for="textfield" class="control-label">พื้นที่เหตุการณ์ : </label>
                            <div class="controls">
                                <select name="ddlArea"  data-placeholder="" class="chzn_a input-xlarge" style="width:220px">
                                    <option id="ui_slider3_sel" value="0">--- ทั้งหมด ---</option>
                                    <?php foreach ($Areas as $key => $Area) { ?>
                                        <option value="<?php echo $key; ?>"><?php echo $Area; ?></option>
                                    <?php } ?>
                                        <option value="999">พื้นที่อื่นๆ</option>
                                </select>        
                                <script>
                                    $('select[name="ddlArea').val('<?php echo (isset($default) && $default['ddlArea'] != '0') ? $default['ddlArea'] : '0'; ?>');
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">ชื่อเหตุการณ์ : </label>
                            <div class="controls">
                                <input type="text" name='txtWName' value="<?php echo (isset($default) && $default['txtWName'] != '') ? $default['txtWName'] : ''; ?>">
                            </div>
                        </div>                        
                        <div class="span6">
                            <label for="textfield" class="control-label">หน่วยจัดทำ : </label>
                            <div class="controls">
                                <input type="text" name='txtWCreater' value="<?php echo (isset($default) && $default['txtWCreater'] != '') ? $default['txtWCreater'] : ''; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">ปีที่เกิดเหตุการณ์ : </label>
                            <div class="controls">
                                <select name="ddlYear"  data-placeholder="" class="chzn_a input-xlarge" style="width:220px;">
                                    <option id="ui_slider3_sel" value="0">--- ทั้งหมด ---</option>
                                    <?php foreach ($Years as $year) { ?>
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                    <?php } ?>
                                </select> 
                                <script>
                                    $('select[name="ddlYear').val('<?php echo (isset($default) && $default['ddlYear'] != '0') ? $default['ddlYear'] : '0'; ?>');
                                </script>
                            </div>
                        </div>                        
                        <div class="span6">
                            <label for="textfield" class="control-label">จัดทำเมื่อ : </label>
                            <div class="controls">
                                <!--                                <div class="input-append date" id="dp1" data-date-format="dd/mm/yyyy">
                                                                    <input class="span6" type="text" readonly="" name='dpkCreateDate' value="<?php echo (isset($default) && $default['dpkCreateDate'] != '') ? $default['dpkCreateDate'] : ''; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                                                </div>-->
                                <?php
                                $arrdpkDate1 = array();
                                $arrdpkDate1['class'] = 'form-control';
                                if (isset($default) && $default['dpkCreateDate'] != '') {
                                    $arrdpkDate1['value'] = $default['dpkCreateDate']['year'] . '-' . $default['dpkCreateDate']['month'] . '-' . $default['dpkCreateDate']['day'];
                                }
                                echo $this->CustomForm->dateThai('dpkCreateDate', $arrdpkDate1);
                                ?>
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
                                    <a href="#myModal2" onclick="addMissionCritical();" data-toggle="modal"  data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">
                                        <i class="splashy-add"></i>เพิ่ม</a>
                                </li>

                                <li class='add_rows_simple hideme mm_3_delete'> <a href="#" class="delete" data-tableid="smpl_tbl" style="display: block;"><i class="icon-trash"></i> ลบ </a></li>

                            </ul>
                        </div>
                    </div>
                </div>


                <div class="span8">
                    <div class="dataTables_filter" id="dt_gal_filter">
                        <label>
                            <form action="../../EDocument/index/150120132326915176" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                                <input name="name_th" style="width:400px;" value="" type="text" placeholder="เหตุการณ์ หลักฐาน">
                                <button id="Unit-submit" type="submit" class="btn btn-primary hideme mm_13_list" style="display: inline-block;">ค้นหา</button>
                                <input type="hidden" name="offset" value="0">
                            </form>
                        </label>						
                    </div>
                </div>
            </div>

            <div class="box-content nopadding">
                <div class="tab-content tab-content-inline">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:50px;"><input type="checkbox" class="toggle" onclick="toggleMissionCritical(this);"></th>
                                <th style="text-align: center;width:50px;">ลำดับ</th>
                                <th style="text-align: center;">จัดทำเมื่อ</th>
                                <th style="text-align: center;">ชั้นความลับ</th>
                                <th style="text-align: left;">ชื่อเหตุการณ์</th>
                                <th style="text-align: center;">ปีที่เกิดเหตุการณ์</th>
                                <th style="text-align: center;">พื้นที่เกิดเหตุการณ์</th>
                                <th style="text-align: left;width:200px;">ไฟล์แนบ</th>
                                <th style="text-align: center;width:80px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($MissionCriticals)) { ?>
                                <?php
                                $rowNo = 1;
                                foreach ($MissionCriticals as $MissionCritical) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" name="MissionCriticalID[]" value="<?php echo $MissionCritical['MissionCritical']['id']; ?>">
                                        </td>  
                                        <td style="text-align: center;"><?php echo $rowNo; ?></td>
                                        <td style="text-align: center;">
                                            <?php
                                            echo (!empty($MissionCritical['MissionCritical']['w_create_date'])) ? $this->DateFormat->formatDateThai($MissionCritical['MissionCritical']['w_create_date']) : "";
                                            ?> 
                                        </td>
                                        <td style="text-align: center;">
                                            <?php
                                            if ($MissionCritical['MissionCritical']['secret'] == '0')
                                                echo "ไม่ลับ";
                                            else if ($MissionCritical['MissionCritical']['secret'] == '1')
                                                echo "ลับ";
                                            ?>
                                        </td>                                        
                                        <td style=""><?php echo $MissionCritical['MissionCritical']['w_name']; ?></td>
                                        <td style="text-align:center;"><?php echo $MissionCritical['MissionCritical']['w_year']; ?></td>
                                        <td style="text-align:center;">
                                            <?php
                                            if (!empty($MissionCritical['MissionCritical']['w_area_id'])) {
                                                if ($MissionCritical['MissionCritical']['w_area_id'] != '999') {
                                                    $modelArea = new Area();
                                                    $whereConditions = array();
                                                    $whereCOnditions['deleted'] = 'N';
                                                    $whereConditions['id'] = $MissionCritical['MissionCritical']['w_area_id'];
                                                    $conditions = array('limit' => '1',
                                                        'order' => array('id' => 'asc'),
                                                        'conditions' => $whereConditions
                                                    );
                                                    $DataArea = $modelArea->find('all', $conditions);
                                                    echo $DataArea[0]["Area"]["name"];
                                                } else {
                                                    echo $MissionCritical['MissionCritical']['w_area_other'];
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $whereConditions = array();
                                            $whereConditions['deleted'] = 'N';
                                            $whereConditions['file_table_name'] = 'MissionCriticals';
                                            $whereConditions['file_table_key'] = $MissionCritical['MissionCritical']['id'];
                                            $conditions = array('limit' => 100,
                                                'order' => array('id' => 'asc'),
                                                'conditions' => $whereConditions
                                            );

                                            $TableAttachFile = ClassRegistry::init('TableAttachFile');
                                            $modelFiles = $TableAttachFile->find('all', $conditions);

                                            if (count($modelFiles) > 0) {
                                                echo "<ul>";
                                                foreach ($modelFiles as $row) {
                                                    echo "<li><a href='/files/missioncriticals/" . $row["TableAttachFile"]["file_name"] . "' target='_blank'>" . $row["TableAttachFile"]["file_original_name"] . "</a></li>";
                                                }
                                                echo "</ul>";
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a data-toggle="modal"  class="add_rows_simple hideme mm_1_edit" data-backdrop="static" href="#myModal2" onclick="editMissionCritical('<?php echo $MissionCritical['MissionCritical']['id']; ?>');" style="display: inline;"><i class="icon-pencil"></i></a>
                                            <a href="#" class="delete add_rows_simple hideme mm_1_delete" value="<?php echo (string) $MissionCritical['MissionCritical']['id']; ?>" style="display: inline;"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $rowNo++;
                                }
                                ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="9" style="text-align:center;">
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
    function toggleMissionCritical(source)
    {
        var checkboxes = document.getElementsByName('MissionCriticalID[]');
        for (var i in checkboxes)
        {
            checkboxes[i].checked = source.checked;
        }
    }

    function addMissionCritical() {
        $('#customModal2').html('');
        $('#customModalHeader2').html('สร้างข้อมูลการรบ');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../MissionCriticals/form", function (data) {
            $('#customModal2').html(data);
        });
    }

    function editMissionCritical(id) {
        $('#customModal2').html('');
        $('#customModalHeader2').html('แก้ไขข้อมูลการรบ');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../MissionCriticals/form/" + id, function (data) {
            $('#customModal2').html(data);
        });
    }

    function deleteMissionCritical(id) {
        var ids = [];
        if (id != null) {
            ids.push(id);
        }
        else
            ids = getChecks();

        if (ids.length != 0) {
            if (confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")) {
                var url = "../../MissionCriticals/delete";
                $.post(url, {
                    ids: ids,
                }, function (data) {

                    if (data.status == "SUCCESS") {
                        window.location = "../../MissionCriticals";
                    } else {
                        alert("การลบข้อมูลล้มเหลว");
                    }
                }, "json");
            }
        } else
            alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
    }

    function getChecks() {
        var checkboxes = $("[name='MissionCriticalID[]']");
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
        deleteMissionCritical(id);
    });


</script>