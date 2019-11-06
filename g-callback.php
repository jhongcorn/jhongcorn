<?php 
	require "g_config.php";
	require "mysqlconn.php";
	if(isset($_SESSION['access_token']))
	{
		$gClient->setAccessToken($_SESSION['access_token']);
	}
	else if (isset($_GET['code']))
	{
		$token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
		$_SESSION['access_token'] = $token;
	}
	else
	{
		headerget();
		exit();
	}

	
	$oAuth=new Google_Service_Oauth2($gClient);
	$userData=$oAuth->userinfo_v2_me->get();
	$sql="SELECT * FROM customer WHERE `OAuth_Id`=".$userData['id']." AND `OAuth`='google'";
	$result=sqldatabaselink($link,$sql);
	if(count($result)>0){
		foreach ($result as $row) {
			
			$sql="UPDATE `customer` SET `Name`='".$userData['familyName'].$userData['givenName']."',`First_Name`='".$userData['givenName']."',`Last_Name`='".$userData['familyName']."',`Email`='".$userData['email']."',`picture`='".$userData['picture']."',`OAuth_Id`='".$userData['id']."' WHERE `Customer_Id`=".$row["Customer_Id"];
			sqldatabaselink($link,$sql);
			$_SESSION['loginName']=$userData['familyName'].$userData['givenName'];
			$_SESSION['OAuth_Id']=$userData['id'];
			$_SESSION['OAuth']=$row['OAuth'];
			$_SESSION['picture']=$userData['picture'];
		}
		
	}else{
		$sql="INSERT INTO `customer` (`Name`,  `First_Name`, `Last_Name`,  `Email`, `picture`, `OAuth`, `OAuth_Id`) VALUES ('".$userData['familyName'].$userData['givenName']."',  '".$userData['givenName']."', '".$userData['familyName']."',  '".$userData['email']."', '".$userData['picture']."', 'google', '".$userData['id']."')";
			sqldatabaselink($link,$sql);
			$_SESSION['loginName']=$userData['familyName'].$userData['givenName'];
			$_SESSION['OAuth_Id']=$userData['id'];
			$_SESSION['OAuth']='google';
			$_SESSION['picture']=$userData['picture'];
	}

	headerget();
	$link="";
	exit();
?>
