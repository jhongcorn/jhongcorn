<?php
	require "mysqlconn.php";
	$sql="SELECT * FROM `customer` WHERE `OAuth_Id`='".$_POST['user_id']."'";
	$userresault=sqldatabaselink($link,$sql);
	$user_Customer_Id="";
	$user_OAuth_Id="";
	if(count($userresault)>0){
		foreach($userresault as $row){
			$user_Customer_Id=$row['Customer_Id'];
			$user_OAuth_Id=$row['OAuth_Id'];
		}

		$sql="SELECT * FROM `room_order` WHERE `customer_Id`='".$user_Customer_Id."' AND `OAuth_Id`='".$user_OAuth_Id."'"; 
		$bookingresault=sqldatabaselink($link,$sql);
		if(count($bookingresault)>0){
			foreach ($bookingresault as  $value) {
				$bookingdate=prDates($value['Checkin_date'],$value['Checkout_date'],$_POST['Checkin_date']);
			}
			if($bookingdate){
				sqldatabaselink($link,insertbooking($user_Customer_Id,$user_OAuth_Id));
				echo true;				
			}else{
				echo false;
			}
		}else{	
			sqldatabaselink($link,insertbooking($user_Customer_Id,$user_OAuth_Id));
			echo true;				
		}
		
	}else{
		echo false;
	}



	$link="";


	function insertbooking($user_Customer_Id,$user_OAuth_Id){
		$sql="INSERT INTO `room_order` ( `hotel_Id`, `customer_Id`, `OAuth_Id`, `Checkin_date`, `Checkout_date`, `adult`, `child`, `nights`, `room`, `times`) VALUES ( '".$_POST['hotel_id']."', '".$user_Customer_Id."', '".$user_OAuth_Id."', '".$_POST['Checkin_date']."', '".$_POST['Checkout_date']."', '".$_POST['adult']."', '".$_POST['child']."', '".$_POST['nights']."', '".$_POST['room']."',  '". date("Y-m-d H:i:s")."')";
		return $sql;
	}

	function prDates($start, $end,$new_start) { 

	    $dt_start = strtotime($start);
	    $dt_end   = strtotime($end);
	    $new_dt_start = strtotime($new_start);

 
 		if($dt_start<=$new_dt_start && $new_dt_start<=$dt_end){
 			return false;
 		}else{
 			return true;
 		}
        
    }	
?>
