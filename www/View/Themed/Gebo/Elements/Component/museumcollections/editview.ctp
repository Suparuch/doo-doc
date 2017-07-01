<?php
echo $this->Html->css(array(
    'jquery-ui-1.8.4.custom',
));

//echo $this->Html->script(array(
//    'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js',
//    'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js',
//));

$cbunny = array(
    'APP_PATH' => Router::url('/', true)
);
echo $this->Html->scriptBlock('var CbunnyObj = ' . $this->Javascript->object($cbunny) . ';');


$default['id'] = empty($default['id']) ? '' : $default['id'];
$formAction = $default['action'];

/* $default['mc_receiver_date'] = empty($default['mc_receiver_date']) ? '' : $default['mc_receiver_date'];
  if ($default['mc_receiver_date'] != '')
  $default['mc_receiver_date'] = $this->TextUtil->formatSqlDateForPckDate($default['mc_receiver_date']);
  $default['mc_record_date'] = empty($default['mc_record_date']) ? '' : $default['mc_record_date'];
  if ($default['mc_receiver_date'] != '')
  $default['mc_record_date'] = $this->TextUtil->formatSqlDateForPckDate($default['mc_record_date']);
 */
if ($formAction == "ADD") {
    $default['mc_condition'] = "0";
    //$default['mc_m_id'] = '0';
    $default['mc_receiver_date'] = date('Y-m-d');
    $default['mc_record_date'] = date('Y-m-d');
}
?>

<style type="text/css">
    .img-gal-container{
        padding: 10px;
        width: 170px;
        height: 145px;
        border: solid 1px #ddd;
        border-radius: 5px;
        float: left;
        margin-right: 10px;
        margin-bottom: 10px;
        text-align:center;
    }
    .img-gal-image{
        height: 120px;
        object-fit: cover;
        width: 200px;
        margin-bottom: 5px;
    }
</style>

<script type="text/javascript">
    var i = 0;

</script>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-content nopadding">
                <?php echo $this->Form->create('MuseumCollections', array('action' => 'save', 'class' => 'form-horizontal form-bordered')); ?>
                <div class="row-fluid">
                    <input type="hidden" name="data[MuseumCollections][id]" value="<?php echo $default['id']; ?>"/>  
                    <input type="hidden" name="data[MuseumCollections][action]" value="<?php echo $default['action']; ?>"/>
                    <input type="hidden" name="data[MuseumCollections][mc_file_id]" value="<?php echo!empty($default['mc_file_id']) ? $default['mc_file_id'] : "0"; ?>"/>
                    <?php
                    if ($formAction != "ADD") {
                        ?>
                        <div class="text-right"><a href="../../MuseumCollections/printItemCard/<?php echo $default['id']; ?>" target="_blank"><li class="splashy-printer"></li> พิมพ์ทะเบียนโบราณวัตถุศิลปวัตถุ</a></div>
                    <?php } ?>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="text-align:right;">* เลขประจำวัตถุ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_no', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_no'])) ? $default['mc_no'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                                <td style="text-align:right;">สถาพวัตถุ : </td>
                                <td>
                                    <input name="data[MuseumCollections][mc_condition]" type="radio" value="0" <?php echo (isset($default['mc_condition']) && $default['mc_condition'] == '0') ? "checked='checked'" : ""; ?>> ชำรุด 
                                    <input name="data[MuseumCollections][mc_condition]" type="radio" value="1" <?php echo (isset($default['mc_condition']) && $default['mc_condition'] == '1') ? "checked='checked'" : ""; ?>> สมบูรณ์
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">เลขอื่นที่เคยใช้ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_old_no', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_old_no'])) ? $default['mc_old_no'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?>  
                                </td>
                                <td style="text-align:right;">ประวัติที่มาวัตถุ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_history', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_history'])) ? $default['mc_history'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?>   
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">* ชื่อวัตถุ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_name', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_name'])) ? $default['mc_name'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?>   
                                </td>
                                <td style="text-align:right;">สถานที่เก็บวัตถุ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_location', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_location'])) ? $default['mc_location'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?>  
                                </td>                                
                            </tr>
                            <tr>
                                <td style="text-align:right;">ลักษณะวัตถุ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_nature', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_nature'])) ? $default['mc_nature'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?>  
                                </td>
                                <td style="text-align:right;">อาคาร/ชั้น : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_building', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_building'])) ? $default['mc_building'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">ประโยชน์ที่ใช้ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_useful', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_useful'])) ? $default['mc_useful'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td> 
                                <td style="text-align:right;">หมายเลขตู้ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_closet_no', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_closet_no'])) ? $default['mc_closet_no'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">แบบ/สมัย : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_style', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_style'])) ? $default['mc_style'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td> 
                                <td style="text-align:right;">หมายเหตุ : </td>
                                <td>
                                    <textarea name="data[MuseumCollections][mc_remark]" id="wysiwg_mini" cols="1" rows="3" class="span12" placeholder=""><?php echo (isset($default) && isset($default['mc_remark'])) ? $default['mc_remark'] : ""; ?></textarea>
                                </td>
                            </tr>


                            <tr>
                                <td style="text-align:right;">พ.ศ.ที่ขึ้นทะเบียน : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_dc_register', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_dc_register'])) ? $default['mc_dc_register'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                                <td style="text-align:right;">ขนาด (ซ.ม.) : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_dimension', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_dimension'])) ? $default['mc_dimension'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">หมวดวัตถุ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_category', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_category'])) ? $default['mc_category'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                                <td style="text-align:right;">ชื่อพิพิธภัณฑ์ : </td>
                                <td>                                    
                                    <?php
//                                    echo $this->Form->input('mc_museum', array(
//                                        'label' => false,
//                                        'div' => false,
//                                        'class' => 'span12',
//                                        //'placeholder' => '',
//                                        'default' => (isset($default) && isset($default['mc_museum'])) ? $default['mc_museum'] : "",
//                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
//                                    ));
//                                    
                                    ?> 
                                    <?php
                                    echo $this->Ajax->autoComplete_ui('txtMuseumName', array(
                                        'source' => array(
                                            'controller' => 'MuseumCollections',
                                            'action' => 'autoComplete',
                                        ),
                                    ));
                                    ?>
                                    <script type="text/javascript">
                                       $('#TxtMuseumName').addClass('span12');
                                       $('#TxtMuseumName').val('<?php echo (isset($default) && isset($default['mc_museum'])) ? $default['mc_museum'] : ""; ?>');
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">ลักษณะวัตถุ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_pattern', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_pattern'])) ? $default['mc_pattern'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                                <td style="text-align:right;">เลขประจำภาพ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_photo_no', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_photo_no'])) ? $default['mc_photo_no'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">ชนิดวัตถุ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_type', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_type'])) ? $default['mc_type'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                                <td style="text-align:right;">ผู้บันทึก : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_record', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_record'])) ? $default['mc_record'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                            </tr>



                            <tr>
                                <td style="text-align:right;">วันที่รับวัตถุ : </td>
                                <td>
<!--                                    <span>
                                        <div class="input-append date" id="dp1" class="pckcal" data-date-format="dd/mm/yyyy">
                                            <input class="span6" type="text" readonly="" name='mc_receiver_date' value="<?php echo (isset($default) && isset($default['mc_receiver_date'])) ? $default['mc_receiver_date'] : ""; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                        </div>
                                    </span>-->
                                    <div>
                                        <?php
                                        echo $this->CustomForm->dateThai('mc_receiver_date', array('value' => $default['mc_receiver_date'],
                                            'class' => 'form-control'
                                        ));
                                        ?>
                                    </div>
                                </td>
                                <td style="text-align:right;">วันที่บันทึก : </td>
                                <td>
<!--                                    <span>
                                        <div class="input-append date" id="dp2" class="pckcal" data-date-format="dd/mm/yyyy">
                                            <input class="span6" type="text" readonly="" name='mc_record_date' value="<?php echo (isset($default) && isset($default['mc_record_date'])) ? $default['mc_record_date'] : ""; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                        </div>
                                    </span>-->
                                    <div>
                                        <?php
                                        echo $this->CustomForm->dateThai('mc_record_date', array('value' => $default['mc_record_date'],
                                            'class' => 'form-control'
                                        ));
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">ผู้รับ : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_receiver', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_receiver'])) ? $default['mc_receiver'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>
                                <td style="text-align:right;">สถานะการยืม : </td>
                                <td>
                                    <?php
                                    echo $this->Form->checkbox('mc_borrow_status', array(
                                        'hiddenField' => false,
                                        'default' => (isset($default) && isset($default['mc_borrow_status'])) ? $default['mc_borrow_status'] : "",
                                    ));
                                    ?> 
                                    ถูกยืม
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;"></td>
                                <td>

                                </td>
                                <td style="text-align:right;">หน่วยที่ยืม : </td>
                                <td>
                                    <?php
                                    echo $this->Form->input('mc_borrow_by', array(
                                        'label' => false,
                                        'div' => false,
                                        'class' => 'span12',
                                        //'placeholder' => '',
                                        'default' => (isset($default) && isset($default['mc_borrow_by'])) ? $default['mc_borrow_by'] : "",
                                            //'onkeypress' => 'return keyNumberArabicAndTextThai(event)'
                                    ));
                                    ?> 
                                </td>

                            </tr>
                            <tr>
                                <td style="text-align:right;">รูปภาพ<br/>(ขนาดไฟล์ ไม่เกิน 5MB) : </td>
                                <td colspan="3">
                                    <div id='file_list'>
                                        <?php
                                        foreach ($TableAttachFiles as $TableAttachFile) {
                                            $btn = '';
                                            if ($default['mc_file_id'] == $TableAttachFile['TableAttachFile']['id'])
                                                $btn = '<button id="btn_img_' . $TableAttachFile['TableAttachFile']['id'] . '" fileid="' . $TableAttachFile['TableAttachFile']['id'] . '" onclick="setCover(\'1\',\'' . $TableAttachFile['TableAttachFile']['id'] . '\');return false;" class="btn btn-warning btn-sm">ยกเลิกเป็นภาพหลัก</button>';
                                            else
                                                $btn = '<button id="btn_img_' . $TableAttachFile['TableAttachFile']['id'] . '" fileid="' . $TableAttachFile['TableAttachFile']['id'] . '" onclick="setCover(\'0\',\'' . $TableAttachFile['TableAttachFile']['id'] . '\');return false;" class="btn btn-primary btn-sm">ตั้งเป็นภาพหลัก</button>';
                                            echo '<div id="row_doc_key_' . $TableAttachFile['TableAttachFile']['id'] . '" class="img-gal-container"><img src="/files/museum_collections/' . $TableAttachFile['TableAttachFile']['file_name'] . '" class="img-gal-image" />&nbsp;&nbsp;<span style="cursor:pointer;" onclick="modalActionRemoveDocument(\'' . $TableAttachFile['TableAttachFile']['id'] . '\');"><i class="icon-trash"></i></span>&nbsp;' . $btn . '</div>';
                                        }
                                        ?>
                                    </div> 
                                    <div style="clear: both;">
                                        <input type="button" name="button" class="btnAttach" id="uploader0" value="เลือกไฟล์แนบ" />
                                    </div>
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
    //$('#dp2').datepicker();

    function moreattach() {
        i++;
        $("#file_list").append("<div><input class='form-control' type='file' name='file_attach[]' /></div>");
    }

    function modalActionRemoveDocument(fileID) {
        if (confirm('ยืนยันการลบเอกสารแนบ')) {
            var url = "../../MuseumCollections/removeDocument/" + fileID;
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
        var form_action = $("input[name='data[MuseumCollections][action]']").val();
        var mc_id = $("input[name='data[MuseumCollections][id]']").val();
        var mc_no = $("input[name='data[MuseumCollections][mc_no]']").val();
        var mc_condition = $("input:radio[name ='data[MuseumCollections][mc_condition]']:checked").val();
        var mc_old_no = $("input[name='data[MuseumCollections][mc_old_no]']").val();
        var mc_history = $("input[name='data[MuseumCollections][mc_history]']").val();
        var mc_name = $("input[name='data[MuseumCollections][mc_name]']").val();
        var mc_location = $("input[name='data[MuseumCollections][mc_location]']").val();
        var mc_nature = $("input[name='data[MuseumCollections][mc_nature]']").val();
        var mc_building = $("input[name='data[MuseumCollections][mc_building]']").val();
        var mc_useful = $("input[name='data[MuseumCollections][mc_useful]']").val();
        var mc_closet_no = $("input[name='data[MuseumCollections][mc_closet_no]']").val();
        var mc_style = $("input[name='data[MuseumCollections][mc_style]']").val();
        var mc_remark = $("textarea[name='data[MuseumCollections][mc_remark]']").val();
        var mc_dc_register = $("input[name='data[MuseumCollections][mc_dc_register]']").val();
        var mc_dimension = $("input[name='data[MuseumCollections][mc_dimension]']").val();
        var mc_category = $("input[name='data[MuseumCollections][mc_category]']").val();
        //var mc_m_id = $("select[name='data[MuseumCollections][mc_m_id]']").val();
        //var mc_museum = $("input[name='data[MuseumCollections][mc_museum]']").val();
        var mc_museum = $("#TxtMuseumName").val();
        var mc_pattern = $("input[name='data[MuseumCollections][mc_pattern]']").val();
        var mc_photo_no = $("input[name='data[MuseumCollections][mc_photo_no]']").val();
        var mc_type = $("input[name='data[MuseumCollections][mc_type]']").val();
        var mc_record = $("input[name='data[MuseumCollections][mc_record]']").val();
        var mc_receiver = $("input[name='data[MuseumCollections][mc_receiver]']").val();
        var mc_file_id = $("input[name='data[MuseumCollections][mc_file_id]']").val();
        var mc_borrow_status = '0';
        if ($("input[name='data[MuseumCollections][mc_borrow_status]']").is(':checked'))
            mc_borrow_status = '1';
        var mc_borrow_by = $("input[name='data[MuseumCollections][mc_borrow_by]']").val();
        /*var mc_receiver_date = $("input[name='mc_receiver_date']").removeAttr('readonly').val();
         $("input[name='mc_receiver_date']").attr('readonly', '');
         var mc_record_date = $("input[name='mc_record_date']").removeAttr('readonly').val();
         $("input[name='mc_record_date']").attr('readonly', '');
         
         mc_receiver_date = formatDateForSave(mc_receiver_date);
         mc_record_date = formatDateForSave(mc_record_date);*/

        var mc_receiver_date = formatDDLDateForSave(
                $("select[name='data[mc_receiver_date][day]']").val(),
                $("select[name='data[mc_receiver_date][month]']").val(),
                $("select[name='data[mc_receiver_date][year]']").val());
        if (mc_receiver_date === 'InvalidDate') {
            alert('วันที่ที่ระบุ ไม่พบในปฏิทิน !!');
            return;
        }
        if (mc_receiver_date === 'DateError') {
            alert('วันที่ที่ระบุ ไม่อยู่ในรูปแบบวันที่ที่ถูกต้อง !!');
            return;
        }
        var mc_record_date = formatDDLDateForSave(
                $("select[name='data[mc_record_date][day]']").val(),
                $("select[name='data[mc_record_date][month]']").val(),
                $("select[name='data[mc_record_date][year]']").val());
        if (mc_record_date === 'InvalidDate') {
            alert('วันที่ที่ระบุ ไม่พบในปฏิทิน !!');
            return;
        }
        if (mc_record_date === 'DateError') {
            alert('วันที่ที่ระบุ ไม่อยู่ในรูปแบบวันที่ที่ถูกต้อง !!');
            return;
        }

        if (mc_no != "" && mc_name != "")
        {
            var url = "../../MuseumCollections/save/" + mc_id + "/" + form_action;
            $.post(url, {
                deleted: 'N',
                order_sort: 0,
                secret: 9,
                mc_no: mc_no,
                mc_condition: mc_condition,
                mc_old_no: mc_old_no,
                mc_history: mc_history,
                mc_name: mc_name,
                mc_location: mc_location,
                mc_nature: mc_nature,
                mc_building: mc_building,
                mc_useful: mc_useful,
                mc_closet_no: mc_closet_no,
                mc_style: mc_style,
                mc_remark: mc_remark,
                mc_dc_register: mc_dc_register,
                mc_dimension: mc_dimension,
                mc_category: mc_category,
                mc_museum: mc_museum,
                mc_pattern: mc_pattern,
                mc_photo_no: mc_photo_no,
                mc_type: mc_type,
                mc_record: mc_record,
                mc_receiver: mc_receiver,
                mc_receiver_date: mc_receiver_date,
                mc_record_date: mc_record_date,
                mc_file_id: mc_file_id,
                mc_borrow_status: mc_borrow_status,
                mc_borrow_by: mc_borrow_by

            }, function (data) {
                if (data.status == "SUCCESS") {
                    $(".close").trigger("click");
                    window.location = "../../MuseumCollections/index";
                } else {
                    alert("การสร้างข้อมูลล้มเหลว");
                }
            }, "json");
        }
        else {
            alert('กรุณาใส่ข้อมูลให้ครบถ้วน');
        }
    }

    function setCover(val, fileID) {
        // Clear state
        $("button[id^='btn_img_']").each(function () {
            $(this).text('ตั้งเป็นภาพหลัก');
            $(this).attr('class', 'btn btn-primary btn-sm');
            $(this).attr('onclick', "setCover(\'0',\'" + $(this).attr('fileid') + "\');return false;");
        });

        // Update button
        btn = $('#btn_img_' + fileID);
        if (val === '1') {
            $("input[name='data[MuseumCollections][mc_file_id]']").val('');
            btn.text('ตั้งเป็นภาพหลัก');
            btn.attr('class', 'btn btn-primary btn-sm');
            btn.attr('onclick', "setCover(\'0',\'" + fileID + "\');return false;");
        } else {
            $("input[name='data[MuseumCollections][mc_file_id]']").val(fileID);
            btn.text('ยกเลิกเป็นภาพหลัก');
            btn.attr('class', 'btn btn-warning btn-sm');
            btn.attr('onclick', "setCover(\'1\',\'" + fileID + "\');return false;");
        }
    }

    // File attach
    var id = $("input[name='data[MuseumCollections][id]']").val();
    var uploader = document.getElementById('uploader0');
    upclick(
            {
                element: uploader,
                action: '../../MuseumCollections/uploadDocument/' + id,
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
                                document_link = '<div id="row_doc_key_' + document_id + '" class="img-gal-container"><img src="/files/museum_collections/' + document_name + '" class="img-gal-image" />';
                                document_link += '&nbsp;&nbsp;<span style="cursor:pointer;" onclick="modalActionRemoveDocument(\'' + document_id + '\');"><i class="icon-trash"></i></span>';
                                document_link += '&nbsp;<button id="btn_img_' + document_id + '" fileid="' + document_id + '" onclick="setCover(\'0\',\'' + document_id + '\');return false;" class="btn btn-primary btn-sm">ตั้งเป็นภาพหลัก</button>';
                                $('#file_list').append(document_link);
                            } else if (data[0].result === 'error') {
                                alert(data[0].detail);
                            }
                        }
            }
    );

</script>
