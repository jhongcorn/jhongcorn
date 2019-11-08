<?php
	require "mysqlconn.php";
		
	$Name="";
	$item= str_replace("userinfo_Customer_","",$_POST['item']);
	$value= str_replace("userinfo_Customer_","",$_POST['value']);
	$id=$_POST['id'];
	if(isset($_POST['OAuth_Id'])){
		$OAuth_Id=" AND `OAuth_Id`=".$_POST['OAuth_Id'];
	}else{
		$OAuth_Id="";
	}
	$sql="UPDATE `customer` SET `".$item."`='".$value."' WHERE `Customer_Id`=".$id.$OAuth_Id;
	
 	sqldatabaselink($link,$sql);

 	$sql="SELECT * FROM `customer` WHERE `Customer_Id`=".$id;
	$resault=sqldatabaselink($link,$sql);
	foreach($resault as $row){
	  $Name= $row["Last_Name"].$row["First_Name"];
	 $_SESSION['loginName']=$Name;
	 $_SESSION['picture']=$row['picture'];
	}
	echo $_SESSION['loginName'];

 	$link="";
?>