/*
 * jForm
 */

var jForm=function(data,options){
	
	/*
	 * data
	 */
	
	var table=data.table;
	var values=data.values;
	var key=data.key;
	
	/*
	 * options
	 */
	
	
 	var hiddenCols=options.hiddenCols;
	var listBox=options.listBox;
	var doubleShow=options.doubleShow;
	var tripleShow=options.tripleShow;
	var labels=options.labels;
	var buttons=options.buttons;
	var addClass=options.addClass;
	var jicons=options.jicons;
	var jMaps=options.jMaps;
	var datepicker=options.datepicker;
	var jPhotos=options.jPhotos;
	var textarea=options.textarea;
	var ckeditor=options.ckeditor;
	var jOsk=options.jOsk;
	var action=options.action;
	var dir=options.dir;
	var selector=options.selector;
	 
	if(buttons===undefined){
		buttons=[];
		buttons[0]=j_save;
		buttons[1]=j_reset;
		 
	}
	 
	var listBoxItems=[];
	for(i=0;listBox!==undefined && i<listBox.length;i++){
		listBoxItems.push(listBox[i].item);
	}
	$(selector).html(j_loading);
	
	/*
	 * Load CSS style
	 */
	
	if($("head link").data('infos')!="jsTable")
		$("head").append('<link rel="stylesheet" data-infos="jsTable"  href="'+dir+'/css/jsTable.css" />');
	

	$.post(dir+'/do/jForm_do.php',{
		action: 'getCols', 
		table: table
	},function(data){
 		data=data.result;
		var row="<div class='msgbox'> </div>";
		row+="<form>";
		row+="<div style='display:table;width:100%'>";
		row+="<div style='display:table-cell; padding-right:20px'>";
		
		for(i=0;i<data.length;i++){
			
			if($.inArray(i,hiddenCols)!=-1){
				row+='<div><input type=hidden class=value name='+data[i].Field+' /></div>';
			}else if($.inArray(i,listBoxItems)!=-1){
				 
				if(labels!==undefined && labels[i]!==undefined && labels[i]!='')
					row+='<div>'+labels[i]+'</div>';
				else
					row+='<div>'+data[i].Field+'</div>';
				
				row+='<div><select class=value  name='+data[i].Field+' /></select></div>';
				
			}else{
				if(labels!==undefined && labels[i]!==undefined && labels[i]!='')
					row+='<div>'+labels[i]+'</div>';
				else
					row+='<div>'+data[i].Field+'</div>';
				
				row+='<div><input type=text class=value name='+data[i].Field+' /></div>';
			}
			
			if(doubleShow && i==Math.floor(data.length/2)){ 
				row+="</div><div style='display:table-cell;padding-right:20px '>";
			}else if(tripleShow && (i==Math.floor(data.length/3) || i==Math.floor(data.length*2/3))){
				row+="</div><div style='display:table-cell;padding-right:20px '>";
			}
			
		}
		
		row+="</div></div>";
		row+="<div style=margin-top:20px><input type=button value="+buttons[0]+" /> ";
		row+="<input type=reset value="+buttons[1]+"></div>";
		row+="</form>";
		
		$(selector).empty().append(row);
		$(selector).find("input[type=button]").on('click',function(){
			
			 if(ckeditor!==null &&  ckeditor instanceof Object)$('textarea.value').val(ckeditor.getData());
			jDataUpdate({table: table},{action:action,dir:dir,selector:selector,msgbox:selector+' .msgbox'});
		});
		
		/*
		 * Remplire les listbox
		 */
		for(i=0;listBox!==undefined && i<listBox.length;i++){
			if(listBox[i].data!==undefined){
				// remplire data from data in
				var option="";
				for(j=0;j<listBox[i].data.length;j++){
					
					option+="<option>"+listBox[i].data[j]+"</option>";
				}
				$(selector).find('.value').eq(listBox[i].item).append(option);
				
			}else if(listBox[i].table!==undefined){
				// remplire data from database
				jListFill({table:listBox[i].table.name},{
					dir:options.dir,
					selector:selector+' .value:eq('+listBox[i].item+')',
					key: listBox[i].table.key ,
					cols: listBox[i].table.cols,
					selected: listBox[i].selected
					}
				);
			}
			
		}


		
		/*
		* Ajouter jMaps
		*/

		for(i=0;jMaps!==undefined && i<jMaps.length;i++){
			  
			$(selector).find('.value').eq(jMaps[i]).addClass('jMaps');

			$('#jMaps .content a').on('click',function(){
			
				alert("ok");
				return false;
			});

 			$('.jMaps').after('<i class="fa fa-map" aria-hidden="true" style="margin-left: -18px;"></i>');

			$('.jMaps').on('click',function(){
				$('#jMaps').show();
			});

			
 			
		}


		 
		/*
		* Ajouter jicons
		*/

		for(i=0;jicons!==undefined && i<jicons.length;i++){
			  
			$(selector).find('.value').eq(jicons[i]).addClass('jicons');

			$('#jicons .content a').on('click',function(){
			
				$('.jicons').val($(this).find('.icons').html());
				$('.jicon').removeClass().addClass('jicon '+$(this).find('.icons i').attr('class'));
				$('#jicons').hide();
					return false;
			});

			$('.jicons').after('<i class="fa fa-smile-o jicon" aria-hidden="true" style="margin-left: -18px;"></i>');
			
			$('.jicons').on('click',function(){
				$('#jicons').show();
			});
		}

		/*
		 * Ajouter des classes
		 */

		for(i=0;addClass!==undefined && i<addClass.length;i++){
			 var cl=addClass[i];
			 $(selector).find('.value').eq(cl[0]).addClass(cl[1]);
		}
		
		/*
		 * Ajouter les textarea
		 */
		 for(i=0;textarea!==undefined && i<textarea.length;i++){
			  
			 var name=$(selector).find('.value').eq(textarea[i]).attr('name');
			 $(selector).find('.value').eq(textarea[i]).after("<textarea class=value name="+name+"></textarea>");
			 $(selector).find('.value').eq(textarea[i]).remove();
		 }
		 
		 /*
		  	* ckeditor
		 */
			 for(i=0;ckeditor!==undefined && i<ckeditor.length;i++){
				  
				 var name=$(selector).find('.value').eq(ckeditor[i]).attr('name');
				 $(selector).find('.value').eq(ckeditor[i]).after("<textarea class=value name="+name+"></textarea>");
				 $(selector).find('.value').eq(ckeditor[i]).remove();
				 var editor=CKEDITOR.replace(name);
				 ckeditor=editor;
			 }
		
		/*
		 * Ajouter les datespicker
		 */
			 
		 for(i=0;datepicker!==undefined && i<datepicker.length;i++){
			  
			 $(selector).find('.value').eq(datepicker[i]).addClass('datepicker');
		 }
		 
		 $('.datepicker').datepicker();
		 $('.datepicker').datepicker("option", "dateFormat","yy-mm-dd");
		 
		 	/*
			 * Ajouter les jOSk
			 */
		 
			 for(i=0;jOsk!==undefined && i<jOsk.length;i++){
				  
				 $(selector).find('.value').eq(jOsk[i]).addClass('jOsk');
			 }
			 
			 jOsk_run();
		 
		 /*
		  * Ajouter jPhoto
		  */
		
		 for(i=0;jPhotos!==undefined && i<jPhotos.length;i++){
			  
			 $(selector).find('.value').eq(jPhotos[i]).addClass('jPhoto');
			 jPhotoRun();
		 }
		 
		 /*
		  * Remplir les les donnees par default
		  */
 		 for(i=0;values!==undefined && i<values.length;i++){
			 $(selector).find('.value').eq(i).val(values[i]);
		 }
 		 
 		 /*
 		  * Remplir les données via le serveur de base de donnees
 		  */
 		 
 		 if(key!==undefined){
 			$.post(dir+'/do/jForm_do.php',{
 				 action: 'find',
 				 table: table,
 				 key: key
 			 },function(data){
   				for(i=0; i<$(selector).find('.value').length;i++){
   					if($(selector).find('.value').eq(i).hasClass('jPhoto')){
   						$(selector).find('.value').next().attr('src',data.result[0][i]);	
   					}
   						$(selector).find('.value').eq(i).val(data.result[0][i]);
 				 }
   				if(ckeditor!==null)ckeditor.setData($('textarea.value').val());
 				
 			 },"json");
 		 }
		
		
	},"json");
	
}


/*
* Add data
*/
		 		 
var jDataUpdate=function(data,options){
	/*
	 * options
	 */
	var action=options.action;
	var dir=options.dir;
	
	var values=[];
	
	$(options.selector).find('.value').each(function(){
		values.push($(this).val());
	});
	
	$.post(dir+'/do/jForm_do.php',{  
		 
		action: action,
		table: data.table,
		values: values
		
		},function(data, status){
			if(options.msgbox===undefined)
				alert(data.msg);
			else
				$(options.msgbox).addClass('success').fadeIn().html(data.msg).delay(2000).fadeOut(1000);
		},"json");
	
}		 
				 		
				 		
/*
 * remplire combobox
 */	
				 		
 var jListFill=function(data,options){
	 
	 var key=options.key;
	 var cols=options.cols;
	 var selected=options.selected;
	 
	 $.post(options.dir+'/do/jTable_do.php',{  
		 
			action: 'list',
			table: data.table,
			condition:{1:1},
			cols: '*'
			 },function(data, status){
				 
				 var e="<option value=0>"+j_select+"</option>";
				 for(var i=0;i<data.result.length;i++){
					 var arr=_(data.result[i]).toArray();
  					 
					 e+="<option value='"+data.result[i][key]+"'";
					 if(selected!==undefined && selected==data.result[i][key]){
						 e+=" selected"
					 }
					 e+=">";
					 for(j=0;j<cols.length;j++)
						 e+=data.result[i][cols[j]]+" ";
					 e+="</option>";
				 }
				 $(options.selector).empty().append(e);
				 
			 },"json");
 }
 
 

function quickUpdate(data,options){
	
	var url=options.dir;
	var selector=options.selector;
	var aler=options.aler;
	var id=data.id;
	var coloun=data.coloun;
	var value=data.value;
	var table=data.table;
	
	$.post(url+"/do/jTable_do.php",{  

		 action:'quikUpdate',  
		 id: id,  
		 coloun: coloun,  
		 value: value,
		 table: table

		 },function(data, status){ 
			 
			 if(aler)
				 alert(data.msg)
			else
				$(selector).fadeIn().html(data.msg);
		 
		 } ,"json"); 
} 



function jFunction(data,options){
	
	var url=options.dir;
	var function_name=options.function_name;
	var function_field=options.function_field;
	var selector=options.selector;
 	var table=data.table;
 	var condition=data.condition==undefined?{1:1}:data.condition;
	
	$.post(url+"/do/jForm_do.php",{  

		 action:'function',
		 name:function_name,
		 field:function_field,
		 table: table,
		 condition:condition

		 },function(data, status){ 
			
			$(selector).html(data.result.value);
		 
		 } ,"json"); 
} 

