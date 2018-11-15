var osk="";

function jvk(dir){
	$.post(dir+'/includes/jvk.php',{},function(data){
		$("body").append(data);
		jOsk_run();
	});
};	

function jOsk_run(){
	$('.jvk').on('click',function(){
		$('#osk2').fadeIn();
		osk=this;
	});
}

function osk2(e){
	id='#'+$(e).attr('id');
	$('#osk2').show();
	osk_set(id);
}

function osk2_set(val){
	o=$(osk).val();
	n=$(osk).val()+val;
	$(osk).val(n);
	$(osk).focus();
	$(osk).attr('autocomplete', 'off');
}

function osk2_shift(){
	
	if($('#osk2_12').val()=='a'){
		for(o_i=12;o_i<45;o_i++){
			$('#osk2_'+o_i).val($('#osk2_'+o_i).val().toUpperCase());
		}
	}else{
		for(o_i=12;o_i<45;o_i++){
			$('#osk2_'+o_i).val($('#osk2_'+o_i).val().toLowerCase());
		}
	}
	
}

function osk2_effacer(){
	
	o=$(osk).val();
	 
		n=o.substring(0,o.length-1);
		$(osk).val(n);
		$(osk).focus();
	 
}


