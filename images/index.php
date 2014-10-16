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
          <a class="navbar-brand" href="#">Workout Recipe</a>
          <?php //Check if the user click logout button
          if($_SESSION['admin']==FALSE){
          	echo "<a class='navbar-brand' href='#' style='margin-left:50px'>out!</a>";
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
            <button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-success">Login</button>
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
        <div class="item active">
          <img alt="First slide" src="pics/home.jpg">
          <div class="container">


          </div>
        </div>
        <div class="item">
          <img data-src="holder.js/900x500/auto/#666:#6a6a6a/text:Second slide" alt="Second slide" src="pics/intense.jpg">
          <div class="container">
            <div class="carousel-caption">
              <h1>壯壯強</h1>
              <!--<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>-->
            </div>
          </div>
        </div>
        <div class="item">
          <img data-src="holder.js/900x500/auto/#555:#5a5a5a/text:Third slide" alt="Third slide" src="pics/gym.jpg">
          <div class="container">
            <div class="carousel-caption">
              <!--<h1>One more for good measure.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>-->

            </div>
          </div>
        </div>
      </div>
      <!--<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>-->
      <div style="text-align: center; margin-top: 5px;">        
        <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
          Register &raquo;
        </button>
      </div>
    </div><!-- /.carousel -->
    <!-- Main jumbotron for a primary marketing message or call to action -->

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image" src="images/15.jpg">
        </div>
      </div>


    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-4">
        <!--<img class="img-circle" data-src="images/intense.jpg" alt="140x140" src="images/intense.jpg" style="width: 960px; height: 640px;">-->
          <h2>Is working out neccessarily?</h2>
          <p>For sure！</p>
          <p><button class="btn btn-default" data-toggle="modal" data-target="#reason1">Tips &raquo;</button></p> <!--看理由用js-->
        </div>
        <div class="col-lg-4">
          <h2>Can girls take advantage of this website?</h2>
          <p>Absolutely！</p>
          <p><button class="btn btn-default" data-toggle="modal" data-target="#reason1">Tips &raquo;</button></p>
       </div>
        <div class="col-md-4">
          <h2>I'm too fat to do this.</h2>
          <p>Fuck you man. Just get an account first!</p>
          <p><button class="btn btn-default" data-toggle="modal" data-target="#reason1">Tips &raquo;</button></p>
        </div>
      </div>

   

      <footer>
        <p>&copy; Pai-Lin Dreamer 2014</p>
      </footer>
    </div> <!-- /container -->
</div>
</div>
</div>
<!--Below is the content of pop-out register page-->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">First Step</h4>
      </div>
      <div class="modal-body">
        <form id="newUser" class="form-horizontal" role="form" action="insertDB.php" method="POST">
          <div class="form-group">
            <label for="inputName3" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputName3" placeholder="Name" name="Uname">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="mail">
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="pwd">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
          <input type="submit" class="btn btn-default" data-dismiss="modal" value="Close">
          <input type="submit" class="btn btn-primary" id="register" form="newUser" value="Register">
      </div>
       </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal -->
<div class="modal fade" id="reason1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">為什麼我他媽非得健身</h4>
      </div>
      <div class="modal-body">
          <p>若你對以下一個範疇有興趣，你就應該健身。<br />
              1.減肥瘦身 改善體型 <br />
              2.結實肌肉 稱羨身材 <br />
              3.增強體能 減少患病 <br />
              4.強大肌肉 體型健碩 <br /></p>
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
