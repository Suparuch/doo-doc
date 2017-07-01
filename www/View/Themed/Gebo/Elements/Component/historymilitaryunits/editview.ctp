<?php
$default['id'] = empty($default['id']) ? '' : $default['id'];
$formAction = $default['action'];

//$default['hmu_establish_date'] = empty($default['hmu_establish_date']) ? '' : $default['hmu_establish_date'];
//if ($default['hmu_establish_date'] != '')
//    $default['hmu_establish_date'] = $this->TextUtil->formatSqlDateForPckDate($default['hmu_establish_date']);

if ($formAction == "ADD") {
    //$default['hmu_establish_date'] = $this->TextUtil->getCurrDateForPckDate();
    $default['hmu_unit_id'] = '0';
}
?>

<script type="text/javascript">
    var i = 0;

</script>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-content nopadding">
                <?php echo $this->Form->create('HistoryMilitaryUnits', array('action' => 'save', 'class' => 'form-horizontal form-bordered')); ?>
                <div class="row-fluid">
                    <input type="hidden" name="data[HistoryMilitaryUnits][id]" value="<?php echo $default['id']; ?>"/>                                    
                    <input type="hidden" name="data[HistoryMilitaryUnits][action]" value="<?php echo $default['action']; ?>"/> 
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="text-align:right;">* ชื่อหน่วย : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hmu_name', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hmu_name'])) ? $default['hmu_name'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">ชื่อค่าย : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hmu_camp', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hmu_camp'])) ? $default['hmu_camp'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">* ส่วนราชการ : </td>
                                <td>
                                    <select name="data[HistoryMilitaryUnits][hmu_unit_id]"  data-placeholder="" class="chzn_a input-xlarge" >
                                        <option id="ui_slider3_sel" value="0">--- เลือกส่วนราชการ ---</option>
                                        <?php foreach ($OrganizationTypes as $key => $OrganizationType) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $OrganizationType; ?></option>
                                        <?php } ?>
                                    </select>        
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">ที่ตั้ง : </td>
                                <td>
                                    <textarea name="data[HistoryMilitaryUnits][hmu_location]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder=""><?php echo (isset($default) && isset($default['hmu_location'])) ? $default['hmu_location'] : ""; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">วันสถาปนา : </td>
                                <td>
<!--                                    <span>
                                        <div class="input-append date" id="dp1" class="pckcal" data-date-format="dd/mm/yyyy">
                                            <input class="span6" type="text" readonly="" name='hmu_establish_date' value="<?php echo (isset($default) && isset($default['hmu_establish_date'])) ? $default['hmu_establish_date'] : ""; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                        </div>
                                    </span>-->
                                    <div>
                                        <?php
                                        echo $this->CustomForm->dateThai('hmu_establish_date', array('value' => (isset($default) && isset($default['hmu_establish_date'])) ? $default['hmu_establish_date'] : "",
                                            'class' => 'form-control'
                                        ));
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">หมายเหตุ : </td>
                                <td>
                                    <textarea name="data[HistoryMilitaryUnits][hmu_remark]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder=""><?php echo (isset($default) && isset($default['hmu_remark'])) ? $default['hmu_remark'] : ""; ?></textarea>
                                </td>
                            </tr>    
                            <tr>
                                <td style="text-align:right;">เอกสารแนบ<br/>(ขนาดไฟล์ ไม่เกิน 5MB) : </td>
                                <td>

                                    <div id='file_list'>
                                        <?php foreach ($TableAttachFiles as $TableAttachFile) { ?>
                                            <?php echo '<div id="row_doc_key_' . $TableAttachFile['TableAttachFile']['id'] . '"><a href="/files/history_military_units/' . $TableAttachFile['TableAttachFile']['file_name'] . '" target=_blank>' . $TableAttachFile['TableAttachFile']['file_original_name'] . '</a>&nbsp;&nbsp;<span style="cursor:pointer;" onclick="modalActionRemoveDocument(\'' . $TableAttachFile['TableAttachFile']['id'] . '\');"><i class="icon-trash"></i></a></span></div>'; ?>
                                        <?php } ?>
                                    </div>           

                                    <input type="button" name="button" class="btnAttach" id="uploader0" value="เลือกไฟล์แนบ" />

                                </td>
                            </tr>    

                        </tbody>
                    </table>	
                </div>

                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //$('#dp1').datepicker();
    $("select[name='data[HistoryMilitaryUnits][hmu_unit_id]']").val('<?php echo (isset($default) && $default['hmu_unit_id'] != '0') ? $default['hmu_unit_id'] : '0'; ?>');

    function moreattach() {
        i++;
        $("#file_list").append("<div><input class='form-control' type='file' name='file_attach[]' /></div>");
    }

    function modalActionRemoveDocument(fileID) {
        if (confirm('ยืนยันการลบเอกสารแนบ')) {
            var url = "../../HistoryMilitaryUnits/removeDocument/" + fileID;
            $.post(url, {
                file_id: fileID,
            }, function (data) {
                if (data.status == "SUCCESS") {
                    alert(data.message);
                    // Remove file from page
                    document.getElementById("row_doc_key_" + fileID).remove();
                } else {
                    alert("ลบไฟล์เอกสารล้มเหลว");
                }
            }, "json");
        }
    }

    // dd/mm/yyyy to yyyy/mm/dd
    function formatDateForSave(strDate) {
        var result = '';
        var arr = strDate.split("/");
        result = arr[2] + '/' + arr[1] + '/' + arr[0];
        return result;
    }

    function formatDDLDateForSave(day, month, year) {
        var result = ''
        if (year != '' && month != '' && day != '') {
            result = year + '/' + month + '/' + day;

            // Check date exist in calendar
            try {
                var xdate = new Date(year + '-' + month + '-' + day);
                var xm = xdate.getMonth() + 1;
                if (parseInt(xm) !== parseInt(month)) {
                    result = 'InvalidDate';
                }
            }
            catch (err) {
                result = 'DateError';
            }
        }
        return result;
    }

    function modalAction2() {
        var form_action = $("input[name='data[HistoryMilitaryUnits][action]']").val();
        var key_id = $("input[name='data[HistoryMilitaryUnits][id]']").val();
        var hmu_name = $("input[name='data[HistoryMilitaryUnits][hmu_name]']").val();
        var hmu_camp = $("input[name='data[HistoryMilitaryUnits][hmu_camp]']").val();
        var hmu_unit_id = $("select[name='data[HistoryMilitaryUnits][hmu_unit_id]']").val();
        var hmu_location = $("textarea[name='data[HistoryMilitaryUnits][hmu_location]']").val();
        var hmu_remark = $("textarea[name='data[HistoryMilitaryUnits][hmu_remark]']").val();

//        var hmu_establish_date = $("input[name='hmu_establish_date']").removeAttr('readonly').val();
//        $("input[name='hmu_establish_date']").attr('readonly', '');
//        if (hmu_establish_date !== '') {
//            hmu_establish_date = formatDateForSave(hmu_establish_date);
//        }

        var hmu_establish_date = formatDDLDateForSave(
                $("select[name='data[hmu_establish_date][day]']").val(),
                $("select[name='data[hmu_establish_date][month]']").val(),
                $("select[name='data[hmu_establish_date][year]']").val());
        if (hmu_establish_date === 'InvalidDate') {
            alert('วันที่ที่ระบุ ไม่พบในปฏิทิน !!');
            return;
        }
        if (hmu_establish_date === 'DateError') {
            alert('วันที่ที่ระบุ ไม่อยู่ในรูปแบบวันที่ที่ถูกต้อง !!');
            return;
        }

        if (hmu_name != "" && hmu_unit_id != "0")
        {
            var url = "../../HistoryMilitaryUnits/save/" + key_id + "/" + form_action;
            $.post(url, {
                deleted: 'N',
                order_sort: 0,
                secret: 9,
                hmu_name: hmu_name,
                hmu_camp: hmu_camp,
                hmu_unit_id: hmu_unit_id,
                hmu_location: hmu_location,
                hmu_remark: hmu_remark,
                hmu_establish_date: hmu_establish_date,
            }, function (data) {
                if (data.status == "SUCCESS") {
                    $(".close").trigger("click");
                    window.location = "../../HistoryMilitaryUnits/index";
                } else {
                    alert("การสร้างข้อมูลล้มเหลว");
                }
            }, "json");
        }
        else {
            alert('กรุณาใส่ข้อมูลให้ครบถ้วน');
        }
    }

    // File attach
    var id = $("input[name='data[HistoryMilitaryUnits][id]']").val();
    var uploader = document.getElementById('uploader0');
    upclick(
            {
                element: uploader,
                action: '../../HistoryMilitaryUnits/uploadDocument/' + id,
                onstart:
                        function (filename)
                        {
                            //alert('Start upload: '+filename);
                        },
                oncomplete:
                        function (response_data)
                        {
                            data = $.parseJSON(response_data);
                            console.log(response_data);

                            if (data[0].result === 'success') {
                                document_id = data[0].document_id;
                                document_original_name = data[0].document_original_name;
                                document_name = data[0].document_name;
                                document_key = data[0].key;
                                document_link = '<div id="row_doc_key_' + document_id + '"><a href="/files/history_military_units/' + document_name + '" target=_blank>';
                                document_link += document_original_name;
                                document_link += '</a>&nbsp;&nbsp;<span style="cursor:pointer;" onclick="modalActionRemoveDocument(\'' + document_id + '\');"><i class="icon-trash"></i></a></span>';
                                $('#file_list').append(document_link);
                            } else if (data[0].result === 'error') {
                                alert(data[0].detail);
                            }
                        }
            }
    );


</script>
