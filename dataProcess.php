<!--used for inserting basic info into DB-->
<?php
	session_start(); //use session to record the login status
	header("content-type:text/html; charset=utf-8");
	include("mysql.inc.php");
	$start = $_POST['start'];
	$mon = 0;
	$tue = 0;
	$wed = 0;
	$thur = 0;
	$fri = 0;
	$sat = 0;
	$sun = 0;
	$count_day=0;
	foreach($_POST['day'] as $weekday){ //set each variable for db
		switch($weekday){
			case 1: $mon = 1; $whichday[$count_day]='Monday';break;
			case 2: $tue = 1; $whichday[$count_day]='Tuesday';break;
			case 3: $wed = 1; $whichday[$count_day]='Wednesday';break;
			case 4: $thur= 1; $whichday[$count_day]='Thursday';break;
			case 5: $fri = 1; $whichday[$count_day]='Friday';break;
			case 6: $sat = 1; $whichday[$count_day]='Saturday';break;
			case 7: $sun = 1; $whichday[$count_day]='Sunday';break;
		}
		$count_day++;
	}
	switch($_POST['lasting']){
		case "三個月": $lasting = 3; break;
		case '六個月': $lasting = 6; break;
		case '一年'  : $lasting = 12; break;
		case '一年三個月' : $lasting = 15; break;
		case '一年六個月' : $lasting = 18; break;
		case '兩年' : $lasting = 21; break;
	}
	$date=strtotime($start);
	$year = date("Y", $date);
	$month = date("m", $date);
	$day = date("d", $date);
	$h = date("H", $date);
	$m = date("i", $date);
	$s = date("s", $date);
	$end = date("Y-m-d H:i:s", mktime($h, $m, $s, $month+$lasting, $day, $year));
	//if package is chosen
	if($_POST['package'] == 1){
		$from = strtotime($start);
		$to = strtotime($end);
		$one_day = 24 * 60 * 60;
		//get package title from database
		$sql="SELECT * FROM package, muscle WHERE package.mid = muscle.mid";
		$result=mysql_query($sql);
		while($row = mysql_fetch_array($result)){
			$part[] = $row[4];
			/*switch($row[1]){
				case 1: $part[0][]=$row[4];break; //if pid = 1, get title into $part[0]
				case 2: $part[1][]=$row[4];break; //if pid = 2, get title into $part[1]
				case 3: $part[2][]=$row[4];break; //if pid = 3, get title into $part[2]
				case 4: $part[3][]=$row[4];break; //if pid = 4, get title into $part[3]
			}*/
		}
		if( $count_day == 1){
			for($t=$from;$t<=$to;$t += $one_day){
				if(date("l", $t) == $whichday[0]){
					$begin = date("Y-m-d H:i:s", mktime(date("H", $t), date("i", $t), date("s", $t), date("m", $t), date("d", $t), date("Y", $t) ));
					foreach($part as $title){
						$sql = "INSERT INTO evenement (title, start, end, uid) VALUES ('$title', '$begin', '$begin', '{$_SESSION['Uid']}')";
						$result = mysql_query($sql);
					}
				}
			}
		}
		
		else if( $count_day == 2){
			$i = 3;
			$j = 0;
			foreach($whichday as $weekday2){
				for($t=$from;$t<=$to;$t += $one_day){
					if(date("l", $t) == $weekday2){ 
						$begin = date("Y-m-d H:i:s", mktime(date("H", $t), date("i", $t), date("s", $t), date("m", $t), date("d", $t), date("Y", $t) ));
						for($k=$j;$k<=$i;$k++){ //insert part[0][0] part[0][1]
							$title = $part[$k];
							$sql = "INSERT INTO evenement (title, start, end, uid) VALUES ('$title', '$begin', '$begin', '{$_SESSION['Uid']}')";
							$result = mysql_query($sql);
						}
					}
				}
				$j=4;
				$i=6;
			}
		}
		else if( $count_day == 3){
			$i = 0;
			$j=2;
			foreach($whichday as $weekday3){
				$temp = $i;
				for($t=$from;$t<=$to;$t += $one_day){
					if(date("l", $t) == $weekday3){ 
						$i = $temp;
						$begin = date("Y-m-d H:i:s", mktime(date("H", $t), date("i", $t), date("s", $t), date("m", $t), date("d", $t), date("Y", $t) ));
						while($i<=$j){ 
							$title = $part[$i];
							$sql = "INSERT INTO evenement (title, start, end, uid) VALUES ('$title', '$begin', '$begin', '{$_SESSION['Uid']}')";
							$result = mysql_query($sql);
							$i++;
						}						
					}
				}
				$j += 2;
			}
		}
		
		else if( $count_day == 4){
			$i = 0;
			$j = 1;
			foreach($whichday as $weekday4){
				$temp = $i;
				for($t=$from;$t<=$to;$t += $one_day){
					if(date("l", $t) == $weekday4){ 
						$i = $temp;
						$begin = date("Y-m-d H:i:s", mktime(date("H", $t), date("i", $t), date("s", $t), date("m", $t), date("d", $t), date("Y", $t) ));
						while($i<=$j){
							$title = $part[$i]; 
							$sql = "INSERT INTO evenement (title, start, end, uid) VALUES ('$title', '$begin', '$begin', '{$_SESSION['Uid']}')";
							$result = mysql_query($sql);
							$i++;
						}						
					}
				}
				$j += 2;
			}
		}
		
		else if($count_day == 5){
			$i=4;
			foreach($whichday as $weekday5){
				for($t=$from;$t<=$to;$t += $one_day){
					if(date("l", $t) == $weekday5){
						$begin = date("Y-m-d H:i:s", mktime(date("H", $t), date("i", $t), date("s", $t), date("m", $t), date("d", $t), date("Y", $t) )); 
						if($i==7){							
							$title = $part[0];
							$sql = "INSERT INTO evenement (title, start, end, uid) VALUES ('$title', '$begin', '$begin', '{$_SESSION['Uid']}')";
							$result = mysql_query($sql);
							$title = $part[1];
							$sql = "INSERT INTO evenement (title, start, end, uid) VALUES ('$title', '$begin', '$begin', '{$_SESSION['Uid']}')";
							$result = mysql_query($sql);							
						}else if($i==8){
							$title = $part[2];
							$sql = "INSERT INTO evenement (title, start, end, uid) VALUES ('$title', '$begin', '$begin', '{$_SESSION['Uid']}')";
							$result = mysql_query($sql);
							$title = $part[3];
							$sql = "INSERT INTO evenement (title, start, end, uid) VALUES ('$title', '$begin', '$begin', '{$_SESSION['Uid']}')";
							$result = mysql_query($sql);
						}else{ 
							$begin = date("Y-m-d H:i:s", mktime(date("H", $t), date("i", $t), date("s", $t), date("m", $t), date("d", $t), date("Y", $t) )); 
							$title = $part[$i];
							$sql = "INSERT INTO evenement (title, start, end, uid) VALUES ('$title', '$begin', '$begin', '{$_SESSION['Uid']}')";
							$result = mysql_query($sql);
						}
					}					
				}
				$i++;
			}
		}
		else if($count_day == 6){
			$i=2;
			foreach($whichday as $weekday6){
				for($t=$from;$t<=$to;$t += $one_day){
					if(date("l", $t) == $weekday6){
						$begin = date("Y-m-d H:i:s", mktime(date("H", $t), date("i", $t), date("s", $t), date("m", $t), date("d", $t), date("Y", $t) )); 
						if($i==7){							
							$title = $part[0];
							$sql = "INSERT INTO evenement (title, start, end, uid) VALUES ('$title', '$begin', '$begin', '{$_SESSION['Uid']}')";
							$result = mysql_query($sql);
							$title = $part[1];
							$sql = "INSERT INTO evenement (title, start, end, uid) VALUES ('$title', '$begin', '$begin', '{$_SESSION['Uid']}')";
							$result = mysql_query($sql);							
						}else{ 
							$begin = date("Y-m-d H:i:s", mktime(date("H", $t), date("i", $t), date("s", $t), date("m", $t), date("d", $t), date("Y", $t) )); 
							$title = $part[$i];
							$sql = "INSERT INTO evenement (title, start, end, uid) VALUES ('$title', '$begin', '$begin', '{$_SESSION['Uid']}')";
							$result = mysql_query($sql);
						}
					}					
				}
				$i++;
			}
		}
		else if($count_day == 7){
			$i=0;
			foreach($whichday as $weekday7){
				for($t=$from;$t<=$to;$t += $one_day){
					if(date("l", $t) == $weekday7){							
						$begin = date("Y-m-d H:i:s", mktime(date("H", $t), date("i", $t), date("s", $t), date("m", $t), date("d", $t), date("Y", $t) )); 
						$title = $part[$i];
						$sql = "INSERT INTO evenement (title, start, end, uid) VALUES ('$title', '$begin', '$begin', '{$_SESSION['Uid']}')";
						$result = mysql_query($sql);
					}					
				}
				$i++;
			}
		}
		//$end = date($start, strtotime("+3 month"));		
		//$end = $start->add(new DateInterval($interval));	*/	
	}
	$sql="INSERT INTO basicInfo (Uid, sex, age, height, weight) VALUES ('{$_SESSION['Uid']}', '{$_POST['sex']}', '{$_POST['age']}', '{$_POST['height']}', '{$_POST['weight']}')"; //insert 
	$result=mysql_query($sql);
	if(mysql_affected_rows()>0){ //if successfully insert
		$sql="INSERT INTO detail (Hid, mon, tue, wed, thur, fri, sat, sun, package, lasting, start, end) VALUES ('{$_SESSION['Uid']}', '$mon', '$tue', '$wed', '$thur', '$fri', '$sat', '$sun', '{$_POST['package']}', '$lasting', '$start', '$end')";
		$result=mysql_query($sql);
			if(mysql_affected_rows()>0){
				//echo 'success';

				//echo $end;
				header("Location: calendar.php");
				}
			else
				echo 'fail';
	}
	else
		echo 'sth wrong';

	//計算創建的菜單事件總數以用來算progress bar
	$sql = "SELECT COUNT(*) FROM evenement WHERE Uid = '{$_SESSION['Uid']}'";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)>0){
		$row = mysql_fetch_array($result);
		$_SESSION['total_event'] = $row[0];
	}else{
		$_SESSION['total_event'] = 1;
	}

?>