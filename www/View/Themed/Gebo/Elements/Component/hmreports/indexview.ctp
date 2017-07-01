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
                <form action="../../HMReports" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    <input type="hidden" name="offset" value="0">

                    <div class="control-group">
                        <div class="span6">
                            <label for="textfield" class="control-label">รายงานผลเรื่อง : </label>
                            <div class="controls">
                                <input type="text" name='txtRpTitle' value="<?php echo (isset($default) && $default['txtRpTitle'] != '') ? $default['txtRpTitle'] : ''; ?>">
                            </div>
                        </div>                        
                        <div class="span6">
                           <label for="textfield" class="control-label">ปีที่รายงานผล : </label>
                            <div class="controls">
                                <select name="ddlYear"  data-placeholder="" class="chzn_a input-xlarge" style="width:150px;">
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
                    </div>

                    <input type="hidden" name="offset" value="0">

                    <!--<button type="submit" class="btn btn-primary"></button>-->
<button id="<?php echo $pagination['model']; ?>-submit" type="submit" class="btn btn-primary add_rows_simple hideme mm_3_list" style="display: inline-block; "><?php echo __('ค้นหา'); ?></button>

<!--                    <button id="<?php echo $pagination['model']; ?>-submit" type="submit" class="btn btn-primary add_rows_simple hideme mm_3_list" style="display: inline-block; "><?php echo __('ค้นหา'); ?></button>-->

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
                                    <a href="#myModal2" onclick="addHMReport();" data-toggle="modal"  data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">
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
                                <th style="text-align: center;width:50px;"><input type="checkbox" class="toggle" onclick="toggleHMReport(this);"></th>
                                <th style="text-align: center;">ปีที่รายงานผล</th>
                                <th style="text-align: left;">การรายงานผลเรื่อง</th>
                                <th style="text-align: left;width:200px;">ไฟล์แนบ</th>
                                <th style="text-align: center;width:80px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($HMReports)) { ?>
                                <?php
                                $rowNo = 1;
                                foreach ($HMReports as $HMReport) {
                                    ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" name="HMReportID[]" value="<?php echo $HMReport['HMReport']['id']; ?>">
                                        </td>                                          
                                        <td style="text-align:center;"><?php echo $HMReport['HMReport']['rp_year']; ?></td>
                                        <td style=""><?php echo $HMReport['HMReport']['rp_title']; ?></td>
                                        <td>
                                            <?php
                                            $whereConditions = array();
                                            $whereConditions['deleted'] = 'N';
                                            $whereConditions['file_table_name'] = 'HMReports';
                                            $whereConditions['file_table_key'] = $HMReport['HMReport']['id'];
                                            $conditions = array('limit' => 100,
                                                'order' => array('id' => 'asc'),
                                                'conditions' => $whereConditions
                                            );

                                            $TableAttachFile = ClassRegistry::init('TableAttachFile');
                                            $modelFiles = $TableAttachFile->find('all', $conditions);

                                            if (count($modelFiles) > 0) {
                                                echo "<ul>";
                                                foreach ($modelFiles as $row) {
                                                    echo "<li><a href='/files/hm_reports/".$row["TableAttachFile"]["file_name"]."' target='_blank'>".$row["TableAttachFile"]["file_original_name"] . "</a></li>";
                                                }
                                                echo "</ul>";
                                            }
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <a data-toggle="modal"  class="add_rows_simple hideme mm_1_edit" data-backdrop="static" href="#myModal2" onclick="editHMReport('<?php echo $HMReport['HMReport']['id']; ?>');" style="display: inline;"><i class="icon-pencil"></i></a>
                                            <a href="#" class="delete add_rows_simple hideme mm_1_delete" value="<?php echo (string) $HMReport['HMReport']['id']; ?>" style="display: inline;"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $rowNo++;
                                }
                                ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="5" style="text-align:center;">
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
    function toggleHMReport(source)
    {
        var checkboxes = document.getElementsByName('HMReportID[]');
        for (var i in checkboxes)
        {
            checkboxes[i].checked = source.checked;
        }
    }

    function addHMReport() {
        $('#customModal2').html('');
        $('#customModalHeader2').html('สร้างชื่อการรายงานผล');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HMReports/form", function (data) {
            $('#customModal2').html(data);
        });
    }

    function editHMReport(id) {
        $('#customModal2').html('');
        $('#customModalHeader2').html('แก้ไขชื่อการรายงานผล');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../HMReports/form/" + id, function (data) {
            $('#customModal2').html(data);
        });
    }

    function deleteHMReport(id) {
        var ids = [];
        if (id != null) {
            ids.push(id);
        }
        else
            ids = getChecks();

        if (ids.length != 0) {
            if (confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")) {
                var url = "../../HMReports/delete";
                $.post(url, {
                    ids: ids,
                }, function (data) {

                    if (data.status == "SUCCESS") {
                        window.location = "../../HMReports";
                    } else {
                        alert("การลบข้อมูลล้มเหลว");
                    }
                }, "json");
            }
        } else
            alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
    }

    function getChecks() {
        var checkboxes = $("[name='HMReportID[]']");
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
        deleteHMReport(id);
    });


</script>