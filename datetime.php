<html>
<head>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<!--<script src="dist/js/bootstrap.min.js"></script>--> 
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<!--calendar-->
<link href="fullcalendar/fullcalendar.css" rel='stylesheet' />
<link href="fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print' />
<link rel="stylesheet" type="text/css" media="screen" href="bootstrap-datetimepicker.min.css">
<script src="lib/moment.min.js"></script>
<script src="lib/jquery.min.js"></script>
<script src="lib/jquery-ui.custom.min.js"></script>
<script src="fullcalendar.min.js"></script>
<!--<script src='../lib/jquery.ui.draggable.js'></script> 
<script src='../lib/jquery-1.10.2.js'></script> 
<script src='../lib/jquery.ui.widget.js'></script> -->
<!--basic page -->
<link rel="stylesheet" type="text/css" href="css/index.css" />
<!-- Bootstrap core CSS -->
<!--<link href="dist/css/bootstrap.css" rel="stylesheet">-->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>壯壯強</title>
</head>
<body>
<div class="container">
    <div class="col-md-10">
        <div class='well'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
    </div>
</div>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="lib/moment.min.js"></script>
<script src="bootstrap-datetimepicker.min.js"></script>
</body>
</html>