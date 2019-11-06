<?php

    session_start();
	
	$link=sqlconnlink("jhongcorn");


		$citylink='hotel_ch';
		$dbtable='hotel_ch';
		$pagetext="間民宿";
		$errorimg="bg.png";
		$table_Id='hotel_Id';
		$tablelink='hotel_ch_Id';
	if(isset($_GET['scenic_spot'])){
		$citylink='scenic_spot';
		$dbtable='scenic_spot';
		$pagetext="個景點";
		$errorimg="bg1.png";
		$table_Id='scenic_Id';
		$tablelink='scenic_spot_Id';
	}else if(isset($_GET['hotel_ch'])){
		$citylink='hotel_ch';
		$dbtable='hotel_ch';
		$pagetext="間民宿";
		$errorimg="bg.png";
		$table_Id='hotel_Id';
		$tablelink='hotel_ch_Id';
	}else if(isset($_GET['restaurant'])){
		$citylink='restaurant';
		$dbtable='restaurant';
		$pagetext="間店家";
		$errorimg="bg2.png";
		$table_Id='restaurant_Id';
		$tablelink='restaurant_Id';
	}

	function sqlconnlink($dbname){
		$servername="127.0.0.1";
		$username="jhongcorn";
		$password="jhongcorn";
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password)or die("資料庫連線失敗:".$conn->connect_error);
	    $conn->query("SET NAMES utf8mb4");
	    return $conn;
	}

	function sqldatabaselink($link,$sql){
		$stmt = $link->query($sql); 
	  	return $stmt->fetchAll();
	}


	function headerget(){
		$linkuser="";


		if(isset($_SESSION['get'])){
			foreach($_SESSION['get'] as $key=>$value){
				$linkuser.=$key.'='.$value.'&';
			}
		
			header('Location: index.php?'.$linkuser);
		}else{
			header('Location: index.php');
		}
	
	}

	$i=0;
	$cityName = array();
	$cityimg = array();
	$sql="SELECT * FROM city ORDER BY `city`.`City_ch` ASC";
    $city=sqldatabaselink($link,$sql);

	     foreach ($city as $row){
	    	 $cityName[$i]=$row['City_ch'];
	         $cityimg[$i]=$row['City_img'];
	       	$i++;
	    }   	
	   

?>