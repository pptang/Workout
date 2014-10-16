<?php
header("content-type:text/html;charset=UTF-8");
session_start();
include("mysql.inc.php");
if(!empty($_POST["friend"])){
	$sql = "SELECT * FROM team WHERE Uid='{$_SESSION['Uid']}' && friend='{$_POST['friend']}'";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0){
		die(json_encode(array("status" => "already" , "message" => "This guy has been invited already")));
	}else{
		$sql = "SELECT * FROM team WHERE friend='{$_POST['friend']}' && status='1'";
		$result = mysql_query($sql);
		if(mysql_num_rows($result) > 0){
			die(json_encode(array("status" => "double" , "message" => "This guy has a group already")));
		}else{
			$sql = "SELECT * FROM team WHERE myname='{$_POST['friend']}' && status='1'";
			$result = mysql_query($sql);
			if(mysql_num_rows($result) > 0){
				die(json_encode(array("status" => "double" , "message" => "This guy already has a group")));
			}else{
				$sql = "SELECT * FROM account WHERE Uname='{$_POST['friend']}'";
				$result = mysql_query($sql);
				if(mysql_num_rows($result) > 0){
					if($_POST['friend'] == $_SESSION['Uname']){
						die(json_encode(array("status" => "self" , "message" => "You are an idiot")));
					}else{
						$sql = "SELECT * FROM friend WHERE (myname='{$_POST['friend']}' && friend='{$_SESSION['Uname']}' && status='1') || (myname='{$_SESSION['Uname']}' && friend='{$_POST['friend']}' && status='1')";
						$result = mysql_query($sql);
						if(mysql_num_rows($result) == 0){
							die(json_encode(array("status" => "nofriend" , "message" => "This guy is not your friend")));
						}else{
							$sql = "SELECT * FROM account WHERE Uname='{$_POST['friend']}'";
							$result = mysql_query($sql);
							while($data = mysql_fetch_array($result)){
								$sql = "INSERT INTO team (Uid, myname, friendid, friend, status) VALUES ('{$_SESSION['Uid']}', '{$_SESSION['Uname']}', '{$data['Uid']}', '{$_POST['friend']}', '0')";
								$result = mysql_query($sql);
								if(mysql_affected_rows() > 0){
									die(json_encode(array("status" => "success")));
								}
							}
						}
					}
				}else{
					die(json_encode(array("status" => "nobody" , "message" => "We don't have this member")));
				}
			}
		}
	}
}else{
	die(json_encode(array("status" => "empty" , "message" => "Please enter a name")));
}
?>
