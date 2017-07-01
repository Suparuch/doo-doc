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
                <form action="../../HistoryBarracks" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    <input type="hidden" name="offset" value="0">





                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">ชื่อค่าย : </label>
                            <div class="controls">
                                <input type="text" name='txtHbName' value="<?php echo (isset($default) && $default['txtHbName'] != '') ? $default['txtHbName'] : ''; ?>">
                            </div>
                        </div>                        
                        <div class="span6">
                            <label for="textfield" class="control-label">ส่วนราชการ : </label>
                            <div class="controls">
                                <select name="ddlUnit"  data-placeholder="" class="chzn_a input-xlarge" >
                                    <option id="ui_slider3_sel" value="0">--- ทั้งหมด ---</option>
                                    <?php foreach ($Areas as $key => $Area) { ?>
                                        <option value="<?php echo $key; ?>"><?php echo $Area; ?></option>
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
                            <label for="textfield" class="control-label">หน่วยทหารในพื้นที่ : </label>
                            <div class="controls">
                                <input type="text" name='txtHbArea' value="<?php echo (isset($default) && $default['txtHbArea'] != '') ? $default['txtHbArea'] : ''; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="span12">
                            <table border="0">
                                <tr>
                                    <td class="text-right"><label for="textfield" class="control-label"><?php echo __('วันสถาปนาค่าย'); ?> : </label></td>
                                    <td>
                                        &nbsp;&nbsp;&nbsp;
                                        <!--                                        <div class="input-append date" id="dp1" data-date-format="dd/mm/yyyy">
                                                                                    <input class="span6" type="text" readonly="" name='dpkEstablishDate' value="<?php echo (isset($default) && $default['dpkEstablishDate'] != '') ? $default['dpkEstablishDate'] : ''; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                                                                </div>-->
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
                                    <a href="#myModal2" onclick="addHistoryBarrack();" data-toggle="modal"  data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">
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
                                <th style="text-align: center;width:50px;"><input type="checkbox" class="toggle" onclick="toggleHistoryBarrack(this);"></th>
                                <th style="text-align: center;width:50px;">ลำดับ</th>
                                <th style="text-align: left;">ชื่อค่าย</th>
                                <th style="text-align: left;">หน่วยทหารในพื้นที่</th>
                                <th style="text-align: center;">วันสถาปนาค่าย</th>
                                <th style="text-align: left;width:200px;">ไฟล์แนบ</th>
                                <th style="text-align: center;width:80px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($HistoryBarracks)) { ?>
                                <?php
                                $rowNo = 1;
                                foreach ($HistoryBarracks as $HistoryBarrack) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" name="HistoryBarrackID[]" value="<?php echo $HistoryBarrack['HistoryBarrack']['id']; ?>">
                                        </td>  
                                        <td style="text-align: center;"><?php echo $rowNo; ?></td>
                                        <td style=""><?php echo $HistoryBarrack['HistoryBarrack']['hb_name']; ?></td>
                                        <td style=""><?php echo $HistoryBarrack['HistoryBarrack']['hb_area']; ?></td>
                                        <td style="text-align: center;">
                                            <?php
                                            echo (!empty($HistoryBarrack['HistoryBarrack']['hb_establish_date'])) ? $this->DateFormat->formatDateThai($HistoryBarrack['HistoryBarrack']['hb_establish_date']) : "";
                                            ?> 
                                        </td>
                                        <td>
                                            <?php
                                            $whereConditions = array();
                                            $whereConditions['deleted'] = 'N';
                                            $whereConditions['file_table_name'] = 'HistoryBarracks';
                                            $whereConditions['file_table_key'] = $HistoryBarrack['HistoryBarrack']['id'];
                                            $conditions = array('limit' => 100,
                                                'order' => array('id' => 'asc'),
                                                'conditions' => $whereConditions
                                            );

                                            $TableAttachFile = ClassRegistry::init('TableAttachFile');
                                            $modelFiles = $TableAttachFile->find('all', $conditions);

                                            if (count($modelFiles) > 0) {
                                                echo "<ul>";
                                                foreach ($modelFiles as $row) {
                                                    echo "<li><a href='/files/history_barracks/" . $row["TableAttachFile"]["file_name"] . "' target='_blank'>" . $row["TableAttachFile"]["file_original_name"] . "</a></li>";
                                                }
                                                echo "</ul>";
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a data-toggle="modal"  class="add_rows_simple hideme mm_1_edit" data-backdrop="static" href="#myModal2" onclick="editHistoryBarrack('<?php echo $HistoryBarrack['HistoryBarrack']['id']; ?>');" style="display: inline;"><i class="icon-pencil"></i></a>
                                            <a href="#" class="delete add_rows_simple hideme mm_1_delete" value="<?php echo (string) $HistoryBarrack['HistoryBarrack']['id']; ?>" style="display: inline;"><i class="icon-trash"></i></a>
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
    function toggleHistoryBarrack(source)
    {
        var checkboxes = document.getElementsByName('HistoryBarrackID[]');
        for (var i in checkboxes)
        {
            checkboxes[i].checked = source.checked;
        }
    }

    function addHistoryBarrack() {
        $('#customModal2').html('');
        $('#customModalHeader2').html('สร้างประวัติค่ายทหาร');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HistoryBarracks/form", function (data) {
            $('#customModal2').html(data);
        });
    }

    function editHistoryBarrack(id) {
        $('#customModal2').html('');
        $('#customModalHeader2').html('แก้ไขข้อมูลประวัติค่ายทหาร');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HistoryBarracks/form/" + id, function (data) {
            $('#customModal2').html(data);
        });
    }

    function deleteHistoryBarrack(id) {
        var ids = [];
        if (id != null) {
            ids.push(id);
        }
        else
            ids = getChecks();

        if (ids.length != 0) {
            if (confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")) {
                var url = "../../HistoryBarracks/delete";
                $.post(url, {
                    ids: ids,
                }, function (data) {

                    if (data.status == "SUCCESS") {
                        window.location = "../../HistoryBarracks";
                    } else {
                        alert("การลบข้อมูลล้มเหลว");
                    }
                }, "json");
            }
        } else
            alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
    }

    function getChecks() {
        var checkboxes = $("[name='HistoryBarrackID[]']");
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
        deleteHistoryBarrack(id);
    });


</script>