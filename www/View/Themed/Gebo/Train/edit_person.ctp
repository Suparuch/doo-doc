<?php echo $this->Form->create();?>
<table>
    <td>
        <label>ข้อมูลผู้รับการฝึก</label>
        <div class="">
            <label style="display: inline-block;">ยศ :</label>
            <select name="rank" style="display: inline-block;">
                <option value=''>ยศ</option>
                <option value='ร้อยตรี' >ร้อยตรี</option>
                <option value='ร้อยโท' >ร้อยโท</option>
                <option value='ร้อยเอก' >ร้อยเอก</option>
                <option value='พันตรี' >พันตรี</option>
                <option value='พันโท' >พันโท</option>
                <option value='พันเอก' >พันเอก</option>
            </select>
        </div>
        <div class="">
            <label  class="control-label" style="display: inline-block;">ชื่อ :</label>
            <input type="text" name="name" style="display: inline-block;">
        </div>
        <div>
            <label style="display: inline-block;">ตำแหน่ง :</label>
            <select name="position" style="display: inline-block;">
                <option value=''>ตำแหน่ง</option>
                                <option value='ผู้บังคับการ' >ผู้บังคับการ</option>
                                <option value='รองผู้บังคับการ' >รองผู้บังคับการ</option>
                                <option value='ครูฝึก' >ครูฝึก</option>
                                <option value='ผู้ช่วยดำเนินการฝึก' >ผู้ช่วยดำเนินการฝึก</option>
                                <option value='ผู้ฝึก' >ผู้ฝึก</option>
            </select>
        </div>
        <div>
            <label style="display: inline-block;">ชกท :</label>
            <input type="text" style="display: inline-block;">
        </div>
        <div>
            <label style="display: inline-block;">สังกัด :</label>
            <input type="text" name="belongto" style="display: inline-block;">
        </div>
        <div>
            <label style="display: inline-block;">การฝึก/หลักสูตร :</label>
            <select name="course" style="display: inline-block;">
                <option value=''>การฝึกตามระเบียบและหลักสูตรการฝึก</option>
            </select>
        </div>
        <div>
            <label style="display: inline-block;">กิจเฉพาะ :</label>
            <select name="specific" id="" style="display: inline-block;">
                <option value=''>กิจเฉพาะ</option>
            </select>
        </div>
        <div>
            <label style="display: inline-block;">ครั้งที่ :</label>
            <input type="text" name="time" style="display: inline-block;">
        </div>
        <div>
            <label for="" style="display: inline-block;">ว-ด-ป :</label>
            <input type="text" style="display: inline-block;" name="date">
        </div>
        <div>
            <label for="" style="display: inline-block;">เรื่อง/วิชาที่ทำการฝึก :</label>
            <input type="text" name="subject" style="display: inline-block;">
        </div>
    </td>
    <td style="padding-left: 40px">
    <div style="border-bottom-style: inset;">
            <label for="">ข้อมูลครูฝึก/ผบช. โดยตรง</label>
        <div>
            <label for="" style="display: inline-block;">ผลการประเมิน : </label>
            <input type="radio" name="result" value="1" style="display: inline-block; padding-right: 5px;"> ผ่าน
            <input type="radio" name="result" value="0" style="display: inline-block; padding-right: 5px;"> ไม่ผ่าน
        </div>
        <div>
            <label for="" style="display: inline-block;">ข้อคิดเห็น :</label>
            <textarea name="comment"></textarea>
        </div>
        <div>
            <label for="" style="display: inline-block;">ปัญหาข้อขัดแย้ง :</label>
            <input type="text" name="problem" style="display: inline-block;">
        </div>
        <div>
            <label for="" style="display: inline-block;">หมายเหตุ :</label>
            <input type="text" name="note">
        </div>
        </div>
        <div style="border-bottom-style: inset; margin-top: 5px;">
            <label for="">ผบช. ตามลำดับชั้นเหนือขึ้นไป 1 ระดับ</label>
        <div>
            <label for="" style="display: inline-block;">ข้อคิดเห็น :</label>
            <input type="text" name="comment2" style="display: inline-block;">
        </div>
        <div>
            <label for="" style="display: inline-block;">ปัญหาขัดข้อง :</label>
            <input type="text" name="problem2" style="display: inline-block;">
        </div>
        <div>
            <label for="" style="display: inline-block;">หมายเหตุ :</label>
            <input type="text" style="display: inline-block;" name="note2">
        </div>
        </div>
        <div>
            <label for="">ตรวจสอบความถูกต้อง</label>
        </div>
        <div>
            <label for="" style="display: inline-block;">ชื่อ :</label>
            <input type="text" style="display: inline-block;" name="name2">
        </div>
        <div>
            <label for="" style="display: inline-block;">ตำแหน่ง :</label>
            <input type="text" name="position2" style="display: inline-block;">
        </div>
        <div>
            <button type="button" class="btn btn-primary">แก้ไข</button>
            <button type="submit" class="btn btn-primary">บันทึก</button>
            <button type="button" class="btn btn-primary">อนุมัติ</button>
            <button type="reset" class="btn btn-primary" onclick="window.location='/Train/index';return false;">ยกเลิก</button>
        </div>
    </td>
</table>
<?php echo $this->Form->end();?>
