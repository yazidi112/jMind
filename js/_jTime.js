function time_show(s){

setInterval(function(){
	d=new Date();
	var h=d.getHours();
	var s=d.getSeconds();
	var m=d.getMinutes();
	var time=h+":"+m+":"+s;
	$(s).html(time);
},1000);

}

 
function get_date(){
	 
	var d=new Date();
	var year=d.getFullYear();
	var month=d.getMonth()<10?'0'+(d.getMonth()+1):(d.getMonth()+1);
	var dt=d.getDate()<10?'0'+d.getDate():d.getDate();
	var date=year+'-'+month+'-'+dt;
	return date;
	
}

function get_month(){
	var d=new Date();
	var month=d.getMonth()<10?'0'+(d.getMonth()+1):(d.getMonth()+1);
	return month;
}

function get_year(){
	var d=new Date();
	var year=d.getFullYear();
	return year;
}