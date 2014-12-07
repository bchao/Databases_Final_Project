<?php
	require("config.php");

	$query = "
			DELETE FROM Request
			WHERE rid = :rid
		";
		$query_params = array(
			':rid' => $_POST['rid']
		);

		try{
			$stmt = $db->prepare($query);
			$stmt->execute($query_params);
		}

		catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
?>