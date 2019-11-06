<?php
	if(isset($_POST['Search_text'])){
		header("Content-Type:text/html;charset=utf8");
		require 'mysqlconn.php';
		$Search_text=mb_ereg_replace("台","臺",$_POST['Search_text']);
		$sql_restaurant=sqltable('`restaurant`',$Search_text);
		$resault_restaurant=sqldatabaselink($link,$sql_restaurant);
		$json_restaurant=array();
		$json_hotel_ch=array();
		$json_scenic_spot=array();
		if(count($resault_restaurant)>0){
			foreach ($resault_restaurant as  $key => $value) {
				$json_restaurant[]=$value;
			}
		}

		$sql_hotel_ch=sqltable('`hotel_ch`',$Search_text);
		$resault_hotel_ch=sqldatabaselink($link,$sql_hotel_ch);
		if(count($resault_hotel_ch)>0){
			foreach ($resault_hotel_ch as $key => $value) {
				$json_hotel_ch[]=$value;
			}
		}

		$sql_scenic_spot=sqltable('`scenic_spot`',$Search_text);
		$resault_scenic_spot=sqldatabaselink($link,$sql_scenic_spot);
		if(count($resault_scenic_spot)>0){
			foreach ($resault_scenic_spot as  $key => $value) {
				$json_scenic_spot[]=$value;
			}
		}
		$json=array($json_restaurant,$json_hotel_ch,$json_scenic_spot);
		echo json_encode($json);
		

		$link="";
	}	

	function sqltable($table,$search){
		return "SELECT * FROM ".$table." WHERE `Name` LIKE '%$search%' OR `Description` LIKE '%$search%' OR  `Town` LIKE '%$search%'";
	}
?>