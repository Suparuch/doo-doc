function keyNumberEng(e){

	var keyCode = ('which' in e) ? e.which : e.keyCode;
	//console.log(e.which);
	if( keyCode == 0 || keyCode == 8 ){ return true; }
	if(keyCode==13){return true;}
	if( keyCode < 48 || keyCode > 57){ return false; }
	
}

function keyNumberThai(e){

	var keyCode = ('which' in e) ? e.which : e.keyCode;
	//console.log(e.which);
	if( keyCode == 0 || keyCode == 8 ){ return true; }
	if(keyCode==13){return true;}
	if( keyCode < 3664 || keyCode > 3673){ return false; }
}

function keyTextEng(e){

	var keyCode = ('which' in e) ? e.which : e.keyCode;
	//console.log(e.which);
	if( keyCode == 0 || keyCode == 8 || keyCode == 32){ return true; }
	if(keyCode==13){return true;}
	if( keyCode < 65 || keyCode > 122){ return false; }

}

function keyTextThai(e){

	var keyCode = ('which' in e) ? e.which : e.keyCode;
	//console.log(e.which);
	if( keyCode == 0 || keyCode == 8 || keyCode == 32 || keyCode == 46 || keyCode == 47 ){ return true; }
	if(keyCode==13){return true;}
	if( keyCode < 3585 || keyCode > 3662){ return false; }

}

function keyNumberAndTextEng(e){
	
	var keyCode = ('which' in e) ? e.which : e.keyCode;
	//console.log(e.which);
	if( keyCode == 0 || keyCode == 8 || keyCode == 32 ){ return true; }
	if( keyCode < 48 || keyCode > 57 || keyCode < 65 || keyCode > 122){ return false; }
	if(keyCode==13){return true;}
	//if( keyCode < 65 || keyCode > 122){ return false; }

}

function keyNumberThaiAndTextThai(e){
	
	var keyCode = ('which' in e) ? e.which : e.keyCode;
	//console.log(e.which);
	if( keyCode == 0 || keyCode == 8 || keyCode == 32 || keyCode == 46 || keyCode == 47 ){ return true; }
	if( (keyCode < 3664 || keyCode > 3673) && (keyCode < 3585 || keyCode > 3662)){ return false; }
	if(keyCode==13){return true;}
	//if( keyCode < 3585 || keyCode > 3662){ return false; }

}

function keyNumberArabicAndTextThai(e){
	
	var keyCode = ('which' in e) ? e.which : e.keyCode;
	//console.log(e.which);
	
	
	if(keyCode == 13 || keyCode == 0 || keyCode == 8 || keyCode == 32 || keyCode == 46 || keyCode == 47 ){ return true; }
	if( (keyCode < 48 || keyCode > 57) && (keyCode < 3585 || keyCode > 3662)){ return false; }

	//if( keyCode < 3585 || keyCode > 3662){ return false; }

}

function validateData(){
	
	//alert('ok');
	var rank_id = $("select[name='data[Profile][rank_id]']").val();
	//alert(rank_id);
	var name_th = $("input[name='data[Profile][name_th]']").val();
	//alert(name_th);
	var surname_th = $("input[name='data[Profile][surname_th]']").val();
	//alert(surname_th);
	var department_id = $("select[name='data[Profile][department_id]']").val();
	//alert(department_id);
	var soldier_group_id = $("select[name='data[Profile][soldier_group_id]']").val();
	//alert(soldier_group_id);
	var origin_id = $("select[name='data[Profile][origin_id]']").val();
	//alert(origin_id);
	var soldier_number = $("input[name='data[Profile][soldier_number]']").val();
	//alert(soldier_number);
	var id_card13 = $("input[name='data[Profile][id_card13]']").val();
	//alert(id_card13);

	//$("select[name='data[Profile][rank_id]']").focus();
	//$("#ProfileNameTh").addClass("f_error");
	//$("#ProfileNameTh").addClass("f_error");
	$("#ProfileNameTh").className = $("#ProfileNameTh").className + ' f_error';
	//alert('ok');
	//return false;

}