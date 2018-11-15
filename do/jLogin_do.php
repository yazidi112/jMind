<?php 
session_start();
require_once('../config.php');
require_once('../db/securite.class.php');
require_once('../db/cnx.class.php');
require_once("../lang/lang.php");

if(!isset($_SESSION['cnx']['captcha']))
	$_SESSION['cnx']['captcha']="";

if($_POST['action']=="login"){
	
	
	
	if(!isset($_SESSION['cnx']['c']))
		$_SESSION['cnx']['c']=0;
	else
		$_SESSION['cnx']['c']=$_SESSION['cnx']['c']+1;
	
	
	
	$cnx=cnx::getInstance();
	
	$user=securite::s($_POST['user']);
	$pwd=securite::s($_POST['pwd']);
	$captcha="";

	if(isset($_POST['captcha'])){
		$captcha=securite::s($_POST['captcha']);
	}

	
	$sql="SELECT * FROM ".ACCOUNT_TABLE." where ".ACCOUNT_USER_FIELD."='".$user."' ";
	$sql.="and ".ACCOUNT_PWD_FIELD."=".ACCOUNT_HASH_FUNCTION."('".$pwd."')"; 
	$r=$cnx->query($sql);

	if($_SESSION['cnx']['c']>=4 && $captcha!=$_SESSION['cnx']['captcha']){

		
		$data=Array("error" =>1, "msg"=> $j_errorCaptcha, "result" => "red","trying"=>$_SESSION['cnx']['c'], "captcha"=>$_SESSION['cnx']['captcha'], "Your captcha"=>$captcha);

	}else if(!empty($r)){
	
		

		$_SESSION['auth']=$r[0];

 		$_SESSION['cnx']['c']=0;
		$data=Array("error" =>0, "msg"=> $j_connected , "result" => "green","url"=>LOGIN_SUCCESS_URL);

	}else{
		$data=Array("error" =>1, "msg"=> $j_errorCnx, "result" => "red","trying"=>$_SESSION['cnx']['c'],"url"=>LOGIN_ERROR_URL);
	}

}



if($_POST['action']=="logout"){

	session_destroy();

	$data=Array("error" =>1, "msg"=> $j_Disconnceted ,"msg_type" => "success", "result" => "green");



}

 	
if($_POST['action']=="changepwd"){

	$cnx=cnx::getInstance();
	$oldpwd=securite::s($_POST['oldpwd']);
	$newpwd=securite::s($_POST['newpwd']);
	$user=$_SESSION['auth'][ACCOUNT_USER_FIELD];
	
	$sql="select ".ACCOUNT_PWD_FIELD." from ".ACCOUNT_TABLE."  where  ".ACCOUNT_USER_FIELD."='{$user}'";
	
 	$data=$cnx->query($sql);
 		
 		if($data[0][0]!=md5($oldpwd)){
 			$r= 0;
 		}else{
 			$sql="update ".ACCOUNT_TABLE." set  ".ACCOUNT_PWD_FIELD."=".ACCOUNT_HASH_FUNCTION."('{$newpwd}') where  ".ACCOUNT_USER_FIELD."='{$user}'";
	
 			$cnx->update($sql);
 			$r=1;
 		}

	if($r==0)
			$data=Array("error" => 0 ,"msg" => "Error ! Try again..","msg_type" => "error");
		else
			$data=Array("error" => 1 ,"msg" => "Update done !","msg_type" => "success");


}

echo json_encode($data);

?>



 







