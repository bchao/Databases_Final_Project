<?php
 require("config.php");

 $date = '2014-12-06';
 $end_date = '2015-12-31';

 $times = array('morning', 'afternoon', 'evening', 'night');
 
 while (strtotime($date) <= strtotime($end_date)) {

 	foreach ($times as $time) {
 		$query = "
		INSERT INTO TimeSlot (time_slot_date, time_slot_time)
		VALUE(:time_slot_date, :time_slot_time)
		";
		
		$query_params = array(
			':time_slot_date' => $date,
			':time_slot_time' => $time
		);

		try{
			$stmt = $db->prepare($query);
			$result = $stmt->execute($query_params);
		}
		catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
 	}

 	$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
 	echo 'DONE!!';
 }
 
?>