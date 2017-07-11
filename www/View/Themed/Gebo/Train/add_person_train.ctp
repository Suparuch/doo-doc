<?= $this->Form->create() ?>
    <div style="text-align: center;">
        <div class="box-title">
            <h3 class="heading">
                แบบบันทึกผลเป็นบุคคล
            </h3>
        </div>
        <div style="text-align: left;">
            <?= $this->Form->create(); ?>
            <div style="display: inline;">
                <label style="display: inline;">ยศ</label>
                    <div style="display: inline;">
                        <?php
                        echo $this->Form->input('rank', array(
                        'label' => false,
                        'div' => false,
                        'style' => 'width:50px',
                        'class' => 'span12',
                        'options' => $Ranks,
                        'empty' => 'ยศ'
                        ));
                        ?>
                    </div>
            </div>
            <div style="display: inline;">
                    <label style="display: inline;">ชื่อ</label>

                    <div style="display: inline;">
                        <input type="text" name="first_name" class="first_name" style="width:170px" require>
                    </div>
            </div>
            <div style="display: inline;">
                    <label style="display: inline;">นามสกุล</label>

                    <div style="display: inline;">
                        <input type="text" name="last_name" class="last_name" style="width:170px" require>
                    </div>
            </div>
            <div style="display: inline;">
                <label style="display: inline;">ตำแหน่ง</label>
                <div style="display: inline;">
                    <input type="text" class="span2 position" name="position" id="position" require>
                </div>
            </div>
            <br>
            <div style="display: inline;">
                <label style="display: inline;">ชกท</label>
                <div style="display: inline;">
                    <input type="text" name="expert" class="span2 expert" id="expert" require>
                </div>
            </div>
            <div style="display: inline;">
                <label style="display: inline;">สังกัด</label>
                <div style="display: inline;">
                    <input type="text" name="belongto" class="belongto" require>
                </div>
            </div>
        </div>
        <div style="text-align: left;">
            <div class="span3" style="display: inline-block;">
                <label style="">การฝึกตามระเบียบและหลักสูตรการฝึก</label>
            </div>
            <div class="" style="display: inline-block; margin-left: -40px">
                <label class="radio inline"><input type="radio" name="course"  value="1">การฝึกทหารใหม่</label>
                <label class="radio inline"><input type="radio" name="course"  value="2">การฝึกทหารใหม่เฉพาะเจ้าหน้าที่</label>
                <label class="radio inline"><input type="radio" name="course"  value="3">การฝึกครูทหารใหม่</label>
                <br>
                <label class="radio inline"><input type="radio" name="course"  value="4">การฝึกสิบตรีกองประจำการ</label>
                <label class="radio inline"><input type="radio" name="course"  value="5">การฝึกตามหน้าที่</label>
                <label class="radio inline"><input type="radio" name="course"  value="6">ตาม ชกท.ของเหล่าต่างๆ</label>
                <label class="radio inline"><input type="radio" name="course"  value="7">การฝึกบิน ฯลฯ </label>
            </div>
        </div>
        <div style="text-align: left;">
            <label class="inline" style="display: inline;">เรื่อง/วิชาที่ทำการฝึก</label>
            <div class="inline" style="display: inline;">
                <input type="text" name="subject" class="subject" require>
            </div>
        </div>
    </div>
    <table class="table table-bordered tablesorter">
        <thead>
            <tr>
                <th class="header headerSortDown" style="text-align: center;width:50px;" rowspan="3">ลำดับ</th>
                <th class="header headerSortDown" style="text-align: center;width:50px;" rowspan="3">กิจเฉพาะ</th>
                <th class="header" style="text-align: center;" colspan="6">การประเมินผล</th>
                <th class="header" rowspan="3">ปัญหาข้อขัดคล้อง</th>
                <th class="header" rowspan="3">หมายเหตุ</th>
                <th class="header" rowspan="3">
                    </>
            </tr>
            <tr>
                <th class="header" style="text-align: center;width:70px;" rowspan="">ครั้งที่</th>
                <th class="header" style="text-align: center;width:70px;" rowspan="">ว-ด-ป</th>
                <th class="header" style="text-align: center;" colspan="2">ผลการประเมิน</th>
                <th class="header" style="text-align: center;width:200px;" colspan="2">ยศ ชื่อ ตำแหน่ง ของผู้ประเมินผลและข้อคิดเห็น</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th class="header">ผ่าน</th>
                <th class="header">ไม่ผ่าน</th>
                <th class="header">ครูฝึก/ผบช.โดยตรง</th>
                <th class="header">ผบช.ตามลำดับชั้นเหนือขึ้นไป 1 ระดับ</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><input type="text" class="span1" name="specific1"></td>
                <td><input type="text" name="time1" class="span1"></td>
                <td><input type="text" class="date" name="date1" class="span1"></td>
                <td>
                    <input type="radio" name="result1" value="1">
                </td>
                <td>
                    <input type="radio" name="result1" value="0">
                </td>
                <td>
                    <input type="text" name="teacher1" class="span2">
                </td>
                <td>
                    <input type="text" name="head1" class="span2">
                </td>
                <td>
                    <input type="text" name="problem1" class="span2">
                </td>
                <td>
                    <input type="text" name="note1" class="span2">
                </td>
                <td></td>
            </tr>
            <tr>

                <td>2</td>
                <td><input type="text" class="span1" name="specific2"></td>
                <td><input type="text" name="time2" class="span1"></td>
                <td><input type="text" class="date" name="date2" class="span1"></td>
                <td>
                    <input type="radio" name="result2" value="1">
                </td>
                <td>
                    <input type="radio" name="result2" value="0">
                </td>
                <td>
                    <input type="text" name="teacher2" class="span2">
                </td>
                <td>
                    <input type="text" name="head2" class="span2">
                </td>
                <td>
                    <input type="text" name="problem2" class="span2">
                </td>
                <td>
                    <input type="text" name="note2" class="span2">
                </td>
                <td></td>
            </tr>
            <tr>

                <td>3</td>
                <td><input type="text" class="span1" name="specific3"></td>
                <td><input type="text" name="time3" class="span1"></td>
                <td><input type="text" class="date" name="date3" class="span1"></td>
                <td>
                    <input type="radio" name="result3" value="1">
                </td>
                <td>
                    <input type="radio" name="result3" value="0">
                </td>
                <td>
                    <input type="text" name="teacher3" class="span2">
                </td>
                <td>
                    <input type="text" name="head3" class="span2">
                </td>
                <td>
                    <input type="text" name="problem3" class="span2">
                </td>
                <td>
                    <input type="text" name="note3" class="span2">
                </td>
                <td></td>
            </tr>
            <tr>

                <td>4</td>
                <td><input type="text" class="span1" name="specific4"></td>
                <td><input type="text" name="time4" class="span1"></td>
                <td><input type="text" class="date" name="date4" class="span1"></td>
                <td>
                    <input type="radio" name="result4" value="1">
                </td>
                <td>
                    <input type="radio" name="result4" value="0">
                </td>
                <td>
                    <input type="text" name="teacher4" class="span2">
                </td>
                <td>
                    <input type="text" name="head4" class="span2">
                </td>
                <td>
                    <input type="text" name="problem4" class="span2">
                </td>
                <td>
                    <input type="text" name="note4" class="span2">
                </td>
                <td></td>
            </tr>
            <tr>

                <td>5</td>
                <td><input type="text" class="span1" name="specific5"></td>
                <td><input type="text" name="time5" class="span1"></td>
                <td><input type="text" class="date" name="date5" class="span1"></td>
                <td>
                    <input type="radio" name="result5" value="1">
                </td>
                <td>
                    <input type="radio" name="result5" value="0">
                </td>
                <td>
                    <input type="text" name="teacher5" class="span2">
                </td>
                <td>
                    <input type="text" name="head5" class="span2">
                </td>
                <td>
                    <input type="text" name="problem5" class="span2">
                </td>
                <td>
                    <input type="text" name="note5" class="span2">
                </td>
                <td></td>
            </tr>

        </tbody>
    </table>
    <div>
        <label><u>หมายเหตุ</u> การบันทึกผลการฝึกบุคคล ให้ทำสำเนาบันทึกหลักฐานไว้ที่หน่วยบังคับบัญชาขึ้นไปถึงระดับกองร้อยหรือเทียบเท่า</label>
        <div style="text-align: right;">
            <div style="">
                <label>ตรวจความถูกต้อง</label>
                <div>
                    <label style="display: inline;">ชื่อ</label>
                    <input type="text" name="checkName">
                </div>
                <div>
                    <label style="display: inline;">ตำแหน่ง</label>
                    <input type="text" name="checkPosition">
                </div>
            </div>
        </div>
    </div>
    <div class="center" style="text-align: center;">
        <button type="submit" class="btn btn-primary">บันทึก</button>
        <button type="reset" class="btn btn-primary" onclick="window.location='/Train/index'">ยกเลิก</button>
    </div>
    <?= $this->Form->create() ?>

        <script>
            var position=[];
            $( window ).on( "load", function(){
                $.ajax({
                        url: "getPosition",
                        dataType: "json",
                        success: function( data ) {
                            for(var x in data){
                                position.push(data[x])
                            }
                                position.splice(0, 1);
                            $("#position").autocomplete({
                                source: position,
                                minLength: 2
                            });
                        }
                    });
                    
            } );

            
            
            $(".date").focus(function() {
                $('.date').datepicker();
            });
            
        </script>