<?php
session_start();
if($_SESSION['admin']==FALSE)
  header("Location: index.php");
include("mysql.inc.php");
$sql="SELECT * FROM detail WHERE Hid = '{$_SESSION['Uid']}'";
$result = mysql_query($sql);
if(mysql_num_rows($result)>0) $_SESSION['haveRecipe'] = 1;
else $_SESSION['haveRecipe'] = 0;
?>
<html>

<head>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="css/index.css" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="dashboard.css" />
<title> 製作菜單 </title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
</head>

<body style="background-color: #2D3E50;">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="main.php">Workout Recipe</a>
          <!--If clicking logout button, redirect to auth.php to give out access token-->
          <?php
			echo '<a class="navbar-brand">Hello, '.$_SESSION['Uname'].'!</a>';
		  ?>
          <a class="navbar-brand" href="auth.php?logout=1" style="margin-left: 50px" >Logout?</a>
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
          <div class="jumbotron" style="margin-left: 10%;">
    	       <?php echo '<h1>'.$_SESSION['Uname'].'的菜單</h1>'; ?>
             <p>填寫你的需求，讓我們來幫幫你！</p>
	           <div class="row">
	    	        <form id="produce">

					         <div class="input-group input-group-lg">
						          <span class="input-group-addon">性別</span>
						          <span class="input-group-addon"><input type="radio" name="sex" value="male" />男</span>
						          <span class="input-group-addon"><input type="radio" name="sex" value="female" />女</span>
					         </div>

					         <div class="input-group input-group-lg">
						          <span class="input-group-addon">年齡</span>
						          <input type="text" class="form-control" placeholder="年齡" name="age"/>
					         </div>
					         <div class="input-group input-group-lg">
						          <span class="input-group-addon">身高</span>
						          <input type="text" class="form-control" placeholder="公分" name="height"/>
					         </div>
					         <div class="input-group input-group-lg">
						          <span class="input-group-addon">體重</span>
						          <input type="text" class="form-control" placeholder="公斤" name="weight"/>
					         </div>	
					         <div class="input-group input-group-lg">
						          <span class="input-group-addon">一個禮拜想練哪幾天</span>
						          <span class="input-group-addon"><input type="checkbox" name="day[]" value="1" /> 星期一</span>
						          <span class="input-group-addon"><input type="checkbox" name="day[]" value="2"/> 星期二</span>
						          <span class="input-group-addon"><input type="checkbox" name="day[]" value="3"/> 星期三</span>
						          <span class="input-group-addon"><input type="checkbox" name="day[]" value="4"/> 星期四</span>
						          <span class="input-group-addon"><input type="checkbox" name="day[]" value="5"/> 星期五</span>
						          <span class="input-group-addon"><input type="checkbox" name="day[]" value="6"/> 星期六</span>
						          <span class="input-group-addon"><input type="checkbox" name="day[]" value="7"/> 星期日</span>
					         </div>
					         <div class="input-group input-group-lg">
						          <span class="input-group-addon">採用套裝菜單還是自行安排</span>
						          <span class="input-group-addon"><input type="radio" name="package" value="1" /> 套裝菜單</span>
						          <span class="input-group-addon"><input type="radio" name="package" value="0" /> 自行安排</span>
					         </div>
					         <div class="input-group input-group-lg">
  						          <span class="input-group-addon">訓練要維持多久</span>
  						          <span class="input-group-addon">
  						            <select class="form-control" name="lasting">
  							            <option>三個月</option>
  							             <option>六個月</option>
  							            <option>一年</option>
  							            <option>一年三個月</option>
  							             <option>一年六個月</option>
  							            <option>兩年</option>
  						            </select>
  						          </span>
        			     </div><!-- /.input-group -->
        			
                	 <div class='input-group date' id='datetimepicker1'>
                    	<input type='datetime' class="form-control" name="start" data-format="YYYY/MM/DD HH:mm:ss"/>
                    	<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    	</span>
                	 </div>
        			     <script type="text/javascript">
            			   $(function () {
                			 $('#datetimepicker1').datetimepicker();
            			   });
        			     </script>
        			     <button style="text-align: left" form="produce" type="submit" formaction="dataProcess.php" formmethod="post" class="btn btn-primary">生成</button>
        			     <button form="produce" type="reset" class="btn btn-primary">重設</button>
		            </form>
		          </div>
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
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="lib/moment.min.js"></script>
<script src="datetimepicker.js"></script>

</body>
</html>