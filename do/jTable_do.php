<?php 
require_once("../config.php");

if(LOGIN=='ON'){
	if(!isset($_SESSION['account'])){
		$data=Array("error" => 1 ,"msg" =>  "You are disconected !"	 ,"msg_type" => "error" );
		echo json_encode($data);
		exit();
	}
}

require_once("../db/cnx.class.php");
require_once("../db/table.class.php");
require_once("../db/view.class.php");
require_once("../db/securite.class.php");
require_once("../lang/lang.php");

$cnx=cnx::getInstance();


if($_POST['action']=="list"){
	
 	 
	$tb=new table($cnx,$_POST['table']);
	
	if(isset($_POST['search'])){
		$data=$tb->search($_POST['search'],$_POST['cols']);
	}else{
		$data=$tb->findBy($_POST['condition'],$_POST['cols']);
	}
	
	$data=Array("error" => 0 ,"msg" =>  $j_loded,"msg_type" => "success", "result" => $data);
	echo json_encode($data);
}

if($_POST['action']=="view"){

		
	$tb=new view($cnx,$_POST['table']);

	 
	$data=$tb->findBy($_POST['condition'],$_POST['cols']); 

	$data=Array("error" => 0 ,"msg" => $j_loded,"msg_type" => "success", "result" => $data);
	echo json_encode($data);
}



if($_POST['action']=="listWhere"){

		
	$tb=new table($cnx,$_POST['table']);

	$data=$tb->findWhere($_POST['condition'],$_POST['cols']);

	$data=Array("error" => 0 ,"msg" => $j_loded ,"msg_type" => "success", "result" => $data);
	echo json_encode($data);
}

if($_POST['action']=="delete"){
	
	$id=securite::s($_POST['id']);
 	$tb=new table($cnx,$_POST['table']);
	$data=$tb->delete($id);
	
	$data=Array("error" => 0 ,"msg" =>  $j_deleted ,"msg_type" => "success", "result" => null);
	echo json_encode($data);
}



if($_POST['action']=="quikUpdate"){

	$id=$_POST['id'];
	$coloun=$_POST['coloun'];
	$value=$_POST['value'];

	$tb=new table($cnx,$_POST['table']);
	$data=$tb->quikUpdate($id,$coloun,$value);

	$data=Array("error" => 0 ,"msg" =>  $j_updated ,"msg_type" => "success", "result" => null);
	echo json_encode($data);
}




 

?>