<?php 
        $default['id'] = empty($default['id']) ? '' : $default['id']; 
        $default['province_id'] = empty($default['province_id']) ? '' : $default['province_id']; 
        $default['name'] = empty($default['name']) ? '' : $default['name']; 
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php echo __('แก้ไข ข้อมูลค่ายทหาร') ;?></h3>-->
			<div class="box-content nopadding">
				
					<div class="row-fluid">

                                                            <input type="hidden" name="id" value="<?php echo$default['id']; ?>"/>
                                                            <?php
                                                                echo $this->Form->input('name', array(
                                                                    'label' => 'ชื่ออำเภอ :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'ชื่ออำเภอ',
                                                                    'default' => $default['name'],
                                                                    'onkeypress' => 'return keyTextThai(event)'

                                                                ));
                                                            ?>    
		  
                                                            <label for="province_id">จังหวัด :</label>
                                                            <select  name="data[province_id]"  data-placeholder="กรุณาเลือกจังหวัด" class="chzn_a input-xlarge" >				
                                                                    <option id="ui_slider3_sel" value=""></option>
                                                                    <?php foreach($provinces as $key => $province) { ?>
                                                                    <option value="<?php echo $key; ?>"><?php echo $province; ?></option>                       
                                                                    <?php  } ?>

                                                            </select>        
                                                            <script>
                                                                $('[name="data[province_id]"]').val('<?php echo $default['province_id'] ?>');
                                                            </script>                                                               
		

						


					</div>
					
                        </div>	
		</div>
	</div>
</div>

<script>
		function modalAction2(){
			
			var id = $("input[name='id']").val();
			var name = $("input[name='data[name]']").val();
			var province_id = $("select[name='data[province_id]']").val();

			
				if(name != "" && province_id != "")
				  {         
					var url = "../../Zones/save/"+id;
							$.post(url,{
							name:name,
							province_id:province_id,
		
						},function(data){
                                                        
							if(data.status == "SUCCESS"){
								$('#myModal2').modal('hide');					
								window.location="../../Zones";                                            
							}else{
								alert("การสร้างข้อมูลล้มเหลว");
							}
							
						}, "json"); 
						

						
				  }
				  else { alert('กรุณาใส่ข้อมูลให้ครบถ้วน');}
		}
</script>


<script>
        gebo_sliders.init();
        gebo_chosen.init();
	//* enhanced select elements
	gebo_chosen = {
		init: function(){
			$(".chzn_a").chosen({
				allow_single_deselect: true
			});
			$(".chzn_b").chosen();
		}
	};
        
	//* sliders
	gebo_sliders = {
		init: function(){
			//* slider with select
			var select = $( "#ui_slider3_sel" );
			var slider = $( "<div id='ui_slider3'></div>" ).insertAfter( select ).slider({
				min: 1,
				max: 6,
				range: "min",
				value: select[ 0 ].selectedIndex + 1,
				slide: function( event, ui ) {
					select[ 0 ].selectedIndex = ui.value - 1;
				}
			});
			$( "#ui_slider3_sel" ).change(function() {
				slider.slider( "value", this.selectedIndex + 1 );
			});
		}
	};          
                                                   
</script>     