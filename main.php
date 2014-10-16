<?php
session_start();
if($_SESSION['admin']==FALSE)
	header("Location: index.php");
include("mysql.inc.php");
$sql="SELECT * FROM detail WHERE Hid = '{$_SESSION['Uid']}'";
$result = mysql_query($sql);
if(mysql_num_rows($result)>0) $_SESSION['haveRecipe'] = 1;
else $_SESSION['haveRecipe'] = 0;
$sql="SELECT COUNT(*) FROM invitation WHERE Mid='{$_SESSION['Uid']}' && expired=0";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$invitation=$row[0];
?>

<html>
<head>

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script src="addfriends.js"></script>
<link rel="stylesheet" type="text/css" href="css/index.css" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="dashboard.css" />
<link rel="stylesheet"  href="css/carousel.css"> 
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Workout Recipe</title>



<script>
  $(function() {
    $( "#legs" ).accordion();
    $( "#shoulders" ).accordion();
    $( "#lowerback" ).accordion();
    $( "#upperback" ).accordion();
    $( "#chest" ).accordion();
    $( "#biceps" ).accordion();
    $( "#triceps" ).accordion();
  });
</script>
<!--<script type="text/javascript">
	$(function() {
		/* position of the <li> that is currently shown */
		var current = 0;
		var loaded  = 0;
		for(var i = 1; i <4; ++i)
			$('<img />').load(function(){
				++loaded;
				if(loaded == 3){
					$('#bg1,#bg2,#bg3').mouseover(function(e){
						var $this = $(this);
						/* if we hover the current one, then don't do anything */
						if($this.parent().index() == current)
							return;
						/* item is bg1 or bg2 or bg3, depending where we are hovering */
						var item = e.target.id;

						/*
						this is the sub menu overlay. Let's hide the current one
						if we hover the first <li> or if we come from the last one,
						then the overlay should move left -> right,
						otherwise right->left
						 */
						if(item == 'bg1' || current == 2)
							$('#menu .sub'+parseInt(current+1)).stop().animate({backgroundPosition:"(-266px 0)"},300,function(){
								$(this).find('li').hide();
							});
						else
							$('#menu .sub'+parseInt(current+1)).stop().animate({backgroundPosition:"(266px 0)"},300,function(){
								$(this).find('li').hide();
							});

						if(item == 'bg1' || current == 2){
							/* if we hover the first <li> or if we come from the last one, then the images should move left -> right */
							$('#menu > li').animate({backgroundPosition:"(-800px 0)"},0).removeClass('bg1 bg2 bg3').addClass(item);
							move(1,item);
						}
						else{
							/* if we hover the first <li> or if we come from the last one, then the images should move right -> left */
							$('#menu > li').animate({backgroundPosition:"(800px 0)"},0).removeClass('bg1 bg2 bg3').addClass(item);
							move(0,item);
						}

						/*
						We want that if we go from the first one to the last one (without hovering the middle one),
						or from the last one to the first one, the middle menu's overlay should also slide, either
						from left to right or right to left.
						 */
						if(current == 2 && item == 'bg1'){
							$('#menu .sub'+parseInt(current)).stop().animate({backgroundPosition:"(-266px 0)"},300);
						}
						if(current == 0 && item == 'bg3'){
							$('#menu .sub'+parseInt(current+2)).stop().animate({backgroundPosition:"(266px 0)"},300);
						}

						
						/* change the current element */
						current = $this.parent().index();
						
						/* let's make the overlay of the current one appear */
					   
						$('#menu .sub'+parseInt(current+1)).stop().animate({backgroundPosition:"(0 0)"},300,function(){
							$(this).find('li').fadeIn();
						});
					});
				}	
			}).attr('src', 'images/'+i+'.jpg');
		
					
		/*
		dir:1 - move left->right
		dir:0 - move right->left
		 */
		function move(dir,item){
			if(dir){
				$('#bg1').parent().stop().animate({backgroundPosition:"(0 0)"},200);
				$('#bg2').parent().stop().animate({backgroundPosition:"(-266px 0)"},300);
				$('#bg3').parent().stop().animate({backgroundPosition:"(-532px 0)"},400,function(){
					$('#menuWrapper').removeClass('bg1 bg2 bg3').addClass(item);
				});
			}
			else{
				$('#bg1').parent().stop().animate({backgroundPosition:"(0 0)"},400,function(){
					$('#menuWrapper').removeClass('bg1 bg2 bg3').addClass(item);
				});
				$('#bg2').parent().stop().animate({backgroundPosition:"(-266px 0)"},300);
				$('#bg3').parent().stop().animate({backgroundPosition:"(-532px 0)"},200);
			}
		}
		
		$("#bg3").click(function(){
		//var test=1;
		//alert(test);
			var haveRecipe = <?php echo $_SESSION['haveRecipe']; ?>;
			if ( haveRecipe )
				window.location = "calendar.php";
			else
				alert("You haven't created any recipe!");
		})	
	
	
	});
</script>-->
</head>

<body style="background-color: #2D3E50;">
	<!--Navbar-->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="main.php">壯壯強</a>
          <?php
			echo '<a class="navbar-brand">你好, '.$_SESSION['Uname'].'!</a>';
		  ?>
          <a class="navbar-brand" href="auth.php?logout=1" style="margin-left: 50px" >登出?</a>
        </div>
      </div>
    </div>
	<!--Container-->
    <div class="container-fluid">
    	<div class="row">
    		<!--Sidebar-->
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
        	<!--progress bar   
			<div class="progress progress-striped">
  				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
    				--><!--<span class="sr-only">20% Complete (success)</span>-->
    				<!--<span> 20%</span>
  				</div>
			</div>-->

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

<!--
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
 <h2 class="page-header" style="color: whitesmoke;">Workout Recipe</h2>       
        <div style="border-radius: 10px;">
            
            <ul class="menu" id="menu"  style="border-radius: 10px;">
                <li class="bg1" style="background-position:0 0;">
                    <a id="bg1" href="basicInfo.php">Basic Info</a>
                    <ul class="sub sub1" style="background-position:0 0;">
                        <li><a href="#">Subtitle</a></li>
                    </ul>
                </li>
                <li class="bg1" style="background-position:-266px 0px;">
                    <a id="bg2" href="produce.php" >New Recipe</a>                    
                    <ul class="sub sub2" style="background-position:-266px 0;">
                    	<li><a href="#">Subtitle</a></li>
                        <li><a href="#" target="_blank">Submenu 1</a></li>
                        <li><a href="#" target="_blank">Submenu 2</a></li>
                        <li><a href="#" target="_blank">Submenu 3</a></li>                  </ul>
                </li>
                <li class="last bg1" style="background-position:-532px 0px;">
                    <a id="bg3">My Recipe</a>
                    <ul class="sub sub3" style="background-position:-266px 0;">
                    </ul>
                </li>
            </ul>
        </div>
                 
</div>-->
      <div class="row featurette" style="margin-top: 15px; margin-left: 280px">
        <div class="col-md-7">
          <h2 class="featurette-heading" style="margin-top: 15px; margin-left: 60%; color: white;">各部位練法</h2>
        </div>
        <div class="col-md-6" style="margin-top: 20px; margin-left: 25%;">
          <button class="btn btn-success" onclick="window.scrollTo(0,170);" >腿部</button>
          <button class="btn btn-success" onclick="window.scrollTo(0,820);" >下背肌</button>
          <button class="btn btn-danger" onclick="window.scrollTo(0,1500);" >三角肌</button>
          <button class="btn btn-info" onclick="window.scrollTo(0,2150);" >胸肌</button>
          <button class="btn btn-info" onclick="window.scrollTo(0,2780);" >三頭肌</button>
          <button class="btn btn-warning" onclick="window.scrollTo(0,3450);" >上背肌</button>
          <button class="btn btn-warning" onclick="window.scrollTo(0,4120);" >二頭肌</button>

			  </div>
      </div>
      <hr class="featurette-divider">
      <div class="row featurette" style="margin-top: 15px; margin-left: 280px">
    			<div class="col-md-7">
          			<h2 class="featurette-heading" style="margin-top: 15px; margin-left: 60%; color: white;">腿部(Legs)</h2>
        	</div>
        	<div class="col-md-6" style="margin-top: 20px;">
          	<img class="featurette-image img-responsive" src="pics/leg.jpg">
        	</div>
        	<div class="col-md-6" style="margin-top: 20px;">
              <ul class="nav nav-tabs" style="color: #FF4000;">
                <li class="active"><a href="#home" data-toggle="tab">深蹲</a></li>
                <li><a href="#profile" data-toggle="tab">踢板子</a></li>
                <li><a href="#messages" data-toggle="tab">往下摺</a></li>
                <li><a href="#settings" data-toggle="tab">往上摺</a></li>
              </ul>

<!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane active" id="home"><img src="pics/chest.JPG" class="img-thumbnail"></div>
                <div class="tab-pane" id="profile">...</div>
                <div class="tab-pane" id="messages"><img src="pics/chest1.jpg" class="img-thumbnail"></div>
                <div class="tab-pane" id="settings">...</div>
              </div> 
          	<!--<div id="legs">
  						<h3>深蹲</h3>
 						  <div>
    						<p>
    							深蹲六組
    						</p>
  						</div>
  						<h3>踢板子</h3>
  						<div>
    						<p>
    							踢板子四組
    						</p>
  						</div>
  						<h3>往下摺</h3>
  						<div>
    						<p>
    							往下摺四組
    						</p>
  						</div>
  						<h3>往上摺</h3>
  						<div>
    						<p>
    							往上摺四組
    						</p>
  						</div>
					  </div>-->
    		  </div>
          <div class="col-md-6" style="margin-top: 10px; margin-left: 50%;">
            <button class="btn btn-default" onclick="window.scrollTo(0,0);" >回上層</button>
          </div>
      </div>
    	<hr class="featurette-divider">
			<div class="row featurette" style="margin-left: 280px">
    			<div class="col-md-7">
          			<h2 class="featurette-heading" style="margin-top: 15px; margin-left: 40%; color: white;">下背肌(Lower Back)</h2>
        		</div>
        	<div class="col-md-6" style="margin-top: 20px;">
          		<img class="featurette-image img-responsive" src="pics/lowerback.jpg">
        	</div>
        	<div class="col-md-6" style="margin-top: 20px;">
          	<div id="lowerback">
  				  	<h3>羅馬椅</h3>
 						  <div>
    						<p>
    							羅馬椅五組
    						</p>
  						</div>
					  </div>
    			</div>
          <div class="col-md-6" style="margin-top: 20px; margin-left: 50%;">
            <button class="btn btn-default" onclick="window.scrollTo(0,0);" >回上層</button>
          </div>
    	</div>
    		<hr class="featurette-divider">
			<div class="row featurette" style="margin-left: 280px">
    			<div class="col-md-7">
          			<h2 class="featurette-heading" style="margin-top: 15px; margin-left: 45%; color: white;">三角肌(Shoulders)</h2>
        		</div>
        		<div class="col-md-6" style="margin-top: 20px;">
          			<img class="featurette-image img-responsive" src="pics/shoulders.jpg">
        		</div>
        		<div class="col-md-6" style="margin-top: 20px;">
          			<div id="shoulders">
  						<h3>棒子往上抬</h3>
 						<div>
    						<p>
    							(站直 肚臍到胸) 六組
    						</p>
  						</div>
  						<h3>棒子往上舉</h3>
  						<div>
    						<p>
    							(站直 從胸開始往上舉) 四組
    						</p>
  						</div>
  						<h3>機器往上舉</h3>
  						<div>
    						<p>
    							機器往上舉 四組
                  <img src="pics/chest.JPG" class="img-thumbnail">
    						</p>
  						</div>
					</div>
    			</div>
          <div class="col-md-6" style="margin-top: 20px; margin-left: 50%;">
            <button class="btn btn-default" onclick="window.scrollTo(0,0);" >回上層</button>
          </div>
    		</div>
    		<hr class="featurette-divider">
			<div class="row featurette" style="margin-left: 280px">
    			<div class="col-md-7">
          			<h2 class="featurette-heading" style="margin-top: 15px; margin-left: 45%; color: white;">胸肌(chest)</h2>
        		</div>
        		<div class="col-md-6" style="margin-top: 20px;">
          			<img class="featurette-image img-responsive" src="pics/chest1.jpg">
        		</div>
        		<div class="col-md-6" style="margin-top: 20px;">
          			<div id="chest">
  						<h3>臥推</h3>
 						<div>
    						<p>
    							臥推 六組
    						</p>
  						</div>
  						<h3>上胸</h3>
  						<div>
    						<p>
    							臥推但椅子立起來做 四組
    						</p>
  						</div>
  						<h3>夾胸</h3>
  						<div>
    						<p>
    							夾胸 四組
    						</p>
  						</div>
  						<h3>下胸</h3>
  						<div>
    						<p>
    							躺在斜板 舉啞鈴 四組
    						</p>
  						</div>
					</div>
    			</div>
          <div class="col-md-6" style="margin-top: 20px; margin-left: 50%;">
            <button class="btn btn-default" onclick="window.scrollTo(0,0);" >回上層</button>
          </div>
    		</div>
    		<hr class="featurette-divider">
			<div name="test" class="row featurette" style="margin-left: 280px">
    			<div class="col-md-7">
          			<h2 class="featurette-heading" style="margin-top: 15px; margin-left: 45%; color: white;">三頭肌(triceps)</h2>
        		</div>
        		<div class="col-md-6" style="margin-top: 20px;">
          			<img class="featurette-image img-responsive" src="pics/triceps.jpg">
        		</div>
        		<div class="col-md-6" style="margin-top: 20px;">
          			<div id="triceps">
  						<h3>M形桿後舉</h3>
 						<div>
    						<p>
    							M形桿後舉六組
    						</p>
  						</div>
  						<h3>啞鈴後舉</h3>
  						<div>
    						<p>
    							啞鈴後舉四組
    						</p>
  						</div>
  						<h3>三頭肌介紹</h3>
  						<div>
    						<p>
    							介紹
    						</p>
  						</div>
					</div>
    			</div>
          <div class="col-md-6" style="margin-top: 20px; margin-left: 50%;">
            <button class="btn btn-default" onclick="window.scrollTo(0,0);" >回上層</button>
          </div>
    		</div>
    		<hr class="featurette-divider">
			<div class="row featurette" style="margin-left: 280px">
    			<div class="col-md-7">
          			<h2 class="featurette-heading" style="margin-top: 15px; margin-left: 40%; color: white;">上背肌(Upper Back)</h2>
        		</div>
        		<div class="col-md-6" style="margin-top: 20px;">
          			<img class="featurette-image img-responsive" src="pics/upperback.jpg">
        		</div>
        		<div class="col-md-6" style="margin-top: 20px;">
          			<div id="upperback">
  						<h3>引體向上</h3>
 						<div>
    						<p>
    							引體向上 1-3下
    						</p>
  						</div>
  						<h3>棒子上舉</h3>
  						<div>
    						<p>
    							微蹲 背前傾打直 手下垂 往上抬到胸部位置 六組
    						</p>
  						</div>
  						<h3>從上往下拉的機台</h3>
  						<div>
    						<p>
    							從上往下拉的機台 四組
    						</p>
  						</div>
  						<h3>划船</h3>
  						<div>
    						<p>
    							划船 四組
    						</p>
  						</div>  						
					</div>
    			</div>
          <div class="col-md-6" style="margin-top: 20px; margin-left: 50%;">
            <button class="btn btn-default" onclick="window.scrollTo(0,0);" >回上層</button>
          </div>
    		</div>
    		<hr class="featurette-divider">
			<div class="row featurette" style="margin-left: 280px">
    			<div class="col-md-7">
          			<h2 class="featurette-heading" style="margin-top: 15px; margin-left: 45%; color: white;">二頭肌(Biceps)</h2>
        	</div>
        		<div class="col-md-6" style="margin-top: 20px;">
          			<img class="featurette-image img-responsive" src="pics/biceps.jpg">
        		</div>
        		<div class="col-md-6" style="margin-top: 20px;">
          			<div id="biceps">
  						<h3>第一種啞鈴舉法</h3>
 						<div>
    						<p>
    							第一種啞鈴舉法 五組
    						</p>
  						</div>
  						<h3>第二種啞鈴舉法</h3>
  						<div>
    						<p>
    							第二種啞鈴舉法 四組
    						</p>
  						</div>						
					</div>
    			</div>
    		</div>
        <div class="col-md-5" style="margin-top: 20px; margin-left: 50%;">
 
          <button class="btn btn-default" onclick="window.scrollTo(0,0);" >回上層</button>
    		  <h2 class="featurette-heading" style="margin-top: 15px; margin-left: 45%; color: white;"> 重訓的第一組是熱身 第二組從做起來比較輕鬆,做完還有餘力開始(ex:10kg),其他每一組都上升2.5-5kg </h2> 
        </div>
        <!-- Nav tabs -->
	
 		</div> <!--row-->
 	</div> <!--container-->

</body>
</html>