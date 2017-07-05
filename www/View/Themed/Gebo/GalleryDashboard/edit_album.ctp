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
    <div style="margin-left: 40px;">
        <a href="myFile" style="color: #65752A"> คลังรูปภาพ</a> |
        <a href="#video" style="color: #65752A"> คลังวีดีโอ</a> |
        <a href="#document" style="color: #65752A"> คลังเอกสาร</a>
    </div>
    <br>
    <br>
    <!--POST-->
    <?php 
        echo $this->Form->create("Gallery",array(
            'type' => 'file',
            'url'=> array('controller'=>'GalleryDashboard','action'=>'uploadPictureAlbum')));
    ?>
    <div style="border: 1px solid #DBDBDB;">
        <div style="padding: 25px; border: 1px solid #DBDBDB; background-color: #EFF0E8">
            <h3 style="display: inline-block">สร้างอัลบั้มรูปภาพ</h3>
            <div style="display: inline-block; margin-left: 60%">

            </div>
        </div>
        <div style="border: 1px solid #DBDBDB; width:200px; display:inline-block;     vertical-align: top;">
            <div style="padding:10px">
                <input type="hidden" name="album_id" value="<?= $album[0]['id'] ?>">
                <input type="text" name="album_name" placeholder="ชื่ออัลบั้ม" value="<?= $album[0]['album_name'] ?>" style="width:140px">
                <input type="text" name="album_description" placeholder="คำอธิบาย" value="<?= $album[0]['album_description'] ?>" style="width: 140px">
                <input type="text" name="album_location" placeholder=" สถานที่" value="<?= $album[0]['album_location'] ?>" style="width: 140px">
            </div>
        </div>
        <div style="display:inline-block">
            <?php
                if(count($pictures) == 0 ){
                    echo "<h2>ไม่มีรูปภาพในอัลบั้ม</h2>";
                }
                else{
                    foreach($pictures as $picture){
                    ?>
                    <div style="margin: 30px; width:280px; border: 1px solid #DFE3CD">
                        <div>
                            <img src="/<?= $picture[0]['path']?>" style="width: 280px; height: 280px">
                        </div>
                        <div style="height: 50px; vertical-align: middle; background: #F7F8F4">
                            <div style="float: left;padding: 10px;">
                                <span> <?= $picture[0]['name'] ?> </span>
                            </div>
                            <div style="float: right;padding: 10px;">
                                <a href="javascipt:void(0)" onclick="del('<?= $picture[0]['id']?>')">
                                    <i style="text-align: right" class="fa fa-trash fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                }
                
            ?>
            <input type="file" id="selectPicture" name="files" accept="image/*"  multiple style="display:none">
        </div>
        <div style=" border: 1px solid #DEE0E2; height:50px ">
            <div>
                <div style="float: right; margin: 10px">
                    <div class="btn-group">
                        <input type="hidden" name="privacy" id="privacy" value="1">
                        <input type="hidden" name="post_id" id="editPostID" value="<?= $album[0]['post_id'] ?>">
                        <button data-toggle="dropdown" id="dropdownPrivacy" class="btn btn-danger dropdown-toggle"><i class="fa fa-globe"></i> สาธารณะ </a> <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li class="" style="display: list-item;"><a style="cursor:pointer" onclick="selectPrivacy(1)" data-tableid="smpl_tbl"><i class="fa fa-globe"></i> สาธารณะ </a></li>
                            <li class="" style="display: list-item;"><a style="cursor:pointer" onclick="selectPrivacy(0)" data-tableid="smpl_tbl"><i class="fa fa-lock"></i> ส่วนตัว </a></li>
                        </ul>
                    </div>
                    <div style="display: inline">
                        <button href="#" type="submit" class="btn btn-primary" >บันทึก</button>
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
    function del(id){
        var albumName = "<?= $album[0]['album_name'] ?>";
        if(confirm("คุณต้องการลบรูปหรือไม่")){
            $.ajax({
                method:"post",
                url:"deletePicAlbum",
                data:{
                    id:id,
                    album_name: albumName,
                },
                success: function(data){
                    location.reload();
                }
            });
        }

    }
</script>

<script src="/fileuploader/src/jquery.fileuploader.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$('#selectPicture').fileuploader({
        limit: null,
        theme: null,
        addMore: true,
	});
</script>
