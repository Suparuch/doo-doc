<?php
$default['id'] = empty($default['id']) ? '' : $default['id'];
$formAction = $default['action'];

if ($formAction == "ADD") {
    //$default['hmu_establish_date'] = $this->TextUtil->getCurrDateForPckDate();
    //$default['hmu_unit_id'] = '0';
}
?>

<script type="text/javascript">
    var i = 0;

</script>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-content nopadding">
                <?php echo $this->Form->create('HistoryOthers', array('action' => 'save', 'class' => 'form-horizontal form-bordered')); ?>
                <div class="row-fluid">
                    <input type="hidden" name="data[HistoryOthers][id]" value="<?php echo $default['id']; ?>"/>                                    
                    <input type="hidden" name="data[HistoryOthers][action]" value="<?php echo $default['action']; ?>"/> 
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="text-align:right;width:150px;">* ชื่อเรื่อง : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('ho_name', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['ho_name'])) ? $default['ho_name'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">รูปแบบข้อมูล : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('ho_format', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['ho_format'])) ? $default['ho_format'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">ที่เก็บ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('ho_location', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['ho_location'])) ? $default['ho_location'] : "",
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
                                            <?php echo '<div id="row_doc_key_' . $TableAttachFile['TableAttachFile']['id'] . '"><a href="/files/history_others/' . $TableAttachFile['TableAttachFile']['file_name'] . '" target=_blank>' . $TableAttachFile['TableAttachFile']['file_original_name'] . '</a>&nbsp;&nbsp;<span style="cursor:pointer;" onclick="modalActionRemoveDocument(\'' . $TableAttachFile['TableAttachFile']['id'] . '\');"><i class="icon-trash"></i></a></span></div>'; ?>
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
            var url = "../../HistoryOthers/removeDocument/" + fileID;
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
        var form_action = $("input[name='data[HistoryOthers][action]']").val();
        var key_id = $("input[name='data[HistoryOthers][id]']").val();
        var ho_name = $("input[name='data[HistoryOthers][ho_name]']").val();
        var ho_format = $("input[name='data[HistoryOthers][ho_format]']").val();
        var ho_location = $("input[name='data[HistoryOthers][ho_location]']").val();

        if (ho_name != "")
        {
            var url = "../../HistoryOthers/save/" + key_id + "/" + form_action;
            $.post(url, {
                deleted: 'N',
                order_sort: 0,
                secret: 9,
                ho_name: ho_name,
                ho_format: ho_format,
                ho_location: ho_location,
            }, function (data) {
                if (data.status == "SUCCESS") {
                    $(".close").trigger("click");
                    window.location = "../../HistoryOthers/index";
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
    var id = $("input[name='data[HistoryOthers][id]']").val();
    var uploader = document.getElementById('uploader0');
    upclick(
            {
                element: uploader,
                action: '../../HistoryOthers/uploadDocument/' + id,
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
                                document_link = '<div id="row_doc_key_' + document_id + '"><a href="/files/history_others/' + document_name + '" target=_blank>';
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
