<?php 
	
	require_once 'GoogleAPI/vendor/autoload.php';
	$gClient=new Google_Client();
	$gClient->setClientId("956584468115-dqh1isqqf4hp2uftf9qb1qm31bss9soi.apps.googleusercontent.com");
	$gClient->setClientSecret("77i46DtWPboWJvdiiYUAi3Zk");
	$gClient->setApplicationName("jhongcorn");
	$gClient->setRedirectUri("http://localhost/jhongcorn/g-callback.php");
	$gClient->setScopes(array('https://www.googleapis.com/auth/plus.login','https://www.googleapis.com/auth/userinfo.email'));
	$_SESSION['get']=$_GET;
?>


