
<link href="/fileuploader/src/jquery.fileuploader.css" media="all" rel="stylesheet">
<?php
    echo $this->Html->css("font-awesome.min");
?>
<div class="container">
  <div id="jCrumbs" class="breadCrumb module">
        <div style="overflow:hidden; position:relative; width: 967px;">
            <div>
                <ul style="width: 5000px;">
                    <li class="first">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>
                    <li class="last">
                        ระบบคลังภาพกองทัพบก
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--
    <div style="margin-left: 40px;">
        <a href="myFile" style="color: #65752A"> คลังรูปภาพ</a> |
        <a href="#video" style="color: #65752A"> คลังวีดีโอ</a> |
        <a href="#document" style="color: #65752A"> คลังเอกสาร</a>
    </div>
    -->
    <br><br>
    <!--POST-->
    <?php
        echo $this->Form->create("Gallery",array(
            'type' => 'file',
            'url'=> array('controller'=>'GalleryDashboard','action'=>'uploadPicture')));
    ?>
    <input type="hidden" name="isalbum" value="1">
    <div style="border: 1px solid #DBDBDB; width: 80%">
        <div style="padding: 25px; border: 1px solid #DBDBDB; background-color: #EFF0E8">
            <h3 style="display: inline-block">สร้างอัลบั้มรูปภาพ</h3>
            <div style="display: inline-block; margin-left: 50%">
                <!--<a href="javascript:void(0);" onclick="selectPicture()" style=" color: #6F801A; font-size: 15px;">+ใส่รูปภาพเพิ่ม</a>-->
            </div>
            <a href="javascript:void(0)" id="times" style="margin-left:10%; " onclick="cancelPost()"><i class="fa fa-times fa-2x"></i></a>
        </div>
        <div style="border: 1px solid #DBDBDB; width:320px; display:inline-block; vertical-align: top">
            <div style="padding:10px">
                <input type="text" name="album" placeholder="ชื่ออัลบั้ม" style="width:280px">
                <textarea  name="description" placeholder="คำอธิบาย" rows="5" cols="40" style="width:280px"></textarea>
                <input type="text" name="location" placeholder=" สถานที่" style="width: 280px">
            </div>
        </div>
        <div style="display:inline-block">
            <input type="file" name="files" >
            <!--<input type="file" id="selectPicture" name="data[Gallery][]" accept="image/*" multiple style="display:none">-->
        </div>
        <div style=" border: 1px solid #DEE0E2; height:50px ">
            <div>
                <div style="float: right; margin: 10px">
                    <div class="btn-group">
                        <input type="hidden" name="privacy" id="privacy" value="1">
                        <button data-toggle="dropdown" id="dropdownPrivacy" class="btn btn-danger dropdown-toggle"><i class="fa fa-globe"></i> สาธารณะ </a> <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li class="" style="display: list-item;"><a style="cursor:pointer" onclick="selectPrivacy(1)" data-tableid="smpl_tbl"><i class="fa fa-globe"></i> สาธารณะ </a></li>
                            <li class="" style="display: list-item;"><a style="cursor:pointer" onclick="selectPrivacy(0)" data-tableid="smpl_tbl"><i class="fa fa-lock"></i> ส่วนตัว </a></li>
                        </ul>
                    </div>
                    <div style="display: inline">
                        <button type="submit" class="btn btn-primary" >โพสต์</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        echo $this->Form->end();
    ?>
    <!--POST-->
</div>

<script>
     function selectPrivacy(privacy){
        //Select Public
        if(privacy == 1){
            $("#privacy").val("1");
            $("#dropdownPrivacy").html("<i class=\"fa fa-globe\"></i> สาธารณะ </a><span class=\"caret\"></span>")
        }

        //Select selectPrivacy
        if(privacy == 0){
            $("#privacy").val("0");
            $("#dropdownPrivacy").html("<i class=\"fa fa-lock\"></i> ส่วนตัว </a><span class=\"caret\"></span>")
        }
    }
    function selectPicture(){
        $("#selectPicture").css("display","")
        $("#selectPicture").trigger('click');
    }
    function cancelPost(){
        window.location.href = "index"
    }
</script>
<script src="/fileuploader/src/jquery.fileuploader.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$('input[name="files"]').fileuploader({
        limit: null,
        theme: null,
        addMore: true,
	});
</script>
