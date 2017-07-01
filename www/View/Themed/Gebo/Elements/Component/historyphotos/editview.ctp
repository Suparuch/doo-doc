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
                <?php echo $this->Form->create('HistoryPhotos', array('action' => 'save', 'class' => 'form-horizontal form-bordered')); ?>
                <div class="row-fluid">
                    <input type="hidden" name="data[HistoryPhotos][id]" value="<?php echo $default['id']; ?>"/>                                    
                    <input type="hidden" name="data[HistoryPhotos][action]" value="<?php echo $default['action']; ?>"/> 
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
                                <td style="text-align:right;">เหตุการณ์/สมัย/คำสำคัญ : </td>
                                <td>
                                    <textarea name="data[HistoryPhotos][ho_keyword]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder=""><?php echo (isset($default) && isset($default['ho_keyword'])) ? $default['ho_keyword'] : ""; ?></textarea>
                                </td>
                            </tr> 
                            <tr>
                                <td style="text-align:right;">คำบรรยายภาพ : </td>
                                <td>
                                    <textarea name="data[HistoryPhotos][ho_description]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder=""><?php echo (isset($default) && isset($default['ho_description'])) ? $default['ho_description'] : ""; ?></textarea>
                                </td>
                            </tr> 
                            <tr>
                                <td style="text-align:right;">เลขที่ตู้ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('ho_closet_no', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['ho_closet_no'])) ? $default['ho_closet_no'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">เลขอื่นที่ใช้ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('ho_other_no', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['ho_other_no'])) ? $default['ho_other_no'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">รูปภาพ<br/>(ขนาดไฟล์ ไม่เกิน 5MB) : </td>
                                <td>

                                    <div id='file_list'>
                                        <?php foreach ($TableAttachFiles as $TableAttachFile) { ?>
                                            <?php
                                            echo "<img src='/files/history_photos/" . $TableAttachFile['TableAttachFile']['file_name'] . "' style='width:250px;' />";
                                            ?>
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
            var url = "../../HistoryPhotos/removeDocument/" + fileID;
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
        var form_action = $("input[name='data[HistoryPhotos][action]']").val();
        var key_id = $("input[name='data[HistoryPhotos][id]']").val();

        var ho_name = $("input[name='data[HistoryPhotos][ho_name]']").val();
        var ho_keyword = $("textarea[name='data[HistoryPhotos][ho_keyword]']").val();
        var ho_description = $("textarea[name='data[HistoryPhotos][ho_description]']").val();
        var ho_closet_no = $("input[name='data[HistoryPhotos][ho_closet_no]']").val();
        var ho_other_no = $("input[name='data[HistoryPhotos][ho_other_no]']").val();

        if (ho_name != "")
        {
            var url = "../../HistoryPhotos/save/" + key_id + "/" + form_action;
            $.post(url, {
                deleted: 'N',
                order_sort: 0,
                secret: 9,
                ho_name: ho_name,
                ho_keyword: ho_keyword,
                ho_description: ho_description,
                ho_closet_no: ho_closet_no,
                ho_other_no: ho_other_no

            }, function (data) {
                if (data.status == "SUCCESS") {
                    $(".close").trigger("click");
                    window.location = "../../HistoryPhotos/index";
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
    var id = $("input[name='data[HistoryPhotos][id]']").val();
    var uploader = document.getElementById('uploader0');
    upclick(
            {
                element: uploader,
                action: '../../HistoryPhotos/uploadDocument/' + id,
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


                                document_link = "<img src='/files/history_photos/" + document_name + "' style='width:250px;' />";
                                $('#file_list').html(document_link);
                            } else if (data[0].result === 'error') {
                                alert(data[0].detail);
                            }
                        }
            }
    );


</script>
