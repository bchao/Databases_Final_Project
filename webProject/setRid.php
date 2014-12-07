<?php
	//from hub go to php code that creates new rid and adds it to post
	//from there go to "add date/time" page
	//"add date/time" page will have option of adding more dates and times or finishing
	//from there go to requestSuccess
	require("config.php");
	$stmt = $db->query('SELECT rid FROM Request ORDER BY rid DESC LIMIT 1');
	$rid = $stmt->fetch();

	$_POST = $rid['rid'];
    header("Location: addDateTime.php");
?>