<?php
require_once("../config.php");
$root=JMIND_DIR;
?>

 <div id="jPhoto" style="display:none;direction:ltr;width: 819px;font-family:calibri;position:fixed;border:1px solid gray;background:#eee;margin:auto;left:0;top:0;right:0;bottom:0; border-radius:5px;width:800;height:600px;z-index:100000000">
	<div style="background:linear-gradient(180deg,#696767,#171616);padding:5px;color:white">
		Pictures explorer
		<img src="<?php echo($root); ?>/images/x.png" onclick="$('#jPhoto').fadeOut()" style="position:absolute;right:5px;top:5px;width:15px;cursor:pointer" />
	</div>
	<div style="padding:10px;height:549px;background:#eee">
	 			
				<div style='height:425px;background:white;padding:10px'>
					<div style="display:table;width:100%">
						<div style="display:table-cell;width:200px;vertical-align:top">
							<div style="overflow-y:scroll;height:529px;">
								 <div id="folders" style='width:200px;float:left; background:white;padding:10px'>
				 				  <div style='text-align:right ;border-bottom:1px solid gray;'>
				 				  <img id=delete-folder title='Supprimer un dossier' onclick="delete_folder()" src="<?php echo($root); ?>/images/delete.png" style='cursor:pointer' width=20 height=20 />
				 				  <img id=add-folder title='Nouveau dossier' onclick="add_folder()" src="<?php echo($root); ?>/images/add-folder.png" style='cursor:pointer' width=20 height=20 /> 				    
				 				  </div>
				 				  
				 				  <table width=100% cellpadding=0 cellspacing=0>
				 				
							 	<?php 
								   
							 	   
				 				  $files = scandir(ROOT_IMAGES);
				 				  
				 				  foreach($files as $file){
								  	if($file=="." || $file=="..")continue;
								  	echo"<tr onclick=\"folder_select('".$file."',this);get_images('".$file."')\" class='images-row' style='cursor:pointer;border-bottom:1px solid #eee'>";
								  	echo"<td style='width: 60px;'><img src=".$root."/images/folder.png width=50 height=50  title=".$file." />  ";
								  	echo"</td>";
								  	echo"<td style='vertical-align: middle;'>".$file."</td>";
								  	echo"</tr>";
								  }
								 
								  ?> 
								 </table> 
								</div> 
							</div>
							
						</div>
						<div style="display:table-cell;width:200px;vertical-align:top">
							<div style="overflow-y:scroll;height: 415px;width: 167px;">
								<div style="text-align: right;padding: 3px;border-bottom: 1px solid gray;">
									<img src="<?php echo($root); ?>/images/delete.png" style='cursor:pointer;width:20px;height:20px' onclick='delete_image()' />
								</div>
								<div id="img-list"></div>
							</div>
							
						</div>
						<div style="display:table-cell;vertical-align:top">
							<div style="overflow-y:scroll;width: 384px;height: 416px;">
								<img  id="img-selected" />
							</div>
							
						</div>	
					</div>
				</div>

				 
 				  
 				  <br/><br/><br/>
 				  		<div style="position: absolute;right: 12px;bottom: 34px;background: white;padding: 10px;width: 576px;border-top: 1px solid gray;" >
					  		<form id="uploadimage"  method="post" enctype="multipart/form-data" >
								<input type="file" id=file name=file /> 
								<input type="hidden"  name=action value=up />
					  			<input type="hidden"  name=folder id=up-folder value=varietes /> 
								<input type="submit" value=Upload  />
	 						</form>	
					  		<input type="text" placeholder="adress.." style="padding-left:5px;color:#555;width:500px;margin-top:8px;font-size:12px" onclick="$(this).select().copy()" id="jPhotoImgSelectedUrl" />
					  		<span id=up-infos></span>
				  	   </div>
 				  </div>   
 	</div>
</div>

