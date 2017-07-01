<br/>
<div class="row-fluid">
	<div class="span6">
		<div class="dataTables_info" id="dt_inbox_info">แสดง <?php if($pagination['total']!=0)echo $pagination['offset']+1;else echo "0"; ?> ถึง <?php $end = ($pagination['offset'])+$pagination['limit']; if($end>$pagination['total'])echo $pagination['total']; else echo $end; ?> จากทั้งหมด <?php echo $pagination['total']; ?> รายการ</div>
	</div>
	<div class="span6">
		<div class="dataTables_paginate paging_bootstrap pagination">
			<ul>
				<?php if($pagination['offset'] == 0) { ?>
				<li class="prev disabled">
					<a>ก่อนหน้า</a>
				<?php }else { ?>
				<li class="prev enable">
					<a style="cursor:pointer" onclick="paginate(<?php echo $pagination['offset']-($pagination['limit']); ?>)">ก่อนหน้า</a>
				<?php } ?>
					
				</li>
					
					<?php if( ((($pagination['offset']/$pagination['limit'])+1) - (($pagination['pages']-1)/2) > 0) 
							  && ((($pagination['offset']/$pagination['limit'])+1) + (($pagination['pages']-1)/2) < $pagination['total'] 
							  && (($pagination['total']/$pagination['limit']) >= $pagination['pages']))
							 
							) 
					{ ?> 
								<?php if($pagination['offset']+($pagination['limit']*2) >= $pagination['total']){ ?>
									<?php for($i=0;$i<$pagination['pages'] && $i<$pagination['total']/$pagination['limit'];$i++) { ?>

											<?php   if(($pagination['total']%$pagination['limit']) == 0) $current_offset = $pagination['total']-(($pagination['limit']*$pagination['pages']-$i)); 
													else $current_offset = $pagination['total']-($pagination['total']%$pagination['limit'])-($pagination['limit']*($pagination['pages']-1-$i));
											?>
											<?php   if(($pagination['total']%$pagination['limit']) == 0) $current_page = ($pagination['total']/$pagination['limit'])-($pagination['pages']-$i); 
													else $current_page = ceil($pagination['total']/$pagination['limit'])-($pagination['pages']-1-$i);
											?>                                

										<?php if(($pagination['offset']/$pagination['limit']) == $i ) { ?>
										<li class="active">
											 <?php $page = $current_page;?>
											 <a><?php echo $current_page; ?></a>
										<?php }else { ?>
										<li>
											<a style="cursor:pointer" onclick="paginate(<?php echo $current_offset; ?>)"><?php echo $current_page; ?></a>
										<?php } ?>

										</li>
									<?php } ?>                                
								<?php }else{ ?>
									<?php for($i=0;$i<$pagination['pages'] && $i<$pagination['total']/$pagination['limit'];$i++) { ?>

											<?php $current_offset = $pagination['offset'] + ((( ((2*$i)+1) - $pagination['pages'])/2)*$pagination['limit']); ?>
											<?php $current_page = (($pagination['offset']/$pagination['limit'])+1)+(( ((2*$i)+1) - $pagination['pages'])/2); ?>                                

										<?php if($i == ((($pagination['pages']+1)/2)-1) ) { ?>
										<li class="active">
											 <?php $page = $current_page;?>
											 <a><?php echo $current_page; ?></a>
										<?php }else { ?>
										<li>
											<a style="cursor:pointer" onclick="paginate(<?php echo $current_offset; ?>)"><?php echo $current_page; ?></a>
										<?php } ?>

										</li>
									<?php } ?>
								<?php } ?>
					<?php }else{ ?>
							<?php if($pagination['offset'] < ($pagination['total']/2) || (($pagination['total']/$pagination['limit']) < $pagination['pages'])) { ?>
								<?php for($i=0;$i<$pagination['pages'] && $i<$pagination['total']/$pagination['limit'];$i++) { ?>
					
										<?php $current_offset = $i*$pagination['limit']; ?>
										<?php $current_page = $i+1 ?>                                                    
									
									<?php if($i == ($pagination['offset']/$pagination['limit'])) { ?>
									<li class="active">
										 <?php $page = $current_page;?>
										 <a><?php echo $current_page; ?></a>
									<?php }else { ?>
									<li>
										<a style="cursor:pointer" onclick="paginate(<?php echo $current_offset; ?>)"><?php echo $current_page; ?></a>
									<?php } ?>
									   
									</li>
								<?php } ?>                                              
							<?php }else{ ?>
								<?php for($i=($pagination['total']-$pagination['pages'])-1;$i<$pagination['total'];$i++) { ?>
					
										<?php $current_offset = $i*$pagination['limit']; ?>
										<?php $current_page = $i+1; ?>                                                    
									
									<?php if($i == ($pagination['offset']/$pagination['limit'])) {  ?>
									<li class="active">
										 <?php $page = $current_page;?>
										 <a><?php echo $current_page; ?></a>
									<?php }else { ?>
									<li>
										<a style="cursor:pointer" onclick="paginate(<?php echo $current_offset; ?>)"><?php echo $current_page; ?></a>
									<?php } ?>
									   
									</li>
								<?php } ?>                                                     
							<?php } ?>
					<?php } ?>
				
				<?php if($pagination['offset'] >= ($pagination['total']-$pagination['limit'])) { ?>
				<li class="prev disabled">
					<a>ถัดไป</a>
				<?php }else { ?>
				<li class="prev enable">
					<a style="cursor:pointer" onclick="paginate(<?php echo $pagination['offset']+($pagination['limit']); ?>)">ถัดไป</a>
				<?php } ?>
				</li>
			</ul>
			ไปหน้า : 
			<?php
			  
			echo $this->Form->input('page', array(
			'label' => false,
			'div' => false,
			'class' => 'input-mini',
			'placeholder' => 'หน้า',
			'default' => empty($page)? '' : $page,
							   

			));
			$max_page = $pagination['total']/$pagination['limit'];
			$max_page = round($max_page, 0, PHP_ROUND_HALF_UP);
			?>
			<input type="hidden" id="model" value="<?php echo $pagination['model']; ?>" />
			<input type="hidden" id="limit" value="<?php echo $pagination['limit']; ?>" />
			<input type="hidden" id="max_page" value="<?php echo $max_page; ?>" />
		</div>
	</div>
</div>

<script>

	$("#page").keypress(function(e) {
		//console.log(e.which);
		if( e.which == 13){
			var page = $(this).val();
			var limit = $("#limit").val();
			var max_page = $("#max_page").val();
			if(page == 0) return false;
			if (page > max_page){
				 alert('จำนวนหน้าเกินกว่าที่มีระบบ');
				 return false;
			}

			offset = (page * limit) - limit;

			if(page != '') paginate(offset);
		}
		if( e.which < 48 || e.which > 57){ return false; }
	});

    function paginate(offset){
        
            $("input[name='offset']").val(offset);
            var model = $("#model").val();
            $("#"+model+"-submit").trigger( "click" );
    }
</script>