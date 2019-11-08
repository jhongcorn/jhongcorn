<?php 
	require "mysqlconn.php";
?>
<!DOCTYPE HTML>
<html lang="en">
	<?php require "head.php";?>
	<body >
	 	<div  class="container border border-info">
	 		<?php 
	 			require "header.php";
	 			if(isset($_GET['citylink'])){
	 				if(isset($_GET[$citylink.'_Id'])){
	 					require $citylink.'.php';
	 				}else{
	 					require 'citylink.php';
	 				}	
	 			}else{
	 				require "city.php";
	 			}

	 			require 'footer.php';
	 		?>

		</div>
	</body>
</html>
<? $link="";?>