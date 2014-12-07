<?php
	require("config.php");

	$mydate = $_POST['date'];

	$timeArr = $_POST['time'];
	$myRid = $_SESSION['currReq']['rid'];

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

		$query = "
			INSERT INTO RequestTimes 
			VALUE(:rid, :tsid)
		";
		$query_params = array(
			':rid' => $myRid,
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