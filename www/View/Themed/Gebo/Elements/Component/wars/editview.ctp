<?php
$default['id'] = empty($default['id']) ? '' : $default['id'];
$formAction = $default['action'];

/* $default['w_create_date'] = empty($default['w_create_date']) ? '' : $default['w_create_date'];
  if ($default['w_create_date'] != '')
  $default['w_create_date'] = $this->TextUtil->formatSqlDateForPckDate($default['w_create_date']);
 */

if ($formAction == "ADD") {
    //$default['w_create_date'] = $this->TextUtil->getCurrDateForPckDate();
    $default['w_create_date'] = date('Y-m-d');
    $default['secret'] = '1';
    $default['w_area_id'] = '0';
}
?>

<script type="text/javascript">
    var i = 0;

</script>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-content nopadding">
                <?php echo $this->Form->create('Wars', array('action' => 'save', 'class' => 'form-horizontal form-bordered')); ?>
                <div class="row-fluid">
                    <input type="hidden" name="data[Wars][id]" value="<?php echo $default['id']; ?>"/>                                    
                    <input type="hidden" name="data[Wars][action]" value="<?php echo $default['action']; ?>"/> 
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="text-align:right;">* ชั้นความลับ : </td>
                                <td>
                                    <input name="data[Wars][secret]" type="radio" value="1" <?php echo (isset($default['secret']) && $default['secret'] == '1') ? "checked='checked'" : ""; ?>> ลับ 
                                    &nbsp;&nbsp;
                                    <input name="data[Wars][secret]" type="radio" value="0" <?php echo (isset($default['secret']) && $default['secret'] == '0') ? "checked='checked'" : ""; ?>> ไม่ลับ    
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">* ชื่อเหตุการณ์ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('w_name', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        'maxlength' => '500',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['w_name'])) ? $default['w_name'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">ปีที่เกิดเหตุการณ์ : </td>
                                <td>
                                    <select name="data[Wars][w_year]"  data-placeholder="" class="chzn_a input-xlarge" >
                                        <?php foreach ($Years as $year) { ?>
                                            <option value="<?php echo $year; ?>" <?php echo (isset($default) && isset($default['w_year']) && $default['w_year'] == $year) ? "selected='selected'" : ""; ?>><?php echo $year; ?></option>
                                        <?php } ?>
                                    </select> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">พื้นที่เกิดเหตุการณ์ : </td>
                                <td>
                                    <select name="data[Wars][w_area_id]" onchange="changearea(this)" data-placeholder="" class="chzn_a input-xlarge" >
                                        <option id="ui_slider3_sel" value="0">--- เลือกพื้นที่เกิดเหตุการณ์ ---</option>
                                        <?php foreach ($Areas as $key => $Area) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $Area; ?></option>
                                        <?php } ?>
                                            <option value="999">พื้นที่อื่นๆ</option>
                                    </select>  
                                </td>
                            </tr>


                            <tr id="tr_area_other" style="display:<?php echo ($default['w_area_id']=='999')?'':'none'; ?>;">
                                <td style="text-align:right;">พื้นที่อื่นๆ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('w_area_other', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        'maxlength' => '500',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['w_area_other'])) ? $default['w_area_other'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td> 
                            </tr>                        

                            <tr>
                                <td style="text-align:right;">หน่วยจัดทำ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('w_creater', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span8',
                                        'maxlength' => '300',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['w_creater'])) ? $default['w_creater'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">จัดทำเมื่อ : </td>
                                <td>
    <!--                                    <span>
                                        <div class="input-append date" id="dp1" class="pckcal" data-date-format="dd/mm/yyyy">
                                            <input class="span6" type="text" readonly="" name='w_create_date' value="<?php echo (isset($default) && isset($default['w_create_date'])) ? $default['w_create_date'] : ""; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                        </div>
                                    </span>-->

                                    <div>
                                        <?php
                                        echo $this->CustomForm->dateThai('w_create_date', array('value' => $default['w_create_date'],
                                            'class' => 'form-control'
                                        ));
                                        ?>
                                    </div>
                                </td>
                            </tr>                            
                            <tr>
                                <td style="text-align:right;">คำค้น : </td>
                                <td>
                                    <textarea name="data[Wars][w_keyword]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder=""><?php echo (isset($default) && isset($default['w_keyword'])) ? $default['w_keyword'] : ""; ?></textarea>
                                </td>
                            </tr> 
                            <tr>
                                <td style="text-align:right;">เอกสารแนบ<br/>(ขนาดไฟล์ ไม่เกิน 5MB) : </td>
                                <td>

                                    <div id='file_list'>
                                        <?php foreach ($TableAttachFiles as $TableAttachFile) { ?>
                                            <?php echo '<div id="row_doc_key_' . $TableAttachFile['TableAttachFile']['id'] . '"><a href="/files/wars/' . $TableAttachFile['TableAttachFile']['file_name'] . '" target=_blank>' . $TableAttachFile['TableAttachFile']['file_original_name'] . '</a>&nbsp;&nbsp;<span style="cursor:pointer;" onclick="modalActionRemoveDocument(\'' . $TableAttachFile['TableAttachFile']['id'] . '\');"><i class="icon-trash"></i></a></span></div>'; ?>
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
    
    function changearea(obj){
        var val = $(obj).val();
        if(val == '999'){
            $('#tr_area_other').show();            
        }else{
            $('#tr_area_other').hide();
            $("input[name='data[Wars][w_area_other]']").val('');
        }
    }

    $("select[name='data[Wars][w_area_id]']").val('<?php echo (isset($default) && $default['w_area_id'] != '0') ? $default['w_area_id'] : '0'; ?>');

    function moreattach() {
        i++;
        $("#file_list").append("<div><input class='form-control' type='file' name='file_attach[]' /></div>");
    }

    function modalActionRemoveDocument(fileID) {
        if (confirm('ยืนยันการลบเอกสารแนบ')) {
            var url = "../../Wars/removeDocument/" + fileID;
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
        var form_action = $("input[name='data[Wars][action]']").val();
        var key_id = $("input[name='data[Wars][id]']").val();

        var secret = $("input:radio[name ='data[Wars][secret]']:checked").val();
        var w_name = $("input[name='data[Wars][w_name]']").val();
        var w_year = $("select[name='data[Wars][w_year]']").val();
        var w_area_id = $("select[name='data[Wars][w_area_id]']").val();
        var w_creater = $("input[name='data[Wars][w_creater]']").val();
        var w_keyword = $("textarea[name='data[Wars][w_keyword]']").val();
        var w_area_other = $("input[name='data[Wars][w_area_other]']").val();
        
        /*var w_create_date = $("input[name='w_create_date']").removeAttr('readonly').val();
         $("input[name='w_create_date']").attr('readonly', '');
         if (w_create_date !== '') {
         w_create_date = formatDateForSave(w_create_date);
         }*/

        var w_create_date = formatDDLDateForSave(
                $("select[name='data[w_create_date][day]']").val(),
                $("select[name='data[w_create_date][month]']").val(),
                $("select[name='data[w_create_date][year]']").val());
        if (w_create_date === 'InvalidDate') {
            alert('วันที่ที่ระบุ ไม่พบในปฏิทิน !!');
            return;
        }
        if (w_create_date === 'DateError') {
            alert('วันที่ที่ระบุ ไม่อยู่ในรูปแบบวันที่ที่ถูกต้อง !!');
            return;
        }

        if (w_name != "")
        {
            var url = "../../Wars/save/" + key_id + "/" + form_action;
            $.post(url, {
                deleted: 'N',
                order_sort: 0,
                secret: secret,
                w_name: w_name,
                w_year: w_year,
                w_area_id: w_area_id,
                w_creater: w_creater,
                w_keyword: w_keyword,
                w_create_date: w_create_date,
                w_area_other: w_area_other

            }, function (data) {
                if (data.status == "SUCCESS") {
                    $(".close").trigger("click");
                    window.location = "../../Wars/index";
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
    var id = $("input[name='data[Wars][id]']").val();
    var uploader = document.getElementById('uploader0');
    upclick(
            {
                element: uploader,
                action: '../../Wars/uploadDocument/' + id,
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
                                document_link = '<div id="row_doc_key_' + document_id + '"><a href="/files/wars/' + document_name + '" target=_blank>';
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
