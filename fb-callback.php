<?php
	require "mysqlconn.php";
	require "fb_config.php";

	try{
		$accessToken=$helper->getAccessToken();
	}catch(\Facebook\Exceptions\FacebookResponseException $e){
		echo "Response Exception:".$e->getMessage();
		exit();
	}catch(\Facebook\Exceptions\FacebookSDKException $e){
		echo "SDK Exception:".$e->getMessage();
		exit();
	}

	if(!$accessToken){
		headerget();
		exit();
	}

	$oAuth2Client=$FB->getOAuth2Client();
	if(!$accessToken->isLongLived()){
		$accessToken=$oAuth2Client->getLongLivedAccessToken($accessToken);
	}
	$response=$FB->get("me?fields=id, first_name, last_name, email, picture.type(large)",$accessToken);
	$userData=$response->getGraphNode()->asArray();
	$sql="SELECT * FROM customer WHERE `OAuth_Id`=".$userData['id']." AND `OAuth`='facebook'";
	$result=sqldatabaselink($link,$sql);
	if(count($result)>0){
		foreach ($result as $row) {
			$sql="UPDATE `customer` SET `Name`='".$userData['last_name'].$userData['first_name']."',`First_Name`='".$userData['first_name']."',`Last_Name`='".$userData['last_name']."',`Email`='".$userData['email']."',`picture`='".$userData['picture']['url']."',`OAuth_Id`='".$userData['id']."' WHERE `Customer_Id`=".$row["Customer_Id"];
			sqldatabaselink($link,$sql);
			$_SESSION['loginName']=$userData['last_name'].$userData['first_name'];
			$_SESSION['OAuth_Id']=$userData['id'];
			$_SESSION['OAuth']=$row['OAuth'];
			$_SESSION['picture']=$userData['picture']['url'];
		}
		
	}else{
		$sql="INSERT INTO `customer` (`Name`,  `First_Name`, `Last_Name`,  `Email`, `picture`, `OAuth`, `OAuth_Id`) VALUES ('".$userData['last_name'].$userData['first_name']."',  '".$userData['first_name']."', '".$userData['last_name']."',  '".$userData['email']."', '".$userData['picture']['url']."', 'facebook', '".$userData['id']."')";
			sqldatabaselink($link,$sql);
			$_SESSION['loginName']=$userData['last_name'].$userData['first_name'];
			$_SESSION['OAuth_Id']=$userData['id'];
			$_SESSION['OAuth']='google';
			$_SESSION['picture']=$userData['picture']['url'];
	}
	headerget();
	$link="";
	exit();
?>