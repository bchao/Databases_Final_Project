<?php
	require("config.php");

	$query = "
			DELETE FROM PersonAttendingMeeting
			WHERE pid = :pid AND mid = :mid
		";
		$query_params = array(
			':pid' => $_SESSION['Person']['pid'],
			':mid' => $_Post['mid']
		);

		try{
			$stmt = $db->prepare($query);
			$stmt->execute($query_params);
		}

		catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }

		header("Location: hub.php");
?>