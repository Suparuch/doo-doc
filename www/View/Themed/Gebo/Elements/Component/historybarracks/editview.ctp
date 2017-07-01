<?php
$default['id'] = empty($default['id']) ? '' : $default['id'];
$formAction = $default['action'];

/*
  $default['hb_establish_date'] = empty($default['hb_establish_date']) ? '' : $default['hb_establish_date'];
  if ($default['hb_establish_date'] != '')
  $default['hb_establish_date'] = $this->TextUtil->formatSqlDateForPckDate($default['hb_establish_date']);
 */
if ($formAction == "ADD") {
    //$default['hb_establish_date'] = $this->TextUtil->getCurrDateForPckDate();
    $default['hb_unit_id'] = '0';
}
?>

<script type="text/javascript">
    var i = 0;

</script>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-content nopadding">
                <?php echo $this->Form->create('HistoryBarracks', array('action' => 'save', 'class' => 'form-horizontal form-bordered')); ?>
                <div class="row-fluid">
                    <input type="hidden" name="data[HistoryBarracks][id]" value="<?php echo $default['id']; ?>"/>                                    
                    <input type="hidden" name="data[HistoryBarracks][action]" value="<?php echo $default['action']; ?>"/> 
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="text-align:right;">* ชื่อค่าย : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hb_name', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hb_name'])) ? $default['hb_name'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">ส่วนราชการ : </td>
                                <td>
                                    <select name="data[HistoryBarracks][hb_unit_id]"  data-placeholder="" class="chzn_a input-xlarge" >
                                        <option id="ui_slider3_sel" value="0">--- เลือกส่วนราชการ ---</option>
                                        <?php foreach ($Areas as $key => $Area) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $Area; ?></option>
                                        <?php } ?>
                                    </select>        
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">หน่วยทหารในพื้นที่ : </td>
                                <td>
                                    <textarea name="data[HistoryBarracks][hb_area]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder=""><?php echo (isset($default) && isset($default['hb_area'])) ? $default['hb_area'] : ""; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">วันสถาปนาค่าย : </td>
                                <td>
<!--                                    <span>
                                        <div class="input-append date" id="dp1" class="pckcal" data-date-format="dd/mm/yyyy">
                                            <input class="span6" type="text" readonly="" name='hb_establish_date' value="<?php echo (isset($default) && isset($default['hb_establish_date'])) ? $default['hb_establish_date'] : ""; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                        </div>
                                    </span>-->
                                    <div>
                                        <?php
                                        echo $this->CustomForm->dateThai('hb_establish_date', array('value' => (isset($default) && isset($default['hb_establish_date'])) ? $default['hb_establish_date'] : "",
                                            'class' => 'form-control'
                                        ));
                                        ?>
                                    </div>
                                </td>
                            </tr>


                            <tr>
                                <td style="text-align:right;">คำค้น : </td>
                                <td>
                                    <textarea name="data[HistoryBarracks][hb_keyword]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder=""><?php echo (isset($default) && isset($default['hb_keyword'])) ? $default['hb_keyword'] : ""; ?></textarea>
                                </td>
                            </tr>                              
                            <tr>
                                <td style="text-align:right;">เอกสารแนบ<br/>(ขนาดไฟล์ ไม่เกิน 5MB) : </td>
                                <td>

                                    <div id='file_list'>
                                        <?php foreach ($TableAttachFiles as $TableAttachFile) { ?>
                                            <?php echo '<div id="row_doc_key_' . $TableAttachFile['TableAttachFile']['id'] . '"><a href="/files/history_barracks/' . $TableAttachFile['TableAttachFile']['file_name'] . '" target=_blank>' . $TableAttachFile['TableAttachFile']['file_original_name'] . '</a>&nbsp;&nbsp;<span style="cursor:pointer;" onclick="modalActionRemoveDocument(\'' . $TableAttachFile['TableAttachFile']['id'] . '\');"><i class="icon-trash"></i></a></span></div>'; ?>
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
    $("select[name='data[HistoryBarracks][hb_unit_id]']").val('<?php echo (isset($default) && $default['hb_unit_id'] != '0') ? $default['hb_unit_id'] : '0'; ?>');

    function moreattach() {
        i++;
        $("#file_list").append("<div><input class='form-control' type='file' name='file_attach[]' /></div>");
    }

    function modalActionRemoveDocument(fileID) {
        if (confirm('ยืนยันการลบเอกสารแนบ')) {
            var url = "../../HistoryBarracks/removeDocument/" + fileID;
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
        var form_action = $("input[name='data[HistoryBarracks][action]']").val();
        var key_id = $("input[name='data[HistoryBarracks][id]']").val();
        var hb_name = $("input[name='data[HistoryBarracks][hb_name]']").val();
        var hb_area = $("textarea[name='data[HistoryBarracks][hb_area]']").val();
        var hb_unit_id = $("select[name='data[HistoryBarracks][hb_unit_id]']").val();
        var hb_keyword = $("textarea[name='data[HistoryBarracks][hb_keyword]']").val();

//        var hb_establish_date = $("input[name='hb_establish_date']").removeAttr('readonly').val();
//        $("input[name='hb_establish_date']").attr('readonly', '');
//        if (hb_establish_date !== '') {
//            hb_establish_date = formatDateForSave(hb_establish_date);
//        }

        var hb_establish_date = formatDDLDateForSave(
                $("select[name='data[hb_establish_date][day]']").val(),
                $("select[name='data[hb_establish_date][month]']").val(),
                $("select[name='data[hb_establish_date][year]']").val());
        if (hb_establish_date === 'InvalidDate') {
            alert('วันที่ที่ระบุ ไม่พบในปฏิทิน !!');
            return;
        }
        if (hb_establish_date === 'DateError') {
            alert('วันที่ที่ระบุ ไม่อยู่ในรูปแบบวันที่ที่ถูกต้อง !!');
            return;
        }

        if (hb_name != '')
        {
            var url = "../../HistoryBarracks/save/" + key_id + "/" + form_action;
            $.post(url, {
                deleted: 'N',
                order_sort: 0,
                secret: 9,
                hb_name: hb_name,
                hb_area: hb_area,
                hb_unit_id: hb_unit_id,
                hb_keyword: hb_keyword,
                hb_establish_date: hb_establish_date,
            }, function (data) {
                if (data.status == "SUCCESS") {
                    $(".close").trigger("click");
                    window.location = "../../HistoryBarracks/index";
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
    var id = $("input[name='data[HistoryBarracks][id]']").val();
    var uploader = document.getElementById('uploader0');
    upclick(
            {
                element: uploader,
                action: '../../HistoryBarracks/uploadDocument/' + id,
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
                                document_link = '<div id="row_doc_key_' + document_id + '"><a href="/files/history_barracks/' + document_name + '" target=_blank>';
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
