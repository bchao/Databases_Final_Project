<?php
	require("config.php");

	$query = "
		INSERT INTO Topic (
			name,
			description
		) VALUES (
			:name, 
			:description
		)
	";

	$query_params = array(
		':name' => $_POST['topicName'],
		':description' => $_POST['topicDescription']
	);

	try{
		$stmt = $db->prepare($query);
		$stmt->execute($query_params);
	}
	catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }

    header("Location: topicSuccess.php"); 
?>