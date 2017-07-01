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
        text-align: center;
        vertical-align: middle;
    }
    
    tr.noBorder td {
        border: 0;
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
                qwef
                    ระบบคลังภาพกองทัพบก
                </li>
            </ul>
        </div>
    </div>
</div>
<!--Menu-->
<div>
    <div style="margin-left: 40px;">
        <a href="index" style="color: #65752A"> แดชบอร์ด</a> |
        <a href="myFile" style="color: #65752A"> คลังรูปภาพ</a> |
        <a href="video" style="color: #65752A"> คลังวีดีโอ</a> |
        <a href="document" style="color: #65752A"> คลังเอกสาร</a>
    </div>
</div>
<!--Menu-->
<br>

<!--SHOW ALBUM-->
<div style="text-align: center;">
    <div style="display: inline-block; ">
        <h3 style="color: #606060">
            <?= $album['album_name'] ?> อัลบั้ม
        </h3>
    </div>
    <div style="display: inline-block; margin-left: 30%;">
        <a href="edit_album?id=<?= $album['id'] ?>" style="margin: 10px; color: #65752A"> <i class="fa fa-pencil"></i>  แก้ไขอัลบั้ม</a>
        <a class="" style="margin: 10px; color: #65752A" onclick="showListView()" href="#"><i class="icon-th-list"></i>List View</a>
        <a class="" style="margin: 10px; color: #65752A" onclick="showGridView()" href="#"><i class="icon-th-large"></i>Grid View</a>
    </div>
</div>

<!--CONTENT-->
<!--List View-->
<div class="list-view">
   <table class="table">
      <thead>
         <tr>
            <td>
               ลำดับ
            </td>
            <td colspan="2">
               ชื่อ
            </td>
            <td>
               คำอธิบาย
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
        $rowNo = 1;
            if(count($pictures) == 0){
                echo "<tr>
                    <td colspan='3'>ไม่มีรูปภาพ</td>
                </tr>";
                return;
            }
        foreach($pictures as $picture){
            ?>
            <tr>
                <td>
                    <?= $rowNo ?>
                </td>
                <td>
                    <a href="javascript:void(0)" onclick="showModalImage('/<?= $picture[0]['path'] ?>')" data-toggle="modal" data-target="#showImage">
                        <img style='height: 40px' src="/<?= $picture[0]['path'] ?>">
                    </a>
                    
                </td>
                <td>
                    <?= $picture[0]['name'] ?>
                </td>
                <td>
                    <?= $album['album_description'] ?>
                </td>
                <td>
                    <?= number_format($picture[0]['size']/1000000, 2) ?> MB
                </td>
            </tr>
            <?php
            $rowNo++;
        }
      ?>
      </tbody>
   </table>
</div>

<!--Grid View-->
<div class="grid-view" style="display:none">
<?php
    $item = 1;
    foreach($pictures as $picture){
        if($item == 3 ){
            $item = 1;
            echo "<br>";
        }
     ?>
            <div style="margin: 30px; width:280px; border: 1px solid #DFE3CD; display:inline-block">
                 <div>
                    <img src="/<?= $picture[0]['path']?>" style="width: 280px; height: 280px">
                </div>
                <div style="height: 50px; vertical-align: middle; background: #F7F8F4">
                    <div style="float: left;padding: 10px;">
                        <span>
                            <?= $picture[0]['name'] ?> 
                        </span>
                    </div>
            </div>
         </div>
     <?php
    }
?>
</div>                                 



<!-- Modal -->
<div id="showImage" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"></h3>
  </div>
  <div class="modal-body" style="text-align: center;">
    <img id="imageTag" style="height: 100%;width: 100%;">
  </div>
</div>


<script>
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
</script>