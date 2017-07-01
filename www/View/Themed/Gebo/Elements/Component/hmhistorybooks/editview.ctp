<?php
$default['id'] = empty($default['id']) ? '' : $default['id'];
$formAction = $default['action'];

if ($formAction == "ADD") {
    //$default['hmu_establish_date'] = $this->TextUtil->getCurrDateForPckDate();
    $default['secret'] = '0';
}
?>

<script type="text/javascript">
    var i = 0;

</script>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-content nopadding">
                <?php echo $this->Form->create('HMHistoryBooks', array('action' => 'save', 'class' => 'form-horizontal form-bordered')); ?>
                <div class="row-fluid">
                    <input type="hidden" name="data[HMHistoryBooks][id]" value="<?php echo $default['id']; ?>"/>                                    
                    <input type="hidden" name="data[HMHistoryBooks][action]" value="<?php echo $default['action']; ?>"/> 
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="text-align:right;">ชั้นความลับ : </td>
                                <td>
                                    <input name="data[HMHistoryBooks][secret]" type="radio" value="1" <?php echo (isset($default['secret']) && $default['secret'] == '1') ? "checked='checked'" : ""; ?>> ลับ 
                                    &nbsp;&nbsp;
                                    <input name="data[HMHistoryBooks][secret]" type="radio" value="0" <?php echo (isset($default['secret']) && $default['secret'] == '0') ? "checked='checked'" : ""; ?>> ไม่ลับ    
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">* ชื่อเอกสาร/หนังสือ : </td>
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
                                <td style="text-align:right;">เลขที่เอกสาร/หนังสือ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hb_no', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hb_no'])) ? $default['hb_no'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">ผู้แต่ง/รายละเอียด : </td>
                                <td>
                                    <textarea name="data[HMHistoryBooks][hb_author]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder=""><?php echo (isset($default) && isset($default['hb_author'])) ? $default['hb_author'] : ""; ?></textarea>
                                </td>
                            </tr> 
                            <tr>
                                <td style="text-align:right;">สถานที่จัดเก็บ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hb_location', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hb_location'])) ? $default['hb_location'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">เลขที่ตู้ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hb_closet_no', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hb_closet_no'])) ? $default['hb_closet_no'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">เลขอื่นที่ใช้ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hb_other_no', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hb_other_no'])) ? $default['hb_other_no'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>


                            <tr>
                                <td style="text-align:right;">เอกสารแนบ<br/>(ขนาดไฟล์ ไม่เกิน 5MB) : </td>
                                <td>

                                    <div id='file_list'>
                                        <?php foreach ($TableAttachFiles as $TableAttachFile) { ?>
                                            <?php echo '<div id="row_doc_key_' . $TableAttachFile['TableAttachFile']['id'] . '"><a href="/files/hmhistorybooks/' . $TableAttachFile['TableAttachFile']['file_name'] . '" target=_blank>' . $TableAttachFile['TableAttachFile']['file_original_name'] . '</a>&nbsp;&nbsp;<span style="cursor:pointer;" onclick="modalActionRemoveDocument(\'' . $TableAttachFile['TableAttachFile']['id'] . '\');"><i class="icon-trash"></i></a></span></div>'; ?>
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

    function moreattach() {
        i++;
        $("#file_list").append("<div><input class='form-control' type='file' name='file_attach[]' /></div>");
    }

    function modalActionRemoveDocument(fileID) {
        if (confirm('ยืนยันการลบเอกสารแนบ')) {
            var url = "../../HMHistoryBooks/removeDocument/" + fileID;
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

    function modalAction2() {
        var form_action = $("input[name='data[HMHistoryBooks][action]']").val();
        var key_id = $("input[name='data[HMHistoryBooks][id]']").val();
        var secret = $("input:radio[name ='data[HMHistoryBooks][secret]']:checked").val();
        var hb_name = $("input[name='data[HMHistoryBooks][hb_name]']").val();
        var hb_no = $("input[name='data[HMHistoryBooks][hb_no]']").val();
        var hb_location = $("input[name='data[HMHistoryBooks][hb_location]']").val();
        var hb_author = $("textarea[name='data[HMHistoryBooks][hb_author]']").val();
        var hb_closet_no = $("input[name='data[HMHistoryBooks][hb_closet_no]']").val();
        var hb_other_no = $("input[name='data[HMHistoryBooks][hb_other_no]']").val();

        if (hb_name != "")
        {
            var url = "../../HMHistoryBooks/save/" + key_id + "/" + form_action;
            $.post(url, {
                deleted: 'N',
                order_sort: 0,
                secret: secret,
                hb_name: hb_name,
                hb_no: hb_no,
                hb_location: hb_location,
                hb_author: hb_author,
                hb_closet_no: hb_closet_no,
                hb_other_no: hb_other_no

            }, function (data) {
                if (data.status == "SUCCESS") {
                    $(".close").trigger("click");
                    window.location = "../../HMHistoryBooks/index";
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
    var id = $("input[name='data[HMHistoryBooks][id]']").val();
    var uploader = document.getElementById('uploader0');
    upclick(
            {
                element: uploader,
                action: '../../HMHistoryBooks/uploadDocument/' + id,
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
                                document_link = '<div id="row_doc_key_' + document_id + '"><a href="/files/hmhistorybooks/' + document_name + '" target=_blank>';
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
