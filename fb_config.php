<?php

	require "Facebook/autoload.php";
	$FB = new \Facebook\Facebook([
	  'app_id' => '793040067785350',
	  'app_secret' => 'cf450a0fc8322ae59a19f1dbb1f5f6a6',
	  'default_graph_version' => 'v2.10',
	]);

	$helper=$FB->getRedirectLoginHelper();
	if (isset($_GET['state'])) {
   	 $helper->getPersistentDataHandler()->set('state', $_GET['state']);
	}
	$redirectURL="http://localhost/jhongcorn/fb-callback.php";
	$permissions=['email'];
	$fbloginURL=$helper->getLoginUrl($redirectURL,$permissions);

?>