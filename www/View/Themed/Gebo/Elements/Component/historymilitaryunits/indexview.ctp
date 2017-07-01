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
                <form action="../../HistoryMilitaryUnits" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    <input type="hidden" name="offset" value="0">





                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">ชื่อหน่วย : </label>
                            <div class="controls">
                                <input type="text" name='txtHmuName' value="<?php echo (isset($default) && $default['txtHmuName'] != '') ? $default['txtHmuName'] : ''; ?>">
                            </div>
                        </div>                        
                        <div class="span6">
                            <label for="textfield" class="control-label">ชื่อค่าย : </label>
                            <div class="controls">
                                <input type="text" name='txtHmuCamp' value="<?php echo (isset($default) && $default['txtHmuCamp'] != '') ? $default['txtHmuCamp'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">ที่ตั้ง : </label>
                            <div class="controls">
                                <input type="text" name='txtHmuLocation' value="<?php echo (isset($default) && $default['txtHmuLocation'] != '') ? $default['txtHmuLocation'] : ''; ?>">
                            </div>
                        </div>                        
                        <div class="span6">
                            <label for="textfield" class="control-label">หมายเหตุ : </label>
                            <div class="controls">
                                <input type="text" name='txtHmuRemark' value="<?php echo (isset($default) && $default['txtHmuRemark'] != '') ? $default['txtHmuRemark'] : ''; ?>">
                            </div>
                        </div>
                    </div>



                    <div class="control-group">
                        <div class="span6">
                            <table border="0">
                                <tr>
                                    <td class="text-right"><label for="textfield" class="control-label"><?php echo __('วันที่สถาปนา'); ?> : </label></td>
                                    <td>
                                        <!--                                        &nbsp;&nbsp;&nbsp;
                                                                                <div class="input-append date" id="dp1" data-date-format="dd/mm/yyyy">
                                                                                    <input class="span6" type="text" readonly="" name='dpkEstablishDate' value="<?php echo (isset($default) && $default['dpkEstablishDate'] != '') ? $default['dpkEstablishDate'] : ''; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                                                                </div>-->
                                        &nbsp;&nbsp;&nbsp;
                                        <?php
                                        $arrdpkDate1 = array();
                                        $arrdpkDate1['class'] = 'form-control';
                                        if (isset($default) && $default['dpkEstablishDate'] != '') {
                                            $arrdpkDate1['value'] = $default['dpkEstablishDate']['year'] . '-' . $default['dpkEstablishDate']['month'] . '-' . $default['dpkEstablishDate']['day'];
                                        }
                                        echo $this->CustomForm->dateThai('dpkEstablishDate', $arrdpkDate1);
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="span6">
                            <label for="textfield" class="control-label">ส่วนราชการ : </label>
                            <div class="controls">
                                <select name="ddlUnit"  data-placeholder="" class="chzn_a input-xlarge" >
                                    <option id="ui_slider3_sel" value="0">--- ทั้งหมด ---</option>
                                    <?php foreach ($OrganizationTypes as $key => $OrganizationType) { ?>
                                        <option value="<?php echo $key; ?>"><?php echo $OrganizationType; ?></option>
                                    <?php } ?>
                                </select>        
                                <script>
                                    $('select[name="ddlUnit').val('<?php echo (isset($default) && $default['ddlUnit'] != '0') ? $default['ddlUnit'] : '0'; ?>');
                                </script>
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
                                    <a href="#myModal2" onclick="addHistoryMilitaryUnit();" data-toggle="modal"  data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">
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
                                <th style="text-align: center;width:50px;"><input type="checkbox" class="toggle" onclick="toggleHistoryMilitaryUnit(this);"></th>
                                <th style="text-align: center;width:50px;">ลำดับ</th>
                                <th style="text-align: left;">ชื่อหน่วย</th>
                                <th style="text-align: center;">วันสถาปนา</th>
                                <th style="text-align: left;">ที่ตั้ง</th>
                                <th style="text-align: left;width:200px;">ไฟล์แนบ</th>
                                <th style="text-align: center;width:80px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($HistoryMilitaryUnits)) { ?>
                                <?php
                                $rowNo = 1;
                                foreach ($HistoryMilitaryUnits as $HistoryMilitaryUnit) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" name="HistoryMilitaryUnitID[]" value="<?php echo $HistoryMilitaryUnit['HistoryMilitaryUnit']['id']; ?>">
                                        </td>  
                                        <td style="text-align: center;"><?php echo $rowNo; ?></td>
                                        <td style=""><?php echo $HistoryMilitaryUnit['HistoryMilitaryUnit']['hmu_name']; ?></td>
                                        <td style="text-align: center;">
                                            <?php
                                            echo (!empty($HistoryMilitaryUnit['HistoryMilitaryUnit']['hmu_establish_date'])) ? $this->DateFormat->formatDateThai($HistoryMilitaryUnit['HistoryMilitaryUnit']['hmu_establish_date']) : "";
                                            ?> 
                                        </td>
                                        <td><?php echo (!empty($HistoryMilitaryUnit['HistoryMilitaryUnit']['hmu_location'])) ? $HistoryMilitaryUnit['HistoryMilitaryUnit']['hmu_location'] : ""; ?></td>
                                        <td>
                                            <?php
                                            $whereConditions = array();
                                            $whereConditions['deleted'] = 'N';
                                            $whereConditions['file_table_name'] = 'HistoryMilitaryUnits';
                                            $whereConditions['file_table_key'] = $HistoryMilitaryUnit['HistoryMilitaryUnit']['id'];
                                            $conditions = array('limit' => 100,
                                                'order' => array('id' => 'asc'),
                                                'conditions' => $whereConditions
                                            );

                                            $TableAttachFile = ClassRegistry::init('TableAttachFile');
                                            $modelFiles = $TableAttachFile->find('all', $conditions);

                                            if (count($modelFiles) > 0) {
                                                echo "<ul>";
                                                foreach ($modelFiles as $row) {
                                                    echo "<li><a href='/files/history_military_units/" . $row["TableAttachFile"]["file_name"] . "' target='_blank'>" . $row["TableAttachFile"]["file_original_name"] . "</a></li>";
                                                }
                                                echo "</ul>";
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a data-toggle="modal"  class="add_rows_simple hideme mm_1_edit" data-backdrop="static" href="#myModal2" onclick="editHistoryMilitaryUnit('<?php echo $HistoryMilitaryUnit['HistoryMilitaryUnit']['id']; ?>');" style="display: inline;"><i class="icon-pencil"></i></a>
                                            <a href="#" class="delete add_rows_simple hideme mm_1_delete" value="<?php echo (string) $HistoryMilitaryUnit['HistoryMilitaryUnit']['id']; ?>" style="display: inline;"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $rowNo++;
                                }
                                ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="7" style="text-align:center;">
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
    function toggleHistoryMilitaryUnit(source)
    {
        var checkboxes = document.getElementsByName('HistoryMilitaryUnitID[]');
        for (var i in checkboxes)
        {
            checkboxes[i].checked = source.checked;
        }
    }

    function addHistoryMilitaryUnit() {
        $('#customModal2').html('');
        $('#customModalHeader2').html('สร้างประวัติหน่วย');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HistoryMilitaryUnits/form", function (data) {
            $('#customModal2').html(data);
        });
    }

    function editHistoryMilitaryUnit(id) {
        $('#customModal2').html('');
        $('#customModalHeader2').html('แก้ไขข้อมูลประวัติหน่วย');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HistoryMilitaryUnits/form/" + id, function (data) {
            $('#customModal2').html(data);
        });
    }

    function deleteHistoryMilitaryUnit(id) {
        var ids = [];
        if (id != null) {
            ids.push(id);
        }
        else
            ids = getChecks();

        if (ids.length != 0) {
            if (confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")) {
                var url = "../../HistoryMilitaryUnits/delete";
                $.post(url, {
                    ids: ids,
                }, function (data) {

                    if (data.status == "SUCCESS") {
                        window.location = "../../HistoryMilitaryUnits";
                    } else {
                        alert("การลบข้อมูลล้มเหลว");
                    }
                }, "json");
            }
        } else
            alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
    }

    function getChecks() {
        var checkboxes = $("[name='HistoryMilitaryUnitID[]']");
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
        deleteHistoryMilitaryUnit(id);
    });


</script>