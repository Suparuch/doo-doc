<?php 
		$default = $ModelDocuments;
		$model_id = $ModelRates['ModelRate']['id'];
		$model_type_id = $ModelRates['ModelRate']['model_type_id'];		
?>

<script>
	function uploaderHide(model_category_id){
		$('#uploader'+model_category_id).hide();
	}
</script>

<table class="table table-bordered">
	<thead>
		<tr>
			<th rowspan="2">ข้อมูล ทบ. <?php // echo $ModelTypeShorts[$model_type_id];?></th>
			<th rowspan="2">ข้อมูล กลาโหม</th>
			<th rowspan="2">แสดงผล</th>

		</tr>
	</thead>

	<tbody>
	
	<tr>
	<td>	
	<div class='att_army'>

	<?php
	foreach($ModelFile1 as $file){
		?>
        <a href='/files/model/<?php echo $file['ModelFile']['model_id'];?>/<?php echo $file['ModelFile']['file_src'];?>' target="_blank"><?php echo $file['ModelFile']['origin'];?></a>&nbsp;&nbsp;&nbsp;
        <a href="javascript:;" onclick="deletemodelfile('<?php echo $file['ModelFile']['id'];?>')">
        <i class="icon-trash"></i> </a>
        <a  href='/files/model/<?php echo $file['ModelFile']['model_id'];?>/<?php echo $file['ModelFile']['file_src'];?>' target="_blank"><i class="icon-print"></i></a>
	<br />
        <?php
	}
	?>
	</div>
    <form action='/ModelRates/saveDocument/<?php echo $model_id;?>/1' id='form1' method="post" enctype="multipart/form-data"> 
    <input type='hidden' value='<?php echo $model_id;?>' name='model_id' />
	<input type="file" name="upload_army_doc" id="upload_army_doc" value="แนบไฟล์คำสั่ง" onchange="upload_doc('form1')"/>
    </form>
    </td>
	<td>
	<div class='att_corp'>

	<?php
	foreach($ModelFile2 as $file){
		?>
        <a href='/files/model/<?php echo $file['ModelFile']['model_id'];?>/<?php echo $file['ModelFile']['file_src'];?>' target="_blank"><?php echo $file['ModelFile']['origin'];?></a>&nbsp;&nbsp;&nbsp;
        <a href="javascript:;" onclick="deletemodelfile('<?php echo $file['ModelFile']['id'];?>')">
        <i class="icon-trash"></i> </a>
        <a  href='/files/model/<?php echo $file['ModelFile']['model_id'];?>/<?php echo $file['ModelFile']['file_src'];?>' target="_blank"><i class="icon-print"></i></a>
	<br />
        <?php
	}
	?>
	</div>
    <form action='/ModelRates/saveDocument/<?php echo $model_id;?>/2' id='form2' method="post" enctype="multipart/form-data"> 
    <input type='hidden' value='<?php echo $model_id;?>' name='model_id' />
	<input type="file" name="upload_army_doc" id="upload_army_doc" value="แนบไฟล์คำสั่ง" onchange="upload_doc('form2')"/>
    </form>
    
    </td>
	<td></td>
	</tr>
		<tr>
			<td>
				<?php $model_category_id = 1;?>
				<div id="document<?php echo $model_category_id;?>" >
				<?php
				$document_key = '';
				if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
					$document_id = $Document['ModelDocument']['id'];
					$document_key = $Document['ModelDocument']['key'];
					//echo $Document['ModelDocument']['name'];
				?>	
					<div id="document<?php echo $document_id.'-'.$model_category_id;?>" >
					<a href='<?php echo $this->Html->url('/FileProviders/index/'.$document_key, true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
					<i class="icon-remove" onclick=removeDocument('<?php echo $document_id;?>','<?php echo $model_category_id;?>');></i>
					</div>
				<?php 
					}
				}
				?>		
				</div>
				<input type="button" name="button" id="uploader<?php echo $model_category_id;?>" value="แนบไฟล์ <?php echo $ModelTypeShorts[$model_type_id]. ' ' .$ModelCategorys[$model_category_id];?>" />
				<?php echo empty($document_key)? '' : '<script>uploaderHide('.$model_category_id.');</script>';?>
	
			</td>
			<td>
				<?php $model_category_id = 7;?>
				<div id="document<?php echo $model_category_id;?>" >
				<?php
				$document_key = '';
				if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
					$document_id = $Document['ModelDocument']['id'];
					$document_key = $Document['ModelDocument']['key'];
					//echo $Document['ModelDocument']['name'];
				?>	
					<div id="document<?php echo $document_id.'-'.$model_category_id;?>" >
					<a href='<?php echo $this->Html->url('/FileProviders/index/'.$document_key, true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
					<i class="icon-remove" onclick=removeDocument('<?php echo $document_id;?>','<?php echo $model_category_id;?>');></i>
					</div>
				<?php 
					}
				}
				?>		
				</div>
				<input type="button" name="button" id="uploader<?php echo $model_category_id;?>" value="แนบไฟล์ <?php echo $ModelCategorys[$model_category_id];?>" /><br>
				<?php echo empty($document_key)? '' : '<script>uploaderHide('.$model_category_id.');</script>';?>
			</td>
			<td></td>
		</tr>
		<tr>
			<td>
				<?php $model_category_id = 2;?>
				<div id="document<?php echo $model_category_id;?>" >
				<?php
				$document_key = '';
				if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
					$document_id = $Document['ModelDocument']['id'];
					$document_key = $Document['ModelDocument']['key'];
					//echo $Document['ModelDocument']['name'];
				?>	
					<div id="document<?php echo $document_id.'-'.$model_category_id;?>" >
					<a href='<?php echo $this->Html->url('/FileProviders/index/'.$document_key, true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
					<i class="icon-remove" onclick=removeDocument('<?php echo $document_id;?>','<?php echo $model_category_id;?>');></i>
					</div>
				<?php 
					}
				}
				?>		
				</div>
				<input type="button" name="button" id="uploader<?php echo $model_category_id;?>" value="แนบไฟล์ <?php echo $ModelTypeShorts[$model_type_id]. ' ' .$ModelCategorys[$model_category_id];?>" />
				<?php echo empty($document_key)? '' : '<script>uploaderHide('.$model_category_id.');</script>';?>

				<?php $model_category_id = 3;?>
				<div id="document<?php echo $model_category_id;?>" >
				<?php
				$document_key = '';
				if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
					$document_id = $Document['ModelDocument']['id'];
					$document_key = $Document['ModelDocument']['key'];
					//echo $Document['ModelDocument']['name'];
				?>	
					<div id="document<?php echo $document_id.'-'.$model_category_id;?>" >
					<a href='<?php echo $this->Html->url('/FileProviders/index/'.$document_key, true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
					<i class="icon-remove" onclick=removeDocument('<?php echo $document_id;?>','<?php echo $model_category_id;?>');></i>
					</div>
				<?php 
					}
				}
				?>		
				</div>
				<input type="button" name="button" id="uploader<?php echo $model_category_id;?>" value="แนบไฟล์ <?php echo $ModelCategorys[$model_category_id];?>" />
				<?php echo empty($document_key)? '' : '<script>uploaderHide('.$model_category_id.');</script>';?>

			</td>
			<td>
				<?php $model_category_id = 8;?>
				<div id="document<?php echo $model_category_id;?>" >
				<?php
				$document_key = '';
				if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
					$document_id = $Document['ModelDocument']['id'];
					$document_key = $Document['ModelDocument']['key'];
					//echo $Document['ModelDocument']['name'];
				?>	
					<div id="document<?php echo $document_id.'-'.$model_category_id;?>" >
					<a href='<?php echo $this->Html->url('/FileProviders/index/'.$document_key, true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
					<i class="icon-remove" onclick=removeDocument('<?php echo $document_id;?>','<?php echo $model_category_id;?>');></i>
					</div>
				<?php 
					}
				}
				?>		
				</div>
				<input type="button" name="button" id="uploader<?php echo $model_category_id;?>" value="แนบไฟล์ <?php echo $ModelCategorys[$model_category_id];?>" />
				<?php echo empty($document_key)? '' : '<script>uploaderHide('.$model_category_id.');</script>';?>

			</td>
			<td></td>
		</tr>
		<tr>
			<td>
				<?php $model_category_id = 4;?>
				<div id="document<?php echo $model_category_id;?>" >
				<?php
				$document_key = '';
				if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
					$document_id = $Document['ModelDocument']['id'];
					$document_key = $Document['ModelDocument']['key'];
					//echo $Document['ModelDocument']['name'];
				?>	
					<div id="document<?php echo $document_id.'-'.$model_category_id;?>" >
					<a href='<?php echo $this->Html->url('/FileProviders/index/'.$document_key, true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
					<i class="icon-remove" onclick=removeDocument('<?php echo $document_id;?>','<?php echo $model_category_id;?>');></i>
					</div>
				<?php 
					}
				}
				?>		
				</div>
				<input type="button" name="button" id="uploader<?php echo $model_category_id;?>" value="แนบไฟล์ <?php echo $ModelCategorys[$model_category_id];?>" />
				<?php echo empty($document_key)? '' : '<script>uploaderHide('.$model_category_id.');</script>';?>

			</td>
			<td>
				<?php $model_category_id = 9;?>
				<div id="document<?php echo $model_category_id;?>" >
				<?php
				$document_key = '';
				if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
					$document_id = $Document['ModelDocument']['id'];
					$document_key = $Document['ModelDocument']['key'];
					//echo $Document['ModelDocument']['name'];
				?>	
					<div id="document<?php echo $document_id.'-'.$model_category_id;?>" >
					<a href='<?php echo $this->Html->url('/FileProviders/index/'.$document_key, true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
					<i class="icon-remove" onclick=removeDocument('<?php echo $document_id;?>','<?php echo $model_category_id;?>');></i>
					</div>
				<?php 
					}
				}
				?>		
				</div>
				<input type="button" name="button" id="uploader<?php echo $model_category_id;?>" value="แนบไฟล์ <?php echo $ModelCategorys[$model_category_id];?>" /><br>
				<?php echo empty($document_key)? '' : '<script>uploaderHide('.$model_category_id.');</script>';?>

				<input type="button" name="button" id="button-add" value="อัตรา <?php echo $ModelTypeShorts[$model_type_id];?> กลาโหม ตอนที่ 3" />		
			</td>
			<td>
				<!--
				<input type="button" name="button" id="button-add" value="พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. ตอนที่ 3 มีอัตราลด 3" /><br>
				<input type="button" name="button" id="button-add" value="พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. รวม ตอนที่ 3" /><br>
				<input type="button" name="button" id="button-add" value="พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. ตอนที่ 3" />
				-->
				<?php if($model_type_id==1){?>
				<a href="../../ModelRates/printModelRate/Property/<?php echo $model_id;?>/Group" class="btn" target="_blank">พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. รวม ตอนที่ 3</a><br>
                
					<a href="../../ModelRates/printModelRate/Property/<?php echo $model_id;?>" class="btn" target="_blank">พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. ตอนที่ 3</a><br>
                    <a href="../../ModelRates/printModelRate/Property/<?php echo $model_id;?>/?type=excel" class="btn" target="_blank">Export <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. ตอนที่ 3</a><br>
					<a href="../../ModelRates/printModelRate/Property/<?php echo $model_id;?>/Group/Decrease3" class="btn" target="_blank">พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. รวม ตอนที่ 3 มีอัตราลด 3</a><br>
					<a href="../../ModelRates/printModelRate/Property/<?php echo $model_id;?>/Decrease3" class="btn" target="_blank">พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. ตอนที่ 3 มีอัตราลด 3</a><br>
					
					
				<?php }else if($model_type_id==2){?>
					<a href="../../ModelRates/printModelRate/Property/<?php echo $model_id;?>" class="btn" target="_blank">พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. ตอนที่ 3</a>
                     <a href="../../ModelRates/printModelRate/Property/<?php echo $model_id;?>/?type=excel" class="btn" target="_blank">Export <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. ตอนที่ 3</a>
				<?php } ?>
			</td>
		</tr>
		<?php if($model_type_id==1){?>
		<tr>
			<td>
			<?php $model_category_id = 5;?>
			<div id="document<?php echo $model_category_id;?>" >
			<?php
			$document_key = '';
			if(!empty($ModelDocuments[$model_category_id])){ 
				$Documents = $ModelDocuments[$model_category_id];
				foreach($Documents as $Document){ 
				$document_id = $Document['ModelDocument']['id'];
				$document_key = $Document['ModelDocument']['key'];
				//echo $Document['ModelDocument']['name'];
			?>	
				<div id="document<?php echo $document_id.'-'.$model_category_id;?>" >
				<a href='<?php echo $this->Html->url('/FileProviders/index/'.$document_key, true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
				<i class="icon-remove" onclick=removeDocument('<?php echo $document_id;?>','<?php echo $model_category_id;?>');></i>
				</div>
			<?php 
				}
			}
			?>		
			</div>
			<input type="button" name="button" id="uploader<?php echo $model_category_id;?>" value="แนบไฟล์ <?php echo $ModelCategorys[$model_category_id];?>" />
			<?php echo empty($document_key)? '' : '<script>uploaderHide('.$model_category_id.');</script>';?>

				<input type="button" style="display:none" name="button" id="uploader6" value="แนบไฟล์ <?php echo $ModelCategorys[$model_category_id];?>" />
			</td>
			<td>
				<?php $model_category_id = 10;?>
				<div id="document<?php echo $model_category_id;?>" >
				<?php
				$document_key = '';
				if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
					$document_id = $Document['ModelDocument']['id'];
					$document_key = $Document['ModelDocument']['key'];
					//echo $Document['ModelDocument']['name'];
				?>	
					<div id="document<?php echo $document_id.'-'.$model_category_id;?>" >
					<a href='<?php echo $this->Html->url('/FileProviders/index/'.$document_key, true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
					<i class="icon-remove" onclick=removeDocument('<?php echo $document_id;?>','<?php echo $model_category_id;?>');></i>
					</div>
				<?php 
					}
				}
				?>		
				</div>
				<input type="button" name="button" id="uploader<?php echo $model_category_id;?>" value="แนบไฟล์ <?php echo $ModelCategorys[$model_category_id];?>" /><br>
				<?php echo empty($document_key)? '' : '<script>uploaderHide('.$model_category_id.');</script>';?>
				<input type="button" name="button" id="uploader" value="อัตรา <?php echo $ModelTypeShorts[$model_type_id];?> กลาโหม ตอนที่ 4" />

				<input type="button" style="display:none" name="button" id="uploader11" value="แนบไฟล์ <?php echo $ModelCategorys[$model_category_id];?>" />
			</td>
			<td>
				<!--
				<input type="button" name="button" id="button-add" value="พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. รวม ตอนที่ 4" /><br>
				<input type="button" name="button" id="button-add" value="พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. ตอนที่ 4" />
				-->
					<a href="../../ModelRates/printModelRate/Equipment/<?php echo $model_id;?>/Group" class="btn" target="_blank">พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. รวม ตอนที่ 4</a><br>
				<a href="../../ModelRates/printModelRate/Equipment/<?php echo $model_id;?>" class="btn" target="_blank">พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. ตอนที่ 4</a><br>
				<a href="../../ModelRates/printModelRate/Equipment/<?php echo $model_id;?>/Group/Decrease3" class="btn" target="_blank">พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. รวม ตอนที่ 4 มีอัตราลด 3</a><br>
				<a href="../../ModelRates/printModelRate/Equipment/<?php echo $model_id;?>/Decrease3" class="btn" target="_blank">พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. ตอนที่ 4 มีอัตราลด 3</a><br>
				
			
			</td>
		</tr>
		<?php }else if($model_type_id==2){?>

		<tr>
			<td>
				<?php $model_category_id = 5;?>
				<div id="document<?php echo $model_category_id;?>" >
				<?php
				$document_key = '';
				if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
					$document_id = $Document['ModelDocument']['id'];
					$document_key = $Document['ModelDocument']['key'];
					//echo $Document['ModelDocument']['name'];
				?>	
					<div id="document<?php echo $document_id.'-'.$model_category_id;?>" >
					<a href='<?php echo $this->Html->url('/FileProviders/index/'.$document_key, true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
					<i class="icon-remove" onclick=removeDocument('<?php echo $document_id;?>','<?php echo $model_category_id;?>');></i>
					</div>
				<?php 
					}
				}
				?>		
				</div>
				<input type="button" name="button" id="uploader<?php echo $model_category_id;?>" value="แนบไฟล์ <?php echo $ModelCategorys[$model_category_id];?>" />
				<?php echo empty($document_key)? '' : '<script>uploaderHide('.$model_category_id.');</script>';?>

			</td>
			<td>
				<?php $model_category_id = 10;?>
				<div id="document<?php echo $model_category_id;?>" >
				<?php
				$document_key = '';
				if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
					$document_id = $Document['ModelDocument']['id'];
					$document_key = $Document['ModelDocument']['key'];
					//echo $Document['ModelDocument']['name'];
				?>	
					<div id="document<?php echo $document_id.'-'.$model_category_id;?>" >
					<a href='<?php echo $this->Html->url('/FileProviders/index/'.$document_key, true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
					<i class="icon-remove" onclick=removeDocument('<?php echo $document_id;?>','<?php echo $model_category_id;?>');></i>
					</div>
				<?php 
					}
				}
				?>		
				</div>
				<input type="button" name="button" id="uploader<?php echo $model_category_id;?>" value="แนบไฟล์ <?php echo $ModelCategorys[$model_category_id];?>" />
				<?php echo empty($document_key)? '' : '<script>uploaderHide('.$model_category_id.');</script>';?>		
			</td>
			<td>
			</td>
		</tr>

		<tr>
			<td>
				<?php $model_category_id = 6;?>
				<div id="document<?php echo $model_category_id;?>" >
				<?php
				$document_key = '';
				if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
					$document_id = $Document['ModelDocument']['id'];
					$document_key = $Document['ModelDocument']['key'];
					//echo $Document['ModelDocument']['name'];
				?>	
					<div id="document<?php echo $document_id.'-'.$model_category_id;?>" >
					<a href='<?php echo $this->Html->url('/FileProviders/index/'.$document_key, true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
					<i class="icon-remove" onclick=removeDocument('<?php echo $document_id;?>','<?php echo $model_category_id;?>');></i>
					</div>
				<?php 
					}
				}
				?>		
				</div>
				<input type="button" name="button" id="uploader<?php echo $model_category_id;?>" value="แนบไฟล์ <?php echo $ModelCategorys[$model_category_id];?>" />
				<?php echo empty($document_key)? '' : '<script>uploaderHide('.$model_category_id.');</script>';?>
			</td>				
			<td>
				<?php $model_category_id = 11;?>
				<div id="document<?php echo $model_category_id;?>" >
				<?php
				$document_key = '';
				if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
					$document_id = $Document['ModelDocument']['id'];
					$document_key = $Document['ModelDocument']['key'];
					//echo $Document['ModelDocument']['name'];
				?>	
					<div id="document<?php echo $document_id.'-'.$model_category_id;?>" >
					<a href='<?php echo $this->Html->url('/FileProviders/index/'.$document_key, true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
					<i class="icon-remove" onclick=removeDocument('<?php echo $document_id;?>','<?php echo $model_category_id;?>');></i>
					</div>
				<?php 
					}
				}
				?>		
				</div>
				<input type="button" name="button" id="uploader<?php echo $model_category_id;?>" value="แนบไฟล์ <?php echo $ModelCategorys[$model_category_id];?>" /><br>
				<?php echo empty($document_key)? '' : '<script>uploaderHide('.$model_category_id.');</script>';?>

				<input type="button" name="button" id="uploader" value="อัตรา <?php echo $ModelTypeShorts[$model_type_id];?> กลาโหม ตอนที่ 5" />(ยังไม่ได้ทำ)
			</td>
			<td>
				<a href="../../ModelRates/printModelRate/Equipment/<?php echo $model_id;?>" class="btn" target="_blank">พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. ตอนที่ 5</a>
			</td>
		</tr>

		<?php } ?>
	</tbody>

</table>

<?php
	/*
	for($i=1;$i<=10;$i++){
		$Documents = $ModelDocuments[$i];
		foreach($Documents as $Document){
			//echo $Document['ModelDocument']['key'];
			//echo $Document['ModelDocument']['name'];
		}
	}
	*/
?>

<script type="text/javascript">

	var model_id = $("input[name='data[ModelRate][id]']").val();
	var i=1;
	for(i=1;i<=11;i++){
	   var uploader = document.getElementById('uploader'+i);

	   var document_id = '';
	   var model_category_id = i;
	   var model_category_name = '';
	   var document_link = '';

	   upclick(
		 {
		  element: uploader,
		  action: '../../ModelDocuments/upload/'+model_id+'/'+model_category_id, 
		  onstart:
			function(filename)
			{
			  //alert('Start upload: '+filename);
			},
		  oncomplete:
			function(response_data) 
			{
			  console.log(response_data);
			  data = $.parseJSON(response_data);
			  document_id = data[0].document_id;
			  model_category_id = data[0].model_category_id;
			  model_category_name = data[0].model_category_name;
			  document_key = data[0].document_key;
			  document_link = '<div id="document'+document_id+'-'+model_category_id+'"><a href="/FileProviders/index/'+document_key+'" target="_blank">'+model_category_name+'</a> <i class="icon-remove" onclick=removeDocument("'+document_id+'","'+model_category_id+'");></i></div>';
			  $('#uploader'+model_category_id).hide();
			  $('#document'+model_category_id).append(document_link);
			}
		 });
	}

	function removeDocument(document_id,model_category_id){

		var url = "../../ModelDocuments/removeDocument";
		$.post(url,{
			document_id:document_id,
		},function(data){

			if(data.status == "SUCCESS"){
			   $('#uploader'+model_category_id).show();
			   $('#document'+model_category_id).empty();

			}else{
				alert("การลบข้อมูลล้มเหลว");
			}

		}, "json"); 

	}
	
	function deletemodelfile(document_id){
		var url = "../../ModelRates/removeDocument";
		$.post(url,{
			document_id:document_id,
		},function(data){

			if(data.status == "SUCCESS"){
			   reloaddocument(<?php echo $model_id;?>);

			}else{
				alert("การลบข้อมูลล้มเหลว");
			}

		}, "json"); 
	}
	
	function upload_doc(obj)
		{
			var postData = $("#" + obj).serializeArray();
		var formURL = $("#" + obj).attr("action");
		var formData = new FormData( $("#" + obj)[0]);
		//alert(formURL);
		$.ajax(
		{
			url : formURL,
			
			type: "POST",
			data : formData,
		
			
		async: false,
		cache: false,
		contentType: false,
		processData: false,
			success:function(data, textStatus, jqXHR) 
			{
				//data: return data from server<br>	
			
				//success(data);
				//return false;
				reloaddocument(<?php echo $model_id;?>);
			},
			error: function(jqXHR, textStatus, errorThrown) 
			{
				//if fails  
				//fail(); 
				//return false;
			}
		});
		}

</script>