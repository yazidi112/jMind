<?php

require_once("../config.php");
 require_once("../lang/lang.php");

$dir=ROOT_IMAGES;


/*
 * function resize
 */

function resize($width, $height,$dir,$name,$file){
	
	list($w, $h) = getimagesize($file);
	$ratio = max($width/$w, $height/$h);
	$h = ceil($height / $ratio);
	$x = ($w - $width / $ratio) / 2;
	$w = ceil($width / $ratio);
	$path = $dir.$width.'x'.$height.'_'.$name;
	$imgString = file_get_contents($file);
	$image = imagecreatefromstring($imgString);
	$tmp = imagecreatetruecolor($width, $height);
	imagecopyresampled($tmp, $image,0, 0,$x, 0,$width, $height,$w, $h);
	
	switch ($_FILES['file']['type']) {
		case 'image/jpeg':
			imagejpeg($tmp, $path, 100);
			break;
		case 'image/png':
			imagepng($tmp, $path, 0);
			break;
		case 'image/gif':
			imagegif($tmp, $path);
			break;
		default:
			exit;
			break;
	}
	
	imagedestroy($image);
	imagedestroy($tmp);
	return $path;
}


/* 
 *  Fonction supprimer dossier
 */

function rrmdir($dir) {
	if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as $object) {
			if ($object != "." && $object != "..") {
				if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
			}
		}
		reset($objects);
		rmdir($dir);
		return true;
	}
	return false;
}

/*
 * Upload des images
 */

if($_POST['action']=="up"){
	$sourcePath = $_FILES['file']['tmp_name'];
	$extn = explode(".", strtolower($_FILES['file']['name']));
	$name=date("Ynjhis").rand().".".$extn[1];
 	$targetPath = $dir.$_POST['folder']."/".$name;  
	if(move_uploaded_file($sourcePath,$targetPath)){
		resize(300, 200,$dir.$_POST['folder'].'/',$name,$targetPath);
		$data=Array("error" => 0 ,"msg" => "ØªÙ… ØªØ­Ù…ÙŠÙ„ Ø§Ù„ØµÙˆØ±Ø©","msg_type" => "success", "url" => $targetPath);
	}else
		$data=Array("error" => 1 ,"msg" => "Ù„Ù… ÙŠØªÙ… Ø§Ù„ØªØ­Ù…ÙŠÙ„ Ø§Ù„Ù…Ø±Ø¬Ùˆ Ø§Ù„Ù…Ø­Ø§ÙˆÙ„Ø© Ù…Ø±Ø© Ø§Ø®Ø±Ù‰","msg_type" => "success", "url" => null);
 }
 
/*
 * Creation nouveau dossier
 */
 
if($_POST['action']=="new-folder"){
	 
	$name=$_POST['name'];
 	if (!mkdir($dir.$name, 0777, true)) {
		$data=Array("error" => 1 ,"msg" => "ØªØ¹Ø°Ø± Ø§Ù†Ø´Ø§Ø¡ Ø§Ù„Ù…Ø³ØªÙ†Ø¯ Ø§Ù„Ø±Ø¬Ø§Ø¡ Ø§Ù„Ù…Ø­Ø§ÙˆÙ„Ø© Ù…Ø±Ø© Ø§Ø®Ø±Ù‰","msg_type" => "error", "result" => null);
	}else 
		$data=Array("error" => 0 ,"msg" => "ØªÙ… Ø§Ù†Ø´Ø§Ø¡ Ø§Ù„Ù…Ø³ØªÙ†Ø¯","msg_type" => "success", "result" => null);
		
 }
 
/*
 * Suppression dossier
 */
 
 if($_POST['action']=="delete-folder"){
 
 	$name=$_POST['name'];
 	
 	if (!rrmdir($dir.$name)) {
 		$data=Array("error" => 1 ,"msg" => "Ù„Ù… ÙŠØªÙ… Ø§Ù„Ø­Ø°Ù� Ø§Ù„Ø±Ø¬Ø§Ø¡ Ø§Ù„Ù…Ø­Ø§ÙˆÙ„Ø© Ù…Ø±Ø© Ø£Ø®Ø±Ù‰","msg_type" => "error", "result" => null);
 	}else
 		$data=Array("error" => 0 ,"msg" => "ØªÙ… Ø­Ø°Ù� Ø§Ù„Ù…Ø³ØªÙ†Ø¯","msg_type" => "success", "result" => null);
 
 }
 
/*
 * Suppression image
 */
 
if($_POST['action']=="delete-image"){
 
 	$name=$_POST['name'];
 	$folder=$_POST['folder'];
 	if (!unlink($dir.$folder."/".$name)) {
 		$data=Array("error" => 1 ,"msg" => "Ù„Ù… ÙŠØªÙ… Ø§Ù„Ø­Ø°Ù� Ø§Ù„Ø±Ø¬Ø§Ø¡ Ø§Ù„Ù…Ø­Ø§ÙˆÙ„Ø© Ù…Ø±Ø© Ø£Ø®Ø±Ù‰","msg_type" => "error", "result" => null);
 	}else
 		$data=Array("error" => 0 ,"msg" => "ØªÙ… Ø­Ø°Ù� Ø§Ù„ØµÙˆØ±Ø©","msg_type" => "success", "result" => null);
 
 }
 
 
/*
 *  Retourner les images d'un dossier
 */
 
 if($_POST['action']=="get-images"){
 
 	 
 	$folder=$_POST['folder']; 
 	
 	 
 			$files = scandir($dir.$folder);
 			$data=Array();
 			foreach($files as $file){
				if($file=="." || $file==".." || strpos($file, '300x200') !== false)continue;
				  	$data[]=HOME.'images/'.$folder."/".$file;
				  }
 		 
 			
 	 
 	$data=Array("error" => 0 ,"msg" => "ØªÙ… Ø§Ù„ØªØ­Ù…ÙŠÙ„","msg_type" => "success", "result" => $data);
 
}
 
echo json_encode($data);






















?>