<?php
	require "mysqlconn.php";
	
	$sql="SELECT * FROM `customer` WHERE `Email`='".$_POST['email']."' AND OAuth='this'";
	$result=sqldatabaselink($link,$sql);
	if(count($result)>0){
		echo false;
	}else{
		echo true;
	}
	$link="";
?>