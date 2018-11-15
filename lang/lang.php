<?php

if(isset($_SESSION['lang']))
	require_once($_SESSION['lang'].".php");
else{
	require_once("FR.php");
}

?>