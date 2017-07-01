<?php 
        $default['name'] = empty($default['name']) ? '' : $default['name'];
?>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-bordered box-color">
			<div class="box-title">
				<h3 class="heading">
					Action Log
				</h3>
			</div>

			<div class="row-fluid">

				<div class="span12">
					<div class="dataTables_filter" id="dt_gal_filter">
						<label>
							<form  action="../../Log" method="POST" class='form-horizontal form-bordered' enctype='multipart/form-data'>
						<table width='100%'>
						<tr><td align='left'>
						
							เลือกช่วงเวลา จาก
											<?php echo $this->Form->day('start_date',array(
											'class'=>'input-mini',
											'empty' => 'วัน',
											'default' =>'0'
											));
											?>
											<?php
												echo $this->Form->input('start_date.month', array(
													'label' => false,
													'div' => false,
													'class' => 'input-thaimonth',
													'options' => $Months,
													'empty' => 'เดือน',
													'default' =>'0'
												));
											?>
											<?php
												echo $this->Form->input('start_date.year', array(
													'label' => false,
													'div' => false,
													'class' => 'input-thaiyear',
													'options' => $Years,
													'empty' => 'ปี',
													'default' => '0'
												));
											?>
											
											ถึง
											
											<?php echo $this->Form->day('end_date',array(
											'class'=>'input-mini',
											'empty' => 'วัน',
											'default' =>''
											));
											?>
											
											<?php
												echo $this->Form->input('end_date.month', array(
													'label' => false,
													'div' => false,
													'class' => 'input-thaimonth',
													'options' => $Months,
													'empty' => 'เดือน',
													'default' =>''
												));
											?>
											<?php
												echo $this->Form->input('end_date.year', array(
													'label' => false,
													'div' => false,
													'class' => 'input-thaiyear',
													'options' => $Years,
													'empty' => 'ปี',
													'default' => ''
												));
											?>
											
							</td><td align='right'>
								<input name="name" type="text" value="<?php echo $default['name']; ?>" placeholder="<?php echo __('module')." / ".__('action');?>" >
								<button id="Log-submit" type="submit" class="btn btn-primary hideme mm_11_list">ค้นหา</button>
								<input type="hidden" name="offset" value="0" />
								</td></tr></table>
							</form>
						</label>						
					</div>
				</div>
			</div>

			<div class="box-content nopadding">
				<div class="tab-content tab-content-inline">

				<table class="table table-bordered">
					<thead>
						<tr>
                                                      
                                                        <th style="text-align: center;">ลำดับ</th>
														<th style="text-align: center;">User Id</th>
							<th style="text-align: center;">module name</th>
                                                        <th style="text-align: center;">action</th>
							<th style="text-align: center;">วันที่สร้าง</th>
							<th style="text-align: center;">ip</th>
							
						</tr>
					</thead>
					<tbody>
                                            <?php if(!empty($log)){ ?>
                                            <?php foreach($log as $row) { ?>
						<tr>
                                                        
                                                       
                                                        
							<td style="text-align: center;">
                                                        <?php 
                                                                /*
                                                                if(!empty($rank['Unit']['order_sort'])) 
                                                                echo $rank['Unit']['order_sort'];                                                               
                                                                 */
                                                                  echo ++$pagination['offset'];
                                                        ?>
                                                        </td>
														<td>
                                                        <?php if(!empty($row['Log']['user_id'])) 
                                                                echo $row['Log']['user_id']; 
																echo "<!--";
																print_r($row);
																echo "-->";
                                                        ?>  
							<td>
                                                        <?php if(!empty($row['Log']['module_name'])) 
                                                                echo $row['Log']['module_name']; 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($row['Log']['action'])) 
                                                                echo $row['Log']['action']; 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($row['Log']['created'])) 
                                                                echo $this->DateFormat->formatDateThai($row['Log']['created']); 
                                                        ?>    
                                                        </td>
							<td>
                                                        <?php if(!empty($row['Log']['ip'])) 
                                                                echo $row['Log']['ip']; 
                                                        ?>    
                                                        </td>
							
							
						</tr>
                                            <?php } ?>
                                            <?php }else {  ?>

                                                <tr>
                                                        <td colspan="7" style="text-align:center;">
                                                                ไม่พบข้อมูลที่ตรงกัน
                                                        </td>
                                                </tr>
                                            <?php } ?>                                                
					</tbody>
				</table>

				</div>
			</div>

		</div>
	</div>

</div>

<script type="text/javascript">
    
            function toggleUnit(source) 
            {

              var checkboxes = document.getElementsByName('rankID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source.checked;
                    }



            }    
                        
            function addUnit(){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('สร้างหน่วยผู้ใช้ใหม่');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Units/form",function(data) {
						$('#customModal2').html(data);
				  });

            }      
    
            function editUnit(id){

		 $('#customModal2').html('');
				  $('#customModalHeader2').html('แก้ไขข้อมูลหน่วยผู้ใช้');
				  $('#customModalAction2').html('บันทึก');
				  $('#customModal2').load("../../Units/form/"+id,function(data) {
						$('#customModal2').html(data);
				  });

            }  

            function deleteUnit(id){

                var ids = [];
                
                if(id != null){
                ids.push(id);
                }
                else
                ids = getChecks();

                    if(ids.length != 0){  

                            if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
                                                    var url = "../../Units/delete";
                                                                    $.post(url,{
                                                                    ids:ids,

                                                            },function(data){

                                                                if(data.status == "SUCCESS"){

                                                                    window.location="../../Units/index";                                                       
                                                                }else{
                                                                    alert("การลบข้อมูลล้มเหลว");
                                                                }

                                                            }, "json"); 

                            }
                    }
            }
    

            function getChecks(){

                var checkboxes = $("[name='rankID[]']");
               
                var ids = [];

                $.each( checkboxes, function( key, checkbox ) {
                      if(checkbox.checked===true) {
                        ids.push(checkbox.value); 
                      }
                });                        
                
                return ids;
            }  
            
            function toggle(source) 
            {

              var checkboxes = document.getElementsByName('rankID[]');
              for(var i in checkboxes)
                    {
                    checkboxes[i].checked = source;
                    }

            }              
</script>

<script>
             $( ".toggle" ).click(function() {
                toggle($(this).prop('checked'));                       

            });     
            
            $(".delete").click(function(){

                var id = $(this).attr("value");              
                deleteUnit(id);
            });              
</script>