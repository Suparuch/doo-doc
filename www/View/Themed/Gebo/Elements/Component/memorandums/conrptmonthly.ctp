<?php
$default['id'] = empty($default['id']) ? '' : $default['id'];
$formAction = ($default['id'] == '') ? "ADD" : "EDIT";

$default['secret'] = empty($default['secret']) ? '0' : $default['secret'];
$default['memo_date_type'] = empty($default['memo_date_type']) ? '' : $default['memo_date_type'];
$default['memo_date_start'] = empty($default['memo_date_start']) ? '' : $default['memo_date_start'];
if($default['memo_date_start'] != '') $default['memo_date_start'] = $this->TextUtil->formatSqlDateForPckDate($default['memo_date_start']);
$default['memo_date_end'] = empty($default['memo_date_end']) ? '' : $default['memo_date_end'];
if($default['memo_date_end'] != '') $default['memo_date_end'] = $this->TextUtil->formatSqlDateForPckDate($default['memo_date_end']);
$default['event'] = empty($default['event']) ? '' : $default['event'];
$default['evidence'] = empty($default['evidence']) ? '' : $default['evidence'];

if ($formAction == "ADD") {
    $default['secret'] = "0";
    $default['memo_date_type'] = "D";
    $default['memo_date_start'] = $this->TextUtil->getCurrDateForPckDate();
}
?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-content nopadding">
                <?php echo $this->Form->create('Memorandums', array('action' => 'save', 'class' => 'form-horizontal form-bordered')); ?>
                <div class="row-fluid">
                    <input type="hidden" name="data[Memorandums][id]" value="<?php echo $default['id']; ?>"/>                                    

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width:91px;text-align:right;">ชั้นความลับ : </td>
                                <td>                                    
                                    <input name="data[Memorandums][secret]" type="radio" value="9" <?php echo ($default['secret'] == '9') ? "checked='checked'" : ""; ?>> ไม่ระบุ 
                                    &nbsp;&nbsp;&nbsp;
                                    <input name="data[Memorandums][secret]" type="radio" value="1" <?php echo ($default['secret'] == '1') ? "checked='checked'" : ""; ?>> ลับ 
                                    &nbsp;&nbsp;&nbsp;
                                    <input name="data[Memorandums][secret]" type="radio" value="0" <?php echo ($default['secret'] == '0') ? "checked='checked'" : ""; ?>> ไม่ลับ
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">วันที่ : </td>
                                <td>
                                    <input name="ddlType" class="chkType" type="radio" value="D" <?php echo ($default['memo_date_type'] == 'D') ? "checked='checked'" : ""; ?>> ระบุวันที่&nbsp;&nbsp;
                                    <span id="spnTypeD" style="display:<?php echo ($default['memo_date_type'] == 'D') ? "" : "none"; ?>;">
                                        <div class="input-append date" id="dp1" class="pckcal" data-date-format="dd/mm/yyyy">
                                            <input class="span6" type="text" readonly="" name='dpkEventDateS' value="<?php echo $default['memo_date_start']; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                        </div>
                                    </span>

                                    <br/>

                                    <input name="ddlType" class="chkType" type="radio" value="P" <?php echo ($default['memo_date_type'] == 'P') ? "checked='checked'" : ""; ?>> ช่วงเวลา&nbsp;
                                    <span id="spnTypeP" style="display:<?php echo ($default['memo_date_type'] == 'P') ? "" : "none"; ?>;">
                                        <div class="input-append date" id="dp2" class="pckcal" data-date-format="dd/mm/yyyy">
                                            <input class="span6" type="text" readonly="" name='dpkEventDatePStart' value="<?php echo $default['memo_date_start']; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                        </div>

                                        &nbsp;ถึง&nbsp;
                                        <div class="input-append date" id="dp3" class="pckcal" data-date-format="dd/mm/yyyy">
                                            <input class="span6" type="text" readonly="" name='dpkEventDatePEnd' value="<?php echo $default['memo_date_end']; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                        </div>

                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">*เหตุการณ์ : </td>
                                <td>
                                    <textarea name="data[Memorandums][event]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder=""><?php echo $default['event']; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">หลักฐาน : </td>
                                <td>
                                    <textarea name="data[Memorandums][evidence]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder=""><?php echo $default['evidence']; ?></textarea>
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
    $('#dp1').datepicker();
    $('#dp2').datepicker();
    $('#dp3').datepicker();
    
    $('.chkType').click(function () {
        var chkType = $(this).val();
        if (chkType == 'P') {
            $('#spnTypeD').hide();
            $('#spnTypeP').show();
        } else if (chkType == 'D') {
            $('#spnTypeD').show();
            $('#spnTypeP').hide();
        }
    });
    
    // dd/mm/yyyy to yyyy/mm/dd
    function formatDateForSave(strDate) {
        var result = '';
        var arr = strDate.split("/");
        result = arr[2] + '/' + arr[1] + '/' + arr[0];
        return result;
    }
    
    function modalAction2() {
            var d_id = $("input[name='data[Memorandums][id]']").val();
            var d_secret = $("input:radio[name ='data[Memorandums][secret]']:checked").val();           
            var d_date_type = $("input:radio[name ='ddlType']:checked").val();
            var d_event = $("textarea[name='data[Memorandums][event]']").val();
            var d_evidence = $("textarea[name='data[Memorandums][evidence]']").val();           

            var date_s_start = $("input[name='dpkEventDateS']").removeAttr('readonly').val();
            $("input[name='dpkEventDateS']").attr('readonly','');
            
            var date_p_start = $("input[name='dpkEventDatePStart']").removeAttr('readonly').val();
            $("input[name='dpkEventDatePStart']").attr('readonly','');
            
            var date_p_end = $("input[name='dpkEventDatePEnd']").removeAttr('readonly').val();
            $("input[name='dpkEventDatePEnd']").attr('readonly','');
           
            var d_memo_date_start = '';
            var d_memo_date_end = '';

            if(d_date_type == 'D'){
                d_memo_date_start = formatDateForSave(date_s_start);
            }else if (d_date_type == 'P'){
                d_memo_date_start = formatDateForSave(date_p_start);
                if(date_p_end != ''){
                   d_memo_date_end = formatDateForSave(date_p_end); 
                }
            }           
 
            //if(area_id != "" && name != "" && province_id != "" && zone_id != "" && district_id != "" && command_date != "")
            if (d_event != "")
            {
                var url = "../../Memorandums/save/" + d_id;
                $.post(url, {
                    deleted: 'N',
                    order_sort: 0,
                    secret: d_secret,
                    event: d_event,
                    evidence: d_evidence,
                    memo_date_type: d_date_type,
                    memo_date_start: d_memo_date_start,
                    memo_date_end: d_memo_date_end,

                }, function (data) {
                    if (data.status == "SUCCESS") {
                        $(".close").trigger("click");
                        window.location = "../../Memorandums/index";
                    } else {
                        alert("การสร้างข้อมูลล้มเหลว");
                    }
                }, "json");
            }
            else {
                alert('กรุณาใส่ข้อมูลให้ครบถ้วน');
            }
        }
</script>
