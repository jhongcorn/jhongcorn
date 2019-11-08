<?php
//查詢更改密碼的資訊
	require "mysqlconn.php";
	$Email=$_POST['forget_email'];
	$Phone=$_POST['forget_phone'];
	$birthday=$_POST['forget_birthday'];
	

	$sql="SELECT * FROM `customer` WHERE `Email`='".$Email."' AND `Phone`='".$Phone."' AND `birthday`='".$birthday."' AND OAuth='this'";
	$resalut=sqldatabaselink($link,$sql);
	if(count($resalut)>0){

		echo json_encode($resalut);
	}else{
		echo false;
	}
	$link="";
?>