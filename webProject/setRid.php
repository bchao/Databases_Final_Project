<?php
	//from hub go to php code that creates new rid and adds it to post
	//from there go to "add date/time" page
	//from there go to requestSuccess
	//requestSuccess will have option of finishing or adding more date/time
	//"add date/time" page should notify user what topic they selected

	require("config.php");
	$stmt = $db->query('SELECT rid FROM Request ORDER BY rid DESC LIMIT 1');
	$rid = $stmt->fetch();

	$sess['rid'] = $rid['rid'];
	$sess['topic'] = $_POST['topic'];
	$sess['grouppref'] = $_POST['grouppref'];
	$_SESSION['currReq'] = $sess;
    header("Location: addDateTime.php");
?>