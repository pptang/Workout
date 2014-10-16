<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Tablecloth</title>
<!-- paste this code into your webpage -->
<!--<link href="tablecloth/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />-->
<!-- Bootstrap core CSS -->
<link href="dist/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/index.css" />
<!-- Custom styles for this template -->
<link href="jumbotron.css" rel="stylesheet">
<script type="text/javascript" src="tablecloth/tablecloth.js"></script>

<!-- end -->

</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="main.php">回 首 頁</a>
        </div>
      </div>
    </div>
<?php
	session_start(); //use session to record the login status
	header("content-type:text/html; charset=utf-8");
	include("mysql.inc.php");
	$sql="SELECT * FROM recipe where Uid='{$_SESSION['Uid']}'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	if(mysql_num_rows($result)>0){
		$mon=$row[2];
		$tue=$row[3];
		$wed=$row[4];
		$thur=$row[5];
		$fri=$row[6];
		$sat=$row[7];
		$sun=$row[8];
	}
	else{
		echo '<h1>你還沒創建菜單哦! </h1>';
	}
  $sql="SELECT * FROM aero where Uid='{$_SESSION['Uid']}'";
  $result=mysql_query($sql);
  $row=mysql_fetch_array($result);
  if(mysql_num_rows($result)>0){
    $aero=$row[1];
  }
  else{
    echo '<h1>你還沒創建菜單哦! </h1>';
  }
?>
<div class="container theme-showcase">
    <!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
  <h1>我的菜單</h1>
<!--test-->
<table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th><h2>星期一</h2></th>
            <th><h2>星期二</h2></th>
            <th><h2>星期三</h2></th>
            <th><h2>星期四</h2></th>
            <th><h2>星期五</h2></th>
            <th><h2>星期六</h2></th>
            <th><h2>星期日</h2></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><h2>部位</td>
            <td><?php if($mon) echo $mon; else echo '休息';?></td>
            <td><?php if($tue) echo $tue; else echo '休息';?></td>
            <td><?php if($wed) echo $wed; else echo '休息';?></td>
            <td><?php if($thur) echo $thur; else echo '休息';?></td>
            <td><?php if($fri) echo $fri; else echo '休息';?></td>
            <td><?php if($sat) echo $sat; else echo '休息';?></td>
            <td><?php if($sun) echo $sun; else echo '休息';?></td>
          </tr>
          <tr>
            <td><h2>有氧</h2></td>
            <td><?php echo $aero;?></td>
            <td><?php echo $aero;?></td>
            <td><?php echo $aero;?></td>
            <td><?php echo $aero;?></td>
            <td><?php echo $aero;?></td>
            <td><?php echo $aero;?></td>
            <td><?php echo $aero;?></td>
          </tr>
          <tr>
            <td><h2>食物</h2></td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
          </tr>
        </tbody>
      </table>
  </div>
  </div>  
</body>
</html>
