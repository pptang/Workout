$(document).ready(function(){
	$("#addingFriend").submit(function(){
		return false;
	});
	$("#adding").click(function(){
		var data = $("#addingFriend").serializeArray();
		$.post("newTeam.php" , data , function(json){
			if(json.status == "empty"){
				alert(json.message);
			}
			if(json.status == "self"){
				$("#friending").val("");
				alert(json.message);
			}
			if(json.status == "noperson"){
				$("#friending").val("");
				alert(json.message);
			}
			if(json.status == "addperson"){
				$("#friending").val("");
				alert(json.message);
			}
			if(json.status == "yesperson"){
				$("#friending").val("");
				alert(json.message);
			}
			if(json.status == "success"){
				window.location = "main.php";
			}
		} , "json");
	});
});