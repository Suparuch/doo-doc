<?php
$default['id'] = empty($default['id']) ? '' : $default['id'];
$formAction = $default['action'];

/* $default['ohd_doc_date'] = empty($default['ohd_doc_date']) ? '' : $default['ohd_doc_date'];
  if ($default['ohd_doc_date'] != '')
  $default['ohd_doc_date'] = $this->TextUtil->formatSqlDateForPckDate($default['ohd_doc_date']);
 */

if ($formAction == "ADD") {
    //$default['ohd_doc_date'] = $this->TextUtil->getCurrDateForPckDate();
    $default['ohd_doc_date'] = date('Y-m-d');
    $default['secret'] = '0';
    $default['ohd_div_id'] = '0';
}
?>

<script type="text/javascript">
    var i = 0;

</script>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-content nopadding">
                <?php echo $this->Form->create('OriginalHistoryDocuments', array('action' => 'save', 'class' => 'form-horizontal form-bordered')); ?>
                <div class="row-fluid">
                    <input type="hidden" name="data[OriginalHistoryDocuments][id]" value="<?php echo $default['id']; ?>"/>                                    
                    <input type="hidden" name="data[OriginalHistoryDocuments][action]" value="<?php echo $default['action']; ?>"/> 
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="text-align:right;">* ชั้นความลับ : </td>
                                <td>
                                    <input name="data[OriginalHistoryDocuments][secret]" type="radio" value="1" <?php echo (isset($default['secret']) && $default['secret'] == '1') ? "checked='checked'" : ""; ?>> ลับ 
                                    &nbsp;&nbsp;
                                    <input name="data[OriginalHistoryDocuments][secret]" type="radio" value="0" <?php echo (isset($default['secret']) && $default['secret'] == '0') ? "checked='checked'" : ""; ?>> ไม่ลับ    
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">เรื่อง : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('ohd_title', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['ohd_title'])) ? $default['ohd_title'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">สายงาน : </td>
                                <td>
                                    <select name="data[OriginalHistoryDocuments][ohd_div_id]" onchange="changearea(this)" data-placeholder="" class="chzn_a input-xlarge" >
                                        <option id="ui_slider3_sel" value="0">--- เลือกสายงาน ---</option>
                                        <?php foreach ($Units as $key => $Unit) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $Unit; ?></option>
                                        <?php } ?>
                                    </select>   
                                </td>
                            </tr>
                            <tr id="tr_div_other" style="display:<?php echo ($default['ohd_div_id'] == '999') ? '' : 'none'; ?>;">
                                <td style="text-align:right;">สายงานอื่นๆ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('ohd_div_other', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        'maxlength' => '500',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['ohd_div_other'])) ? $default['ohd_div_other'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td> 
                            </tr>  



                            <tr>
                                <td style="text-align:right;">เลขที่หนังสือ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('ohd_doc_no', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['ohd_doc_no'])) ? $default['ohd_doc_no'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">วันที่หนังสือ : </td>
                                <td>
<!--                                    <span>
                                        <div class="input-append date" id="dp1" class="pckcal" data-date-format="dd/mm/yyyy">
                                            <input class="span6" type="text" readonly="" name='ohd_doc_date' value="<?php echo (isset($default) && isset($default['ohd_doc_date'])) ? $default['ohd_doc_date'] : ""; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                        </div>
                                    </span>-->
                                    <div>
                                        <?php
                                        echo $this->CustomForm->dateThai('ohd_doc_date', array('value' => $default['ohd_doc_date'],
                                            'class' => 'form-control'
                                        ));
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">หน่วยส่งเอกสาร : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('ohd_sender', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['ohd_sender'])) ? $default['ohd_sender'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">* หน่วยรับเอกสาร : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('ohd_receiver', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['ohd_receiver'])) ? $default['ohd_receiver'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">เลขที่ตู้ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('ohd_closet_no', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['ohd_closet_no'])) ? $default['ohd_closet_no'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">เลขอื่นที่ใช้ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('ohd_other_no', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['ohd_other_no'])) ? $default['ohd_other_no'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>    
                            <tr>
                                <td style="text-align:right;">คำสำคัญ : </td>
                                <td>
                                    <textarea name="data[OriginalHistoryDocuments][ohd_keyword]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder=""><?php echo (isset($default) && isset($default['ohd_keyword'])) ? $default['ohd_keyword'] : ""; ?></textarea>
                                </td>
                            </tr> 
                            <tr>
                                <td style="text-align:right;">หมายเหตุ : </td>
                                <td>
                                    <textarea name="data[OriginalHistoryDocuments][ohd_remark]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder=""><?php echo (isset($default) && isset($default['ohd_remark'])) ? $default['ohd_remark'] : ""; ?></textarea>
                                </td>
                            </tr> 
                            <tr>
                                <td style="text-align:right;">เอกสารแนบ<br/>(ขนาดไฟล์ ไม่เกิน 5MB) : </td>
                                <td>

                                    <div id='file_list'>
                                        <?php foreach ($TableAttachFiles as $TableAttachFile) { ?>
                                            <?php echo '<div id="row_doc_key_' . $TableAttachFile['TableAttachFile']['id'] . '"><a href="/files/originalhistorydocuments/' . $TableAttachFile['TableAttachFile']['file_name'] . '" target=_blank>' . $TableAttachFile['TableAttachFile']['file_original_name'] . '</a>&nbsp;&nbsp;<span style="cursor:pointer;" onclick="modalActionRemoveDocument(\'' . $TableAttachFile['TableAttachFile']['id'] . '\');"><i class="icon-trash"></i></a></span></div>'; ?>
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

    $("select[name='data[OriginalHistoryDocuments][ohd_div_id]']").val('<?php echo (isset($default) && $default['ohd_div_id'] != '0') ? $default['ohd_div_id'] : '0'; ?>');

    function changearea(obj) {
        var val = $(obj).val();
        if (val == '999') {
            $('#tr_div_other').show();
        } else {
            $('#tr_div_other').hide();
            $("input[name='data[OriginalHistoryDocuments][ohd_div_other]']").val('');
        }
    }

    function moreattach() {
        i++;
        $("#file_list").append("<div><input class='form-control' type='file' name='file_attach[]' /></div>");
    }

    function modalActionRemoveDocument(fileID) {
        if (confirm('ยืนยันการลบเอกสารแนบ')) {
            var url = "../../OriginalHistoryDocuments/removeDocument/" + fileID;
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
        var form_action = $("input[name='data[OriginalHistoryDocuments][action]']").val();
        var key_id = $("input[name='data[OriginalHistoryDocuments][id]']").val();

        var secret = $("input:radio[name ='data[OriginalHistoryDocuments][secret]']:checked").val();
        var ohd_title = $("input[name='data[OriginalHistoryDocuments][ohd_title]']").val();
        var ohd_doc_no = $("input[name='data[OriginalHistoryDocuments][ohd_doc_no]']").val();
        var ohd_sender = $("input[name='data[OriginalHistoryDocuments][ohd_sender]']").val();
        var ohd_receiver = $("input[name='data[OriginalHistoryDocuments][ohd_receiver]']").val();
        var ohd_closet_no = $("input[name='data[OriginalHistoryDocuments][ohd_closet_no]']").val();
        var ohd_other_no = $("input[name='data[OriginalHistoryDocuments][ohd_other_no]']").val();
        var ohd_keyword = $("textarea[name='data[OriginalHistoryDocuments][ohd_keyword]']").val();
        var ohd_remark = $("textarea[name='data[OriginalHistoryDocuments][ohd_remark]']").val();
        var ohd_div_id = $("select[name='data[OriginalHistoryDocuments][ohd_div_id]']").val();
         var ohd_div_other = $("input[name='data[OriginalHistoryDocuments][ohd_div_other]']").val();
         
//        var ohd_doc_date = $("input[name='ohd_doc_date']").removeAttr('readonly').val();
//        $("input[name='ohd_doc_date']").attr('readonly', '');
//        if (ohd_doc_date !== '') {
//            ohd_doc_date = formatDateForSave(ohd_doc_date);
//        }

        var ohd_doc_date = formatDDLDateForSave(
                $("select[name='data[ohd_doc_date][day]']").val(),
                $("select[name='data[ohd_doc_date][month]']").val(),
                $("select[name='data[ohd_doc_date][year]']").val());
        if (ohd_doc_date === 'InvalidDate') {
            alert('วันที่ที่ระบุ ไม่พบในปฏิทิน !!');
            return;
        }
        if (ohd_doc_date === 'DateError') {
            alert('วันที่ที่ระบุ ไม่อยู่ในรูปแบบวันที่ที่ถูกต้อง !!');
            return;
        }

        if (ohd_receiver != "")
        {
            var url = "../../OriginalHistoryDocuments/save/" + key_id + "/" + form_action;
            $.post(url, {
                deleted: 'N',
                order_sort: 0,
                secret: secret,
                ohd_doc_date: ohd_doc_date,
                ohd_title: ohd_title,
                ohd_doc_no: ohd_doc_no,
                ohd_sender: ohd_sender,
                ohd_receiver: ohd_receiver,
                ohd_closet_no: ohd_closet_no,
                ohd_other_no: ohd_other_no,
                ohd_keyword: ohd_keyword,
                ohd_remark: ohd_remark,
                ohd_div_id: ohd_div_id,
                ohd_div_other: ohd_div_other

            }, function (data) {
                if (data.status == "SUCCESS") {
                    $(".close").trigger("click");
                    window.location = "../../OriginalHistoryDocuments/index";
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
    var id = $("input[name='data[OriginalHistoryDocuments][id]']").val();
    var uploader = document.getElementById('uploader0');
    upclick(
            {
                element: uploader,
                action: '../../OriginalHistoryDocuments/uploadDocument/' + id,
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
                                document_link = '<div id="row_doc_key_' + document_id + '"><a href="/files/originalhistorydocuments/' + document_name + '" target=_blank>';
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
