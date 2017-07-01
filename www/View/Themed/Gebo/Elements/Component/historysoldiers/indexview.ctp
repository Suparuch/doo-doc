<?php
App::import("Model", "Rank");
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
                <form action="../../HistorySoldiers" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    <input type="hidden" name="offset" value="0">




                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">ตำแหน่ง : </label>
                            <div class="controls">
                                <input type="text" name='txtHsPosition' value="<?php echo (isset($default) && $default['txtHsPosition'] != '') ? $default['txtHsPosition'] : ''; ?>">
                            </div>
                        </div>  
                        <div class="span6">
                            <label for="textfield" class="control-label">ลำดับที่ : </label>
                            <div class="controls">
                                <input type="text" name='txtHsLevel' value="<?php echo (isset($default) && $default['txtHsLevel'] != '') ? $default['txtHsLevel'] : ''; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">ชื่อ : </label>
                            <div class="controls">
                                <input type="text" name='txtHsFirstname' value="<?php echo (isset($default) && $default['txtHsFirstname'] != '') ? $default['txtHsFirstname'] : ''; ?>">
                            </div>
                        </div>  
                        <div class="span6">
                            <label for="textfield" class="control-label">นามสกุล : </label>
                            <div class="controls">
                                <input type="text" name='txtHsLastname' value="<?php echo (isset($default) && $default['txtHsLastname'] != '') ? $default['txtHsLastname'] : ''; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">เลขประจำตัวประชาชน : </label>
                            <div class="controls">
                                <input type="text" name='txtHsIDCard' value="<?php echo (isset($default) && $default['txtHsIDCard'] != '') ? $default['txtHsIDCard'] : ''; ?>">
                            </div>
                        </div>
                        <div class="span6">
                            <label for="textfield" class="control-label">เหล่า : </label>
                            <div class="controls">
                                <select name="ddlCorp"  data-placeholder="" class="chzn_a input-xlarge" >
                                    <option id="ui_slider3_sel" value="0">--- ทั้งหมด ---</option>
                                    <?php foreach ($Corps as $key => $Corp) { ?>
                                        <option value="<?php echo $key; ?>"><?php echo $Corp; ?></option>
                                    <?php } ?>
                                </select>        
                                <script>
                                    $('select[name="ddlCorp').val('<?php echo (isset($default) && $default['ddlCorp'] != '0') ? $default['ddlCorp'] : '0'; ?>');
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="span12">
                            <table border="0" >
                                <tr>
                                    <td class="text-right"><label for="textfield" class="control-label">ช่วงเวลาดำรงตำแหน่ง : </label></td>
                                    <td>
                                        &nbsp;&nbsp;&nbsp;
                                        <!--                                        <div class="input-append date" id="dp1" data-date-format="dd/mm/yyyy">
                                                                                    <input class="span6" type="text" readonly="" name='dpkStartDate' value="<?php echo (isset($default) && $default['dpkStartDate'] != '') ? $default['dpkStartDate'] : ''; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                                                                </div>-->
                                        <?php
                                        $arrdpkDate1 = array();
                                        $arrdpkDate1['class'] = 'form-control';
                                        if (isset($default) && $default['dpkStartDate'] != '') {
                                            $arrdpkDate1['value'] = $default['dpkStartDate']['year'] . '-' . $default['dpkStartDate']['month'] . '-' . $default['dpkStartDate']['day'];
                                        }
                                        echo $this->CustomForm->dateThai('dpkStartDate', $arrdpkDate1);
                                        ?>

                                    </td>
                                    <td class="text-right"><label for="textfield" class="">&nbsp;&nbsp;&nbsp;ถึง : </label></td>
                                    <td>
                                        &nbsp;&nbsp;&nbsp;
                                        <!--                                        <div class="input-append date" id="dp1" data-date-format="dd/mm/yyyy">
                                                                                    <input class="span6" type="text" readonly="" name='dpkEndDate' value="<?php echo (isset($default) && $default['dpkEndDate'] != '') ? $default['dpkEndDate'] : ''; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                                                                </div>-->
                                        <?php
                                        $arrdpkDate2 = array();
                                        $arrdpkDate2['class'] = 'form-control';
                                        if (isset($default) && $default['dpkEndDate'] != '') {
                                            $arrdpkDate2['value'] = $default['dpkEndDate']['year'] . '-' . $default['dpkEndDate']['month'] . '-' . $default['dpkEndDate']['day'];
                                        }
                                        echo $this->CustomForm->dateThai('dpkEndDate', $arrdpkDate2);
                                        ?>
                                    </td>
                                </tr>
                            </table>
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
                                    <a href="#myModal2" onclick="addHistorySoldier();" data-toggle="modal"  data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">
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
                                <button id="Corp-submit" type="submit" class="btn btn-primary hideme mm_13_list" style="display: inline-block;">ค้นหา</button>
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
                                <th style="text-align: center;width:50px;"><input type="checkbox" class="toggle" onclick="toggleHistorySoldier(this);"></th>
                                <th style="text-align: center;width:50px;">ลำดับ</th>
                                <th style="text-align: left;">ตำแหน่ง</th>
                                <th style="text-align: left;">ลำดับที่</th>
                                <th style="text-align: left;">ยศ ชื่อ-นามสกุล</th>
                                <th style="text-align: left;width:200px;">ไฟล์แนบ</th>
                                <th style="text-align: center;width:80px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($HistorySoldiers)) { ?>
                                <?php
                                $rowNo = 1;
                                foreach ($HistorySoldiers as $HistorySoldier) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" name="HistorySoldierID[]" value="<?php echo $HistorySoldier['HistorySoldier']['id']; ?>">
                                        </td>  
                                        <td style="text-align: center;"><?php echo $rowNo; ?></td>
                                        <td style=""><?php echo $HistorySoldier['HistorySoldier']['hs_position']; ?></td>
                                        <td style=""><?php echo $HistorySoldier['HistorySoldier']['hs_level']; ?></td>
                                        <td style="">
                                            <?php
                                            if (!empty($HistorySoldier['HistorySoldier']['hs_rank_id'])) {
                                                $modelRank = new Rank();
                                                $whereConditions = array();
                                                $whereCOnditions['deleted'] = 'N';
                                                $whereConditions['id'] = $HistorySoldier['HistorySoldier']['hs_rank_id'];
                                                $conditions = array('limit' => '1',
                                                    'order' => array('id' => 'asc'),
                                                    'conditions' => $whereConditions
                                                );
                                                $DataRank = $modelRank->find('all', $conditions);
                                                echo $DataRank[0]["Rank"]["name"] . " ";
                                            }

                                            echo $HistorySoldier['HistorySoldier']['hs_firstname'] . ' ' . $HistorySoldier['HistorySoldier']['hs_lastname'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $whereConditions = array();
                                            $whereConditions['deleted'] = 'N';
                                            $whereConditions['file_table_name'] = 'HistorySoldiers';
                                            $whereConditions['file_table_key'] = $HistorySoldier['HistorySoldier']['id'];
                                            $conditions = array('limit' => 100,
                                                'order' => array('id' => 'asc'),
                                                'conditions' => $whereConditions
                                            );

                                            $TableAttachFile = ClassRegistry::init('TableAttachFile');
                                            $modelFiles = $TableAttachFile->find('all', $conditions);

                                            if (count($modelFiles) > 0) {
                                                echo "<ul>";
                                                foreach ($modelFiles as $row) {
                                                    echo "<li><a href='/files/history_soldiers/" . $row["TableAttachFile"]["file_name"] . "' target='_blank'>" . $row["TableAttachFile"]["file_original_name"] . "</a></li>";
                                                }
                                                echo "</ul>";
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a data-toggle="modal"  class="add_rows_simple hideme mm_1_edit" data-backdrop="static" href="#myModal2" onclick="editHistorySoldier('<?php echo $HistorySoldier['HistorySoldier']['id']; ?>');" style="display: inline;"><i class="icon-pencil"></i></a>
                                            <a href="#" class="delete add_rows_simple hideme mm_1_delete" value="<?php echo (string) $HistorySoldier['HistorySoldier']['id']; ?>" style="display: inline;"><i class="icon-trash"></i></a>
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
    function toggleHistorySoldier(source)
    {
        var checkboxes = document.getElementsByName('HistorySoldierID[]');
        for (var i in checkboxes)
        {
            checkboxes[i].checked = source.checked;
        }
    }

    function addHistorySoldier() {
        $('#customModal2').html('');
        $('#customModalHeader2').html('สร้างประวัติบุคคล');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HistorySoldiers/form", function (data) {
            $('#customModal2').html(data);
        });
    }

    function editHistorySoldier(id) {
        $('#customModal2').html('');
        $('#customModalHeader2').html('แก้ไขข้อมูลประวัติบุคคล');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HistorySoldiers/form/" + id, function (data) {
            $('#customModal2').html(data);
        });
    }

    function deleteHistorySoldier(id) {
        var ids = [];
        if (id != null) {
            ids.push(id);
        }
        else
            ids = getChecks();

        if (ids.length != 0) {
            if (confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")) {
                var url = "../../HistorySoldiers/delete";
                $.post(url, {
                    ids: ids,
                }, function (data) {

                    if (data.status == "SUCCESS") {
                        window.location = "../../HistorySoldiers";
                    } else {
                        alert("การลบข้อมูลล้มเหลว");
                    }
                }, "json");
            }
        } else
            alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
    }

    function getChecks() {
        var checkboxes = $("[name='HistorySoldierID[]']");
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
        deleteHistorySoldier(id);
    });


</script>