<?php
	require("config.php");

	//matchRequests();

	//function matchRequests(){
	// $topics_query = mysql_query("SELECT DISTINCT topid FROM Topic;");
	$topics_query = $db -> prepare('SELECT DISTINCT topid FROM Topic');
	$topics_query->execute();

	$topics = array();
	// $array = $topics_query -> fetchAll();
	// // print_r($array);
	// //echo 'topics_query: ' . print_r($topics_query->fetch()) . ' ';

	// foreach ($array as $line) {
	// 	$topics[] = $line['topid'];
	// }
	//set sizes of groups
	$GROUP_SIZES = array('large','medium','small');

	while($line = $topics_query -> fetch()){
		// while($line = mysql_fetch_row($topics_query)){
		$topics[] = $line['topid'];
	}

	foreach($topics as $topic){
		foreach($GROUP_SIZES as $group_size){
			// echo 'topic: ' . print_r($topic) . ' ';
			matchRequestsForTopicAndSize($topic, $group_size, $db);
		}
	}
	//}

	//matches up requests for specified topic and size
	function matchRequestsForTopicAndSize($topic, $group_size, $db){

		$MIN_GROUP_SIZE = array('small' => 2, 'medium' => 4, 'large' => 7);
		$MAX_GROUP_SIZE = array('small' => 3, 'medium' => 6, 'large' => 50);

		//echo 'topic: ' . print_r($topic) . ' ';

		//echo 'test2';
		$made_update = true;
		$count = 0;
		while ($made_update and $count < 100){
			//echo 'test3';
			$count = $count + 1;
			$query_params = array(
				':topic' => $topic
			);

			switch($group_size){
				case 'small':
					echo "case small\n";

					$query = "
						SELECT * 
						FROM SmallRequestedTimeSlots 
						WHERE topid = :topic
						ORDER BY num_people DESC
					";
					try{
						$top_time_slot = $db->prepare($query);
						$top_time_slot->execute($query_params);
					}
					catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }

					// $top_time_slot = mysql_query("SELECT * FROM SmallRequestedTimeSlots WHERE topid = $topic ORDER BY num_people DESC;");
					break;
				case 'medium':
					echo "case medium\n";

					$query = "
						SELECT * 
						FROM MediumRequestedTimeSlots 
						WHERE topid = :topic
						ORDER BY num_people DESC
					";
					try{
						$top_time_slot = $db->prepare($query);
						$top_time_slot->execute($query_params);
					}
					catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
					// $top_time_slot = mysql_query("SELECT * FROM MediumRequestedTimeSlots WHERE topid = $topic ORDER BY num_people DESC;");
					break;
				case 'large':
					echo "case large\n";

					$query = "
						SELECT * 
						FROM LargeRequestedTimeSlots 
						WHERE topid = :topic
						ORDER BY num_people DESC
					";
					try{
						$top_time_slot = $db->prepare($query);
						$top_time_slot->execute($query_params);
					}
					catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
					// $top_time_slot = mysql_query("SELECT * FROM LargeRequestedTimeSlots WHERE topid = $topic ORDER BY num_people DESC;");
					break;
				default:
					echo "error here\n";
			}
			// echo 'stmt: ' . $stmt -> rowCount() . ' ';
			//echo 'topic: ' . print_r($topic) . ' ';
			// echo "stmt: " . $stmt;
			if(!empty($top_time_slot) AND $top_time_slot->rowCount() > 0){
				//$meeting = mysql_fetch_array($top_time_slot);
				$meeting = $top_time_slot -> fetch();

				//echo $meeting['num_people'];
				if ($meeting['num_people'] >= $MIN_GROUP_SIZE[$group_size]){
					$tsid = $meeting['tsid'];
					$query_params = array(
						':tsid' => $tsid,
						':topic' => $topic
					);
					switch($group_size){
						case 'small':
							$query = "
								SELECT pid 
								FROM Request, RequestTimes 
								WHERE (topid = :topic AND small_group_ok = TRUE AND Request.rid = RequestTimes.rid AND tsid = :tsid AND status = 'open'
									AND tsid NOT IN (SELECT tsid FROM PersonBusyDuringTimeSlot WHERE PersonBusyDuringTimeSlot.pid = Request.pid))
							";
							try{
								$people_query = $db->prepare($query);
								$people_query->execute($query_params);
							}
							catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
							// $people_query = mysql_query("SELECT pid FROM Request, RequestTimes WHERE (topid = $topic AND small_group_ok = TRUE AND Request.rid = RequestTimes.rid AND tsid = $tsid AND status = 'open');");	
							break;
						case 'medium':
							$query = "
								SELECT pid 
								FROM Request, RequestTimes 
								WHERE (topid = :topic AND medium_group_ok = TRUE AND Request.rid = RequestTimes.rid AND tsid = :tsid AND status = 'open'
									AND tsid NOT IN (SELECT tsid FROM PersonBusyDuringTimeSlot WHERE PersonBusyDuringTimeSlot.pid = Request.pid))
							";
							try{
								$people_query = $db->prepare($query);
								$people_query->execute($query_params);
							}
							catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
							//$people_query = mysql_query("SELECT pid FROM Request, RequestTimes WHERE (topid = $topic AND medium_group_ok = TRUE AND Request.rid = RequestTimes.rid AND tsid = $tsid AND status = 'open');");	
							break;
						case 'large':
							$query = "
								SELECT pid 
								FROM Request, RequestTimes 
								WHERE (topid = :topic AND large_group_ok = TRUE AND Request.rid = RequestTimes.rid AND tsid = :tsid AND status = 'open'
									AND tsid NOT IN (SELECT tsid FROM PersonBusyDuringTimeSlot WHERE PersonBusyDuringTimeSlot.pid = Request.pid))
							";
							try{
								$people_query = $db->prepare($query);
								$people_query->execute($query_params);
							}
							catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
							//$people_query = mysql_query("SELECT pid FROM Request, RequestTimes WHERE (topid = $topic AND large_group_ok = TRUE AND Request.rid = RequestTimes.rid AND tsid = $tsid AND status = 'open');");	
							break;
						default:
							echo "error\n";
					}
					$people = array();
					$count = 0;
					while($line = $people_query -> fetch() and $count < $MAX_GROUP_SIZE[$group_size]){
						//while($line = mysql_fetch_row($people_query) and $count < $MAX_GROUP_SIZE[$group_size]){
						$people[] = $line['pid'];
						$count = $count + 1;
					}
					makeMeeting($people, $topic, $meeting['tsid'], $db);
				}
				else{
					$made_update = false;
				}
			}
			else{
				$made_update = false;
			}
		}
	}

	//takes an array of people's ids to be added, a topic id, and a time slot it
	//creates a meeting for them with the specified time and topic, adds them to PersonAttendingMeeting, and updates their requests
	function makeMeeting($people, $topic, $time_slot, $db){
		$query_params = array(
			':time_slot' => $time_slot,
			':topic' => $topic
		);
		$query = "
			INSERT INTO Meeting (topic, meeting_time)
			VALUES (:topic, :time_slot) 
			";
		try{
			$stmt = $db->prepare($query);
			$stmt->execute($query_params);
		}
		catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }

		// mysql_query("INSERT INTO Meeting (topic,meeting_time) VALUES ($topic,$time_slot);") or die("cannot create meeting");

		//mid is number of elements now in Meeting
		$rows = $db -> prepare('SELECT * FROM Meeting');
		$rows->execute();
		$mid = $rows->rowCount();
		//$mid = mysql_num_rows(mysql_query("SELECT * FROM Meeting;")) or die("cannot get meeting id");

		
		$query = "
			SELECT name
			FROM Topic
			WHERE topid=:topic
		";
		$query_params = array(
			':topic' => $topic
		);
		try{
			$stmt = $db->prepare($query);
			$stmt->execute($query_params);
		}
		catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
		$topic_name_row = $stmt -> fetch();
		//$topic_name_row = mysql_fetch_array(mysql_query("SELECT name FROM Topic WHERE topid=$topic"));
		$topic_name = $topic_name_row['name'];

		$query_params = array(
			':time_slot' => $time_slot
		);
		$query = "
			SELECT time_slot_date
			FROM TimeSlot
			WHERE tsid=:time_slot
		";
		try{
			$stmt = $db->prepare($query);
			$stmt->execute($query_params);
		}
		catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
		$slot_date_row = $stmt -> fetch();
		//$slot_date_row = mysql_fetch_array(mysql_query("SELECT time_slot_date FROM TimeSlot WHERE tsid=$time_slot"));
		$slot_date = $slot_date_row['time_slot_date'];

		$query = "
			SELECT time_slot_time
			FROM TimeSlot
			WHERE tsid=:time_slot
		";
		try{
			$stmt = $db->prepare($query);
			$stmt->execute($query_params);
		}
		catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
		$slot_time_row = $stmt -> fetch();
		//$slot_time_row = mysql_fetch_array(mysql_query("SELECT time_slot_time FROM TimeSlot WHERE tsid=$time_slot"));
		$slot_time = $slot_time_row['time_slot_time'];

		$message = "You have a meeting for " . $topic_name . " scheduled on the " . $slot_time . " of " . $slot_date . ".\r\n";
		$message = $message . "Your group members are listed below. \r\n\r\n";
		$headers = 'From: Scheduler@StudyBuddies.com';

		foreach($people as $person) {

			$query_params = array(
				':person' => $person
			);
			$query = "
				SELECT first_name
				FROM Person
				WHERE pid=:person
			";
			try{
				$stmt = $db->prepare($query);
				$stmt->execute($query_params);
			}
			catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
			$first_name_row = $stmt -> fetch();
			//$first_name_row = mysql_fetch_array(mysql_query("SELECT first_name FROM Person WHERE pid=$person"));
			$first_name = $first_name_row['first_name'];

			$query = "
				SELECT last_name
				FROM Person
				WHERE pid=:person
			";
			try{
				$stmt = $db->prepare($query);
				$stmt->execute($query_params);
			}
			catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
			$last_name_row = $stmt -> fetch();
			//$last_name_row = mysql_fetch_array(mysql_query("SELECT last_name FROM Person WHERE pid=$person"));
			$last_name = $last_name_row['last_name'];

			$query = "
				SELECT email
				FROM Person
				WHERE pid=:person
			";
			try{
				$stmt = $db->prepare($query);
				$stmt->execute($query_params);
			}
			catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
			$person_email_row = $stmt -> fetch();
			//$person_email_row = mysql_fetch_array(mysql_query("SELECT email FROM Person WHERE pid=$person"));
			$person_email = $person_email_row['email'];

			$message = $message . $first_name . " " . $last_name . " - " . $person_email . " \r\n";
		}

		foreach($people as $person){
			$subject = "Study Buddies " . $topic_name . " Meeting Scheduled!";
			$query_params = array(
				':person' => $person
			);
			$query = "
				SELECT email
				FROM Person
				WHERE pid=:person
			";
			try{
				$stmt = $db->prepare($query);
				$stmt->execute($query_params);
			}
			catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
			$email_row = $stmt -> fetch();
			//$email_row = mysql_fetch_array(mysql_query("SELECT email FROM Person WHERE pid=$person"));
			$email = $email_row['email'];


			//mail($email, $subject, $message, $headers);
			mail('brandonchao3@gmail.com', $subject, $message, $headers);


			$query = "
				INSERT INTO PersonAttendingMeeting
				VALUES (:person, :mid)
			";
			$query_params = array(
				':person' => $person,
				':mid' => $mid
			);
			try{
				$stmt = $db->prepare($query);
				$stmt->execute($query_params);
			}
			catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
			//mysql_query("INSERT INTO PersonAttendingMeeting VALUES ($person, $mid);") or die("cannot add to PersonAttendingMeeting");

			$query = "
				UPDATE Request
				SET status = 'closed'
				WHERE (pid = :person AND topid = :topic)
			";
			$query_params = array(
				':person' => $person,
				':topic' => $topic
			);
			try{
				$stmt = $db->prepare($query);
				$stmt->execute($query_params);
			}
			catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); }
			//mysql_query("UPDATE Request SET status = 'closed' WHERE (pid = $person AND topid = $topic);") or die("cannot update Request");
		}
	}
?>
