<?php
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
<script>
  function del(id){
    if(confirm("คุณต้องการเอกสารหรือไม่")){
      $.ajax({
        method: 'post',
        url: 'deleteDocument',
        data: {
          id: id
        },
        success: function(data){
          // console.log(data);
          location.reload();
        }
      });
    }
  }
</script>
<div id="jCrumbs" class="breadCrumb module">
    <div style="overflow:hidden; position:relative; width: 967px;">
        <div>
            <ul style="width: 5000px;">
                <li class="first">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="last">
                    ระบบเอกสาร
                </li>
            </ul>
        </div>
    </div>
</div>
<div style="margin-left: 40px;">
    <a href="index" style="color: #65752A"> ไทม์ไลน์</a> |
    <a href="myFile" style="color: #65752A"> คลังรูปภาพ</a> |
    <a href="video" style="color: #65752A"> คลังวีดีโอ</a> |
    <a href="document" style="color: #65752A"> คลังเอกสาร</a>
</div>
<br><br>
<div style="margin: 10px; display: inline; background: #EFF0E8; border: 1px solid #BBBFAB">
    <a class="" style="color: #65752A;padding: 10px;" data-toggle="modal" href="#uploadModal"><i class="fa fa-folder-open"></i> อัพโหลดเอกสาร</a>
</div>
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
            $no=1;
            foreach($document as $row){
                $date = strtotime($row[0]['created_at']);
                $date = date("d-m-Y", $date);
                ?>
                <tr>
                    <td>
                        <?= $no ?>
                    </td>
                    <td>
                        <? if (strpos($row[0]['name'], 'xlsx') !== false) { ?>
                            <img src="../img/icon/excel.png" style="width:40px; height:40px;">
                        <? } elseif (strpos($row[0]['name'], 'pdf') !== false) { ?>
                            <img src="../img/icon/pdf.png" style="width:40px; height:40px;">
                        <? } elseif (strpos($row[0]['name'], 'docx') !== false) { ?>
                            <img src="../img/icon/word.png" style="width:40px; height:40px;">
                        <? } elseif (strpos($row[0]['name'], 'pptx') !== false) { ?>
                            <img src="../img/icon/powerpoint.png" style="width:40px; height:40px;">
                        <? } ?>
                    </td>
                    <td colspan="2">
                        <?= $row[0]['name'] ?>
                    </td>
                    <td>
                        <?= $date ?>
                    </td>
                    <td>
                        <?=  round($size = $row[0]['size']/1000000, 1); ?> MB
                    </td>
                    <td>
                        <a href="/<?= $row[0]['path']?>" download><i class="fa fa-download"></i></a>
                        <a href="javascript:void(0)" onclick="del('<?= $row[0]['id']?>')"><i class="fa fa-trash"></i></a>
                    </td>

                </tr>
                <?
                $no++;
            }
            ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal -->
<div id="uploadModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">อัพโหลดเอกสาร</h3>
    </div>
    <div class="modal-body">
        <?php
        echo $this->Form->create("Gallery",array(
            'type' => 'file',
            'url'=> array('controller'=>'GalleryDashboard','action'=>'uploadDocument')));
        ?>
        <input type="file" name="data[Document][]">

    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary" type="submit">Upload</button>
    </div>
    <?php
    echo $this->Form->end();
    ?>
</div>