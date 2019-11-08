<!DOCTYPE html>
<html lang="en">
	<head>
	    <?php 
	    	require "head.php";
	    	require "mysqlconn.php";
	    	
	    ?>

		    <script>
				var reglane=true,regnum=false,regalley=true;
				var id4="userinfo_map_city";
				var id5="userinfo_map_region";
				var id6="userinfo_map_street";
				var id_str2="userinfo_Customer_Addr_";
				$(function(){		
						
					map(id4);
					$("#"+id4).change(function(){
						$("#"+id4).removeClass('border border-danger');
						map_city($("#"+id4).find(':selected').data('id'),id5,id6);
					});
					$("#"+id5).change(function(){
						$("#"+id5).removeClass('border border-danger');
						map_region($("#"+id2).find(':selected').data('id'),id4,id5,id6);
					});
					$("#"+id6).change(function(){
						$("#"+id6).removeClass('border border-danger');
					});
					$( "#userinfo_Customer_birthday" ).datepicker({
						yearRange:"-100:+0",
						dateFormat: 'yy-mm-dd',
						changeMonth:true,
						changeYear:true,
			 			maxDate:new Date(),
					});
					if($( "#userinfo_Customer_birthday" ).val()!=""){
						
						$(".fa-calendar-alt").addClass("active");
						
						$("label[for='userinfo_Customer_birthday']").addClass("active");
						
					}

					$("#userinfo_Customer_title").bind("change",function(){
						if($("#userinfo_Customer_title").prop("checked")){
							userinfo(this.id,"先生");
						}else{
							userinfo(this.id,"小姐");
						}
					});	
					$(".updatabtn").hide();
					$(".passwordbtn").hide();

					
					
				
					$("#"+id_str2+"lane").bind("input propertychange",function(){
				
						reglane=regAddr($(this).attr("id"),$(this).val());

					});				
					

				
					$("#"+id_str2+"alley").bind("input propertychange",function(){
					
						regalley=regAddr($(this).attr("id"),$(this).val());
				
					});
					$("#"+id_str2+"num").bind("input propertychange",function(){
						$("#"+id_str2+"lane").removeClass("border border-danger");
						$("#"+id_str2+"alley").removeClass("border border-danger");
						regnum=regAddr($(this).attr("id"),$(this).val());
					
					});

				});
			</script>

			<script>
				function nameapi(id){
					if(namebind(id,$("#"+id).val())){
						userinfo(id,$('#'+id).val());
					}
				}



				function passwordapi(id){
					if(regpassword(id,$("#"+id).val())){
						if(repassword(id)){
							userinfo(id.replace("re_",""),$("#"+id.replace("re_","")).val());
							window.setTimeout(function(){passwordbtn_exit();},1000)
						}
					}
				}

				function phoneapi(id){
					var phoneid=$('#'+id);
					var phoneapibind=Phonebind(id,phoneid.val());
					if(phoneapibind){
						userinfo(id,$('#'+id).val());
					}
						
					
				}
				function userinfo(id,val){	


					$.ajax({
						url: 'userinfo_api.php',
						type: 'post',
						dataType: 'text',
						data: {item:id,value:val,id:$("#userinfo_Customer_Id").val(),OAuth_Id:$("#userinfo_Customer_Id").attr("oauth_id")},
						success:function(data){
							console.log(data);
							$("#"+id+"_span").text('已儲存');
							$("#"+id+"_span").css("color","#0f0");
							$("#btnGroupDrop1").text(data);
							
							window.setTimeout(function(){window.location.replace(window.location.href);},1000);
							},
						error:function(){alert("error")},
					});
				}

				function updatapassword(){
				

					$('html,body,form').animate({scrollTop:$('#password').offset().top},100);
					$(".passwordbtn").show();
					$(".userinfopw").hide();
				}

				function updataAddr(){
					
					$(".updatabtn").show();	
					$(".userinfo").hide();
					
				}
				function updatabtn_exit(){
					
					$(".updatabtn").hide();	
					$(".userinfo").show();
					
				}

				function passwordbtn_exit(){
					
					$(".passwordbtn").hide();	
					$(".userinfopw").show();
					
				}

				function updataAddrapi(){
					if($("#"+id4).val()!="" && $("#"+id5).val()!="" && $("#"+id6).val()!=""){
						
						
						$("#userinfo_Customer_Addr").val(Addrsum(id4,id5,id6,id_str2));
						
						if(regnum){
							if(regnum && reglane && regalley){
								userinfo('userinfo_Customer_Addr',$("#userinfo_Customer_Addr").val());	
							}else {
								if($("#userinfo_Customer_Addr_lane").val()=="" && $("#userinfo_Customer_Addr_alley").val()=="" ){
									reglane=true;
									regalley=true;
									updataAddrapi();
								}
							}
						}else{
							$('#modalConfirmDelete').modal('show');
							$('#modalConfirmDelete span').html('號一定要輸入');
							$("#"+id_str2+"num").addClass("border border-danger");
							}				
						}else{
					
							$('#modalConfirmDelete').modal('show');
							$('#modalConfirmDelete span').html('地址資料沒選擇');
							if($("#"+id4).val()==""){
								$("#"+id4).addClass('border border-danger');
							}else{
								$("#"+id4).removeClass('border border-danger');
							}
							if($("#"+id5).val()==""){
								$("#"+id5).addClass('border border-danger');
							}else{
								$("#"+id5).removeClass('border border-danger');
							}
							if($("#"+id6).val()==""){
								$("#"+id6).addClass('border border-danger');
							}else{
								$("#"+id6).removeClass('border border-danger');
							}
						
					}


				}

				function upload_photo(id){

					$.ajax({
						url: 'upload/upload.php',
						type: 'POST',
						dataType: 'text',
						cache: false,
						data: new FormData($('#photoform')[0]),
						contentType: false,
		 				processData: false,
						success:function(data){
							if(data!=false){
								userinfo(id,data);
							}
							
						},
						error:function(){alert("error")},
					});
				}
		
		</script>

		<style>
			.card{
				position: relative;
			}
			.upload_cover {
				
				left:50%;
				transform: translateX(-50%);
				position:absolute;
				top:0;
				cursor: pointer;
				

			}
			#userinfo_Customer_picture {
				display: none;
			}
			.upload_icon {
				position:absolute;
				font-weight: bold;
				font-size: 4vw;
				bottom:2px;
				width: 100%;
				left:50%;
				transform: translateX(-50%);
				text-shadow: 0.1vw 0.1vw 1px #333,-0.1vw -0.1vw 1px #333;
			}
		</style>
	</head>
	<body class="container border border-info">


		<?php require "modal_error.php";?>
			
		<?php 
			require "header.php";
			if(isset($_SESSION['loginName'])){
				$sql="SELECT * FROM customer WHERE `OAuth_Id`=".$_SESSION['OAuth_Id']." AND `OAuth`='".$_SESSION['OAuth']."'";
				$result=sqldatabaselink($link,$sql);
				foreach($result as $row){
					
					foreach($cityName as $key=>$val){
						if( strpos($row['Addr'],$val)!==false){
							$Addrval=$key;
						}
					}
					
				
		?>
		<h5 class="card-header text-center">會員資料</h5>	
		<div class="card " > 

			<div>		
				
				<?php if(isset($Addrval)){?>
						
				<img class="card-img up-img-body" src="img/<?php echo $cityimg[$Addrval];?>" >

				<?php }else{

					echo '<div class="bg-info " style="height:39vw;"></div>';
				}

				?>
		        <div class=" text-center up-img" >
		        	<?php if($row['picture']){ ?>
		        	<img class="avatar rounded-circle img-thumbnail" src="<?php echo $row['picture'];?>" >
		        	<?php }else{
		        		echo '<div class="mx-auto avatar rounded-circle img-thumbnail p-1"><i class="fas fa-user "style="font-size:15vw;"></i></div>';
		        	} ?>
		        	<form action="upload/upload.php" method="post"  id="photoform" name="photoform" enctype="multipart/form-data">
			        	<label class="upload_cover avatar rounded-circle">
							<input id="userinfo_Customer_picture" name="userinfo_Customer_picture" type="file" onchange="upload_photo(this.id);">
							<span class="upload_icon"><i class="fas fa-camera text-white"></i></span>
						</label>
		        	</form>
						          	
		        </div>
	    	
				<span class="userinfo_Customer_picture_span"></span>	
			</div>	

			
			<div class="card-body">
				<input type="hidden" name="userinfo_Customer_Id" oauth_id="<?php echo $row['OAuth_Id']?>" id="userinfo_Customer_Id" value="<?php echo $row['Customer_Id'];?>">	    			
				<div>
					<div class="md-form ">
						<i class="fas fa-address-card prefix"></i>
						<input type="text" class="form-control" name="userinfo_Customer_Last_Name" id="userinfo_Customer_Last_Name" placeholder="姓氏" value="<?php echo $row['Last_Name'];?>" onchange="nameapi(this.id);">
						<span id="userinfo_Customer_Last_Name_span"></span>
					</div>						
					<div class="md-form ">
						<i class="fas fa-address-card prefix"></i>
						<input type="text" id="userinfo_Customer_First_Name" name="userinfo_Customer_First_Name" class="form-control" placeholder="名子" value="<?php echo $row['First_Name'];?>"  onchange="nameapi(this.id);">
						<span id="userinfo_Customer_First_Name_span"></span>
					</div>



				
				</div>							
				<div class="row">
					<div class="md-form ml-3">
						<i class="fas fa-venus-mars prefix"></i>
					</div>
					
					<div  class="onoffswitch3 ml-4 col-10 mt-4">
					    <input type="checkbox" name="userinfo_Customer_title" class="onoffswitch3-checkbox" id="userinfo_Customer_title" <?php echo $row['Title']=="先生"?'checked':'';?>>
					    <label class="onoffswitch3-label" for="userinfo_Customer_title">    	
					        <span class="onoffswitch3-inner">
					            <span class="onoffswitch3-active"><span class="onoffswitch3-switch"><i class="fas fa-mars"></i></span></span>
					            <span class="onoffswitch3-inactive"><span class="onoffswitch3-switch"><i class="fas fa-venus"></i></span></span>
					        </span>
					    </label>
					    <span id="userinfo_Customer_title_span"></span>
					</div>
				</div>

				<div class="md-form">
					<i class="fas fa-phone prefix"></i>
					<input type="tel" id="userinfo_Customer_Phone" name="userinfo_Customer_Phone" class="form-control" placeholder="09XXXXXXXX 或 04XXXXXXXX"  value="<?php echo $row['Phone'];?>" onchange="phoneapi(this.id);">
					<span id="userinfo_Customer_Phone_span"></span>	
				</div>	

				<div class="md-form">
					<i class="fas fa-envelope prefix"></i>
					<input type="email" id="userinfo_Customer_email" name="userinfo_Customer_email" class="form-control" placeholder="XXX@gmail.com" <?php echo $row['OAuth']=="this"?"":"readonly"; ?> value="<?php echo $row['Email'];?>" readonly>
					<span id="userinfo_Customer_email_span"></span>		
				</div>

				<div class="md-form">
				    <i class=" fas fa-map-marked-alt prefix"></i>
				    <div class="row pl-5">
				    	
				        <select class="mx-2 col-md-3 col-sm-12  custom-select  md-select updatabtn" name="userinfo_map_city" id="userinfo_map_city">
				        	<option value="">縣市</option>
				        </select>
				        <select class="mx-2 col-md-3 col-sm-12  custom-select  md-select updatabtn" name="userinfo_map_region" id="userinfo_map_region">
				        	<option value="">區域</option>
				        </select>  
				        <select class="mx-2 col-md-4 col-sm-12  custom-select  md-select updatabtn" name="userinfo_map_street" id="userinfo_map_street">
				        	<option value="">路(街)名或鄉里名稱</option>
				        </select>  
				        <input type="text"  class="ml-1 userinfo  col-md-10 form-control"   value="<?php echo $row['Addr'];?>" readonly>
				        <div class="row container">
					        <div class="col md-form updatabtn">
					        	<label class="pl-3"for="userinfo_Customer_Addr_lane">巷</label>
								<input type="text" id="userinfo_Customer_Addr_lane" name="userinfo_Customer_Addr_lane" class=" form-control">
							
					        </div>
					        <div class="col md-form updatabtn">
					        	<label class="pl-3" for="userinfo_Customer_Addr_alley">弄</label>
								<input type="text" id="userinfo_Customer_Addr_alley" name="userinfo_Customer_Addr_alley" class=" form-control" >
								
							</div>
					        <div class="col md-form updatabtn">
					        	<label class="pl-3" for="userinfo_Customer_Addr_num">號</label>
								<input type="text" id="userinfo_Customer_Addr_num" name="userinfo_Customer_Addr_num" class="form-control" >
							
							</div>
					        <div class="col md-form updatabtn">
					        	<label class="pl-3" for="userinfo_Customer_Addr_f1">樓</label>
								<input type="text" id="userinfo_Customer_Addr_f1" name="userinfo_Customer_Addr_f1" class="form-control">
								
							</div>
					        <div class=" col md-form updatabtn">
					        	<label for="userinfo_Customer_Addr_suite">室</label>
								<input type="text" id="userinfo_Customer_Addr_suite" name="userinfo_Customer_Addr_suite" class="form-control">

							</div>				        	
				        </div>

				       
						<input type="hidden" name="userinfo_Customer_Addr" id="userinfo_Customer_Addr">
				        <span id="userinfo_Customer_Addr_span"></span>
				        <div class=" ml-auto">
					        <a  class=" btn btn-info btn-sm rounded-pill userinfo pt-3" id="updatabtn" onclick="updataAddr();">修改地址</a>
					        <a  class=" btn btn-info btn-sm rounded-pill updatabtn pt-3  " id="updatabtn_submit" onclick="updataAddrapi();">保存</a>	 
					        <a  class=" btn btn-info btn-sm rounded-pill updatabtn pt-3" id="updatabtn_exit" onclick="updatabtn_exit();">取消</a>	 				        	
				        </div>
      
				    </div>        
				</div>
				<div class="md-form">
					<i class="fas fa-calendar-alt prefix"></i>
				    <input type="text" id="userinfo_Customer_birthday" name="userinfo_Customer_birthday"  readonly class="form-control datepicker " value="<?php echo $row['birthday']!='0000-00-00'?$row['birthday']:"";?>" onchange="userinfo(this.id,this.value);">
				    <label for="userinfo_Customer_birthday" class="pl-3">出生年月日</label>
				    <span id="userinfo_Customer_birthday_span"></span>
				</div>
					<?php if($row['OAuth']=="this"){?>
				<div class="d-flex justify-content-center row" id="password">
					
					<p class="ml-5 pl-4  passwordbtn col-12" style="font-size: 1vw;">需8~12位數，並且至少包含字母、數字、符號各一</p>
					<div class="md-form form-sm mb-4  passwordbtn col-12">
				        <i class="fas fa-lock prefix"></i>
				        <input type="password" id="userinfo_Customer_password" name="userinfo_Customer_password" class="form-control form-control-sm validate" placeholder="新密碼" onchange="regpassword(this.id,this.value);">
				        
				       <span id="userinfo_Customer_password_span"></span>	
				     </div>

					<div class="md-form form-sm  passwordbtn col-12">
				        <i class="fas fa-lock prefix"></i>
				        <input type="password" id="re_userinfo_Customer_password" class="form-control form-control-sm validate" placeholder="確認密碼" onchange="repassword(this.id);">
				        <span id="re_userinfo_Customer_password_span"></span>	
				    </div>
				    <a  class="btn btn-info btn-sm rounded-pill  pt-3  userinfopw "  onclick="updatapassword();">變更密碼</a>
				    <a  class="btn btn-info btn-sm rounded-pill passwordbtn pt-3" id="passwordbtn_submit" onclick="passwordapi('re_userinfo_Customer_password')">保存</a>	 
					<a  class="btn btn-info btn-sm rounded-pill passwordbtn pt-3" id="passwordbtn_exit" onclick="passwordbtn_exit();">取消</a>							
				</div>					
			</div>

			
			<?php }?>
		<?php }?>
		</div>
		
		<?php
			}else{
				header('location: index.php');
				exit();
			}
			$link="";
		?>				
																			
										

	</body>
</html>


