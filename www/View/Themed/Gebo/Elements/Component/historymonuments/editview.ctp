<?php
$default['id'] = empty($default['id']) ? '' : $default['id'];
$formAction = $default['action'];

//$default['hb_establish_date'] = empty($default['hb_establish_date']) ? '' : $default['hb_establish_date'];
//if ($default['hb_establish_date'] != '')
//    $default['hb_establish_date'] = $this->TextUtil->formatSqlDateForPckDate($default['hb_establish_date']);

if ($formAction == "ADD") {
    //$default['hb_establish_date'] = $this->TextUtil->getCurrDateForPckDate();
    $default['hm_unit_id'] = '0';
}
?>

<script type="text/javascript">
    var i = 0;

</script>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-content nopadding">
                <?php echo $this->Form->create('HistoryMonuments', array('action' => 'save', 'class' => 'form-horizontal form-bordered')); ?>
                <div class="row-fluid">
                    <input type="hidden" name="data[HistoryMonuments][id]" value="<?php echo $default['id']; ?>"/>                                    
                    <input type="hidden" name="data[HistoryMonuments][action]" value="<?php echo $default['action']; ?>"/> 
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="text-align:right;">* ชื่ออนุสาวรีย์ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hm_name', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hm_name'])) ? $default['hm_name'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">ส่วนราชการ : </td>
                                <td>
                                    <select name="data[HistoryMonuments][hm_unit_id]"  data-placeholder="" class="chzn_a input-xlarge" >
                                        <option id="ui_slider3_sel" value="0">--- เลือกส่วนราชการ ---</option>
                                        <?php foreach ($Units as $key => $Unit) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $Unit; ?></option>
                                        <?php } ?>
                                    </select>        
                                </td>
                            </tr>

                            <tr>
                                <td style="text-align:right;">ตั้งอยู่ที่ค่าย : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hm_location_camp', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hm_location_camp'])) ? $default['hm_location_camp'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">ตั้งอยู่ที่หน่วย : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hm_location_unit', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hm_location_unit'])) ? $default['hm_location_unit'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">คำค้น : </td>
                                <td>
                                    <textarea name="data[HistoryMonuments][hm_keyword]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder=""><?php echo (isset($default) && isset($default['hm_keyword'])) ? $default['hm_keyword'] : ""; ?></textarea>
                                </td>
                            </tr>                              
                            <tr>
                                <td style="text-align:right;">เอกสารแนบ<br/>(ขนาดไฟล์ ไม่เกิน 5MB) : </td>
                                <td>

                                    <div id='file_list'>
                                        <?php foreach ($TableAttachFiles as $TableAttachFile) { ?>
                                            <?php echo '<div id="row_doc_key_' . $TableAttachFile['TableAttachFile']['id'] . '"><a href="/files/history_monuments/' . $TableAttachFile['TableAttachFile']['file_name'] . '" target=_blank>' . $TableAttachFile['TableAttachFile']['file_original_name'] . '</a>&nbsp;&nbsp;<span style="cursor:pointer;" onclick="modalActionRemoveDocument(\'' . $TableAttachFile['TableAttachFile']['id'] . '\');"><i class="icon-trash"></i></a></span></div>'; ?>
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
    $("select[name='data[HistoryMonuments][hm_unit_id]']").val('<?php echo (isset($default) && $default['hm_unit_id'] != '0') ? $default['hm_unit_id'] : '0'; ?>');

    function moreattach() {
        i++;
        $("#file_list").append("<div><input class='form-control' type='file' name='file_attach[]' /></div>");
    }

    function modalActionRemoveDocument(fileID) {
        if (confirm('ยืนยันการลบเอกสารแนบ')) {
            var url = "../../HistoryMonuments/removeDocument/" + fileID;
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
        var form_action = $("input[name='data[HistoryMonuments][action]']").val();
        var key_id = $("input[name='data[HistoryMonuments][id]']").val();
        var hm_name = $("input[name='data[HistoryMonuments][hm_name]']").val();
        var hm_location_camp = $("input[name='data[HistoryMonuments][hm_location_camp]']").val();
        var hm_location_unit = $("input[name='data[HistoryMonuments][hm_location_unit]']").val();
        var hm_unit_id = $("select[name='data[HistoryMonuments][hm_unit_id]']").val();
        var hm_keyword = $("textarea[name='data[HistoryMonuments][hm_keyword]']").val();

        if (hm_name != '')
        {
            var url = "../../HistoryMonuments/save/" + key_id + "/" + form_action;
            $.post(url, {
                deleted: 'N',
                order_sort: 0,
                secret: 9,
                hm_name: hm_name,
                hm_location_camp: hm_location_camp,
                hm_location_unit: hm_location_unit,
                hm_unit_id: hm_unit_id,
                hm_keyword: hm_keyword,
            }, function (data) {
                if (data.status == "SUCCESS") {
                    $(".close").trigger("click");
                    window.location = "../../HistoryMonuments/index";
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
    var id = $("input[name='data[HistoryMonuments][id]']").val();
    var uploader = document.getElementById('uploader0');
    upclick(
            {
                element: uploader,
                action: '../../HistoryMonuments/uploadDocument/' + id,
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
                                document_link = '<div id="row_doc_key_' + document_id + '"><a href="/files/history_monuments/' + document_name + '" target=_blank>';
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
