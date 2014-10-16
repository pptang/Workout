<?php
session_start();
if($_SESSION['admin']==FALSE)
  header("Location: index.php");
include("mysql.inc.php");
include("progress.php");
$sql="SELECT * FROM detail WHERE Hid = '{$_SESSION['Uid']}'";
$result = mysql_query($sql);
if(mysql_num_rows($result)>0) $_SESSION['haveRecipe'] = 1;
else $_SESSION['haveRecipe'] = 0;

?>
<html>
<head>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/index.css" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="dashboard.css" />
<link href="jumbotron.css" rel="stylesheet">
<title> 基本資料 </title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

</head>

<body style="background-color: #2D3E50;">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="main.php">壯壯強</a>
          <!--If clicking logout button, redirect to auth.php to give out access token-->
          <?php
			       echo '<a class="navbar-brand">你好, '.$_SESSION['Uname'].'!</a>';
		      ?>
          <a class="navbar-brand" href="auth.php?logout=1" style="margin-left: 50px" >登出?</a>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="main.php">首頁</a></li>
            <li><a href="basicInfo.php">我的主頁</a></li>
            <li><a href="" data-toggle="modal" data-target="#members">組隊健身</a></li>
                <li><a href="" data-toggle="modal" data-target="#beFriend"> 
                  <span class="badge pull-right">
                   <?php
                    header("content-type:text/html;charset=UTF-8");
                    include("mysql.inc.php");
                    $sql = "SELECT * FROM friend WHERE friend='{$_SESSION['Uname']}' && status='0'";
                    $result = mysql_query($sql);
                    if(mysql_num_rows($result) > 0){
                     echo mysql_num_rows($result);
                    }else{
                       echo "0";
                    }
                   ?>
                  </span>有人邀請你</a></li>      
          	<li><a href="produce.php">創建新菜單</a></li>
            <li><a href="calendar.php">我的菜單</a></li>
          </ul>
        </div>


        <div class="container theme-showcase">
        <!-- Main jumbotron for a primary marketing message or call to action -->
          <div class="jumbotron" style="margin-left: 10%;">
    	       <h1>我的主頁</h1>
<!--顯示出朋友名字-->
              <?php
		header("content-type:text/html;charset=UTF-8");
		include("mysql.inc.php");
		$total = array();
		$sql = "SELECT * FROM friend WHERE friendid='{$_SESSION['Uid']}' && status='1'";
		$result = mysql_query($sql);
		if(mysql_num_rows($result) > 0){
			while($data = mysql_fetch_array($result)){
				$ok = "<p>" . $data['myname'] . "</p>";
				array_push($total , $ok);
			}
		}
		$sqll = "SELECT * FROM friend WHERE Uid='{$_SESSION['Uid']}' && status='1'";
		$resultt = mysql_query($sqll);
		if(mysql_num_rows($resultt) > 0){
			while($data = mysql_fetch_array($resultt)){
				$okk = "<p>" . $data['friend'] . "</p>";
				array_push($total , $okk);
			}
		}
		$answer = array_unique($total);
		foreach($answer as $value) {
      //progress bar
      echo $value;   
      echo '<div class="progress progress-striped">
              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="1" style="width:20%">
                <span class="sr-only">20% Complete (success)</span>
                <span>20%</span>
              </div>
            </div>';
		}
		$total = array();
		$answer = array();
    echo $_SESSION['Uname'];
    echo '<div class="progress progress-striped">
              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="1" style="width:'.$_SESSION['progress'].'%">
                <span class="sr-only">20% Complete (success)</span>
                <span>'.$_SESSION['progress'].'%</span>
              </div>
          </div>';   

    $sql="SELECT * FROM basicInfo WHERE Uid='{$_SESSION['Uid']}'";
    $result=mysql_query($sql);
    $row=mysql_fetch_array($result);
    if(mysql_num_rows($result)>0){
      $sex=$row[sex];
      $age=$row[age];
      $height=$row[height];
      $weight=$row[weight];
      if($sex=='male')
        $BMR=(13.7*$weight)+(5.0*$height)-(6.8*$age)+66;
      else
        $BMR=(9.6*$weight)+(1.8*$height)-(4.7*$age)+655;
      echo '<h2>我的基礎代謝率為 '.$BMR.'</h2>';
      $temp=$height*$height/10000;
      $BMI=$weight/$temp;
      echo '<h2>我的BMI為 '.$BMI.'</h2>';
    }else
      echo '<h2>你還沒創建菜單哦!</h2>';	                 
?>		

          </div>
        </div>
       </div>
      </div>



<!--Below is the content of pop-out be-friend page-->
<!-- Modal -->
      <div class="modal fade" id="beFriend" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">誰邀請你</h4>
            </div>
            <div class="modal-body">
              <form id="sayyesFriend" class="form-horizontal" role="form" action="sayok.php" method="POST">
                <div class="form-group">
                  <label for="yes" class="col-sm-2 control-label">
                   <?php
                      header("content-type:text/html;charset=UTF-8");
                      include("mysql.inc.php");
                      $sql = "SELECT * FROM friend WHERE friend='{$_SESSION['Uname']}' && status='0'";
                      $result = mysql_query($sql);
                      while($data = mysql_fetch_array($result)){
                         echo "<p>" . "<input type='checkbox' name='yes[]' value='{$data['Uid']}' />{$data['myname']}" . "</p>";
                      }
                   ?>
                  </label>
                </div>
              </form>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-default" data-dismiss="modal" value="關閉">
                <input type="submit" class="btn btn-primary" id="sayyes" form="sayyesFriend" value="確認">
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <!--Below is the content of pop-out team page-->
      <!-- Modal -->
      <div class="modal fade" id="members" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">組隊健身</h4>
                </div>
                <div class="modal-body">
                  <form id="addingFriend" class="form-horizontal" role="form">
                      <div class="form-group">
                        <label for="friending" class="col-sm-2 control-label">邀請對象</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="friending" placeholder="暱稱" name="friending" />
                        </div>
                      </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <input type="submit" class="btn btn-default" data-dismiss="modal" value="關閉">
                    <input type="submit" class="btn btn-primary" id="adding" form="addingFriend" value="加入">
                </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div><!-- /.modal --> 



</body>
</html>
		