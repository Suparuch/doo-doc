<style type="text/css">
    #myModal2{
        width:800px;
        margin-left:-400px;
    }
</style>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered box-color">

            <div class="box-content nopadding">
                <form action="../../Memorandums" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    <input type="hidden" name="offset" value="0">
                    <div class="control-group">
                        <div class="">
                            <label for="textfield" class="control-label"><?php echo __('ชั้นความลับ'); ?> : </label>
                            <div class="controls">
                                <?php
                                $checked9 = "";
                                $checked1 = "";
                                $checked0 = "";
                                if (isset($default)) {
                                    $checked9 = ($default['rdbSecret'] == "9") ? "checked='checked'" : "";
                                    $checked1 = ($default['rdbSecret'] == "1") ? "checked='checked'" : "";
                                    $checked0 = ($default['rdbSecret'] == "0") ? "checked='checked'" : "";
                                } else {
                                    $checked0 = "checked='checked'";
                                }
                                ?>
                                <input name="rdbSecret" type="radio" checked="checked" value="9" <?php echo $checked9; ?>> ไม่ระบุ 
                                &nbsp;&nbsp;&nbsp;
                                <input name="rdbSecret" type="radio" value="1" <?php echo $checked1; ?>> ลับ 
                                &nbsp;&nbsp;&nbsp;
                                <input name="rdbSecret" type="radio" value="0" <?php echo $checked0; ?>> ไม่ลับ
                            </div>
                        </div>

                    </div>
                    <div class="control-group">
                        <div class="">
                            <table border="0">
                                <tr>
                                    <td class="text-right"><label for="textfield" class="control-label"><?php echo __('วันที่'); ?> : </label></td>
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
                                    <td class="text-right"><label for="textfield" class="control-label"><?php echo __('ถึงวันที่'); ?> : </label></td>
                                    <td>
                                        &nbsp;&nbsp;&nbsp;
                                        <!--                                        <div class="input-append date" id="dp2"  data-date-format="dd/mm/yyyy">
                                                                                    <input class="span6" type="text" readonly="" name='dpkEndDate' value="<?php echo (isset($default) && $default['dpkEndDate'] != '') ? $default['dpkEndDate'] : '' ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
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
                    
                    
                    <div class="control-group">
                        <div class="">
                            <label for="textfield" class="control-label"><?php echo __('เหตุการณ์'); ?> : </label>
                            <div class="controls">
                                <input type="text" name='txtEvent' value="<?php echo (isset($default) && $default['txtEvent'] != '') ? $default['txtEvent'] : ''; ?>">
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
                                    <a href="#myModal2" onclick="addMemorandum();" data-toggle="modal"  data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">
                                        <i class="splashy-add"></i> เพิ่ม
                                    </a>
                                </li>

                                <li class='add_rows_simple hideme mm_3_delete'> 
                                    <a href="#" class="delete" data-tableid="smpl_tbl" style="display: block;">
                                        <i class="icon-trash"></i> ลบ 
                                    </a>
                                </li>


                                <li class="hideme mm_13_add" style="display: list-item;">
                                    <a href="#myModal2" onclick="printMemorandumMonthlyReport();" data-toggle="modal"  data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">
                                        <i class="splashy-document_a4_marked"></i> รายงานจดหมายเหตุประจำเดือน 
                                    </a>
                                </li>

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
                                <th style="text-align: center;width:50px;"><input type="checkbox" class="toggle" onclick="toggleMemorandum(this);"></th>               
                                <th style="text-align: center;width:80px;">ชั้นความลับ</th>
                                <th style="text-align: center;width:160px;">วันที่</th>
                                <th style="text-align: left;">เหตุการณ์</th>
                                <th style="text-align: left;width:200px;">หลักฐาน</th>
                                <th style="text-align: center;width:80px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($Memorandums)) { ?>
                                <?php foreach ($Memorandums as $Memorandum) { ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" name="MemorandumID[]" value="<?php echo $Memorandum['Memorandum']['id']; ?>"></td>  
                                        <td style="text-align: center;">
                                            <?php echo $this->TextUtil->getSecretName($Memorandum['Memorandum']['secret']); ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($Memorandum['Memorandum']['memo_date_type'] == "D")
                                                echo (!empty($Memorandum['Memorandum']['memo_date_start'])) ? $this->DateFormat->formatDateThai($Memorandum['Memorandum']['memo_date_start']) : "";
                                            else
                                                echo ((!empty($Memorandum['Memorandum']['memo_date_start'])) ? $this->DateFormat->formatDateThai($Memorandum['Memorandum']['memo_date_start']) : "") . " - " . ((!empty($Memorandum['Memorandum']['memo_date_end'])) ? $this->DateFormat->formatDateThai($Memorandum['Memorandum']['memo_date_end']) : "");
                                            ?> 
                                        </td>
                                        <td><?php echo (!empty($Memorandum['Memorandum']['event'])) ? $Memorandum['Memorandum']['event'] : ""; ?></td>
                                        <td><?php echo (!empty($Memorandum['Memorandum']['evidence'])) ? $Memorandum['Memorandum']['evidence'] : ""; ?></td>
                                        <td style="text-align: center;">
                                            <a data-toggle="modal"  class="add_rows_simple hideme mm_1_edit" data-backdrop="static" href="#myModal2" onclick="editMemorandum('<?php echo $Memorandum['Memorandum']['id']; ?>');" style="display: inline;"><i class="icon-pencil"></i></a>
                                            <a href="#" class="delete add_rows_simple hideme mm_1_delete" value="<?php echo (string) $Memorandum['Memorandum']['id']; ?>" style="display: inline;"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
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
    function toggleMemorandum(source)
    {
        var checkboxes = document.getElementsByName('MemorandumID[]');
        for (var i in checkboxes)
        {
            checkboxes[i].checked = source.checked;
        }
    }

    function addMemorandum() {
        $('#customModal2').html('');
        $('#customModalHeader2').html('สร้างจดหมายเหตุ');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../Memorandums/form", function (data) {
            $('#customModal2').html(data);
        });
    }

    function printMemorandumMonthlyReport() {
        $('#customModal2').html('');
        $('#customModalHeader2').html('รายงานจดหมายเหตุประจำเดือน');
        $('#customModalAction2').html('แสดงรายงาน');
        $('#customModal2').load("../../Memorandums/FormConRptMonthly", function (data) {
            $('#customModal2').html(data);
        });
    }

    function editMemorandum(id) {
        $('#customModal2').html('');
        $('#customModalHeader2').html('แก้ไขข้อมูลจดหมายเหตุ');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../Memorandums/form/" + id, function (data) {
            $('#customModal2').html(data);
        });
    }

    function deleteMemorandum(id) {
        var ids = [];
        if (id != null) {
            ids.push(id);
        }
        else
            ids = getChecks();

        if (ids.length != 0) {
            if (confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")) {
                var url = "../../Memorandums/delete";
                $.post(url, {
                    ids: ids,
                }, function (data) {

                    if (data.status == "SUCCESS") {
                        window.location = "../../Memorandums";
                    } else {
                        alert("การลบข้อมูลล้มเหลว");
                    }
                }, "json");
            }
        } else
            alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
    }

    function getChecks() {
        var checkboxes = $("[name='MemorandumID[]']");
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
        deleteMemorandum(id);
    });
</script>