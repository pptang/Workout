<?php
	header("content-type:text/html;charset=UTF-8");
	session_start();
	include("mysql.inc.php");
	if(!empty($_POST['Uname']) && !empty($_POST['mail']) && !empty($_POST['pwd'])){
		$sql="SELECT * FROM account WHERE email='{$_POST['mail']}'"; //find if same account exists
		$result=mysql_query($sql);
		if(mysql_num_rows($result)>0){ //if having same user in the DB, throw error message
			duplicate("This account has already been registered.");
		}else{
			$sql="INSERT INTO account (Uname, email, password) VALUES ('{$_POST['Uname']}', '{$_POST['mail']}', '{$_POST['pwd']}')"; //insert new user account info
			$result=mysql_query($sql);
			if(mysql_affected_rows()>0){ //if successfully insert
				$sql="SELECT * FROM account where email='{$_POST['mail']}'"; //get account info for uid 
				$result=mysql_query($sql);
				$data=mysql_fetch_array($result);
				if(mysql_num_rows($result)>0){
					$_SESSION['Uid']=$data[0];
					$_SESSION['Uname']=$data[1];
					$_SESSION['admin']=TRUE;
					success("success");
					//die(json_encode(array("status" => "ok")));
				}
			}
		}
	}
	function duplicate($message){
		die($message);
	}
	function success($message){
		die($message);
	}
?>
