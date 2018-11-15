var jGraph=function(data,options){
	
	var selector=options.selector;
	var dir=options.dir;
	var table=data.table;
	var condition=data.condition;
	var cols=data.cols;
	
	if(condition==null)
		condition={1:1};
	
	if(cols==null)
		cols="*";
	
 	var x=[];
 	var y=[];
	var total=0;
	
	$(selector).empty().html("Chargement..");
	
	$.post(dir+"/do/jTable_do.php",{  
		  
		action:'view',
		table: table,
		condition: condition,
		cols: cols
		
		 },function(data, status){ 
			 data=data.result;
			 for(i=0;i<data.length;i++){
				 x.push(data[i][0]);
				
				 y.push(data[i][1]);
				
				 total+=parseFloat(data[i][1]);
 			 }
			 
			 var content="<div>" +
			 		"<h3>"+options.title+"</h3>" +
				"<div style='width:400px;    height: 237px;'>" +
				"<table  cellspacig=10 cellpadding=10>";
		
			for(i=0;i<y.length;i++){
		 		content+="<tr>";
				content+="<td>"+x[i]+"</td>";
				var pourcent=parseFloat(y[i])*100/total;
				content+="<td><progress value="+pourcent+" max=100></progress></td><td>" +
				parseFloat(y[i])+" ("+pourcent+"%)</td>";
				content+="</tr>";
			} 
			content+="</table></div></div>";
			$(selector).html(content);
			  
	},"json");
	
	
	 
	
}



