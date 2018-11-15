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
require_once("../db/securite.class.php");
require_once("../lang/lang.php");

$cnx=cnx::getInstance();


if($_POST['action']=="add"){


	$values=$_POST['values'];
	$tb=new table($cnx,$_POST['table']);
 	$id=$tb->save($values);
	

	$data=Array("error" => 0 ,"msg" =>  $j_inserted	 ,"msg_type" => "success", "result" => $id);
	echo json_encode($data);
}

if($_POST['action']=="update"){


	$values=$_POST['values'];
	$tb=new table($cnx,$_POST['table']);
	$id=$tb->update($values);


	$data=Array("error" => 0 ,"msg" =>  $j_updated ,"msg_type" => "success", "result" => $id);
	echo json_encode($data);
}

 

if($_POST['action']=="getCols"){

	$tb=new table($cnx,$_POST['table']);
	$data=$tb->getStructure();


	$data=Array("error" => 0 ,"msg" =>  $j_loded ,"msg_type" => "success", "result" => $data);
	echo json_encode($data);
}
 

if($_POST['action']=="find"){

	$tb=new table($cnx,$_POST['table']);
	$data=$tb->find($_POST['key']);


	$data=Array("error" => 0 ,"msg" =>  $j_loded ,"msg_type" => "success", "result" => $data);
	echo json_encode($data);
}

if($_POST['action']=="function"){

	$tb=new table($cnx,$_POST['table']);
	$data=$tb->_function($_POST['condition'],$_POST['name'],$_POST['field']);
	$data=Array("error" => 0 ,"msg" =>  $j_loded ,"msg_type" => "success", "result" => $data[0]);
	echo json_encode($data);
}


?>