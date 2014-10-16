<?php
	session_start(); //use session to record the login status
?>
<?php
	header("content-type:text/html;charset=UTF-8");
	include("mysql.inc.php");
	if($_GET['logout']==1){
		$_SESSION['admin']=FALSE;
		header("Location: index.php");
	}else{
		if(!empty($_POST['mail']) && !empty($_POST['pwd'])){ //if get mail and password info
			$sql="SELECT * FROM account WHERE email='{$_POST['mail']}' && password='{$_POST['pwd']}'"; //check if password is correct
			$result=mysql_query($sql);
			$data=mysql_fetch_array($result);
			if(mysql_num_rows($result)>0){ //if correct, user will get access token ($_SESSION['admin']=TRUE)
				$_SESSION['admin']=TRUE;
				$_SESSION['Uid']=$data[0];
				$_SESSION['Uname']=$data[1]; //set user name session for future use
				//header("Location: main.php");
				success("success");
			}else{
				//no corresponding record in database -> back to index page and enter again
				//ajax
				//echo "Please enter correct mail and password.";
				//header("Location: main.php");
				invalid("Email or Password is false");
			}
		}else{
			//doesn't enter mail or pwd
			//ajax
			//echo "Please enter the mail and password.";
			//header("Location: main.php");
			blank("Enter Email or Password");
		}
	}
	function invalid($message){
		die($message);
	}
	function blank($message){
		die($message);
	}
	function success($message){
		die($message);
	}
?>