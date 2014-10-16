$(document).ready(function(){
	$("#newFriend").submit(function(){
		return false;
	});
	$("#invite").click(function(){
		$.post("insertfriend.php" , function(json){
			if(json.status == "empty"){
				alert(json.message);
			}
			if(json.status == "nofriend"){
				$("#friend").val("");
				alert(json.message);
			}
			if(json.status == "nobody"){
				$("#friend").val("");
				alert(json.message);
			}
			if(json.status == "already"){//已經邀請過了
				$("#friend").val("");
				alert(json.message);
			}
			if(json.status == "double"){//已經有隊伍了
				$("#friend").val("");
				alert(json.message);
			}
			if(json.status == "self"){
				$("#friend").val("");
				alert(json.message);
			}
			if(json.status == "success"){
				window.location = "main.php";
			}
		} , "json");
	});
});