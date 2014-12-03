<?php
	session_start();

	$host="localhost"; // Host name 
	$username="thnbgr_admin"; // Mysql email 
	$password="Database101"; // Mysql password 
	$db_name="thnbgr_db"; // Database name 

	// Connect to server and select databse.
	mysql_connect("$host", "$username", "$password")or die(mysql_error()); 
	mysql_select_db("$db_name")or die("cannot select DB");

	// email and password sent from form 
	$mypid = $_SESSION['userID'];
	// echo $mypid;

	$mytopic = $_POST['topic'];
	$result = mysql_query("SELECT topid FROM Topic WHERE name = '$mytopic'");
	$row = mysql_fetch_array($result);
	$mytopid = $row['topid'];
	// echo $mytopid;

	$month = $_POST['month'];
	$day = $_POST['day'];
	$year = $_POST['year'];
	$mydate = $month . $day . $year;
	// echo $mydate;

	$mytime=$_POST['time'];
	$curtime = time();
	$tsid = mysql_query("SELECT tsid FROM TimeSlot WHERE time_slot_date='$mydate' AND time_slot_time='$mytime'");

	$groupSize = $_POST['group'];
	if(strcmp($groupSize, "small group") == 0) {
		$small = true;
		$med = false;
		$large = false;
	}
	else if(strcmp($groupSize, "medium group") == 0) {
		$small = false;
		$med = true;
		$large = false;
	}
	else {
		$small = false;
		$med = false;
		$large = true;
	}

	mysql_query("INSERT INTO Request VALUE('', '$mypid', '$mytopid', '$large', '$med', '$small', '$curtime', 'open')") or die(mysql_error());

	$rid = mysql_num_rows(mysql_query("SELECT * FROM Request;")) or die("cannot get request id");
	mysql_query("INSERT INTO RequestTimes VALUE('$rid', '$tsid')") or die(mysql_error());

    header("Location: requestSuccess.php"); 
?>