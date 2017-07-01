<?php
$default['id'] = empty($default['id']) ? '' : $default['id'];
$formAction = $default['action'];

//$default['hs_occupy_date'] = empty($default['hs_occupy_date']) ? '' : $default['hs_occupy_date'];
//if ($default['hs_occupy_date'] != '')
//    $default['hs_occupy_date'] = $this->TextUtil->formatSqlDateForPckDate($default['hs_occupy_date']);
//$default['hs_retry_date'] = empty($default['hs_retry_date']) ? '' : $default['hs_retry_date'];
//if ($default['hs_retry_date'] != '')
//    $default['hs_retry_date'] = $this->TextUtil->formatSqlDateForPckDate($default['hs_retry_date']);

if ($formAction == "ADD") {
    //$default['hs_occupy_date'] = $this->TextUtil->getCurrDateForPckDate();

    $default['hs_rank_id'] = '0';
    $default['hs_corp_id'] = '0';
}
?>

<script type="text/javascript">
    var i = 0;

</script>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-content nopadding">
                <?php echo $this->Form->create('HistorySoldiers', array('action' => 'save', 'class' => 'form-horizontal form-bordered')); ?>
                <div class="row-fluid">
                    <input type="hidden" name="data[HistorySoldiers][id]" value="<?php echo $default['id']; ?>"/>                                    
                    <input type="hidden" name="data[HistorySoldiers][action]" value="<?php echo $default['action']; ?>"/> 
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="text-align:right;">ตำแหน่ง : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hs_position', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hs_position'])) ? $default['hs_position'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">ลำดับที่ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hs_level', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hs_level'])) ? $default['hs_level'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">เลขรหัสประจำตัวประชาชน : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hs_idcard', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        'maxlength' => '13',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hs_idcard'])) ? $default['hs_idcard'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">* ชั้นยศ : </td>
                                <td>
                                    <select name="data[HistorySoldiers][hs_rank_id]"  data-placeholder="" class="chzn_a input-xlarge" >
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
                                    echo $this->Form->input('hs_firstname', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        'maxlength' => '300',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hs_firstname'])) ? $default['hs_firstname'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">นามสกุล : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('hs_lastname', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        'maxlength' => '300',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['hs_lastname'])) ? $default['hs_lastname'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">* เหล่า : </td>
                                <td>
                                    <select name="data[HistorySoldiers][hs_corp_id]"  data-placeholder="" class="chzn_a input-xlarge" >
                                        <option id="ui_slider3_sel" value="0">--- เลือกเหล่า ---</option>
                                        <?php foreach ($Corps as $key => $Corp) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $Corp; ?></option>
                                        <?php } ?>
                                    </select>        
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">วันที่ดำรงตำแหน่ง : </td>
                                <td>
<!--                                    <span>
                                        <div class="input-append date" id="dp1" class="pckcal" data-date-format="dd/mm/yyyy">
                                            <input class="span6" type="text" readonly="" name='hs_occupy_date' value="<?php echo (isset($default) && isset($default['hs_occupy_date'])) ? $default['hs_occupy_date'] : ""; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                        </div>
                                    </span>-->
                                    <div>
                                        <?php
                                        echo $this->CustomForm->dateThai('hs_occupy_date', array('value' => (isset($default) && isset($default['hs_occupy_date'])) ? $default['hs_occupy_date']:"",
                                            'class' => 'form-control'
                                        ));
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">วันที่พ้นจากตำแหน่ง : </td>
                                <td>
<!--                                    <span>
                                        <div class="input-append date" id="dp2" class="pckcal" data-date-format="dd/mm/yyyy">
                                            <input class="span6" type="text" readonly="" name='hs_retry_date' value="<?php echo (isset($default) && isset($default['hs_retry_date'])) ? $default['hs_retry_date'] : ""; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                        </div>
                                    </span>-->
                                    <?php
                                    echo $this->CustomForm->dateThai('hs_retry_date', array('value' => (isset($default) && isset($default['hs_retry_date'])) ? $default['hs_retry_date'] : "",
                                        'class' => 'form-control'
                                    ));
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td style="text-align:right;">คำค้น : </td>
                                <td>
                                    <textarea name="data[HistorySoldiers][hs_keyword]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder=""><?php echo (isset($default) && isset($default['hs_keyword'])) ? $default['hs_keyword'] : ""; ?></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td style="text-align:right;">เอกสารแนบ<br/>(ขนาดไฟล์ ไม่เกิน 5MB) : </td>
                                <td>

                                    <div id='file_list'>
                                        <?php foreach ($TableAttachFiles as $TableAttachFile) { ?>
                                            <?php echo '<div id="row_doc_key_' . $TableAttachFile['TableAttachFile']['id'] . '"><a href="/files/history_soldiers/' . $TableAttachFile['TableAttachFile']['file_name'] . '" target=_blank>' . $TableAttachFile['TableAttachFile']['file_original_name'] . '</a>&nbsp;&nbsp;<span style="cursor:pointer;" onclick="modalActionRemoveDocument(\'' . $TableAttachFile['TableAttachFile']['id'] . '\');"><i class="icon-trash"></i></a></span></div>'; ?>
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
//    $('#dp1').datepicker();
//    $('#dp2').datepicker();

    $("select[name='data[HistorySoldiers][hs_rank_id]']").val('<?php echo (isset($default) && $default['hs_rank_id'] != '0') ? $default['hs_rank_id'] : '0'; ?>');
    $("select[name='data[HistorySoldiers][hs_corp_id]']").val('<?php echo (isset($default) && $default['hs_corp_id'] != '0') ? $default['hs_corp_id'] : '0'; ?>');

    function moreattach() {
        i++;
        $("#file_list").append("<div><input class='form-control' type='file' name='file_attach[]' /></div>");
    }

    function modalActionRemoveDocument(fileID) {
        if (confirm('ยืนยันการลบเอกสารแนบ')) {
            var url = "../../HistorySoldiers/removeDocument/" + fileID;
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
        var form_action = $("input[name='data[HistorySoldiers][action]']").val();
        var key_id = $("input[name='data[HistorySoldiers][id]']").val();

        var hs_position = $("input[name='data[HistorySoldiers][hs_position]']").val();
        var hs_level = $("input[name='data[HistorySoldiers][hs_level]']").val();
        var hs_idcard = $("input[name='data[HistorySoldiers][hs_idcard]']").val();
        var hs_rank_id = $("select[name='data[HistorySoldiers][hs_rank_id]']").val();
        var hs_firstname = $("input[name='data[HistorySoldiers][hs_firstname]']").val();
        var hs_lastname = $("input[name='data[HistorySoldiers][hs_lastname]']").val();
        var hs_corp_id = $("select[name='data[HistorySoldiers][hs_corp_id]']").val();
        var hs_keyword = $("textarea[name='data[HistorySoldiers][hs_keyword]']").val();

//        var hs_occupy_date = $("input[name='hs_occupy_date']").removeAttr('readonly').val();
//        $("input[name='hs_occupy_date']").attr('readonly', '');
//        var hs_retry_date = $("input[name='hs_retry_date']").removeAttr('readonly').val();
//        $("input[name='hs_retry_date']").attr('readonly', '');
//
//        if (hs_occupy_date !== '') {
//            hs_occupy_date = formatDateForSave(hs_occupy_date);
//        }
//        if (hs_retry_date !== '') {
//            hs_retry_date = formatDateForSave(hs_retry_date);
//        }

        var hs_occupy_date = formatDDLDateForSave(
                $("select[name='data[hs_occupy_date][day]']").val(),
                $("select[name='data[hs_occupy_date][month]']").val(),
                $("select[name='data[hs_occupy_date][year]']").val());
        if (hs_occupy_date === 'InvalidDate') {
            alert('วันที่ที่ระบุ ไม่พบในปฏิทิน !!');
            return;
        }
        if (hs_occupy_date === 'DateError') {
            alert('วันที่ที่ระบุ ไม่อยู่ในรูปแบบวันที่ที่ถูกต้อง !!');
            return;
        }
        var hs_retry_date = formatDDLDateForSave(
                $("select[name='data[hs_retry_date][day]']").val(),
                $("select[name='data[hs_retry_date][month]']").val(),
                $("select[name='data[hs_retry_date][year]']").val());
        if (hs_retry_date === 'InvalidDate') {
            alert('วันที่ที่ระบุ ไม่พบในปฏิทิน !!');
            return;
        }
        if (hs_retry_date === 'DateError') {
            alert('วันที่ที่ระบุ ไม่อยู่ในรูปแบบวันที่ที่ถูกต้อง !!');
            return;
        }

        if (hs_firstname != '' && hs_corp_id != "0" && hs_rank_id != "0")
        {
            var url = "../../HistorySoldiers/save/" + key_id + "/" + form_action;
            $.post(url, {
                deleted: 'N',
                order_sort: 0,
                secret: 9,
                hs_position: hs_position,
                hs_level: hs_level,
                hs_idcard: hs_idcard,
                hs_rank_id: hs_rank_id,
                hs_firstname: hs_firstname,
                hs_lastname: hs_lastname,
                hs_corp_id: hs_corp_id,
                hs_keyword: hs_keyword,
                hs_occupy_date: hs_occupy_date,
                hs_retry_date: hs_retry_date

            }, function (data) {
                if (data.status == "SUCCESS") {
                    $(".close").trigger("click");
                    window.location = "../../HistorySoldiers/index";
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
    var id = $("input[name='data[HistorySoldiers][id]']").val();
    var uploader = document.getElementById('uploader0');
    upclick(
            {
                element: uploader,
                action: '../../HistorySoldiers/uploadDocument/' + id,
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
                                document_link = '<div id="row_doc_key_' + document_id + '"><a href="/files/history_soldiers/' + document_name + '" target=_blank>';
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
