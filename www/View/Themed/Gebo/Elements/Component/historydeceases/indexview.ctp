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
                <form action="../../HistoryDeceases" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    <input type="hidden" name="offset" value="0">





                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">ชื่อยศ : </label>
                            <div class="controls">
                                <select name="ddlRank"  data-placeholder="" class="chzn_a input-xlarge" >
                                    <option id="ui_slider3_sel" value="0">--- ทั้งหมด ---</option>
                                    <?php foreach ($Ranks as $key => $Rank) { ?>
                                        <option value="<?php echo $key; ?>"><?php echo $Rank; ?></option>
                                    <?php } ?>
                                </select>        
                                <script>
                                    $('select[name="ddlRank').val('<?php echo (isset($default) && $default['ddlRank'] != '0') ? $default['ddlRank'] : '0'; ?>');
                                </script>
                            </div>
                        </div>                        
                        <div class="span6">
                            <label for="textfield" class="control-label">เลขที่ตู้ : </label>
                            <div class="controls">
                                <input type="text" name='txtHdClosetNo' value="<?php echo (isset($default) && $default['txtHdClosetNo'] != '') ? $default['txtHdClosetNo'] : ''; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">ชื่อ : </label>
                            <div class="controls">
                                <input type="text" name='txtHdFirstname' value="<?php echo (isset($default) && $default['txtHdFirstname'] != '') ? $default['txtHdFirstname'] : ''; ?>">
                            </div>
                        </div>

                        <div class="span6">
                            <label for="textfield" class="control-label">ลำดับเล่ม : </label>
                            <div class="controls">
                                <input type="text" name='txtHdBookNo' value="<?php echo (isset($default) && $default['txtHdBookNo'] != '') ? $default['txtHdBookNo'] : ''; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="span12">
                            <label for="textfield" class="control-label">นามสกุล : </label>
                            <div class="controls">
                                <input type="text" name='txtHdLastname' value="<?php echo (isset($default) && $default['txtHdLastname'] != '') ? $default['txtHdLastname'] : ''; ?>">
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
                                    <a href="#myModal2" onclick="addHistoryDecease();" data-toggle="modal"  data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">
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
                                <button id="Rank-submit" type="submit" class="btn btn-primary hideme mm_13_list" style="display: inline-block;">ค้นหา</button>
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
                                <th style="text-align: center;width:50px;"><input type="checkbox" class="toggle" onclick="toggleHistoryDecease(this);"></th>
                                <th style="text-align: center;width:50px;">ลำดับ</th>
                                <th style="text-align: center;width:80px;">ยศ</th>
                                <th style="text-align: left;">ชื่อ-นามสกุล</th>
                                <th style="text-align: left;">สถานที่เก็บเอกสาร</th>
                                <th style="text-align: left;width:200px;">ไฟล์แนบ</th>
                                <th style="text-align: center;width:80px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($HistoryDeceases)) { ?>
                                <?php
                                $rowNo = 1;
                                foreach ($HistoryDeceases as $HistoryDecease) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" name="HistoryDeceaseID[]" value="<?php echo $HistoryDecease['HistoryDecease']['id']; ?>">
                                        </td>  
                                        <td style="text-align: center;"><?php echo $rowNo; ?></td>
                                        <td style="text-align: center;">
                                            <?php
                                            if (!empty($HistoryDecease['HistoryDecease']['hd_rank_id'])) {
                                                $modelRank = new Rank();
                                                $whereConditions = array();
                                                $whereCOnditions['deleted'] = 'N';
                                                $whereConditions['id'] = $HistoryDecease['HistoryDecease']['hd_rank_id'];
                                                $conditions = array('limit' => '1',
                                                    'order' => array('id' => 'asc'),
                                                    'conditions' => $whereConditions
                                                );
                                                $DataRank = $modelRank->find('all', $conditions);
                                                echo $DataRank[0]["Rank"]["name"] . " ";
                                            }
                                            ?>
                                        </td>
                                        <td style="">
                                            <?php
                                            echo $HistoryDecease['HistoryDecease']['hd_firstname'] . ' ' . $HistoryDecease['HistoryDecease']['hd_lastname'];
                                            ?>
                                        </td>
                                        <td style=""><?php echo $HistoryDecease['HistoryDecease']['hd_document_location']; ?></td>
                                        <td>
                                            <?php
                                            $whereConditions = array();
                                            $whereConditions['deleted'] = 'N';
                                            $whereConditions['file_table_name'] = 'HistoryDeceases';
                                            $whereConditions['file_table_key'] = $HistoryDecease['HistoryDecease']['id'];
                                            $conditions = array('limit' => 100,
                                                'order' => array('id' => 'asc'),
                                                'conditions' => $whereConditions
                                            );

                                            $TableAttachFile = ClassRegistry::init('TableAttachFile');
                                            $modelFiles = $TableAttachFile->find('all', $conditions);

                                            if (count($modelFiles) > 0) {
                                                echo "<ul>";
                                                foreach ($modelFiles as $row) {
                                                    echo "<li><a href='/files/history_deceases/" . $row["TableAttachFile"]["file_name"] . "' target='_blank'>" . $row["TableAttachFile"]["file_original_name"] . "</a></li>";
                                                }
                                                echo "</ul>";
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a data-toggle="modal"  class="add_rows_simple hideme mm_1_edit" data-backdrop="static" href="#myModal2" onclick="editHistoryDecease('<?php echo $HistoryDecease['HistoryDecease']['id']; ?>');" style="display: inline;"><i class="icon-pencil"></i></a>
                                            <a href="#" class="delete add_rows_simple hideme mm_1_delete" value="<?php echo (string) $HistoryDecease['HistoryDecease']['id']; ?>" style="display: inline;"><i class="icon-trash"></i></a>
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
    function toggleHistoryDecease(source)
    {
        var checkboxes = document.getElementsByName('HistoryDeceaseID[]');
        for (var i in checkboxes)
        {
            checkboxes[i].checked = source.checked;
        }
    }

    function addHistoryDecease() {
        $('#customModal2').html('');
        $('#customModalHeader2').html('สร้างสมุดประวัติข้าราชการถึงแก่กรรม');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HistoryDeceases/form", function (data) {
            $('#customModal2').html(data);
        });
    }

    function editHistoryDecease(id) {
        $('#customModal2').html('');
        $('#customModalHeader2').html('แก้ไขข้อมูลสมุดประวัติข้าราชการถึงแก่กรรม');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HistoryDeceases/form/" + id, function (data) {
            $('#customModal2').html(data);
        });
    }

    function deleteHistoryDecease(id) {
        var ids = [];
        if (id != null) {
            ids.push(id);
        }
        else
            ids = getChecks();

        if (ids.length != 0) {
            if (confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")) {
                var url = "../../HistoryDeceases/delete";
                $.post(url, {
                    ids: ids,
                }, function (data) {

                    if (data.status == "SUCCESS") {
                        window.location = "../../HistoryDeceases";
                    } else {
                        alert("การลบข้อมูลล้มเหลว");
                    }
                }, "json");
            }
        } else
            alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
    }

    function getChecks() {
        var checkboxes = $("[name='HistoryDeceaseID[]']");
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
        deleteHistoryDecease(id);
    });


</script>