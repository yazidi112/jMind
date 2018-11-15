/*
 * 		jDetails 1.0
 */	

var jDetails=function(data,options){  
		 			
					/*
					 * DATA
					 */
	
					var entite=data.table;
					var condition=data.condition===undefined?{1:1}:data.condition;
					var cols=data.cols==null?"*":data.cols;
					var search=data.search;
					var datas=data;
					
					/*
					 * Options
					 */
					
					var labels=options.labels;
 					var view=options.view===undefined?'list':options.view;
					var url=options.dir;
					var jPhoto=options.jPhoto;
					var element=options.selector;
					var MEFC=options.MEFC;
					var action=options.action;
					var listBox=options.listBox; 
					var search=options.search;
					var formOptions=options.formOptions;
					var hiddenLabels=options.hiddenLabels;
					
					var total=0;
					     
					var listBoxItems=[];
					for(i=0;listBox!==undefined && i<listBox.length;i++){
						listBoxItems.push(listBox[i].item);
					}
					
				 	/*
					 * Load CSS style
					 */
					
					if($("head link").data('infos')!="jsTable")
						$("head").append('<link rel="stylesheet" data-infos="jsTable"  href="'+url+'/css/jsTable.css" />');
					
					$(element).empty().html(j_loading);
		 			 $.post(url+"/do/jTable_do.php",{  
		 				  
		 					action:view,
		 					table: entite,
		 					condition: condition,
		 					cols: cols,
		 					search: search
		 					
		 					 },function(data, status){ 
		 						 	
		 						 	dataset=data.result;
		 						 	
		 						 	$(element).empty();
		 						 	
		 						 	if(search==true){ 
		 						 		$(element).append("<div class='search_block'><input type='search' placeholder='Recherche..' />" +
		 						 				"<input type='button' value='OK' /></div>");
			 						}
		 						 	
		 						 	$(element).append("<div class='msgbox'></div><table width=90% style='background: white' data-name="+entite+"></table>");
		 						 	 
		 						 	var t=$(element).find("table");
		 							total=dataset.length;
		 						 	 
		 							if(total==0){
		 								t.append("<tr><td>"+j_nodata+"</td></tr>");
		 								return;
	 						 	     }

		 							 t.empty();
		 							 
		 							 var keys=_(dataset[0]).keys();
		 						 	    
		 							var tr="";
		 						
		 						 	     	
		 						 	 tr+="<tbody>";
		 						 	     
		 						 for(var i=0;i<total;i++){

		 							 	    var v=dataset[i];
		 							 	    var arr=_(v).toArray();
		 							 	   
		  								 	tr+="<tr>";
		  								 	tr+="<td style='width:40%;background: #cacaca;color: #000;'>#</td>";
		 								 	tr+="<td>"+arr[0]+"</td>";
		 								 	tr+="</tr>";
		 								 	var k=1;
		  								 	for(var j=(arr.length)/2+1;j<arr.length;j++){
		  								 		
		  								 		
		  								 		if(arr[j]==null)arr[j]="--";
		  								 		/*
		  								 		 * add for hajasone
		  								 		 */
		  								 		if(arr[j]=='0.00')arr[j]="";
 		  								 			
		  								 			var exts=arr[j].substring(arr[j].length-3, arr[j].length);
		  								 			if(exts=="jpg" || exts=="gif" || exts=="png")
		  								 				arr[j]="<img  src="+arr[j]+" width=100 height=100 />";

		  								 			if(labels===undefined){
					 								  tr+="<td style='background: #cacaca;color: #000;'>"+keys[j]+"</td>";
					 							   }else{
 					 								  tr+="<td style='background: #cacaca;color: #000;'>"+labels[k]+"</td>";
					 								  k++;
 					 							   }
		  								 		 
		  								 		tr+="<td class=updated data="+keys[j]+">"+arr[j]+"</td>";
		  								 		tr+="</tr>";
		  								 	}
		  								 	
		  								 	
		 								 	
		 							        
		 						    }
		 						 
		 							 tr+="</tbody>";
		 							 t.append(tr);
		 						 
		 						
 							 /*
	 						  * Action: Select
	 						  */
		 							 
	 						
			 						if(action.select){ 
				 						t.find('tbody tr td').click(function (e) {
				 							
				 							if(!action)return;
				 							t.find('tbody tr').removeClass("selected");
				 							$(this).parent('tr').addClass("selected");
			 				    		     
				 						});
			 						
			 						}	 
		 						 /*
		 						  * Action : Quick Update
		 						  */
		 						if(action.quickUpdate){ 
		 							
		 						 t.find('tbody tr td.updated').dblclick(function () {
		 							 
		 							 
		 							 	
		 							 	var valueIni=valueshap=$(this).html();
		 							 	if($(this).find("img").length==1){
		 							 		valueIni=$(this).find("img").attr('src');
		 						 		}
		 						    	
		 						    	var coloun=$(this).attr("data");
		 						    	var id=$(this).siblings().first().html();


		 						    	if($(this).find("input").length==0){
		 						    		value=valueIni;
		 							    	
		 							    	if($(this).find("img").length==1)
		 							    		$(this).html("<input type=text /><img src=public/images/default.png width=25 height=25 />");
		 							 		else
		 							 			$(this).html("<input type=text />");
		 							 		
		 							    	$(this).find("img").on("click",function(){
		 							    		set_who_open_image(this);
		 										$('#image').show();
		 										$(this).prev("input").select();	
		 							    	});
		 							    	$(this).find("input").val(value);
		 							    	$(this).find("input").select();							    	
		 							    	

		 							    	 $(this).find('input').keyup(function (event) {

		 									    	if(event.keyCode==13){
		 									    		value=value2=$(this).val();
		 									    		if(value.substring(0, 1)=="=")
		 									    			value2=eval(value.substring(1, value.length));
		 									    		
		 									    		var exts=value.substring(value.length-3, value.length);
		 		 								 		if(exts=="jpg" || exts=="gif" || exts=="png" || exts=="jpeg")
		 		 								 			value2="<img  src="+value+" width=100 height=100 />";

		 										    	$(this).parents("td").html(value2);

		  
		 										    	$.post(url+"/do/jTable_do.php",{  

		 													 action:'quikUpdate',  
		 													 id: id,  
		 													 coloun: coloun,  
		 													 value: value,
		 													 table: entite

		 													 },function(data, status){ 
		 														 
		 														$(element+' .msgbox').fadeIn().html(data.msg).delay(2000).fadeOut(1000);
		 													 
		 													 } ,"json"); 

		 									    	}

		 									    	if(event.keyCode==27){

		 										    	$(this).parents("td").html(valueshap);

		 									    	}

		 									  });
		 						    	}

		 						    });
		 						 
		 						 }
		 						 
		 						 /*
		 						  * Action: delete
		 						  */
		 						
		 						if(action.delete){ 
		 							
		 						
			 						 t.find('tbody tr td.delete').click(function (e) {
			 							 	if(!confirm('Are you sure ?'))
			 							 		return;
			 							 	
			 				    		    var id=$(this).data('id');
			 				    		    $(this).parent('tr').remove();
			 				    			$.post(url+"/do/jTable_do.php",{  
	
			 									 action: 'delete',
			 									 table: entite,
			 									 id: id
	
			 									 },function(data, status){ 
			 										 
														$(element+' .msgbox').addClass('success').fadeIn().html(data.msg).delay(2000).fadeOut(5000);
	
			 										 
			 									 } ,"json")
			 						 });
		 						 
		 						}
		 						 
		 						/*
		 						 * Action: search
		 						 */
		 						
		 						if(action.search){ 
	 						 		$(element).find('.search_block input[type=button]').on('click',function(){
	 						 			var keyword=$(element).find('.search_block input[type=search]').val();
	 						 			
	 						 			datas.search=keyword;
	 						 			console.log(datas);
	 						 			jTable(datas,options);
	 						 		});
		 						}
		 						
		 						/*
		 						  * Action : Update
		 						  */
		 						
		 						if(action.update){ 
		 							
			 						
			 						 t.find('tbody tr td.update').click(function (e) {
			 							 	 
			 				    		   
			 				    		  var id=$(this).data('id');
			 				    		  
			 				    		  jForm({table: entite,key: id},formOptions);

			 						 });
		 						 
		 						}
		 						
		 						/*
		 						 * Mise en forme conditionelle
		 						 */
		 						 
		 							if(MEFC!=null)
		 								jsTableMEFC(element,MEFC.condition,MEFC.style);
		 						 
		 							$(element).find("table").addClass("jsTable");
		 					 },"json"); 
		 			 
 		 				 
		 		 	}


 

function jTableGetID(element){
	var id=$(element).find("tr.selected td").eq(0).text();
	return id;
}	

function jTableGetDataByIndex(element,index){
	var id=$(element).find("tr.selected td").eq(index).text();
	return id;
}

function jsTableMEFC(element,condition,style){
	 
	$(element).find('tr').each(function(){
		 
		 if($(this).find('td').eq(condition.index).html()==condition.value){
			 $(this).addClass(style);
		 }
		 
	 });
}	


				 		