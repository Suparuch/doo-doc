<?php 
        $default['id'] = empty($default['id']) ? '' : $default['id']; 
        $default['zone_id'] = empty($default['zone_id']) ? '' : $default['zone_id']; 
        $default['name'] = empty($default['name']) ? '' : $default['name']; 
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-bordered">

			<!--<h3 class="heading"><?php //echo __('แก้ไข ข้อมูลค่ายทหาร') ;?></h3>-->
			<div class="box-content nopadding">
				
					<div class="row-fluid">

                                                            <input type="hidden" name="id" value="<?php echo$default['id']; ?>"/>
                                                            <?php
                                                                echo $this->Form->input('name', array(
                                                                    'label' => 'ชื่อตำบล :',
                                                                    'div' => true,
                                                                    'class' => 'span6',
                                                                    'placeholder' => 'ชื่อตำบล',
                                                                    'default' => $default['name'],
                                                                    'onkeypress' => 'return keyTextThai(event)'

                                                                ));
                                                            ?>    
		
                                                            <label for="zone_id">อำเภอ :</label>
                                                            <select  name="data[zone_id]"  data-placeholder="กรุณาเลือกอำเภอ" class="chzn_a input-xlarge" >				
                                                                    <option id="ui_slider3_sel" value=""></option>
                                                                    <?php foreach($zones as $key => $zone) { ?>
                                                                    <option value="<?php echo $key; ?>"><?php echo $zone; ?></option>                       
                                                                    <?php  } ?>

                                                            </select>        
                                                            <script>
                                                                $('[name="data[zone_id]"]').val(<?php echo $default['zone_id'] ?>);
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
                        var zone_id = $("select[name='data[zone_id]']").val();

			
				if(name != "" && zone_id != "")
				  {         
					var url = "../../Districts/save/"+id;
							$.post(url,{
							name:name,
							zone_id:zone_id,
		
						},function(data){
                                                        
                                                    if(data.status == "SUCCESS"){
                                                        $('#myModal2').modal('hide');					
                                                        window.location="../../Districts";                                            
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