	var citydata=function(){
		var cityjson=null;
		$.ajax({
			url: 'AllData.json',
			async: false,
			type: 'GET',
			dataType: 'json',
			success:function(data){cityjson=data;},
			error:function(){alert("error")},
		});
		return cityjson;
	}();


	function emailbind(id,value){
		var regemail=/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})*$/;
		if(regemail.test(value)){
			$("#"+id).removeClass('border border-danger');
			return true;
		}else{
			$("#"+id).val("");
			$("#"+id).addClass('border border-danger');
			$('#modalConfirmDelete').modal('show');
			$('#modalConfirmDelete span').html('Email格式錯誤');
			return false;
			} 
	}

	function repassword(repwid){
		var pwid=repwid.replace("re_","");
		var pw=$("#"+pwid);
		var repw=$("#"+repwid);
		if(pw.val()==repw.val()){
			$("#"+repwid).removeClass('border border-danger');
			return true;
		}else{
			$("#"+repwid).val("");
			$("#"+repwid).addClass('border border-danger');
			$('#modalConfirmDelete').modal('show');
			$('#modalConfirmDelete span').html('密碼不一致');
			return false;
			} 
	}

	function regpassword(id,value){
		var regpw=/^(?=.*[^a-zA-Z0-9])(?=.*[A-Z,a-z])(?=.*\d).{8,12}$/;
		
		if(regpw.test(value)){
			$("#"+id).removeClass('border border-danger');
			return true;
		}else{
			$("#"+id).val("");
			$("#"+id).addClass('border border-danger');
			$('#modalConfirmDelete').modal('show');
			$('#modalConfirmDelete span').html('格式錯誤');
			return false;
			} 
	}

	function namebind(id,value){
		var regname=/^([\u4e00-\u9fa5A-Za-z]*)$/;

		if(regname.test(value)){
			$("#"+id).removeClass('border border-danger');
			return true;
		}else{
			$("#"+id).val("");
			$("#"+id).addClass('border border-danger');
			$('#modalConfirmDelete').modal('show');
			$('#modalConfirmDelete span').html('只能輸入中文或英文');
			return false;
			} 
	}

	function Phonebind(id,value){
	
   		var regPhone = /^09[0-9]\d{7}$|^0(2|3|4|5|6|7|8)\d{0,2}\d{6,8}$/;

		if(regPhone.test(value)){
			$("#"+id).removeClass('border border-danger');
			return true;
		}else{
			$("#"+id).val("");
			$("#"+id).addClass('border border-danger');
			$('#modalConfirmDelete').modal('show');
			$('#modalConfirmDelete span').html('請輸入正常電話格式');
			return false;
			} 

	}

	function regAddr(id,value){
		var rgeAddr=/^([1-9][0-9]*)$/;

		if(rgeAddr.test(value)){
			$("#"+id).removeClass('border border-danger');
			return true;
		}else{
			$("#"+id).val("");
			$("#"+id).addClass('border border-danger');
			$('#modalConfirmDelete').modal('show');
			$('#modalConfirmDelete span').html('只能輸入數字');
			return false;
			} 
		
	}

	function map(id){

		for(city=0;city<citydata.length;city++){
			$("#"+id).append("<option data-id="+city+" value="+citydata[city].CityName+">"+citydata[city].CityName+"</option>");
		}
		
	}
	function map_city(data_id,id2,id3){

		$("#"+id2).empty();
		$("#"+id3).empty();
		$("#"+id2).append("<option value=''>區域</option>");
		$("#"+id3).append("<option value=''>路(街)名或鄉里名稱</option>");
		
		for(area=0;area<citydata[data_id].AreaList.length;area++){
			
			$("#"+id2).append("<option data-id="+area+" value="+citydata[data_id].AreaList[area].AreaName+">"+citydata[data_id].AreaList[area].AreaName+"</option>");
		
		}
				
			
		
	}
	function map_region(data_id,id1,id2,id3){	
		$("#"+id3).empty();
		$("#"+id3).append("<option value=''>路(街)名或鄉里名稱</option>");
		var city=$("#"+id1).find(':selected').data('id');
		var area=$("#"+id2).find(':selected').data('id');			
		for(road=0;road<citydata[city].AreaList[area].RoadList.length;road++){
			$("#"+id3).append("<option value="+citydata[city].AreaList[area].RoadList[road].RoadName+">"+citydata[city].AreaList[area].RoadList[road].RoadName+"</option>");
		}
					
	}

	function Addrsum(id1,id2,id3,id_str){
		
		return ($("#"+id1).val()+$("#"+id2).val()+$("#"+id3).val()+($("#"+id_str+"lane").val()!=""?$("#"+id_str+"lane").val()+"巷":"")+($("#"+id_str+"alley").val()!=""?$("#"+id_str+"alley").val()+"弄":""+$("#"+id_str+"num").val()+"號")+($("#"+id_str+"f1").val()!=""?$("#"+id_str+"f1").val()+"樓":"")+($("#"+id_str+"suite").val()!=""?$("#"+id_str+"suite").val()+"室":""));
	}