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
                <form action="../../HMHistoryBooks" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
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
                            <label for="textfield" class="control-label">เลขที่เอกสาร/หนังสือ : </label>
                            <div class="controls">
                                <input type="text" name='txtHbNo' value="<?php echo (isset($default) && $default['txtHbNo'] != '') ? $default['txtHbNo'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">ชื่อเอกสาร/หนังสือ : </label>
                            <div class="controls">
                                <input type="text" name='txtHbName' value="<?php echo (isset($default) && $default['txtHbName'] != '') ? $default['txtHbName'] : ''; ?>">
                            </div>
                        </div>                        
                        <div class="span6">
                            <label for="textfield" class="control-label">ผู้แต่ง/รายละเอียด : </label>
                            <div class="controls">
                                <input type="text" name='txtHbAuthor' value="<?php echo (isset($default) && $default['txtHbAuthor'] != '') ? $default['txtHbAuthor'] : ''; ?>">
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
                                    <a href="#myModal2" onclick="addHMHistoryBook();" data-toggle="modal"  data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">
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
                                <th style="text-align: center;width:50px;"><input type="checkbox" class="toggle" onclick="toggleHMHistoryBook(this);"></th>
                                <th style="text-align: center;width:50px;">ลำดับ</th>
                                <th style="text-align: center;">ชั้นความลับ</th>
                                <th style="text-align: left;">ชื่อเอกสาร/หนังสือ</th>
                                <th style="text-align: left;">สถานที่จัดเก็บ</th>
                                <th style="text-align: center;">เลขที่ตู้</th>
                                <th style="text-align: left;width:200px;">ไฟล์แนบ</th>
                                <th style="text-align: center;width:80px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($HMHistoryBooks)) { ?>
                                <?php
                                $rowNo = 1;
                                foreach ($HMHistoryBooks as $HMHistoryBook) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" name="HMHistoryBookID[]" value="<?php echo $HMHistoryBook['HMHistoryBook']['id']; ?>">
                                        </td>  
                                        <td style="text-align: center;"><?php echo $rowNo; ?></td>
                                        <td style="text-align: center;">
                                           <?php
                                           if($HMHistoryBook['HMHistoryBook']['secret'] == '0')
                                               echo "ไม่ลับ";
                                           else if($HMHistoryBook['HMHistoryBook']['secret'] == '1')
                                               echo "ลับ";
                                           ?>
                                        </td>
                                        <td style=""><?php echo $HMHistoryBook['HMHistoryBook']['hb_name']; ?></td>
                                        <td style=""><?php echo $HMHistoryBook['HMHistoryBook']['hb_location']; ?></td>
                                        <td style="text-align:center"><?php echo $HMHistoryBook['HMHistoryBook']['hb_closet_no']; ?></td>                                        
                                        <td>
                                            <?php
                                            $whereConditions = array();
                                            $whereConditions['deleted'] = 'N';
                                            $whereConditions['file_table_name'] = 'HMHistoryBooks';
                                            $whereConditions['file_table_key'] = $HMHistoryBook['HMHistoryBook']['id'];
                                            $conditions = array('limit' => 100,
                                                'order' => array('id' => 'asc'),
                                                'conditions' => $whereConditions
                                            );

                                            $TableAttachFile = ClassRegistry::init('TableAttachFile');
                                            $modelFiles = $TableAttachFile->find('all', $conditions);

                                            if (count($modelFiles) > 0) {
                                                echo "<ul>";
                                                foreach ($modelFiles as $row) {
                                                    echo "<li><a href='/files/hmhistorybooks/".$row["TableAttachFile"]["file_name"]."' target='_blank'>".$row["TableAttachFile"]["file_original_name"] . "</a></li>";
                                                }
                                                echo "</ul>";
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a data-toggle="modal"  class="add_rows_simple hideme mm_1_edit" data-backdrop="static" href="#myModal2" onclick="editHMHistoryBook('<?php echo $HMHistoryBook['HMHistoryBook']['id']; ?>');" style="display: inline;"><i class="icon-pencil"></i></a>
                                            <a href="#" class="delete add_rows_simple hideme mm_1_delete" value="<?php echo (string) $HMHistoryBook['HMHistoryBook']['id']; ?>" style="display: inline;"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $rowNo++;
                                }
                                ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="8" style="text-align:center;">
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
    function toggleHMHistoryBook(source)
    {
        var checkboxes = document.getElementsByName('HMHistoryBookID[]');
        for (var i in checkboxes)
        {
            checkboxes[i].checked = source.checked;
        }
    }

    function addHMHistoryBook() {
        $('#customModal2').html('');
        $('#customModalHeader2').html('สร้างระบบจัดเก็บเอกสารและหนังสือประวัติศาสตร์');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HMHistoryBooks/form", function (data) {
            $('#customModal2').html(data);
        });
    }

    function editHMHistoryBook(id) {
        $('#customModal2').html('');
        $('#customModalHeader2').html('แก้ไขข้อมูลระบบจัดเก็บเอกสารและหนังสือประวัติศาสตร์');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HMHistoryBooks/form/" + id, function (data) {
            $('#customModal2').html(data);
        });
    }

    function deleteHMHistoryBook(id) {
        var ids = [];
        if (id != null) {
            ids.push(id);
        }
        else
            ids = getChecks();

        if (ids.length != 0) {
            if (confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")) {
                var url = "../../HMHistoryBooks/delete";
                $.post(url, {
                    ids: ids,
                }, function (data) {

                    if (data.status == "SUCCESS") {
                        window.location = "../../HMHistoryBooks";
                    } else {
                        alert("การลบข้อมูลล้มเหลว");
                    }
                }, "json");
            }
        } else
            alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
    }

    function getChecks() {
        var checkboxes = $("[name='HMHistoryBookID[]']");
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
        deleteHMHistoryBook(id);
    });


</script>