<?php
$default['id'] = empty($default['id']) ? '' : $default['id'];
$formAction = ($default['id'] == '') ? "ADD" : "EDIT";

/*$default['event_date'] = empty($default['event_date']) ? '' : $default['event_date'];
if ($default['event_date'] != '')
    $default['event_date'] = $this->TextUtil->formatSqlDateForPckDate($default['event_date']);
$default['event_name'] = empty($default['event_name']) ? '' : $default['event_name'];
$default['evidence'] = empty($default['evidence']) ? '' : $default['evidence'];
*/
if ($formAction == "ADD") {
    //$default['event_date'] = $this->TextUtil->getCurrDateForPckDate();
    $default['event_date'] = date('Y-m-d');
}
?>

<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-content nopadding">
<?php echo $this->Form->create('Pastevents', array('action' => 'save', 'class' => 'form-horizontal form-bordered')); ?>
                <div class="row-fluid">
                    <input type="hidden" name="data[Pastevents][id]" value="<?php echo $default['id']; ?>"/>                                    

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="text-align:right;">*วันที่ : </td>
                                <td>
<!--                                    <span>
                                        <div class="input-append date" id="dp1" class="pckcal" data-date-format="dd/mm/yyyy">
                                            <input class="span6" type="text" readonly="" name='dpkEventDate' value="<?php echo $default['event_date']; ?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                        </div>
                                    </span>-->
                                    <div>
                                        <?php
                                        echo $this->CustomForm->dateThai('event_date', array('value' => $default['event_date'],
                                            'class' => 'form-control'
                                        ));
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">เหตุการณ์ : </td>
                                <td>
                                    <textarea name="data[Pastevents][event_name]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder=""><?php echo (isset($default) && isset($default['event_name'])) ? $default['event_name'] : ""; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">หลักฐาน : </td>
                                <td>
                                    <textarea name="data[Pastevents][evidence]" id="wysiwg_mini" cols="1" rows="6" class="span12" placeholder=""><?php echo (isset($default) && isset($default['evidence'])) ? $default['evidence'] : ""; ?></textarea>
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
                if(parseInt(xm) !== parseInt(month)){                    
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
        var d_id = $("input[name='data[Pastevents][id]']").val();
        var d_event_name = $("textarea[name='data[Pastevents][event_name]']").val();
        var d_evidence = $("textarea[name='data[Pastevents][evidence]']").val();

        /*var date_event = $("input[name='dpkEventDate']").removeAttr('readonly').val();
        $("input[name='dpkEventDate']").attr('readonly', '');

        var d_event_date = formatDateForSave(date_event);
        */
       var event_date = formatDDLDateForSave(
                $("select[name='data[event_date][day]']").val(),
                $("select[name='data[event_date][month]']").val(),
                $("select[name='data[event_date][year]']").val());        
        if(event_date === 'InvalidDate'){
            alert('วันที่ที่ระบุ ไม่พบในปฏิทิน !!');
            return;
        }
        if(event_date === 'DateError'){
            alert('วันที่ที่ระบุ ไม่อยู่ในรูปแบบวันที่ที่ถูกต้อง !!');
            return;
        }

        if (event_date != "")
        {
            var url = "../../PastEvents/save/" + d_id;
            $.post(url, {
                deleted: 'N',
                order_sort: 0,
                secret: 9,
                event_name: d_event_name,
                evidence: d_evidence,
                event_date: event_date,
            }, function (data) {
                if (data.status == "SUCCESS") {
                    $(".close").trigger("click");
                    window.location = "../../PastEvents/index";
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
