<?php
	require("config.php");

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

	$mydate = $_POST['date'];
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

	$small=false;
	$medium=false;
	$large=false;

	if(strcmp($_POST['grouppref'],"Small") == 0) {
		$small=true;
	}
	if(strcmp($_POST['grouppref'],"Medium") == 0) {
		$medium=true;
	}
	if(strcmp($_POST['grouppref'],"Large") == 0) {
		$large=true;
	}

	// $groupSize = $_POST['group'];
	// if(strcmp($groupSize, "small group") == 0) {
	// 	$small = true;
	// 	$med = false;
	// 	$large = false;
	// }
	// else if(strcmp($groupSize, "medium group") == 0) {
	// 	$small = false;
	// 	$med = true;
	// 	$large = false;
	// }
	// else {
	// 	$small = false;
	// 	$med = false;
	// 	$large = true;
	// }


	//Don't need this with autoincrementing
	// $rows = $db -> prepare('Select * FROM Request');
	// $rows->execute();
	// $count = $rows->rowCount();

	$query = "
		INSERT INTO Request (
			pid,
			topid,
			large_group_ok,
			medium_group_ok,
			small_group_ok,
			time,
			status
		) VALUES (
			:pid, :topid, :large, :med, :small, :curtime, 'open'
		)
	";
	$query_params = array(
		//':count' => $count,
		':pid' => htmlentities($_SESSION['Person']['pid'], ENT_QUOTES, 'UTF-8'),
		':topid' => $mytopid,
		':large' => $large,
		':med' => $medium,
		':small' => $small,
		':curtime' => $curtime
	);

	try{
		$stmt = $db->prepare($query);
		$stmt->execute($query_params);
	}
	catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }

	// mysql_query("INSERT INTO Request VALUE('', '$my_pid', '$mytopid', '$large', '$med', '$small', '$curtime', 'open')") or die(mysql_error());

	//not 100% sure this will work like I think it's supposed to
	$stmt = $db->query('SELECT rid FROM Request ORDER BY rid DESC LIMIT 1');
	$rid = $stmt->fetch();

	$query = "
		INSERT INTO RequestTimes 
		VALUE(:rid, :tsid)
	";
	$query_params = array(
		':rid' => $rid['rid'],
		':tsid' => $tsid['tsid']
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



















