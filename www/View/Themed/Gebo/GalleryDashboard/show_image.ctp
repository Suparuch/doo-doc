<?php 
$currentUser = $this->Session->read('AuthUser');
function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
	}
?>
<style>
    .gallery-select{
        border: 1px solid #dddfe2;
        padding: 20px 10px;
        display: inline-block;
        width: 100%;
        box-sizing: border-box;
    }
    .btn-select{
        background-color: #f6f7f9;
        padding: 10px 15px;
        border-radius: 5px;
        margin-right: 10px;
        text-decoration: none;
        color: #000;
    }
    .gallery-box-avatar{
        display: inline-block;
        width: 80px;
        padding-right: 20px;
    }.gallery-box-avatar img{
        width: 100%;
        height: 64px;
        object-fit: contain;
    }
    .gallery-box-title{
        vertical-align: middle;
        display: inline-block;
        font-size: 16px;
        line-height: 20px;
    }
    .gallery-box-row{
        display: table;
        width: 100%;
        margin: 20px 0px;
    }
    .gallery{
        font-size: 16px;
        line-height: 20px;
    }
    .txt-12{
        font-size: 12px;
    }
</style>
<div id="jCrumbs" class="breadCrumb module">
              <div style="overflow:hidden; position:relative; width: 100%;">
                <div>
                  <div style="overflow:hidden; position:relative; width: 967px;">
                      <div><ul style="width: 5000px;">
                    <li class="first"> <a href="myFile"><i class="icon-home"></i></a> </li>
                    <li class="last"> ระบบคลังภาพ </li>
                  </ul>
                  </div>
                  </div>
              </div>
              </div>
</div>

<!--<div style="margin-top: -32px;margin-left: -31px;width: 106%">
    <div class="well well-large">
       <h2>
            Picture's Details
       </h2>
    </div>
</div>-->

<div class="gallery-box">
            <div class="gallery-select">
                <a href="" class="btn-select"><img src="/img/gallery/img.png" alt=""> รูปภาพ/วิดีโอ </a> 
                <a href="" class="btn-select"><img src="/img/gallery/album.png" alt=""> อัลบั้มรูป </a> 
            </div>
            <div class="gallery-box-row">
                <div class="gallery-box-avatar">
                    <img src="/img/gallery/user.png" style="height: 80px;">
                </div>
                <div class="gallery-box-title">
                        <?php echo $currentUser['UserProfile']['name'] ?>
                        ได้เพิ่มรูปภาพใหม่ 1 ภาพ - ที่
                        <img src="/img/gallery/location.png">
                        <?php echo $data['location'] ?>
                        <br>
                        <span class="txt-12">
                            <?php 
                                 $date = DateThai($data['createtime']);
                            ?>
                            <?= $date ?>
                             <!--Create by <?= $data['userid']?> on <?= $date?> | <a><i class="icon-grey icon-star"></i> รายการโปรด</a> | <a><i class="icon-grey icon-thumbs-up"></i> Like</a> |
                            <a><i class="icon-grey icon-comment"> </i> แสดงความคิดเห็น</a> | <a><i class="icon-grey icon-share"></i> แบ่งปัน</a>
                            <a href="/<?php echo $data['filepath'].$data['filename']?>" download  class="btn btn-primary"><i class="icon-download-alt"></i>ดาวโหลด</a>-->
                        </span>
                </div>
            </div>
</div>
<div style="margin-top: 10px;">
    <div class="show_img">
        <img src="/<?php echo $data['filepath'].$data['filename']?>" style="height:600;" >
    </div>
    <div>
        <h3>รายละเอียด</h3>
        <p>
            <?php echo $data['describtion']; ?>
            <a href="" data-toggle="modal" onclick="editDescribtion(<?php echo $data['id']?>)"><i class="icon-pencil"></i></a>
        </p>
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
        <?php
        
            
        ?>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>