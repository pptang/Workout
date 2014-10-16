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
<meta charset='utf-8' />
<link href="fullcalendar/fullcalendar.css" rel='stylesheet' />
<link href="fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print' />
<link rel="stylesheet" type="text/css" href="css/index.css" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="dashboard.css" />
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="lib/moment.min.js"></script>
<script src="lib/jquery.min.js"></script>
<script src="lib/jquery-ui.custom.min.js"></script>
<script src="fullcalendar.min.js"></script>
<script>

	$(document).ready(function() {
		/* initialize the external events
		-----------------------------------------------------------------*/
	
		$('#external-events div.external-event').each(function() {
		
			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};
			
			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);
			
			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});
			
		});



		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		$('#calendar').fullCalendar({
			editable: true,
			header:{
				left: 'prev, next today',
				center: 'title',
				right: 'agendaWeek, month, agendaDay'
			},
			events: "http://mineralman.lionfree.net/workout/events.php",
   			//Convert the allDay from string to boolean
   			/*eventRender: function(event, element, view) {
    			if (event.allDay === 'true') {
     				event.allDay = true;
    			} else {
    				event.allDay = false;
    			}
   			},*/
			/*
			$('#calendar').fullCalendar( 'addEventSource',        
    			function(start, end, callback) {
        		// When requested, dynamically generate a
        		// repeatable event for every monday.
        		var events = [];
        		var monday = 1;
        		var one_day = (24 * 60 * 60 * 1000);

        		for (loop = start.getTime();
             		loop <= end.getTime();
             		loop = loop + one_day) {

            			var column_date = new Date(loop);

            			if (column_date.getDay() == monday) {
                			// we're in Moday, create the event
                			events.push({
                    			title: 'Morning Meeting',
                    			start: new Date(column_date.setHours(10, 00)),
                    			end: new Date(column_date.setHours(10, 40)),
                    			allDay: false
                			});
            			}
        		} // for loop

        		// return events generated
        		callback( events );
    		});*/
			

			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay){
				var title = prompt('Event Title:');
				var url = prompt('Type Event url, if exists:');
				if (title){
					var start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
					var end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
					$.ajax({
						url: 'http://mineralman.lionfree.net/workout/add_events.php',
						data: 'title='+ title+'&start='+ start +'&end='+ end+'&url='+ url,
						type: "POST",
						success: function(json){
							alert('Added Successfully');
						}
					});
					$('#calendar').fullCalendar('renderEvent', {title: title, start: start, end: end, allDay: allDay}, true);
				}
				$('#calendar').fullCalendar('unselect');
			},


			//update event
			editable: true,
			eventDrop: function(event, dayDelta, minuteDelta) {

				var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
				var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");

				$.ajax({
					url: "update_events.php",
					data: 'title='+ event.title+'&start='+ start +'&end='+ end + '&id='+ event.id ,
					type: "POST",

					success: function(json) {
						alert("Updated Successfully");
					}
				});
				$('#calendar').fullCalendar('updateEvent', {title: event.title, start: start, end: end});
			},
			eventResize: function(event, dayDelta, minuteDelta){

				var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
				var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");

				$.ajax({
					url: 'update_events.php',
					data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
					type: "POST",
					success: function(json) {
						alert("Updated Successfully");
					}					
				});
			},
			//delete events
			eventClick: function(event){
			var decision = confirm("Delete this event?");
			if(decision){
				$.ajax({
					type: "POST",
					url: 'http://mineralman.lionfree.net/workout/delete_events.php',
					data: "id="+ event.id,
					success: function(json) {
						alert("Deleted Successfully");
					}
				});
				$('#calendar').fullCalendar('removeEvents', event.id);
			}else{
			}
			},

			//drop external events
			droppable: true,
			drop: function(date) { // this function is called when something is dropped
			
				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');
				
				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);
				
				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.end = date;
				
				var start = $.fullCalendar.formatDate(copiedEventObject.start, "yyyy-MM-dd HH:mm:ss");
				var end = $.fullCalendar.formatDate(copiedEventObject.end, "yyyy-MM-dd HH:mm:ss");
				var url = '';
				$.ajax({
					url: "add_events.php",
					data: 'title='+ copiedEventObject.title+'&start='+ start + '&end='+ end + '&url=' + url + '&id='+ event.id ,
					type: "POST",

					success: function(json) {
						alert("Updated Successfully");
					}

				});


				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
				
				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}
				
			}


		});
		
	});

</script>
<style>

body {
	margin-top: 100px;
  	text-align: center;
  	font-size: 18px;
  	font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
  	color: #A4A4A4;
 }

	#wrap {
		width: 1100px;
		margin: 0 auto;
	}
		
	#external-events {
		margin-top: 60px;
		float: right;
		width: 150px;
		padding: 0 10px;
		border: 1px solid #ccc;
		background: #eee;
		text-align: left;
		border-radius: 10px;
	}
		
	#external-events h4 {
		color: black;
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
	}
		
	.external-event { /* try to mimick the look of a real event */
		margin: 10px 0;
		padding: 2px 4px;
		background: #3366CC;
		color: #fff;
		font-size: .85em;
		cursor: pointer;
		border-radius: 10px;
	}
		
	#external-events p {
		margin: 1.5em 0;
		font-size: 11px;
		color: #666;
	}
		
	#external-events p input {
		margin: 0;
		vertical-align: middle;
	}

	#calendar {
		margin-left: 10px;
		float: right;
		width: 900px;
	}


</style>
</head>
<body style="background-color: #2D3E50;">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="main.php">壯壯強</a>
          <!--If clicking logout button, redirect to auth.php to give out access token-->
          <?php
			echo '<a class="navbar-brand">Hello, '.$_SESSION['Uname'].'!</a>';
		  ?>
          <a class="navbar-brand" href="auth.php?logout=1" style="margin-left: 50px" >登出?</a>
        </div>
      </div>
    </div>

    <div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" style="text-align: left;">
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

	<div id='wrap'>
		<div id='calendar'></div>
		<div id='external-events'>
			<h4>Parts</h4>
			<div class='external-event'>Chest</div>
			<div class='external-event'>Triceps</div>
			<div class='external-event'>Leg</div>
			<div class='external-event'>Upper back</div>
			<div class='external-event'>Shoulders</div>
			<div class='external-event'>Biceps</div>
			<div class='external-event'>Abdominals</div>
			<div class='external-event'>Lower back</div>
			<p>
				<input type='checkbox' id='drop-remove' />
				<label for='drop-remove'>remove after drop</label>
			</p>
		</div>

		

		<div style='clear:both'></div>

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
