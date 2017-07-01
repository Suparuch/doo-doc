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
                <form action="../../HMCommands" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    <input type="hidden" name="offset" value="0">

                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">เลขที่ : </label>
                            <div class="controls">
                                <input type="text" name='txtCmNo' value="<?php echo (isset($default) && $default['txtCmNo'] != '') ? $default['txtCmNo'] : ''; ?>">
                            </div>
                        </div>                        
                        <div class="span6">
                            <label for="textfield" class="control-label">เรื่อง : </label>
                            <div class="controls">
                                <input type="text" name='txtCmTitle' value="<?php echo (isset($default) && $default['txtCmTitle'] != '') ? $default['txtCmTitle'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="span6">
                            <table border="0">
                                <tr>
                                    <td class="text-right"><label for="textfield" class="control-label">วันที่ : </label></td>
                                    <td>
                                        &nbsp;&nbsp;&nbsp;
                                        <!--<div class="input-append date" id="dp1" data-date-format="dd/mm/yyyy">
                                            <input class="span6" type="text" readonly="" name='dpkCmDate' value="<?php echo (isset($default) && $default['dpkCmDate'] != '') ? $default['dpkCmDate'] : ''; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                        </div>-->
                                        <?php
                                        $arrdpkCmDate = array();
                                        $arrdpkCmDate['class'] = 'form-control';
                                        if(isset($default) && $default['dpkCmDate'] != ''){                                            
                                            $arrdpkCmDate['value'] = $default['dpkCmDate']['year'].'-'.$default['dpkCmDate']['month'].'-'.$default['dpkCmDate']['day'];
                                        }
                                        echo $this->CustomForm->dateThai('dpkCmDate', $arrdpkCmDate);
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>                        
                    </div>

                    <input type="hidden" name="offset" value="0">

                    
                    <button id="<?php echo $pagination['model']; ?>-submit" type="submit" class="btn btn-primary add_rows_simple hideme mm_3_list" style="display: inline-block; "><?php echo __('ค้นหา'); ?></button>

                    <!--<button type="submit" class="btn btn-primary"></button>-->
<!--
                    <button id="<?php echo $pagination['model']; ?>-submit" type="submit" class="btn btn-primary add_rows_simple hideme mm_3_list" style="display: inline-block; "><?php echo __('ค้นหา'); ?></button>-->

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
                                    <a href="#myModal2" onclick="addHMCommand();" data-toggle="modal"  data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">
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
                                <th style="text-align: center;width:50px;"><input type="checkbox" class="toggle" onclick="toggleHMCommand(this);"></th>                        
                                <th style="text-align: center;">เลขที่</th>
                                <th style="text-align: left;">เรื่อง</th>
                                <th style="text-align: center;width:100px;">วันที่</th>
                                <th style="text-align: center;">หมายเหตุ</th>
                                <th style="text-align: left;width:200px;">ไฟล์แนบ</th>
                                <th style="text-align: center;width:80px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($HMCommands)) { ?>
                                <?php
                                $rowNo = 1;
                                foreach ($HMCommands as $HMCommand) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" name="HMCommandID[]" value="<?php echo $HMCommand['HMCommand']['id']; ?>">
                                        </td>  
                                        <td style="text-align: center;"><?php echo $HMCommand['HMCommand']['cm_no']; ?></td>
                                        <td style=""><?php echo $HMCommand['HMCommand']['cm_title']; ?></td>
                                        <td style="text-align: center;">
                                            <?php
                                            echo (!empty($HMCommand['HMCommand']['cm_date'])) ? $this->DateFormat->formatDateThai($HMCommand['HMCommand']['cm_date']) : "";
                                            ?> 
                                        </td>
                                         <td style="text-align:center;">
                                             <?php 
                                             if($HMCommand['HMCommand']['status'] == "1")
                                                 echo "ใช้งาน";
                                             else
                                                 echo "ไม่ใช้งาน";
                                             ?>
                                         </td>
                                        
                                        <td>
                                            <?php
                                            $whereConditions = array();
                                            $whereConditions['deleted'] = 'N';
                                            $whereConditions['file_table_name'] = 'HMCommands';
                                            $whereConditions['file_table_key'] = $HMCommand['HMCommand']['id'];
                                            $conditions = array('limit' => 100,
                                                'order' => array('id' => 'asc'),
                                                'conditions' => $whereConditions
                                            );

                                            $TableAttachFile = ClassRegistry::init('TableAttachFile');
                                            $modelFiles = $TableAttachFile->find('all', $conditions);

                                            if (count($modelFiles) > 0) {
                                                echo "<ul>";
                                                foreach ($modelFiles as $row) {
                                                    echo "<li><a href='/files/hmcommands/" . $row["TableAttachFile"]["file_name"] . "' target='_blank'>" . $row["TableAttachFile"]["file_original_name"] . "</a></li>";
                                                }
                                                echo "</ul>";
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a data-toggle="modal"  class="add_rows_simple hideme mm_1_edit" data-backdrop="static" href="#myModal2" onclick="editHMCommand('<?php echo $HMCommand['HMCommand']['id']; ?>');" style="display: inline;"><i class="icon-pencil"></i></a>
                                            <a href="#" class="delete add_rows_simple hideme mm_1_delete" value="<?php echo (string) $HMCommand['HMCommand']['id']; ?>" style="display: inline;"><i class="icon-trash"></i></a>
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
    function toggleHMCommand(source)
    {
        var checkboxes = document.getElementsByName('HMCommandID[]');
        for (var i in checkboxes)
        {
            checkboxes[i].checked = source.checked;
        }
    }

    function addHMCommand() {
        $('#customModal2').html('');
        $('#customModalHeader2').html('สร้างคำสั่ง/คู่มือการปฏิบัติงาน');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HMCommands/form", function (data) {
            $('#customModal2').html(data);
        });
    }

    function editHMCommand(id) {
        $('#customModal2').html('');
        $('#customModalHeader2').html('แก้ไขข้อมูลคำสั่ง/คู่มือการปฏิบัติงาน');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HMCommands/form/" + id, function (data) {
            $('#customModal2').html(data);
        });
    }

    function deleteHMCommand(id) {
        var ids = [];
        if (id != null) {
            ids.push(id);
        }
        else
            ids = getChecks();

        if (ids.length != 0) {
            if (confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")) {
                var url = "../../HMCommands/delete";
                $.post(url, {
                    ids: ids,
                }, function (data) {

                    if (data.status == "SUCCESS") {
                        window.location = "../../HMCommands";
                    } else {
                        alert("การลบข้อมูลล้มเหลว");
                    }
                }, "json");
            }
        } else
            alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
    }

    function getChecks() {
        var checkboxes = $("[name='HMCommandID[]']");
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
        deleteHMCommand(id);
    });


</script>