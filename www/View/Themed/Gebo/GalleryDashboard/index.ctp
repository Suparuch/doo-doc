<?php
?>
<!--container-->
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
    <br>
    <br>
    <!--POST-->
    <?php
    echo $this->Form->create("Gallery",array(
        'type' => 'file',
        'url'=> array('controller'=>'GalleryDashboard','action'=>'uploadPicture')));
    ?>

    <div class="main-gallary">
        <div class="main-gallary__header">
            <a href="#SelectUploadFile" data-toggle="modal" class="main-gallary__header--upload"><i class="fa fa-camera"></i> อัพโหลดไฟล์</a>
            <a href="album" class="main-gallary__header--album"><i class="fa fa-file-image-o"></i> สร้างอัลบั้ม</a>
            <a href="javascript:void(0)" id="times" style="margin-left:40%; display:none" onclick="cancelPost()"><i class="fa fa-times fa-2x"></i></a>
        </div>
        <div class="main-gallary__comment">
            <div class="main-gallary__comment--text-area">
                <textarea rows="4" name="description" placeholder="ใส่คำบรรยายไฟล์ที่อัพโหลด"></textarea>
                <input type="hidden" id="isAlbum" name="isalbum" value="0">
            </div>
            <div>
                <br>
                <div id="selectPicDiv" style="display:none">
                    <p>เลือกรูปภาพ
                        <input type="file" id="selectPicture"  name="data[Gallery][]" multiple accept="image/*" >
                    </p>
                </div>
                <div id="selectVideoDiv" style="display:none">
                    <p>เลือกวีดีโอ
                        <input type="file" id="selectVideo" name="data[GalleryVideo][]" multiple  accept="video/*">
                    </p>
                </div>
                <div id="selectDocumentDiv" style="display:none">
                    <p>เลือกเอกสาร
                        <input type="file" id="selectDocument" name="data[GalleryDocument][]" multiple  accept="">
                    </p>
                </div>
            </div>
        </div>
        <div style=" border: 1px solid #DEE0E2; ">
            <div>
                <div style="display:inline-block">
                    <i class="fa fa-map-marker fa-2x" style="padding: 12px"></i>
                </div>
                <div style="display: inline-block;">
                    <input type="text" style="width:100px" name="location" placeholder="Location">
                </div>
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
                        <button href="#" class="btn btn-primary" >โพสต์</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo $this->Form->end();
?>
<!--POST-->
<!--TIMELINE-->
<?php
$countPicture = 0;
$albumPath = [];
$descriptionAlbum;
$albumName;
$locationAlbum;
$dateAlbum;
$albumId = NULL;
$isAlbum = false;
if(count($GalleryDetail) == 0){
    echo "<h1 style='text-align:center;'>ไม่พบข้อมูล</h1>";
}
else{
    foreach($GalleryDetail as $picture){
        if(!empty($picture[0]['document_path'])){
            ?>
            <!--Document Show-->
            <div style="width: 850px">
                <div style="margin-top: 25px; border: 1px solid #DDDFE2">
                    <div style="padding: 20px">
                        <div style="display: inline-flex">
                            <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/17241-200.png" style="width:40px; height:40px;">
                        </div>
                        <div style="display: inline-block">
                            <h3 style="color: lightgray">
                                <a href="#">admin</a> ได้เพิ่มเอกสาร
                                <a href="#"><i class="icon-grey fa fa-map-marker fa-1x"></i>  <?= $picture[0]['picture_location'] ?></a>
                            </h3>
                            <p style="color: lightgrey">
                                <?= date('d F Y  h.m',strtotime($picture[0]['created'])) ?> น. <?= $picture[0]['picture_location'] ?> <i class="fa fa-globe"></i>
                            </p>
                        </div>
                    </div>
                    <div style="margin-left: 25px">
                        <p><?= $picture[0]['picture_description'] ?></p>
                    </div>
                    <?php
                    $location = $picture[0]['picture_location'];
                    $description = $picture[0]['picture_description'];
                    $date = date('d F Y  h.m',strtotime($picture[0]['created']));
                    $path = $picture[0]['picture_path'];
                    ?>
                    <div style="padding: 20px; text-align: center;">
                        <embed src="/<?= $picture[0]['document_path'] ?>" width="650" height="500px" type="">
                    </div>
                </div>
            </div>
            <!--End of document-->
            <?php
        }

        if(!empty($picture[0]['picture_path'])){
            if(empty($picture[0]['picture_album'])){
                ?>
                <div style="width: 850px">
                    <div style="margin-top: 25px; border: 1px solid #DDDFE2">
                        <div style="padding: 20px">
                            <div style="display: inline-flex">
                                <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/17241-200.png" style="width:40px; height:40px;">
                            </div>
                            <div style="display: inline-block">
                                <h3 style="color: lightgray">
                                    <a href="#">admin</a> ได้เพิ่มรูปภาพใหม่ 1 ภาพ  ที่
                                    <a href="#"><i class="icon-grey fa fa-map-marker fa-1x"></i>  <?= $picture[0]['picture_location'] ?></a>
                                </h3>
                                <p style="color: lightgrey">
                                    <?= date('d F Y  h.m',strtotime($picture[0]['created'])) ?> น. <?= $picture[0]['picture_location'] ?> <i class="fa fa-globe"></i>
                                </p>
                            </div>
                        </div>
                        <div style="margin-left: 25px">
                            <p><?= $picture[0]['picture_description']; ?></p>
                        </div>
                        <?php
                        $location = $picture[0]['picture_location'];
                        $description = $picture[0]['picture_description'];
                        $date = date('d F Y  h.m',strtotime($picture[0]['created']));
                        $path = $picture[0]['picture_path'];
                        ?>
                        <div style="padding: 20px; text-align: center;">
                            <a href="javascript:void(0)" onclick="showModalImage('<?=$path?>', '<?=$description?>', '<?=$date?>', '<?=$location?>')" data-toggle="modal" data-target="#modalImage">
                                <img src="/<?= $picture[0]['picture_path'] ?>" style="width:50%" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
            else{
                // Protected conflict Album
                $countPicture++;
                $isAlbum = true;
                if($albumId != $picture[0]['picture_album'] && $albumId != NULL){

                    if($countPicture == 1 ){
                        $countPicture = 0 ;
                        ?>
                        <!--Album 1 Picture-->
                        <div style="width: 850px">
                            <div style="margin-top: 25px; border: 1px solid #DDDFE2">
                                <div style="padding: 20px">
                                    <div style="display: inline-flex">
                                        <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/17241-200.png" style="width:40px; height:40px;">
                                    </div>
                                    <div style="display: inline-block">
                                        <h3 style="color: lightgray">
                                            <a href="#">admin</a> ได้เพิ่มรูปภาพใหม่ 1 ภาพ  ที่
                                            <a href="#"><i class="icon-grey fa fa-map-marker fa-1x"></i>  <?= $locationAlbum ?></a>
                                        </h3>
                                        <p style="color: lightgrey">
                                            <?= date('d F Y  h.m',strtotime($dateAlbum)) ?> น. <?= $locationAlbum ?> <i class="fa fa-globe"></i>
                                        </p>
                                    </div>
                                </div>
                                <div style="margin-left: 25px">
                                    <p><?= $albumName ?></p>
                                </div>
                                <?php
                                $location = $locationAlbum;
                                $description = $descriptionAlbum;
                                $date = date('d F Y  h.m',strtotime($dateAlbum));
                                $path = $albumPath[0];
                                ?>
                                <div style="padding: 20px; text-align: center;">
                                    <a href="javascript:void(0)" onclick="showModalImage('<?=$path?>', '<?=$description?>', '<?=$date?>', '<?=$location?>')" data-toggle="modal" data-target="#modalImage">
                                        <img src="/<?= $path ?>" style=" width: 50%;" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--Album 1 Picture-->
                        <?php
                    }
                    if($countPicture <= 2){
                        $countPicture = 0 ;
                        ?>
                        <!--Album 2 Picture-->
                        <div style="width: 850px">
                            <div style="margin-top: 25px; border: 1px solid #DDDFE2">
                                <div style="padding: 20px">
                                    <div style="display: inline-flex">
                                        <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/17241-200.png" style="width:40px; height:40px;">
                                    </div>
                                    <div style="display: inline-block">
                                        <h3 style="color: lightgray">
                                            <a href="#">admin</a> ได้เพิ่มรูปภาพใหม่ 2 ภาพ  ที่
                                            <a href="#"><i class="icon-grey fa fa-map-marker fa-1x"></i>  <?= $locationAlbum ?></a>
                                        </h3>
                                        <p style="color: lightgrey">
                                            <?= date('d F Y  h.m',strtotime($dateAlbum)) ?> น. <?= $locationAlbum ?> <i class="fa fa-globe"></i>
                                        </p>
                                    </div>
                                </div>
                                <div style="margin-left: 25px">
                                    <p><?= $albumName ?></p>
                                </div>
                                <?php
                                $location = $locationAlbum;
                                $description = $descriptionAlbum;
                                $date = date('d F Y  h.m',strtotime($dateAlbum));

                                ?>
                                <div style="padding: 20px;">
                                    <div style="height:50%; border: 1px solid #DDDFE2; display:block; text-align: center;">
                                        <a href="javascript:void(0)" onclick="showSliderImage('<?=$albumPath[0]?>', '<?=$description?>', '<?=$date?>', '<?=$location?>', '<?=$albumId?>')" data-toggle="modal" data-target="#modalSliderImage">
                                            <img src="/<?= $albumPath[0] ?>" style=" width: auto;" alt="">
                                        </a>
                                    </div>
                                    <div style="height:50%; border: 1px solid #DDDFE2; display:block; text-align: center;">
                                        <a href="javascript:void(0)" onclick="showSliderImage('<?=$albumPath[1]?>', '<?=$description?>', '<?=$date?>', '<?=$location?>', '<?=$albumId?>')" data-toggle="modal" data-target="#modalSliderImage">
                                            <img src="/<?= $albumPath[1] ?>" style=" width: auto;" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Album 2 Picture-->
                        <?php
                    }
                    if ($countPicture >= 3) { ?>
                        <!--Album 3 Picture-->
                        <div style="width: 850px">
                            <div style="margin-top: 25px; border: 1px solid #DDDFE2">
                                <div style="padding: 20px">
                                    <div style="display: inline-flex">
                                        <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/17241-200.png" style="width:40px; height:40px;">
                                    </div>
                                    <div style="display: inline-block">
                                        <h3 style="color: lightgray">
                                            <a href="#">admin</a> ได้เพิ่มรูปภาพใหม่ <?= $countPicture ?> ภาพ  ที่
                                            <a href="#"><i class="icon-grey fa fa-map-marker fa-1x"></i>  <?= $locationAlbum ?></a>
                                        </h3>
                                        <p style="color: lightgrey">
                                            <?= date('d F Y  h.m',strtotime($dateAlbum)) ?> น.<?= $locationAlbum ?> <i class="fa fa-globe"></i>NNNN
                                        </p>
                                    </div>
                                </div>
                                <div style="margin-left: 25px">
                                    <p><?= $albumName ?></p>
                                </div>
                                <?php
                                $location = $locationAlbum;
                                $description = $descriptionAlbum;
                                $date = date('d F Y  h.m',strtotime($dateAlbum));
                                ?>
                                <div style="padding: 20px;">
                                    <div style="height:50%; border: 1px solid #DDDFE2; display:block; text-align: center;">
                                        <a href="javascript:void(0)" onclick="showSliderImage('<?=$albumPath[0]?>', '<?=$description?>', '<?=$date?>', '<?=$location?>', '<?=$albumId?>')" data-toggle="modal" data-target="#modalSliderImage">
                                            <img src="/<?= $albumPath[0] ?>"  style=" width: 50%;" alt="">
                                        </a>
                                    </div>
                                    <div style="width:49%; border: 1px solid #DDDFE2; display:inline-block; text-align: center;">
                                        <a href="javascript:void(0)" onclick="showSliderImage('<?=$albumPath[1]?>', '<?=$description?>', '<?=$date?>', '<?=$location?>', '<?=$albumId?>')" data-toggle="modal" data-target="#modalSliderImage">
                                            <img src="/<?= $albumPath[1] ?>" style=" width: auto;" alt="">
                                        </a>
                                    </div>
                                    <?php
                                    if(!empty($albumPath[2])){
                                    ?>
                                    <div class="containerBox">
                                        <a href="javascript:void(0)" onclick="showSliderImage('<?=$albumPath[2]?>', '<?=$description?>', '<?=$date?>', '<?=$location?>', '<?=$albumId?>')" data-toggle="modal" data-target="#modalSliderImage">
                                            <img class="img-responsive" src="/<?= $albumPath[2] ?>">
                                            <?php
                                            if($countPicture > 3){
                                                ?>
                                                <div class='text-box' style="background-color: gray;width: 100%;opacity: 0.7;height: 100%;">
                                                    <p class='dataNumber' style="margin-top: 100px;color: black;"> +<?= $countPicture-3 ?> </p>
                                                </div>
                                                <?php
                                            }
                                            $countPicture = 0 ;
                                            ?>
                                        </a>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                                <!-- Like Comment Share -->
                              <!--   <hr style="margin-bottom: 0px; margin-top: 0px;">
                                <div style="padding: 20px;">

                                    <div id="bloc1"><img src="../img/icon/like.png" style="width:15px; height:15px;"></div>
                                    <div id="bloc2">Like</div>

                                    <div id="bloc1"><img src="../img/icon/like.png" style="width:15px; height:15px;"></div>
                                    <div id="bloc2">Comment</div>

                                    <div id="bloc1"><img src="../img/icon/like.png" style="width:15px; height:15px;"></div>
                                    <div id="bloc2">Share</div>

                                </div> -->
                                <!-- End Like Comment Share -->
                            </div>
                        </div>
                        <!--Album 3 Picture-->
                        <?php
                    }
                    $albumId = NULL;
                    $albumPath = [];
                    $countPicture = 0;
                    $isAlbum = false;
                }
                $albumId = $picture[0]['picture_album'];
                $descriptionAlbum = $picture[0]['picture_description'];
                $albumName = $picture[0]['album_name'];
                $dateAlbum = date('d F Y  h.m',strtotime($picture[0]['created']));
                $locationAlbum = $picture[0]['picture_location'];
                array_push($albumPath,$picture[0]['picture_path']);

            }
        }
        else if(!empty($picture[0]['video_path'])){
            ?>
            <div style="width: 850px">
                <div style="margin-top: 25px; border: 1px solid #DDDFE2">
                    <div style="padding: 20px">
                        <div style="display: inline-flex">
                            <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/17241-200.png" style="width:40px; height:40px;">
                        </div>
                        <div style="display: inline-block">
                            <h3 style="color: lightgray">
                                <a href="#">admin</a> ได้เพิ่มวีดีโอ  ที่
                                <a href="#"><i class="icon-grey fa fa-map-marker fa-1x"></i>  <?= $picture[0]['video_location'] ?></a>
                            </h3>
                            <p style="color: lightgrey">
                                <?= date('d F Y  h.m',strtotime($picture[0]['created'])) ?> น. <?= $picture[0]['video_location'] ?> <i class="fa fa-globe"></i>
                            </p>
                        </div>
                    </div>
                    <div style="margin-left: 25px">
                        <p><?= $picture[0]['video_description'] ?></p>
                    </div>
                    <?php
                    $location = $picture[0]['video_location'];
                    $description = $picture[0]['video_description'];
                    $date = date('d F Y  h.m',strtotime($picture[0]['created']));
                    $path = $picture[0]['video_path'];
                    ?>
                    <div style="padding: 20px">
                        <a href="javascript:void(0)" onclick="showModalVideo('<?=$path?>', '<?=$description?>', '<?=$date?>', '<?=$location?>')" data-toggle="modal" data-target="#modalVideo">
                            <video class="video_player" id="player" width="100%" controls="controls">
                                <source src="/<?= $picture[0]['video_path'] ?>">
                                Your browser does not support the HTML5 video tag.  Use a better browser!
                            </video>
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }

    }
    if($isAlbum == true && $countPicture > 0){

        if($countPicture == 1){
            $countPicture = 0 ;
            ?>
            <div style="width: 850px">
                <div style="margin-top: 25px; border: 1px solid #DDDFE2">
                    <div style="padding: 20px">
                        <div style="display: inline-flex">
                            <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/17241-200.png" style="width:40px; height:40px;">
                        </div>
                        <div style="display: inline-block">
                            <h3 style="color: lightgray">
                                <a href="#">admin</a> ได้เพิ่มรูปภาพใหม่ 1 ภาพ  ที่
                                <a href="#"><i class="icon-grey fa fa-map-marker fa-1x"></i>  <?= $locationAlbum ?></a>
                            </h3>
                            <p style="color: lightgrey">
                                <?= date('d F Y  h.m',strtotime($dateAlbum)) ?> น. <?= $locationAlbum ?> <i class="fa fa-globe"></i>
                            </p>
                        </div>
                    </div>
                    <div style="margin-left: 25px">
                        <p><?= $albumName ?></p>
                    </div>
                    <?php
                    $location = $locationAlbum;
                    $description = $descriptionAlbum;
                    $date = date('d F Y  h.m',strtotime($dateAlbum));
                    $path = $albumPath[0];
                    ?>
                    <div style="padding: 20px; text-align: center;">
                        <a href="javascript:void(0)" onclick="showModalImage('<?=$path?>', '<?=$description?>', '<?=$date?>', '<?=$location?>')" data-toggle="modal" data-target="#modalImage">
                            <img src="/<?= $path ?>" style=" width: 50%;" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }
        if($countPicture <= 2){
            $countPicture = 0 ;
            ?>
            <div style="width: 850px">
                <div style="margin-top: 25px; border: 1px solid #DDDFE2">
                    <div style="padding: 20px">
                        <div style="display: inline-flex">
                            <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/17241-200.png" style="width:40px; height:40px;">
                        </div>
                        <div style="display: inline-block">
                            <h3 style="color: lightgray">
                                <a href="#">admin</a> ได้เพิ่มรูปภาพใหม่ 2 ภาพ  ที่
                                <a href="#"><i class="icon-grey fa fa-map-marker fa-1x"></i>  <?= $locationAlbum ?></a>
                            </h3>
                            <p style="color: lightgrey">
                                <?= date('d F Y  h.m',strtotime($dateAlbum)) ?> น. <?= $locationAlbum ?> <i class="fa fa-globe"></i>
                            </p>
                        </div>
                    </div>
                    <div style="margin-left: 25px">
                        <p><?= $albumName ?></p>
                    </div>
                    <?php
                    $location = $locationAlbum;
                    $description = $descriptionAlbum;
                    $date = date('d F Y  h.m',strtotime($dateAlbum));

                    ?>
                    <div style="padding: 20px;">
                        <div style="height:50%; border: 1px solid #DDDFE2; display:block; text-align: center;">
                            <a href="javascript:void(0)" onclick="showSliderImage('<?=$albumPath[0]?>', '<?=$description?>', '<?=$date?>', '<?=$location?>', '<?=$albumId?>')" data-toggle="modal" data-target="#modalSliderImage">
                                <img src="/<?= $albumPath[0] ?>" style=" width: auto;" alt="">
                            </a>
                        </div>
                        <div style="height:50%; border: 1px solid #DDDFE2; display:block; text-align: center;">
                            <a href="javascript:void(0)" onclick="showSliderImage('<?=$albumPath[0]?>', '<?=$description?>', '<?=$date?>', '<?=$location?>', '<?=$albumId?>')" data-toggle="modal" data-target="#modalSliderImage">
                                <img src="/<?= $albumPath[0] ?>" style=" width: auto;" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        if($countPicture >= 3){

            ?>
            <div style="width: 850px">
                <div style="margin-top: 25px; border: 1px solid #DDDFE2">
                    <div style="padding: 20px" class="col-sm-8">
                        <div style="display: inline-flex">
                            <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/17241-200.png" style="width:40px; height:40px;">
                        </div>
                        <div style="display: inline-block">
                            <h3 style="color: lightgray">
                                <a href="#">admin</a> ได้เพิ่มรูปภาพใหม่ <?= $countPicture ?> ภาพ  ที่
                                <a href="#"><i class="icon-grey fa fa-map-marker fa-1x"></i>  <?= $locationAlbum ?></a>
                            </h3>
                            <p style="color: lightgrey">
                                <?= date('d F Y  h.m',strtotime($dateAlbum)) ?> น. <?= $locationAlbum ?> <i class="fa fa-globe"></i>
                            </p>
                        </div>
                    </div>
                    <div style="margin-left: 25px">
                        <p><?= $descriptionAlbum ?></p>
                    </div>
                    <?php
                    $location = $locationAlbum;
                    $description = $descriptionAlbum;
                    $date = date('d F Y  h.m',strtotime($dateAlbum));
                    ?>
                    <div style="padding: 20px;">
                        <div style="height:50%; border: 1px solid #DDDFE2; display:block; text-align: center;">
                            <a href="javascript:void(0)" onclick="showSliderImage('<?=$albumPath[0]?>', '<?=$description?>', '<?=$date?>', '<?=$location?>', '<?=$albumId?>')" data-toggle="modal" data-target="#modalSliderImage">
                                <img src="/<?= $albumPath[0] ?>"  style=" width: 50%;" alt="">
                            </a>
                        </div>
                        <div style="width:49%; border: 1px solid #DDDFE2; display:inline-block; text-align: center;">
                            <a href="javascript:void(0)" onclick="showSliderImage('<?=$albumPath[1]?>', '<?=$description?>', '<?=$date?>', '<?=$location?>', '<?=$albumId?>')" data-toggle="modal" data-target="#modalSliderImage">
                                <img src="/<?= $albumPath[1] ?>" style=" width: auto;" alt="">
                            </a>
                        </div>
                        <div class="containerBox">
                            <a href="javascript:void(0)" onclick="showSliderImage('<?=$albumPath[2]?>', '<?=$description?>', '<?=$date?>', '<?=$location?>', '<?=$albumId?>')" data-toggle="modal" data-target="#modalSliderImage">
                                <img class="img-responsive" src="/<?= $albumPath[2] ?>">
                                <?php
                                if($countPicture >= 3){

                                    ?>
                                    <div class='text-box' style="background-color: gray;width: 100%;opacity: 0.7;height: 100%;">
                                        <p class='dataNumber' style="margin-top: 100px;color: black;"> +<?=$countPicture-3 ?> </p>
                                    </div>
                                    <?php
                                    $countPicture = 0 ;
                                }
                                ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Post Row -->
            <?php
        }
        $albumPath = [];
        $countPicture = 0;
        $isAlbum = false;
    }
}
?>
<!--TIMELINE-->

<!--container-->
<!--Model Select Uploadfile-->
<!-- Modal -->

<div id="SelectUploadFile" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">อัพโหลดไฟล์</h3>
    </div>
    <div class="modal-body" style="text-align:center;">
        <div style="display: inline-block; padding: 20px; border-right: solid #D9D9D9; ">
            <a href="javascript:void(0);" onclick="selectPicture()" data-dismiss="modal" style="color: #788441">อัพโหลดรูปภาพ</a>
        </div>
        <div style="display: inline-block; padding: 20px; border-right: solid #D9D9D9; ">
            <a href="javascript:void(0);" onclick="selectVideo()" data-dismiss="modal" style="color: #788441">อัพโหลดวีดีโอ</a>
        </div>
        <div style="display: inline-block; padding: 20px; ">
            <a href="javascript:void(0)" onclick="selectDocument()" data-dismiss="modal" style="color: #788441">อัพโหลดไฟล์เอกสาร</a>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>

<!--Model Select Uploadfile-->
<!--Modal Show Image-->
<!-- Modal -->
<div id="modalImage" class="modal hide fade" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="modal-body__left">
            <figure class="model-body__image" id="imageTag"></figure>
        </div>
        <div class="modal-body__right">
            <div style="">
                <h3>
                    <a href="javascript:void(0)" style="color: #65752A">
                        <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/17241-200.png" style="width:40px; height:40px;">
                        Admin
                    </a>
                    <p style="color: lightgrey; font-size: 15px;" id="imageDetailModal"></p>
                    <p id="imageDescription"></p>
                    <p id="imageLocation"></p>
                </h3>
            </div>
        </div>
    </div>
</div>
<!--Modal Slider Image-->
<div id="modalSliderImage" class="modal modal-image hide fade" tabindex="-1" style="width: auto;height: auto;" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="modal-body__left">
            <div id="myCarousel" class="carousel slide">
                <ol class="carousel-indicators">
                </ol>
                <!-- Carousel items -->
                <div class="carousel-inner" id="corouselImg">
                </div>
                <!-- Carousel nav -->
                <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
            </div>
        </div>
        <div class="modal-body__right">
            <div style="">
                <h3>
                    <a href="javascript:void(0)" style="color: #65752A">
                        <img src="https://d30y9cdsu7xlg0.cloudfront.net/png/17241-200.png" style="width:40px; height:40px;">
                        Admin
                    </a>
                    <p style="color: lightgrey; font-size: 15px;" id="imageDetailSliderModal"></p>
                    <p id="imageDescriptionSlider"></p>
                    <p id="imageLocationSlider"></p>
                </h3>
            </div>
        </div>
    </div>
</div>
<!-- Load Facebook SDK for JavaScript -->
<!--<div id="fb-root"></div>-->
<!--<script>(function(d, s, id) {-->
<!--        var js, fjs = d.getElementsByTagName(s)[0];-->
<!--        if (d.getElementById(id)) return;-->
<!--        js = d.createElement(s); js.id = id;-->
<!--        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1";-->
<!--        fjs.parentNode.insertBefore(js, fjs);-->
<!--    }(document, 'script', 'facebook-jssdk'));</script>-->
<script>
            function init() {
                var input = document.getElementById('location');
                var autocomplete = new google.maps.places.Autocomplete(input);
            }

            google.maps.event.addDomListener(window, 'load', init);
        </script>
<script src="../js/gallery/index.js"></script>
<link rel="stylesheet" type="text/css" href="../css/gallery/main.css"/>
