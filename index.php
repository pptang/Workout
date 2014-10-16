<?php
session_start();
?>

<html>
  <head>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="lib/moment.min.js"></script>
    <script src="lib/jquery.min.js"></script>
    <script src="lib/jquery-ui.custom.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet"  href="css/carousel.css">   
    <title>Workout Recipe</title>
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">壯壯強</a>
          <?php //Check if the user click logout button
          if($_SESSION['admin']==FALSE){
          	echo "<a class='navbar-brand' href='#' style='margin-left:50px'>尚未登入</a>";
          }
          ?>
        </div>
        <div class="navbar-collapse collapse">
          <form id="loginform" class="navbar-form navbar-right" method="POST" action="auth.php">
            <div class="form-group">
              <input type="text" id="mail" name="mail" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" id="pwd" name="pwd" placeholder="Password" class="form-control">
            </div>
            <button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-success">登入</button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#register">註冊</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    <div class="container">
    <div class="body">
    <div class="main-content">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active" style="margin-left: 20px;">
          <img src="pics/home.jpg">
          <div class="container">
            <div class="carousel-caption">
              <h1 style="color: #FF4000">壯壯強</h1>
            </div>
          </div>
        </div>
        <div class="item" style="margin-left: 10px;">
          <img src="pics/intense.jpg">
          <div class="container">
            <div class="carousel-caption">
              <h1 style="color: #FF4000">壯壯強</h1>
            </div>
          </div>
        </div>
        <div class="item" style="margin-left: 10px;">
          <img src="pics/gym.jpg">
          <div class="container">
            <div class="carousel-caption">
              <h1 style="color: #FF4000">壯壯強</h1>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.carousel -->
    <!-- Main jumbotron for a primary marketing message or call to action -->



    <div class="container marketing" style="margin-left: 15%;">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-3">
        <img class="img-circle" alt="140x140" src="pics/15.jpg">
          <h2>為什麼出現壯壯強</h2>
          <p><button class="btn btn-default" data-toggle="modal" data-target="#reason1">起源 &raquo;</button></p> <!--看理由用js-->
        </div>
        <div class="col-lg-3">
          <img class="img-circle" alt="140x140" src="pics/16.jpg">
          <h2>誰該使用壯壯強</h2>
          <p><button class="btn btn-default" data-toggle="modal" data-target="#reason1">對象 &raquo;</button></p>
       </div>
        <div class="col-md-3">
          <img class="img-circle" alt="140x140" src="pics/17.jpg">
          <h2>怎麼使用壯壯強</h2>
          <p><button class="btn btn-default" data-toggle="modal" data-target="#reason1">功能 &raquo;</button></p>
        </div>
      </div>

   

      <footer>
        <p>&copy; 百齡夢想家 2014</p>
      </footer>
    </div> <!-- /container -->
</div>
</div>
</div>
<!--註冊頁的Modal-->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">加入</h4>
      </div>
      <div class="modal-body">
        <form id="newUser" class="form-horizontal" role="form" action="insertDB.php" method="POST">
          <div class="form-group">
            <label for="inputName3" class="col-sm-2 control-label">暱稱</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputName3" placeholder="Name" name="Uname">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">電子信箱</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="mail">
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">密碼</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="pwd">
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-default" data-dismiss="modal" value="關閉">
            <input type="submit" class="btn btn-primary" id="btnRegister" value="註冊">
          </div>
       </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--為什麼壯壯強的Modal -->
<div class="modal fade" id="reason1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">為什麼壯壯強</h4>
      </div>
      <div class="modal-body">
          <p>
              1.想要減肥瘦身 <br /><br />
              2.練出肌肉線條 <br /><br />
              3.增強自己的體能 <br /><br />
              4.增加自己某項運動的爆發力 <br /><br /></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="js/auths.js"></script>
  </body>
</html>
