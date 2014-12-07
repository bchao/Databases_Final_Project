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

	$mydate = $_POST['date'];
	$curtime = time();

	$timeArr[] = $_POST['time[]'];

	for($index = 0; $index < count($timeArr[]); $index++) {
		$mytime = $timeArr[$index];
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
			$result = $stmt->execute($query_params);
		}
		catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }

			$tsid = $stmt -> fetch();

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

		catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
	}



    header("Location: requestSuccess.php"); 
?>