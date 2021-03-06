<?php
	//from hub go to php code that creates new rid and adds it to post
	//from there go to "add date/time" page
	//from there go to requestSuccess
	//requestSuccess will have option of finishing or adding more date/time
	//"add date/time" page should notify user what topic they selected

	require("config.php");

	$query = "
		SELECT topid 
		FROM Topic 
		WHERE name = :name
	";
	$query_params = array(
		':name' => $_POST['topic']
	);

	try{
		$stmt = $db->prepare($query);
		$result = $stmt->execute($query_params);
	}
	catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }

	$row = $stmt ->fetch();
	$mytopid = $row['topid'];
	$curtime = time();

	$groupArr = $_POST['grouppref'];
	$small=false;
	$medium=false;
	$large=false;


	for($index = 0; $index < count($groupArr); $index++) {
		$gSize = $groupArr[$index];
		if(strcmp($gSize, "Small") == 0) {$small = true;}
		else if(strcmp($gSize, "Medium") == 0) {$medium = true;}
		else if(strcmp($gSize, "Large") == 0) {$large = true;}
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

	$stmt = $db->query('SELECT rid FROM Request ORDER BY rid DESC LIMIT 1');
	$rid = $stmt->fetch();

	$sess['rid'] = $rid['rid'];
	$_SESSION['currReq'] = $sess;


    header("Location: addDateTime.php");
?>