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
	 		?>
	 		<!-- Footer -->
			<footer class="page-footer sticky-top font-small bg-info">
			  <!-- Copyright -->
			  <div class=" text-center py-2 ">
			  	<a href="#" class="">Reference:</a>
			    <a href="https://mdbootstrap.com/">MDBootstrap</a>
			    -
			    <a href="https://getbootstrap.com">Bootstrap</a>
			    -
			    <a href="https://jqueryui.com">jQuery UI</a>
			    -
			    <a href="https://jquery.com">jQuery</a>
			    -
			    <a href="https://www.w3schools.com">w3schools.com</a>
			  </div>
			  <!-- Copyright -->
			</footer>
			<!-- Footer -->
		</div>
	</body>
</html>
<? $link="";?>