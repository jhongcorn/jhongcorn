<?php
	require "mysqlconn.php";

	if(isset($_POST['registered'])){
		$title=isset($_POST["Customer_title"])?"先生":"小姐";
		$Name= $_POST["Customer_Last_Name"].$_POST["Customer_First_Name"];
		$Phone=$_POST["Customer_phone"];
		
		$Email= $_POST["Customer_email"];
		$Password= $_POST["Customer_password"];
		$Addr=$_POST['addr'];
		$Birthday= $_POST["Customer_birthday"];
		$OAuth_Id=date("ymd").rand();

		$sql="INSERT INTO `customer` (`Name`, `Title`, `First_Name`, `Last_Name`, `Phone`, `Email`, `password`, `Addr`, `birthday` , `OAuth`, `OAuth_Id`) VALUES ('".$Name."', '".$title."', '".$_POST["Customer_First_Name"]."', '".$_POST["Customer_Last_Name"]."', '".$Phone."', '".$Email."', '".$Password."', '".$Addr."', '".$Birthday."', 'this', '".$OAuth_Id."')";
		sqldatabaselink($link,$sql);
		
	 	$_SESSION['loginName']=$Name;
		$_SESSION['OAuth_Id']=$OAuth_Id;
		$_SESSION['OAuth']='this';	
		echo $_SESSION['OAuth_Id'];	

	 }else if(isset($_POST['login'])){
	 	$Email= $_POST["login_Email"];
	 	$Password= $_POST["login_password"];
	 	$sql="SELECT * FROM `customer` WHERE `Email`='".$Email."' AND `password`='".$Password."' AND OAuth='this'";
	 	$resault=sqldatabaselink($link,$sql);
	 	if(count($resault)>0){
	 		foreach ($resault as  $value) {
	 			$Name=$value['Name'];
	 			$OAuth_Id=$value['OAuth_Id'];
	 		}
		 	$_SESSION['loginName']=$Name;
			$_SESSION['OAuth_Id']=$OAuth_Id;
			$_SESSION['OAuth']='this';	
			echo $_SESSION['OAuth_Id'];
	 	}else{
	 		echo false;
	 	}
	 }else{
	 		header('Location: index.php');
	 	}
	 
	 	

 	$link="";
?>