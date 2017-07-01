<?php
$default['id'] = empty($default['id']) ? '' : $default['id'];
$formAction = $default['action'];

//$default['hb_establish_date'] = empty($default['hb_establish_date']) ? '' : $default['hb_establish_date'];
//if ($default['hb_establish_date'] != '')
//    $default['hb_establish_date'] = $this->TextUtil->formatSqlDateForPckDate($default['hb_establish_date']);

if ($formAction == "ADD") {
    //$default['hb_establish_date'] = $this->TextUtil->getCurrDateForPckDate();
    $default['hd_rank_id'] = '0';
}
?>

<script type="text/javascript">
    var i = 0;

</script>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-content nopadding">
                <?php echo $this->Form->create('HistoryDeceases', array('action' => 'save', 'class' => 'form-horizontal form-bordered')); ?>
                <div class="row-fluid">
                    <input type="hidden" name="data[HistoryDeceases][id]" value="<?php echo $default['id']; ?>"/>                                    
                    <input type="hidden" name="data[HistoryDeceases][action]" value="<?php echo $default['action']; ?>"/> 
                    <table class="table table-bordered">
                        <tbody>

                            <tr>
                                <td style="text-align:right;">* ชั้นยศ : </td>
                                <td>
                                    <select name="data[HistoryDeceases][hd_rank_id]" class="span10" data-placeholder="" class="chzn_a input-xlarge" >
                                        <option id="ui_slider3_sel" value="0">--- เลือกชั้นยศ ---</option>
                                        <?php foreach ($Ranks as $key => $Rank) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $Rank; ?></option>
                                        <?php } ?>
                                    </select>        
                                </td>
                            </tr>



                            <tr>
                                <td style="text-align:right;">* ชื่อ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hd_firstname', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span10',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hd_firstname'])) ? $default['hd_firstname'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">นามสกุล : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hd_lastname', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span10',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hd_lastname'])) ? $default['hd_lastname'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">ปีเกิด : </td>
                                <td>
                                    <select name="data[HistoryDeceases][hd_year_born]" class="span4" data-placeholder="" class="chzn_a input-xlarge" >
                                        <?php foreach ($Years_Born as $year) { ?>
                                            <option value="<?php echo $year; ?>" <?php echo (isset($default) && isset($default['hd_year_born']) && $default['hd_year_born'] == $year) ? "selected='selected'" : ""; ?>><?php echo $year; ?></option>
                                        <?php } ?>
                                    </select>  
                                </td>
                            </tr>  
                            <tr>
                                <td style="text-align:right;">ปีที่ถึงแก่กรรม : </td>
                                <td>
                                    <select name="data[HistoryDeceases][hd_year_dead]" class="span4" data-placeholder="" class="chzn_a input-xlarge" >
                                        <?php foreach ($Years_Dead as $year) { ?>
                                            <option value="<?php echo $year; ?>" <?php echo (isset($default) && isset($default['hd_year_dead']) && $default['hd_year_dead'] == $year) ? "selected='selected'" : ""; ?>><?php echo $year; ?></option>
                                        <?php } ?>
                                    </select>  
                                </td>
                            </tr> 
                            <tr>
                                <td style="text-align:right;">สถานที่จัดเก็บเอกสาร : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hd_document_location', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span10',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hd_document_location'])) ? $default['hd_document_location'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">เลขที่ตู้ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hd_closet_no', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span10',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hd_closet_no'])) ? $default['hd_closet_no'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">เลขอื่นที่ใช้ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hd_ref_num', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span10',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hd_ref_num'])) ? $default['hd_ref_num'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">ลำดับเล่ม : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hd_book_no', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span10',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hd_book_no'])) ? $default['hd_book_no'] : "",
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
                                            <?php echo '<div id="row_doc_key_' . $TableAttachFile['TableAttachFile']['id'] . '"><a href="/files/history_deceases/' . $TableAttachFile['TableAttachFile']['file_name'] . '" target=_blank>' . $TableAttachFile['TableAttachFile']['file_original_name'] . '</a>&nbsp;&nbsp;<span style="cursor:pointer;" onclick="modalActionRemoveDocument(\'' . $TableAttachFile['TableAttachFile']['id'] . '\');"><i class="icon-trash"></i></a></span></div>'; ?>
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
    $("select[name='data[HistoryDeceases][hd_rank_id]']").val('<?php echo (isset($default) && $default['hd_rank_id'] != '0') ? $default['hd_rank_id'] : '0'; ?>');

    function moreattach() {
        i++;
        $("#file_list").append("<div><input class='form-control' type='file' name='file_attach[]' /></div>");
    }

    function modalActionRemoveDocument(fileID) {
        if (confirm('ยืนยันการลบเอกสารแนบ')) {
            var url = "../../HistoryDeceases/removeDocument/" + fileID;
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
        var form_action = $("input[name='data[HistoryDeceases][action]']").val();
        var key_id = $("input[name='data[HistoryDeceases][id]']").val();
        var hd_rank_id = $("select[name='data[HistoryDeceases][hd_rank_id]']").val();
        var hd_firstname = $("input[name='data[HistoryDeceases][hd_firstname]']").val();
        var hd_lastname = $("input[name='data[HistoryDeceases][hd_lastname]']").val();
        var hd_year_born = $("select[name='data[HistoryDeceases][hd_year_born]']").val();
        var hd_year_dead = $("select[name='data[HistoryDeceases][hd_year_dead]']").val();
        var hd_document_location = $("input[name='data[HistoryDeceases][hd_document_location]']").val();
        var hd_closet_no = $("input[name='data[HistoryDeceases][hd_closet_no]']").val();
        var hd_ref_num = $("input[name='data[HistoryDeceases][hd_ref_num]']").val();
        var hd_book_no = $("input[name='data[HistoryDeceases][hd_book_no]']").val();


        if (hd_firstname != '' && hd_rank_id != '0')
        {
            var url = "../../HistoryDeceases/save/" + key_id + "/" + form_action;
            $.post(url, {
                deleted: 'N',
                order_sort: 0,
                secret: 9,
                hd_rank_id: hd_rank_id,
                hd_firstname: hd_firstname,
                hd_lastname: hd_lastname,
                hd_year_born: hd_year_born,
                hd_year_dead: hd_year_dead,
                hd_document_location: hd_document_location,
                hd_closet_no: hd_closet_no,
                hd_ref_num: hd_ref_num,
                hd_book_no: hd_book_no,
            }, function (data) {
                if (data.status == "SUCCESS") {
                    $(".close").trigger("click");
                    window.location = "../../HistoryDeceases/index";
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
    var id = $("input[name='data[HistoryDeceases][id]']").val();
    var uploader = document.getElementById('uploader0');
    upclick(
            {
                element: uploader,
                action: '../../HistoryDeceases/uploadDocument/' + id,
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
                                document_link = '<div id="row_doc_key_' + document_id + '"><a href="/files/history_deceases/' + document_name + '" target=_blank>';
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
