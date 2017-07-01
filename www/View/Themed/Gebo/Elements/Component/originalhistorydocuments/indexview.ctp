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
                <form action="../../OriginalHistoryDocuments" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
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
                            <label for="textfield" class="control-label">หน่วยส่งเอกสาร : </label>
                            <div class="controls">
                                <input type="text" name='txtOhdSender' value="<?php echo (isset($default) && $default['txtOhdSender'] != '') ? $default['txtOhdSender'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">เรื่อง : </label>
                            <div class="controls">
                                <input type="text" name='txtOhdTitle' value="<?php echo (isset($default) && $default['txtOhdTitle'] != '') ? $default['txtOhdTitle'] : ''; ?>">
                            </div>
                        </div>                        
                        <div class="span6">
                            <label for="textfield" class="control-label">หน่วยรับเอกสาร : </label>
                            <div class="controls">
                                <input type="text" name='txtOhdReceiver' value="<?php echo (isset($default) && $default['txtOhdReceiver'] != '') ? $default['txtOhdReceiver'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">สายงาน : </label>
                            <div class="controls">
                                <select name="ddlUnit"  data-placeholder="" class="chzn_a input-xlarge">
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
                        <div class="span6">
                            <label for="textfield" class="control-label">เลขที่ตู้ : </label>
                            <div class="controls">
                                <input type="text" name='txtOhdClosetNo' value="<?php echo (isset($default) && $default['txtOhdClosetNo'] != '') ? $default['txtOhdClosetNo'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">เลขที่หนังสือ : </label>
                            <div class="controls">
                                <input type="text" name='txtOhdDocNo' value="<?php echo (isset($default) && $default['txtOhdDocNo'] != '') ? $default['txtOhdDocNo'] : ''; ?>">
                            </div>
                        </div>                        
                        <div class="span6">
                            <label for="textfield" class="control-label">เลขอื่นที่ใช้ : </label>
                            <div class="controls">
                                <input type="text" name='txtOhdOtherNo' value="<?php echo (isset($default) && $default['txtOhdOtherNo'] != '') ? $default['txtOhdOtherNo'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">วันที่หนังสือ : </label>
                            <div class="controls">
                                <!--                                <div class="input-append date" id="dp1" data-date-format="dd/mm/yyyy">
                                                                    <input class="span6" type="text" readonly="" name='dpkOhdDocDate' value="<?php echo (isset($default) && $default['dpkOhdDocDate'] != '') ? $default['dpkOhdDocDate'] : ''; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                                                </div>-->
                                <?php
                                $arrdpkDate1 = array();
                                $arrdpkDate1['class'] = 'form-control';
                                if (isset($default) && $default['dpkOhdDocDate'] != '') {
                                    $arrdpkDate1['value'] = $default['dpkOhdDocDate']['year'] . '-' . $default['dpkOhdDocDate']['month'] . '-' . $default['dpkOhdDocDate']['day'];
                                }
                                echo $this->CustomForm->dateThai('dpkOhdDocDate', $arrdpkDate1);
                                ?>
                            </div>
                        </div>                        
                        <div class="span6">
                            <label for="textfield" class="control-label"> </label>
                            <div class="controls">

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
                                    <a href="#myModal2" onclick="addOriginalHistoryDocument();" data-toggle="modal"  data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">
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
                                <th style="text-align: center;width:50px;"><input type="checkbox" class="toggle" onclick="toggleOriginalHistoryDocument(this);"></th>
                                <th style="text-align: center;width:50px;">ลำดับ</th>
                                <th style="text-align: center;width:80px;">ชั้นความลับ</th>
                                <th style="text-align: center;width:80px;">วันที่</th>
                                <th style="text-align: left;">เรื่อง</th>
                                <th style="text-align: left;width:200px;">ไฟล์แนบ</th>
                                <th style="text-align: center;width:80px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($OriginalHistoryDocuments)) { ?>
                                <?php
                                $rowNo = 1;
                                foreach ($OriginalHistoryDocuments as $OriginalHistoryDocument) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" name="OriginalHistoryDocumentID[]" value="<?php echo $OriginalHistoryDocument['OriginalHistoryDocument']['id']; ?>">
                                        </td>  
                                        <td style="text-align: center;"><?php echo $rowNo; ?></td>
                                        <td style="text-align: center;">
                                            <?php
                                            if ($OriginalHistoryDocument['OriginalHistoryDocument']['secret'] == '0')
                                                echo "ไม่ลับ";
                                            else if ($OriginalHistoryDocument['OriginalHistoryDocument']['secret'] == '1')
                                                echo "ลับ";
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php
                                            echo (!empty($OriginalHistoryDocument['OriginalHistoryDocument']['ohd_doc_date'])) ? $this->DateFormat->formatDateThai($OriginalHistoryDocument['OriginalHistoryDocument']['ohd_doc_date']) : "";
                                            ?> 
                                        </td>
                                        <td style=""><?php echo $OriginalHistoryDocument['OriginalHistoryDocument']['ohd_title']; ?></td>
                                        <td>
                                            <?php
                                            $whereConditions = array();
                                            $whereConditions['deleted'] = 'N';
                                            $whereConditions['file_table_name'] = 'OriginalHistoryDocuments';
                                            $whereConditions['file_table_key'] = $OriginalHistoryDocument['OriginalHistoryDocument']['id'];
                                            $conditions = array('limit' => 100,
                                                'order' => array('id' => 'asc'),
                                                'conditions' => $whereConditions
                                            );

                                            $TableAttachFile = ClassRegistry::init('TableAttachFile');
                                            $modelFiles = $TableAttachFile->find('all', $conditions);

                                            if (count($modelFiles) > 0) {
                                                echo "<ul>";
                                                foreach ($modelFiles as $row) {
                                                    echo "<li><a href='/files/originalhistorydocuments/" . $row["TableAttachFile"]["file_name"] . "' target='_blank'>" . $row["TableAttachFile"]["file_original_name"] . "</a></li>";
                                                }
                                                echo "</ul>";
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a data-toggle="modal"  class="add_rows_simple hideme mm_1_edit" data-backdrop="static" href="#myModal2" onclick="editOriginalHistoryDocument('<?php echo $OriginalHistoryDocument['OriginalHistoryDocument']['id']; ?>');" style="display: inline;"><i class="icon-pencil"></i></a>
                                            <a href="#" class="delete add_rows_simple hideme mm_1_delete" value="<?php echo (string) $OriginalHistoryDocument['OriginalHistoryDocument']['id']; ?>" style="display: inline;"><i class="icon-trash"></i></a>
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
    function toggleOriginalHistoryDocument(source)
    {
        var checkboxes = document.getElementsByName('OriginalHistoryDocumentID[]');
        for (var i in checkboxes)
        {
            checkboxes[i].checked = source.checked;
        }
    }

    function addOriginalHistoryDocument() {
        $('#customModal2').html('');
        $('#customModalHeader2').html('สร้างต้นฉบับเอกสารประวัติศาสตร์');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../OriginalHistoryDocuments/form", function (data) {
            $('#customModal2').html(data);
        });
    }

    function editOriginalHistoryDocument(id) {
        $('#customModal2').html('');
        $('#customModalHeader2').html('แก้ไขข้อมูลต้นฉบับเอกสารประวัติศาสตร์');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../OriginalHistoryDocuments/form/" + id, function (data) {
            $('#customModal2').html(data);
        });
    }

    function deleteOriginalHistoryDocument(id) {
        var ids = [];
        if (id != null) {
            ids.push(id);
        }
        else
            ids = getChecks();

        if (ids.length != 0) {
            if (confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")) {
                var url = "../../OriginalHistoryDocuments/delete";
                $.post(url, {
                    ids: ids,
                }, function (data) {

                    if (data.status == "SUCCESS") {
                        window.location = "../../OriginalHistoryDocuments";
                    } else {
                        alert("การลบข้อมูลล้มเหลว");
                    }
                }, "json");
            }
        } else
            alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
    }

    function getChecks() {
        var checkboxes = $("[name='OriginalHistoryDocumentID[]']");
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
        deleteOriginalHistoryDocument(id);
    });


</script>