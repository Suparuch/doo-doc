<?php
$default['id'] = empty($default['id']) ? '' : $default['id'];
$formAction = $default['action'];

/*
  $default['cm_date'] = empty($default['cm_date']) ? '' : $default['cm_date'];
  if ($default['cm_date'] != '')
  $default['cm_date'] = $this->TextUtil->formatSqlDateForPckDate($default['cm_date']);
 */

if ($formAction == "ADD") {
    //$default['cm_date'] = $this->TextUtil->getCurrDateForPckDate();
    $default['cm_date'] = date('Y-m-d');
    $default['status'] = '1';
}
?>

<script type="text/javascript">
    var i = 0;

</script>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-content nopadding">
                <?php echo $this->Form->create('HMCommands', array('action' => 'save', 'class' => 'form-horizontal form-bordered')); ?>
                <div class="row-fluid">
                    <input type="hidden" name="data[HMCommands][id]" value="<?php echo $default['id']; ?>"/>                                    
                    <input type="hidden" name="data[HMCommands][action]" value="<?php echo $default['action']; ?>"/> 
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="text-align:right;">สถานะคำสั่ง : </td>
                                <td>
                                    <input name="data[HMCommands][status]" type="radio" value="1" <?php echo (isset($default['status']) && $default['status'] == '1') ? "checked='checked'" : ""; ?>> ใช้งาน 
                                    <input name="data[HMCommands][status]" type="radio" value="0" <?php echo (isset($default['status']) && $default['status'] == '0') ? "checked='checked'" : ""; ?>> ไม่ใช้งาน    
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">เลขที่ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('cm_no', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['cm_no'])) ? $default['cm_no'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">* เรื่อง : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('cm_title', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['cm_title'])) ? $default['cm_title'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>                            
                            <tr>
                                <td style="text-align:right;">วันที่ : </td>
                                <td>
                                    <!--<span>
                                        <div class="input-append date" id="dp1" class="pckcal" data-date-format="dd/mm/yyyy">
                                            <input class="span6" type="text" readonly="" name='cm_date' value="<?php echo (isset($default) && isset($default['cm_date'])) ? $default['cm_date'] : ""; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                        </div>
                                    </span>-->
                                    <div>
                                        <?php
                                        echo $this->CustomForm->dateThai('HMCommands', array('value' => $default['cm_date'],
                                            'class' => 'form-control'
                                        ));
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">คำค้น : </td>
                                <td>
                                    <textarea name="data[HMCommands][cm_remark]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder=""><?php echo (isset($default) && isset($default['cm_remark'])) ? $default['cm_remark'] : ""; ?></textarea>
                                </td>
                            </tr>                              
                            <tr>
                                <td style="text-align:right;">เอกสารแนบ<br/>(ขนาดไฟล์ ไม่เกิน 5MB) : </td>
                                <td>

                                    <div id='file_list'>
                                        <?php foreach ($TableAttachFiles as $TableAttachFile) { ?>
                                            <?php echo '<div id="row_doc_key_' . $TableAttachFile['TableAttachFile']['id'] . '"><a href="/files/hmcommands/' . $TableAttachFile['TableAttachFile']['file_name'] . '" target=_blank>' . $TableAttachFile['TableAttachFile']['file_original_name'] . '</a>&nbsp;&nbsp;<span style="cursor:pointer;" onclick="modalActionRemoveDocument(\'' . $TableAttachFile['TableAttachFile']['id'] . '\');"><i class="icon-trash"></i></a></span></div>'; ?>
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

    function moreattach() {
        i++;
        $("#file_list").append("<div><input class='form-control' type='file' name='file_attach[]' /></div>");
    }

    function modalActionRemoveDocument(fileID) {
        if (confirm('ยืนยันการลบเอกสารแนบ')) {
            var url = "../../HMCommands/removeDocument/" + fileID;
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
                if(parseInt(xm) !== parseInt(month)){                    
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
        var form_action = $("input[name='data[HMCommands][action]']").val();
        var key_id = $("input[name='data[HMCommands][id]']").val();
        var cm_no = $("input[name='data[HMCommands][cm_no]']").val();
        var cm_title = $("input[name='data[HMCommands][cm_title]']").val();
        var cm_remark = $("textarea[name='data[HMCommands][cm_remark]']").val();
        var status = $("input:radio[name ='data[HMCommands][status]']:checked").val();
        /*var cm_date = $("input[name='cm_date']").removeAttr('readonly').val();
         $("input[name='cm_date']").attr('readonly', '');
         if (cm_date !== '') {
         cm_date = formatDateForSave(cm_date);
         }*/
        var cm_date = formatDDLDateForSave(
                $("select[name='data[HMCommands][day]']").val(),
                $("select[name='data[HMCommands][month]']").val(),
                $("select[name='data[HMCommands][year]']").val());        
        if(cm_date === 'InvalidDate'){
            alert('วันที่ที่ระบุ ไม่พบในปฏิทิน !!');
            return;
        }
        if(cm_date === 'DateError'){
            alert('วันที่ที่ระบุ ไม่อยู่ในรูปแบบวันที่ที่ถูกต้อง !!');
            return;
        }
                        
        if (cm_title !== '')
        {
            var url = "../../HMCommands/save/" + key_id + "/" + form_action;
            $.post(url, {
                deleted: 'N',
                order_sort: 0,
                secret: 9,
                cm_no: cm_no,
                cm_title: cm_title,
                cm_remark: cm_remark,
                status: status,
                cm_date: cm_date,
            }, function (data) {
                if (data.status == "SUCCESS") {
                    $(".close").trigger("click");
                    window.location = "../../HMCommands/index";
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
    var id = $("input[name='data[HMCommands][id]']").val();
    var uploader = document.getElementById('uploader0');
    upclick(
            {
                element: uploader,
                action: '../../HMCommands/uploadDocument/' + id,
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
                                document_link = '<div id="row_doc_key_' + document_id + '"><a href="/files/hmcommands/' + document_name + '" target=_blank>';
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
