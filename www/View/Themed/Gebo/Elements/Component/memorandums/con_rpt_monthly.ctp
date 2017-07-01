<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-content nopadding">

                <div class="row-fluid">

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width:91px;text-align:right;">ชั้นความลับ : </td>
                                <td>                                    
                                    <!--<input name="rdSecret" type="radio" value="9" checked="checked"> ไม่ระบุ &nbsp;&nbsp;&nbsp;-->
                                    
                                    <input name="rdSecret" type="radio" value="1"> ลับ 
                                    &nbsp;&nbsp;&nbsp;
                                    <input name="rdSecret" type="radio" value="0" checked="checked"> ไม่ลับ
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">เดือน / ปี : </td>
                                <td>
                                    <select name="selMonth"  data-placeholder="" class="chzn_a input-xlarge" style="width:130px;">
                                        <?php foreach ($thai_month_arr as $key => $val) { ?>
                                            <option value="<?php echo $key; ?>" <?php echo (intval($key) == intval(date("m")))?"selected='selected'":""; ?>><?php echo $val; ?></option>
                                        <?php } ?>
                                    </select>   
                                    <select name="selYear"  data-placeholder="" class="chzn_a input-xlarge" style="width:85px;">
                                        <?php foreach ($years as $val) { ?>
                                            <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                                        <?php } ?>
                                    </select>   
                                </td>
                            </tr>                                                     
                        </tbody>
                    </table>	
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function modalAction2() {
        var secret = $("input:radio[name ='rdSecret']:checked").val();
        var month = $("select[name='selMonth").val();
        var year = $("select[name='selYear").val();
        
        window.open("../../Memorandums/printMonthlyReport/"+secret+"/"+month+"/"+year,"_blank");
    }
</script>
