var dir="";  
var who_open_image;

function jPhoto(e){

	dir=e;
	
	jPhotoRun(); 

	if($('#jPhoto').length==0){
		 
	
			$.post(e+"/includes/jPhoto.php",{
				root : dir
					
			},function(data){
				
				$("body").append(data);
				
				$("#uploadimage").submit(function(e){
					 
					 
			 			
						e.preventDefault();
						$('#uploadimage input[type=submit]').attr('value','Uploding..');
						$.ajax({
						url: dir+'/do/jPhoto_do.php',  
						type: "POST",              
						data: new FormData(this),
						dataType: "json",
						contentType: false,        
						cache: false,              
						processData:false,  
			 			success: function(data)   
							{
								
			 				
			 					
			 					if(data.error==0){
			 						var e=$('#img-list');
									e.append("<img class='exp-img' src='"+dir+data.url+"'  ondblclick=select_image_exit(this) onclick=\"select_image(this);\" width=130 height=100 style='border:2px solid #eee;cursor:pointer;margin:10px'  />");
									get_images($('#up-folder').val());
									e.scrollTop(e[0].scrollHeight);
									$('#uploadimage input[type=submit]').attr('value','Upload');
								}else{
									alert(data.msg);
								}
							}
		 
					});
					 
				});
			});
			
	}
}

function set_who_open_image(e){
	
	who_open_image=e;
}


function folder_select(file,e){
	$(".exp-img").removeClass("selectedBorder").css("border-color","#eee");
	$('.folder').hide();
	$('#'+file).show();
	$('#up-folder').val(file);
	$('.images-row').removeClass("selectedBorder").css("background","#fff");
	$(e).addClass("selectedBorder").css("background","#eee");
	$(e).addClass("selectedBorder").css("color","#000");

}

function add_folder(){
	
	var name = prompt("folder name", "new folder");
	$.post(dir+'/do/jPhoto_do.php',{
		action: 'new-folder',
		name: name
	},function(data){
 		var e="<tr   onclick=\"folder_select('"+name+"',this);get_images('"+name+"')\" class='images-row'  style='cursor:pointer;border-bottom:1px solid #eee'>";
		e+="<td><img src="+dir+"/images/folder.png width=50 height=50  style=cursor:pointer />  ";
		e+="</td>";
		e+="<td style='vertical-align: middle;'>"+name+"</td>"; 
		e+="</tr>";
	  	
	  	$('#folders table').append(e);
		$('#folders').scrollTop($("#folders")[0].scrollHeight);
		
		var e="<div class=folder style='display:block;' id="+name+">";
	  	e+="<div style='background:#fff;padding:3px;border-bottom:1px solid #ccc'>"+name+"</div></div>";
	  	
	  	$('.folder').hide();
	  	$('#up-folder').val(name);
	  	$('#folder-open').prepend(e);

	},"json");

}

function delete_folder(){
	
 
	var name=$('.images-row.selectedBorder').find('td').eq(1).html();
	if(name===undefined){
		alert("Chose a folder ?");
		return;
	}
		
	if(!confirm("delete ? "+name))
		return;
	 
	$.post(dir+'/do/jPhoto_do.php',{
		action: 'delete-folder',
		name: name
	},function(data){
		$('.images-row.selectedBorder').remove();
		$('.images-row').click();
		alert(data.msg);
		
	},"json");

}

function select_image(e){
	var url=$(e).attr("src");
	$(".exp-img").removeClass("selectedBorder").css("border-color","#ddd");
	$(e).addClass("selectedBorder").css("border-color","#800000");
	$('#jPhotoImgSelectedUrl').val(url);
}


function select_image_exit(e){
	
	var url=$(e).attr("src");
	$(who_open_image).attr("src",url);
	$(who_open_image).prev('input').val(url).select();
	$('#jPhoto').hide();
	/*
	 * Code add
	 */
	
	$('#theme .themeValue').val("url("+url+")");
	
}

/*
 * Supprimer image
 */

function delete_image(){
	
	var name=$('.exp-img.selectedBorder').attr('src');
	
	 
	var folder=$('#up-folder').val();
 	if(name=== undefined){
 		alert("Chose a picture !");
 		return;
 	}
 		
 	
	if(!confirm("delete ?"))
		return;
	
 	var file = name.split("/");
	name=file[file.length-1];
 	$.post(dir+'/do/jPhoto_do.php',{
		action: 'delete-image',
		name: name,
		folder: folder
	},function(data){
		$('.exp-img.selectedBorder').remove();
		alert(data.msg);
		
	},"json");
	
}

/*
 * Retourner les images
 */

function get_images(folder){
	$('#img-list').html("loading..");
	$.post(dir+'/do/jPhoto_do.php',{
		action: 'get-images' ,
		folder: folder
	},function(data){
		 
		 
		var img="";
		 
		for(i=0;i<data.result.length;i++){
			 
			img+="<img src='"+data.result[i]+"' class='exp-img'   ondblclick=select_image_exit(this) onclick=\"select_image(this);$('#img-selected').attr('src',$(this).attr('src'))\" width=130 height=100 style='border:2px solid #eee;cursor:pointer;margin:10px' />";
			
		}
		
		$('#img-list').empty().append(img);
		
	},"json");
}

function jPhotoRun(){
	$('.jPhoto').each(function(){
		if($(this).attr("type")=="text"){
			$('.jPhoto').after("<img src="+dir+"/images/default.png  class=image-icon style='cursor:pointer;width:70px; height:70px' />");
			$('.jPhoto').attr("type","hidden");
			$('.jPhoto').val(dir+"default.png");
		}
	});
	
	$('.image-icon').on("click",function(){
		who_open_image=this;
		$('#jPhoto').show();
	});	
}




