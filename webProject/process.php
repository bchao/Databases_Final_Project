<html><body>

<?php
	session_start();
	$topic = $_POST['topic'];
	$month = $_POST['month'];
	$day = $_POST['day'];
	$year = $_POST['year'];
	$date = $month . $day . $year;

	echo $_SESSION['userID'];
	echo "\r\n";
	echo $topic;
	echo "\r\n";
	echo $date;
	echo "\r\n";

	echo $testVar;

?>

</body></html>
