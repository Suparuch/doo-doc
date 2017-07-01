<?php 
		$default = $ModelDocuments;
		$model_id = $ModelRates['ModelRate']['id'];
		$model_type_id = $ModelRates['ModelRate']['model_type_id'];		
?>

<table class="table table-bordered">
	<thead>
		<tr>
			<th rowspan="2">แก้ไข อจย.</th>
			<th rowspan="2">กลาโหม</th>
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
        
        <a  href='/files/model/<?php echo $file['ModelFile']['model_id'];?>/<?php echo $file['ModelFile']['file_src'];?>' target="_blank"><i class="icon-print"></i></a>
	<br />
        <?php
	}
	?>
	</div>
    
    </td>
	<td>
	<div class='att_corp'>

	<?php
	foreach($ModelFile2 as $file){
		?>
        <a href='/files/model/<?php echo $file['ModelFile']['model_id'];?>/<?php echo $file['ModelFile']['file_src'];?>' target="_blank"><?php echo $file['ModelFile']['origin'];?></a>&nbsp;&nbsp;&nbsp;
        
        <a  href='/files/model/<?php echo $file['ModelFile']['model_id'];?>/<?php echo $file['ModelFile']['file_src'];?>' target="_blank"><i class="icon-print"></i></a>
	<br />
        <?php
	}
	?>
	</div>
    
    </td>
	<td></td>
	</tr>
		<tr>
			<td>
				<?php 
				$model_category_id = 1;
				if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
				?>
					<a href='<?php echo $this->Html->url('/FileProviders/index/'.$Document['ModelDocument']['key'], true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
				<?php 
					}
				}else{
				?>
					<a href='#' onclick=emptyDocument() class='emptyDocument'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
				<?php } ?>
			</td>
			<td>
				<?php
				$model_category_id = 7;
				if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
				?>
				<a href='<?php echo $this->Html->url('/FileProviders/index/'.$Document['ModelDocument']['key'], true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
				<?php 
					}
				}else{
				?>
					<a href='#' onclick=emptyDocument() class='emptyDocument'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
				<?php } ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<td>
				<?php
					$model_category_id = 2;
					if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
				?>
				<a href='<?php echo $this->Html->url('/FileProviders/index/'.$Document['ModelDocument']['key'], true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a><br>
				<?php 
					}
				}else{
				?>
					<a href='#' onclick=emptyDocument() class='emptyDocument'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a><br>
				<?php } ?>
				<?php
					$model_category_id = 3;
					if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
				?>
				<a href='<?php echo $this->Html->url('/FileProviders/index/'.$Document['ModelDocument']['key'], true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
				<?php 
					}
				}else{
				?>
					<a href='#' onclick=emptyDocument() class='emptyDocument'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
				<?php } ?>
			</td>
			<td>
				<?php
					$model_category_id = 8;
					if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
				?>
				<a href='<?php echo $this->Html->url('/FileProviders/index/'.$Document['ModelDocument']['key'], true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
				<?php 
					}
				}else{
				?>
					<a href='#' onclick=emptyDocument() class='emptyDocument'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
				<?php } ?>
			</td>
			<td></td>
		</tr>
		<tr>
			<td>
				<?php
					$model_category_id = 4;
					if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
				?>
				<a href='<?php echo $this->Html->url('/FileProviders/index/'.$Document['ModelDocument']['key'], true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a><br>
				<?php 
					}
				}else{
				?>
					<a href='#' onclick=emptyDocument() class='emptyDocument'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
				<?php } ?>
			</td>
			<td>
				<?php
					$model_category_id = 9;
					if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
				?>
				<a href='<?php echo $this->Html->url('/FileProviders/index/'.$Document['ModelDocument']['key'], true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a><br>	
				<?php 
					}
				}else{
				?>
					<a href='#' onclick=emptyDocument() class='emptyDocument'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a><br>
				<?php } ?>
				<input type="button" name="button" id="button-add" value="อัตรา อจย. กลาโหม ตอนที่ 3" />
			</td>
			<td>
			<!--
			<input type="button" name="button" id="button-add" value="พิมพ์ อจย.ทบ. ตอนที่ 3 มีอัตราลด 3" /><br>
			<input type="button" name="button" id="button-add" value="พิมพ์ อจย.ทบ. รวม ตอนที่ 3" /><br>
			<input type="button" name="button" id="button-add" value="พิมพ์ อจย.ทบ. ตอนที่ 3" />
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
		<tr>
			<td>
				<?php
					$model_category_id = 5;
					if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
				?>
				<a href='<?php echo $this->Html->url('/FileProviders/index/'.$Document['ModelDocument']['key'], true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a><br>
				<?php 
					}
				}else{
				?>
					<a href='#' onclick=emptyDocument() class='emptyDocument'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
				<?php } ?>
			</td>
			<td>
				<?php
					$model_category_id = 10;
					if(!empty($ModelDocuments[$model_category_id])){ 
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
				?>
				<a href='<?php echo $this->Html->url('/FileProviders/index/'.$Document['ModelDocument']['key'], true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a><br>	
				<?php 
					}
				}else{
				?>
					<a href='#' onclick=emptyDocument() class='emptyDocument'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a><br>
				<?php } ?>
				<input type="button" name="button" id="button-add" value="อัตรา อจย. กลาโหม ตอนที่ 4" />
			</td>
			<td>
				<!--
				<input type="button" name="button" id="button-add" value="พิมพ์ อจย.ทบ. รวม ตอนที่ 4" /><br>
				<input type="button" name="button" id="button-add" value="พิมพ์ อจย.ทบ. ตอนที่ 4" />
				-->
				<?php if($model_type_id==1){?>
				<a href="../../ModelRates/printModelRate/Equipment/<?php echo $model_id;?>/Group" class="btn" target="_blank">พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. รวม ตอนที่ 4</a><br>
				<a href="../../ModelRates/printModelRate/Equipment/<?php echo $model_id;?>" class="btn" target="_blank">พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. ตอนที่ 4</a><br>
				<a href="../../ModelRates/printModelRate/Equipment/<?php echo $model_id;?>/Group/Decrease3" class="btn" target="_blank">พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. รวม ตอนที่ 4 มีอัตราลด 3</a><br>
				<a href="../../ModelRates/printModelRate/Equipment/<?php echo $model_id;?>/Decrease3" class="btn" target="_blank">พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. ตอนที่ 4 มีอัตราลด 3</a><br>
				
				
				<?php }?>
			</td>
		</tr>
		<?php if($model_type_id==2){?>
		<tr>
			<td>
				<?php
					$model_category_id = 6;
					if(!empty($ModelDocuments[$model_category_id])){
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
				?>
				<a href='<?php echo $this->Html->url('/FileProviders/index/'.$Document['ModelDocument']['key'], true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a><br>
				<?php 
					}
				}else{
				?>
					<a href='#' onclick=emptyDocument() class='emptyDocument'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
				<?php } ?>
			</td>
			
			<td>
				<?php
					$model_category_id = 11;
					if(!empty($ModelDocuments[$model_category_id])){
					$Documents = $ModelDocuments[$model_category_id];
					foreach($Documents as $Document){ 
				?>
				<a href='<?php echo $this->Html->url('/FileProviders/index/'.$Document['ModelDocument']['key'], true);?>' target='_blank'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a><br>
				<?php 
					}
				}else{
				?>
					<a href='#' onclick=emptyDocument() class='emptyDocument'><?php echo $ModelCategorys[$model_category_id];?>.pdf</a>
				<?php } ?>
			</td>			
			<td>
				<a href="../../ModelRates/printModelRate/Equipment/<?php echo $model_id;?>" class="btn" target="_blank">พิมพ์ <?php echo $ModelTypeShorts[$model_type_id];?>ทบ. ตอนที่ 5</a>			
			</td>
		</tr>
		<?php }?>


	</tbody>
</table>
<script>
	function emptyDocument(){
		alert('ไม่มีเอกสารแนบ');
	}
</script>

<style>
a.emptyDocument {color: #c7c7c7;}
</style>