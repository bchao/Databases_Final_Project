<?php
	require("config.php");

	$query = "
		SELECT topid 
		FROM Topic 
		WHERE name = :name
	";
	$query_params = array(
		':name' => $_SESSION['currReq']['topic']
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

	$timeArr = $_POST['time'];

	for($index = 0; $index < count($timeArr); $index++) {
		$mytime = $timeArr[$index];
		$query = "
			SELECT tsid
			FROM TimeSlot
			WHERE time_slot_date=:date AND time_slot_time=:time
		";
		$query_params = array(
			':date' => date('Y-m-d', strtotime($_POST['date'])),
			':time' => $mytime
		);		
		try {
			$stmt = $db->prepare($query);
			$result = $stmt->execute($query_params);
		}
		catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }

		$tsid = $stmt -> fetch();



		$groupArr = $_SESSION['currReq']['grouppref'];
		$small=false;
		$medium=false;
		$large=false;


		for($index = 0; $index < count($groupArr); $index++) {
			$gSize = $groupArr[$index];
			if(strcmp($gSize, "Small") == 0) {$small = true;}
			if(strcmp($gSize, "Medium") == 0) {$medium = true;}
			if(strcmp($gSize, "Large") == 0) {$large = true;}
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

		$query = "
			INSERT INTO RequestTimes 
			VALUE(:rid, :tsid)
		";
		$query_params = array(
			// ':rid' => $rid['rid'],
			':rid' => $_SESSION['currReq']['rid'],
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