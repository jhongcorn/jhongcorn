<?php
	if (isset($_POST['Change_Order'])) {
		if("Change_Order"==base64_decode(str_replace(" ","+",$_POST['Change_Order']))){
			require "mysqlconn.php";

			$sql="UPDATE `room_order` SET `adult`='".$_POST['adult']."',`child`='".$_POST['child']."',`room`='".$_POST['room']."' WHERE `Order_Id`='".$_POST['order_id']."' AND `hotel_Id`='".$_POST['hotel_id']."' AND `customer_Id`='".$_POST['customer_id']."' AND `OAuth_Id`='".$_POST['oauth_id']."'";
			sqldatabaselink($link,$sql);
			echo true;

		}else{
			echo false;
		}
	}else{
		header('Location: index.php');
	}

	if(isset($_POST['del_Order'])){
		if("del_Order"==base64_decode(str_replace(" ","+",$_POST['del_Order']))){
			require "mysqlconn.php";

			$sql="DELETE FROM `room_order` WHERE `Order_Id`='".$_POST['order_id']."' AND `hotel_Id`='".$_POST['hotel_id']."' AND `customer_Id`='".$_POST['customer_id']."' AND `OAuth_Id`='".$_POST['oauth_id']."'";
			sqldatabaselink($link,$sql);
			echo true;

		}else{
			echo false;
		}
	}else{
		header('Location: index.php');
	}
	$link="";
?>