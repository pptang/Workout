<?php
header("content-type:text/html;charset=UTF-8");
session_start();
include("mysql.inc.php");
echo 'test';
if(empty($_POST['friending'])){
	die(json_encode(array("status" => "empty" , "message" => "Please enter a name")));
}else{
	if($_SESSION['Uname'] == $_POST['friending']){
		die(json_encode(array("status" => "self" , "message" => "You are an idiot")));
	}else{
		$sql = "SELECT * FROM account WHERE Uname='{$_POST['friending']}'";
		$result = mysql_query($sql);
		if(mysql_num_rows($result) > 0){
			$sql = "SELECT * FROM friend WHERE Uid='{$_SESSION['Uid']}' && friend='{$_POST['friending']}' && status='0'";
			$result = mysql_query($sql);
			if(mysql_num_rows($result) > 0){
				die(json_encode(array("status" => "addperson" , "message" => "This guy has been added already")));
			}else{
				$sql = "SELECT * FROM friend WHERE Uid='{$_SESSION['Uid']}' && friend='{$_POST['friending']}' && status='1'";
				$result = mysql_query($sql);
				if(mysql_num_rows($result) > 0){
					die(json_encode(array("status" => "yesperson" , "message" => "This guy is your friend already")));
				}else{
					$sql = "SELECT * FROM friend WHERE friendid='{$_SESSION['Uid']}' && myname='{$_POST['friending']}' && status='1'";
					$result = mysql_query($sql);
					if(mysql_num_rows($result) > 0){
						die(json_encode(array("status" => "yesperson" , "message" => "This guy is your friend already")));
					}else{
						$sql = "SELECT * FROM account WHERE Uname='{$_POST['friending']}'";
						$result = mysql_query($sql);
						while($data = mysql_fetch_array($result)){
							$sql = "INSERT INTO friend (Uid , myname , friendid , friend , status) VALUES ('{$_SESSION['Uid']}' , '{$_SESSION['Uname']}' , '{$data['Uid']}' , '{$_POST['friending']}' , '0')";
							$result = mysql_query($sql);
							if(mysql_affected_rows() > 0){
								die(json_encode(array("status" => "success")));
							}
						}
					}
				}
			}
		}else{
			die(json_encode(array("status" => "noperson" , "message" => "We don't have this member")));
		}
	}
}
?>
