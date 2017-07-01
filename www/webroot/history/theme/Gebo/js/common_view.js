function toggleData(source) 
{
	var checkboxes = document.getElementsByName('DataID[]');
	for(var i in checkboxes)
	{
	checkboxes[i].checked = source.checked;
	}
}    

function addData(){

	  $('#customModal2').html('');
	  $('#customModalHeader2').html('สร้างชนิดหน่วยใหม่');
	  $('#customModalAction2').html('บันทึก');
	  $('#customModal2').load("../../Datas/form",function(data) {
			$('#customModal2').html(data);
	  });

}

function editData(id){

	  $('#customModal2').html('');
	  $('#customModalHeader2').html('แก้ไขข้อมูลชนิดหน่วย');
	  $('#customModalAction2').html('บันทึก');
	  $('#customModal2').load("../../Datas/form/"+id,function(data) {
			$('#customModal2').html(data);
	  });

}

function deleteData(id){

	var ids = [];
	
	if(id != null) ids.push(id);
	else ids = getChecks();

	if(ids.length != 0){                 
	
		if(confirm("คุณต้องการลบข้อมูลเหล่านี้หรือไม่ ?")){
			var url = "../../Datas/delete";
			$.post(url,{
				ids:ids,
			},function(data){
				if(data.status == "SUCCESS"){
					window.location="../../Datas";                                                       
				}else{
					alert("การลบข้อมูลล้มเหลว");
				}
			}, "json");
		}

	}else alert('กรุณาเลือกข้อมูลที่ต้องการจะลบ');
}

function getChecks(){

	var checkboxes = $("[name='DataID[]']");
   
	var ids = [];

	$.each( checkboxes, function( key, checkbox ) {
		  if(checkbox.checked===true) {
			ids.push(checkbox.value); 
		  }
	});                        
	
	return ids;
}             

$(".delete").click(function(){
	var id = $(this).attr("value");              
	deleteData(id);
});  