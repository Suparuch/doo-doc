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
                <form action="../../PastEvents" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                    <input type="hidden" name="offset" value="0">

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
                                    <td class="text-right">


                                        <table>
                                            <tr>
                                                <td class="text-right">&nbsp;&nbsp;&nbsp;ถึง&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td class="text-left">
                                                    <!--                                                    <div class="input-append date" id="dp2"  data-date-format="dd/mm/yyyy">
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
                                    <a href="#myModal2" onclick="addPastEvent();" data-toggle="modal"  data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">
                                        <i class="splashy-add"></i>เพิ่ม</a>
                                </li>

                                <li class='add_rows_simple hideme mm_3_delete'> <a href="#" class="delete" data-tableid="smpl_tbl" style="display: block;"><i class="icon-trash"></i> ลบ </a></li>

                                <li class="hideme mm_13_add" style="display: list-item;">
                                    <a href="#myModal2" onclick="printPastEventTodayReport();"   data-backdrop="static" class="add_rows_simple" data-tableid="smpl_tbl">
                                        <i class="splashy-document_a4_marked"></i> รายงานวันนี้ในอดีต 
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
                                <th style="text-align: center;width:50px;"><input type="checkbox" class="toggle" onclick="togglePastEvent(this);"></th>
                                <th style="text-align: center;width:130px;">วันที่</th>
                                <th style="text-align: left;">เหตุการณ์</th>
                                <th style="text-align: left;">หลักฐาน</th>
                                <th style="text-align: center;width:80px;">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($PastEvents)) { ?>
                                <?php foreach ($PastEvents as $PastEvent) { ?>
                                    <tr>
                                        <td style="text-align: center;">
                                            <input type="checkbox" name="PastEventID[]" value="<?php echo $PastEvent['PastEvent']['id']; ?>"></td>  
                                        <td style="text-align: center;">
                                            <?php
                                            echo (!empty($PastEvent['PastEvent']['event_date'])) ? $this->DateFormat->formatDateThai($PastEvent['PastEvent']['event_date']) : "";
                                            ?> 
                                        </td>
                                        <td><?php echo (!empty($PastEvent['PastEvent']['event_name'])) ? $PastEvent['PastEvent']['event_name'] : ""; ?></td>
                                        <td><?php echo (!empty($PastEvent['PastEvent']['evidence'])) ? $PastEvent['PastEvent']['evidence'] : ""; ?></td>
                                        <td style="text-align: center;">
                                            <a data-toggle="modal"  class="add_rows_simple hideme mm_1_edit" data-backdrop="static" href="#myModal2" onclick="editPastEvent('<?php echo $PastEvent['PastEvent']['id']; ?>');" style="display: inline;"><i class="icon-pencil"></i></a>
                                            <a href="#" class="delete add_rows_simple hideme mm_1_delete" value="<?php echo (string) $PastEvent['PastEvent']['id']; ?>" style="display: inline;"><i class="icon-trash"></i></a>
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
    function togglePastEvent(source)
    {
        var checkboxes = document.getElementsByName('PastEventID[]');
        for (var i in checkboxes)
        {
            checkboxes[i].checked = source.checked;
        }
    }

    function addPastEvent() {
        $('#customModal2').html('');
        $('#customModalHeader2').html('สร้างเหตุการณ์วันนี้ในอดีต');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../PastEvents/form", function (data) {
            $('#customModal2').html(data);
        });
    }

    function editPastEvent(id) {
        $('#customModal2').html('');
        $('#customModalHeader2').html('แก้ไขข้อมูลเหตุการณ์วันนี้ในอดีต');
        $('#customModalAction2').html('บันทึก');
        $('#customModal2').load("../../PastEvents/form/" + id, function (data) {
            $('#customModal2').html(data);
        });
    }

    function printPastEventTodayReport() {
        /*$('#customModal2').html('');
         $('#customModalHeader2').html('รายงานวันนี้ในอดีต');
         $('#customModalAction2').html('แสดงรายงาน');
         $('#customModal2').load("../../PastEvents/FormConRptToday", function (data) {
         $('#customModal2').html(data);
         });*/
        window.open("../../PastEvents/printTodayReport", "_blank");
    }

    function deletePastEvent(id) {
        var ids = [];
        if (id != null) {
            ids.push(id);
        }
        else
            ids = getChecks();

        if (ids.length != 0) {
            if (confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")) {
                var url = "../../PastEvents/delete";
                $.post(url, {
                    ids: ids,
                }, function (data) {

                    if (data.status == "SUCCESS") {
                        window.location = "../../PastEvents";
                    } else {
                        alert("การลบข้อมูลล้มเหลว");
                    }
                }, "json");
            }
        } else
            alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
    }

    function getChecks() {
        var checkboxes = $("[name='PastEventID[]']");
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
        deletePastEvent(id);
    });
</script>