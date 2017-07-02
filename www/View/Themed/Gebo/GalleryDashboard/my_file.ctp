<?php
$currentUser = $this->Session->read('AuthUser');
echo $this->Html->css('font-awesome.min');
?>

<style type="text/css">
    .thumbnails img {
        height: 80px;
        border: 4px solid #555;
        padding: 1px;
        margin: 0 10px 10px 0;
    }

    .thumbnails img:hover {
        border: 4px solid #00ccff;
        cursor: pointer;
    }

    .preview img {
        border: 4px solid #444;
        padding: 1px;
        width: 800px;
    }

    table.table thead tr td {
        text-align: center;
        background-color: #E1E4CF;
    }

    table.table tbody tr td {
        vertical-align: middle;
    }

    table.table tbody tr td {
        text-align: left;
        vertical-align: middle;
    }

    table, th, td {
        border: 1px solid #ddd;
    }
</style>

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
<div data-spy="" data-target=".bs-docs-sidebar">
    <div class="contrainer">
        <div class="row">
            <!--TYPE-->
            <!-- <div style="margin-left: 40px;">
                 <a href="index" style="color: #65752A"> ไทม์ไลน์</a> |
                 <a href="javascript:void(0)" style="color: #65752A"> คลังรูปภาพ</a> |
                 <a href="video" style="color: #65752A"> คลังวีดีโอ</a> |
                 <a href="document" style="color: #65752A"> คลังเอกสาร</a>
             </div> -->
            <div class="span12" style="text-align: center; margin-top: 20px;">
                <!--picture-->
                <section id="#picture">
                    <div style="display: inline-block; ">
                        <h3 style="color: #606060">
                            คลังรูปภาพ
                        </h3>
                    </div>
                    <div style="display: inline-block; margin-left: 30%;">
                        <!--<div style="margin: 10px; display: inline; background: #EFF0E8; border: 1px solid #BBBFAB">
                            <a class="" style="color: #65752A;padding: 10px;" data-toggle="modal" href="#uploadModal"><i class="fa fa-camera"></i> อัพโหลดรูปภาพ</a>
                        </div>
                        <div style="margin: 10px; display: inline; background: #EFF0E8; border: 1px solid #BBBFAB">
                            <a class="" style="color: #65752A; padding: 10px;" data-toggle="modal" href="#uploadModal"><i class="fa fa-file-image-o"></i> สร้างอัลบั้มรูปภาพ</a>
                        </div>-->

                        <a class="active" style="margin: 10px; color: #65752A" onclick="showListView()" href="#"><i class="icon-th-list"></i>List View</a>
                        <a class="" style="margin: 10px; color: #65752A" onclick="showGridView()" href="#"><i class="icon-th-large"></i>Grid View</a>
                    </div>
                    <br>
                    <div class="content" style="margin-top: 15px;">
                        <div class="list-view">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td>
                                        ลำดับ
                                    </td>
                                    <td>
                                        ประเภทไฟล์
                                    </td>
                                    <td colspan="2">
                                        ชื่อ
                                    </td>
                                    <td>
                                        คำอธิบาย
                                    </td>
                                    <td>
                                        วันที่สร้าง
                                    </td>
                                    <td>
                                        ขนาดไฟล์
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(count($picture)==0 && count($albums) == 0){
                                    echo "
                              <tr>
                                <td colspan='5' style='text-align:center;'><h3>ไม่พบไฟล์</h3></td>
                              </tr>
                            ";
                                }
                                $No = 1;
                                foreach($picture as $row){
                                    $date = strtotime($row[0]['created']);
                                    $date = date("d-m-Y", $date);
                                    $size = number_format($row[0]['size']/1000000, 2);
                                    echo "
                                    <tr>
                                    <td style=\"text-align: center !important;\">
                                        $No
                                    </td>
                                    <td>
                                        <img src='../img/icon/photo.png' style=\"width:40px; height:40px;\">
                                    </td>
                                    <td>
                                        <a href='javascript:void(0)' onclick='showModalImage(\"/". $row[0]['path']."\")' data-toggle='modal' data-target='#showImage'>
                                        <img style='height: 60px' src='/".$row[0]['path']."'></img>
                                        </a>
                                    </td>
                                    <td>
                                        ".$row[0]['name']."
                                    </td>
                                    <td>
                                        ".$row[0]['description']."
                                    </td>
                                    <td>
                                        ".$date."
                                    </td>
                                    <td>
                                    ".$size." MB
                                    </td>
                                    <td>
                                        <a href='javascript:void(0)' data-toggle='modal' data-target='#editModal' onclick='editImage(\"".$row[0]['id']."\")'><i class='fa fa-pencil'></i></a>
                                        <a href='/".$row[0]['path']."' download><i class=\"fa fa-download\"></i></a>
                                        <a href='javascript:void(0)' onclick='del(\"".$row[0]['id']."\",\"".$row[0]['post_id']."\")'><i class='fa fa-trash'></i> </a>
                                    </td>
                                    </tr>
                                ";
                                    $No++;
                                }
                                foreach($albums as $album){
                                    $albumDate = strtotime($album[0]['created']);
                                    $albumDate = date("d-m-Y", $albumDate);
                                    ?>
                                    <tr>
                                        <td style="text-align: center !important;">
                                            <?= $No ?>
                                        </td>
                                        <td>
                                            <img src="../img/icon/album.png" style="width:40px; height:40px;">
                                        </td>
                                        <td colspan="2">
                                            <a href="showAlbum?id=<?= $album[0]['id']?>" > <?= $album[0]['album_name'] ?> </a>
                                        </td>
                                        <td>
                                            <?= $album[0]['album_description'] ?>
                                        </td>
                                        <td>
                                            <?= $albumDate ?>
                                        </td>
                                        <td>

                                        </td>

                                        <td>
                                            <a href='edit_album?id=<?= $album[0]['id'] ?>'><i class="fa fa-pencil"></i></a>
                                            <a href='javascript:void(0)' onclick='delAlbum("<?= $album[0]['id'] ?>","<?= $album[0]['post_id'] ?>")'><i class='fa fa-trash'></i> </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $No++;
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="grid-view" hidden>
                            <table class="table" style="">
                                <thead>
                                <tr>
                                    <td colspan="3" style="height: 20px;border-bottom: 1px gray solid;"></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(count($picture)==0){
                                    echo "
                                            <tr>
                                                <td colspan='5' style='text-align:center;'><h3>ไม่พบไฟล์</h3></td>
                                            </tr>
                                            ";
                                }
                                $no=1;
                                foreach($picture as $row){
                                    if($no == 1){
                                        echo "<tr clas ='noBorder'>";
                                    }
                                    ?>
                                    <td>
                                        <div style="margin: 30px; width:280px; border: 1px solid #DFE3CD">
                                            <div>
                                                <a href="javascript:void(0)" onclick="showModalImage('/<?= $row[0]['path']?>')" data-toggle="modal" data-target="#showImage">
                                                    <img src="/<?= $row[0]['path']?>" style="width: 280px; height: 280px">
                                                </a>
                                            </div>
                                            <div style="height: 50px; vertical-align: middle; background: #F7F8F4">
                                                <div style="float: left;padding: 10px;">
                                                    <span> <?= $row[0]['name'] ?> </span>
                                                </div>
                                                <div style="float: right;padding: 10px;">
                                                    <a href="javascipt:void(0)" onclick="del('<?= $row[0]['id']?>','<?= $row[0]['post_id']?>')">
                                                        <i style="text-align: right" class="fa fa-trash fa-2x"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <?php
                                    $no++;
                                    if($no == 4 ){
                                        echo "</tr>";
                                        $no=1;
                                    }
                                }
                                foreach ($albums as $album){
                                    if($no == 1){
                                        echo "<tr clas ='noBorder'>";
                                    }
                                    ?>
                                    <td>
                                        <div style="margin: 30px; width:280px; border: 1px solid #DFE3CD">
                                            <div>
                                                <i class="fa fa-file-image-o" style="font-size: 280px;"></i>
                                            </div>
                                            <div style="height: 50px; vertical-align: middle; background: #F7F8F4">
                                                <div style="float: left;padding: 10px;">
                                                            <span>
                                                                <a href="showAlbum?id=<?= $album[0]['id']?>">
                                                                    <?= $album[0]['album_name'] ?>
                                                                </a>
                                                            </span>
                                                </div>
                                                <div style="float: right;padding: 10px;">
                                                    <a href="javascipt:void(0)" onclick="del('<?= $row[0]['id']?>','<?= $row[0]['post_id']?>')">
                                                        <i style="text-align: right" class="fa fa-trash fa-2x"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <?php
                                    $no++;
                                    if($no == 4 ){
                                        echo "</tr>";
                                        $no=1;
                                    }
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Picture</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <?= $this->Form->create($uploadData, ['type' => 'file']); ?>
                    <?php echo $this->Form->input('file', ['type' => 'file', 'class' => 'form-control']); ?>
                    <?php echo $this->Form->button(__('Upload File'), ['type'=>'submit', 'class' => 'form-control btn btn-primary']); ?>
                    <?php echo $this->Form->end(); ?>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!--BODY-->




<!-- Modal -->
<div id="showImage" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body" style="text-align: center;">
        <img id="imageTag" style="height: 100%;width: 100%;">
    </div>
</div>


<!--Edit Modal -->
<div id="editModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <?= $this->Form->create(false, array('url' => array('controller' => 'GalleryDashboard', 'action' => 'editImageDetail'))) ?>
    <div class="modal-body">
        <input type="hidden" id="editId" name="id">
        <p>
            คำอธิบาย :
            <input type="text" name="description" value="" id="editDescription">
        </p>
        <p>
            สถานที่ :
            <input type="text" name="location" value="" id="editLocation">
        </p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary">Save changes</button>
    </div>
</div>
<?= $this->Form->end();?>


<script>
  function editImage(id){
    console.log(id);
    $.ajax({
      url: "editPicture",
      method:'post',
      dataType: 'json',
      data:{
        id:id
      },
      success: function(data){
        $("#editDescription").val(data.description);
        $("#editLocation").val(data.location);
        $("#editId").val(data.id);
      }

    });
  }
  function showModalImage(path){
    $("#imageTag").attr('src',path);
  }
  function showListView() {
    $(".grid-view").hide("slow");
    $(".list-view").show(500);
  }

  function showGridView() {
    $(".list-view").hide("slow");
    $(".grid-view").show(500);
  }

  function del(id, post_id){
    if(confirm("คุณต้องการลบรุปภาพหรือไม่")){
      $.ajax({
        method: 'post',
        url: 'deletePicture',
        data: {
          id: id,
          post_id: post_id
        },
        success: function(data){
          location.reload();
        }
      });
    }
    else{
      return;
    }
  }

  function delAlbum(albumID, postID){
    if(confirm("คุณต้องการลบอัลบั้มหรือไม่")){
      $.ajax({
        method: 'post',
        url: 'deleteAlbum',
        data: {
          albumID: albumID,
          postID: postID
        },
        success: function(data){
          location.reload();
        }
      });
    }
    else{
      return;
    }
  }
</script>