<?php
	require("config.php");

	// email and password sent from form 
	$my_pid = htmlentities($_SESSION['Person']['pid'], ENT_QUOTES, 'UTF-8');

	$mytopic = $_POST['topic'];
	$query = "
		SELECT topid 
		FROM Topic 
		WHERE name = :name
	";
	$query_params = array(
		':name' => $mytopic
	);

	try{
		$stmt = $db->prepare($query);
		$result = $stmt->execute($query_params);
	}
	catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }

	$row = $stmt ->fetch();
	$mytopid = $row['topid'];
	// echo $mytopid;

	$month = $_POST['month'];
	$day = $_POST['day'];
	$year = $_POST['year'];
	$mydate = $month . $day . $year;
	// echo $mydate;

	$mytime=$_POST['time'];
	$curtime = time();

	$query = "
		SELECT tsid
		FROM TimeSlot
		WHERE time_slot_date=:date AND time_slot_time=:time
	";
	$query_params = array(
		':date' => $mydate,
		':time' => $mytime
	);

	try {
		$stmt = $db->prepare($query);
		$tsid = $stmt->execute($query_params);
	}
	catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }

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

	$rows = $db -> prepare('Select * FROM Request');
	$rows->execute();
	$count = $rows->rowCount();

	$query = "
		INSERT INTO Request 
		VALUE(:count, :pid, :topid, :large, :med, :small, :curtime, 'open')
	";
	$query_params = array(
		':count' => $count,
		':pid' => $my_pid,
		'topid' => $mytopid,
		'large' => $large,
		'med' => $med,
		'small' => $small,
		'curtime' => $curtime
	);

	try{
		$stmt = $db->prepare($query);
		$stmt->execute($query_params);
	}
	catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }

	// mysql_query("INSERT INTO Request VALUE('', '$my_pid', '$mytopid', '$large', '$med', '$small', '$curtime', 'open')") or die(mysql_error());

	$query = "
		INSERT INTO RequestTimes
		VALUE(:count, :tsid)
	";
	$query_params = array(
		':count' => $count,
		':tsid' => $tsid
	);

	try{
		$stmt = $db->prepare($query);
		$stmt->execute($query_params);
	}

	// $rid = mysql_num_rows(mysql_query("SELECT * FROM Request;")) or die("cannot get request id");
	// mysql_query("INSERT INTO RequestTimes VALUE('$rid', '$tsid')") or die(mysql_error());

	catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }

    header("Location: requestSuccess.php"); 
?>



















