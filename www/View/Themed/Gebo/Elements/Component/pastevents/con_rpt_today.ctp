<div class="row-fluid">
    <div class="span12">
        <div class="box box-color box-bordered">
            <div class="box-content nopadding">

                <div class="row-fluid">

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width:91px;text-align:right;">วันที่ : </td>
                                <td>                                    
                                    <div class="input-append date" id="dp1" data-date-format="dd/mm/yyyy">
                                            <input class="span6" type="text" readonly="" name='dpkEventDate' value="<?php echo $this->TextUtil->getCurrDateForPckDate();?>"><span class="add-on"><i class="splashy-calendar_day"></i></span>
                                        </div>
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
    $('#dp1').datepicker();
    
    // dd/mm/yyyy to yyyy/mm/dd
    function formatDateForSave(strDate) {
        var result = '';
        var arr = strDate.split("/");
        result = arr[2] + '-' + arr[1] + '-' + arr[0];
        return result;
    }
    
    function modalAction2() {
        var date_event = $("input[name='dpkEventDate']").removeAttr('readonly').val();
        $("input[name='dpkEventDate']").attr('readonly', '');

        var d_event_date = formatDateForSave(date_event);

        window.open("../../PastEvents/printTodayReport/"+d_event_date,"_blank");
    }
</script>
