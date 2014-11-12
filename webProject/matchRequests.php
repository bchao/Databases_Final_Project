<?php
	$host="localhost"; // Host name 
    $username="thnbgr_admin"; // Mysql email 
    $password="Database101"; // Mysql password 
    $db_name="thnbgr_db"; // Database name 

    mysql_connect("$host", "$username", "$password")or die(mysql_error());
    mysql_select_db("$db_name")or die("cannot select DB");

	matchRequests();

	function matchRequests(){
		$topics_query = mysql_query("SELECT DISTINCT topid FROM Topic;");
		$topics = array();

		//set sizes of groups
		$GROUP_SIZES = array('large','medium','small');

		while($line = mysql_fetch_row($topics_query)){
			$topics[] = $line[0];
		}
		foreach($topics as $topic){
			foreach($GROUP_SIZES as $group_size){
				matchRequestsForTopicAndSize($topic,$group_size);
			}
		}
	}

	//matches up requests for specified topic and size
	function matchRequestsForTopicAndSize($topic, $group_size){

		$MIN_GROUP_SIZE = array('small' => 3, 'medium' => 6, 'large' => 11);
		$MAX_GROUP_SIZE = array('small' => 5, 'medium' => 10, 'large' => 50);

		//echo 'test2';

		$made_update = true;
		while ($made_update){
			//echo 'test3';
			$top_time_slot = 'hello';
			switch($group_size){
				case 'small':
					$top_time_slot = mysql_query("SELECT TOP 1 * FROM SmallRequestedTimeSlots WHERE (topid = '$topic') ORDER BY num_people DESC;");
					break;
				case 'medium':
					$top_time_slot = mysql_query("SELECT TOP 1 * FROM MediumRequestedTimeSlots WHERE (topid = '$topic') ORDER BY num_people DESC;");
					break;
				default:
					$top_time_slot = mysql_query("SELECT TOP 1 * FROM LargeRequestedTimeSlots WHERE (topid = '$topic') ORDER BY num_people DESC;");
			}
			//echo $top_time_slot;
			if($top_time_slot != 0){
				$meeting = mysql_fetch_array($top_time_slot);

				//echo 'hello';
				//echo $meeting['num_people'];
				if ($meeting['num_people'] >= $MIN_GROUP_SIZE[$group_size]){
					$tsid = $meeting['tsid'];
					switch($group_size){
						case 'small':	
							$people_query = mysql_query("SELECT pid FROM Request, RequestTimes WHERE (topid = '$topic' AND large_group_ok = TRUE AND Request.rid = RequestTimes.rid AND tsid = '$tsid');");	
							break;
						case 'medium':
							$people_query = mysql_query("SELECT pid FROM Request, RequestTimes WHERE (topid = '$topic' AND large_group_ok = TRUE AND Request.rid = RequestTimes.rid AND tsid = '$tsid');");	
							break;
						default:
							$people_query = mysql_query("SELECT pid FROM Request, RequestTimes WHERE (topid = '$topic' AND large_group_ok = TRUE AND Request.rid = RequestTimes.rid AND tsid = '$tsid');");	
					}
					$people = array();
					$count = 0;
					while($line = mysql_fetch_row($people_query) and $count < $MAX_GROUP_SIZE[$group_size]){
						$people[] = $line[0];
						$count = $count + 1;
					}
					makeMeeting($people, $topic, $meeting['tsid']);
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
	function makeMeeting($people, $topic, $time_slot){
		mysql_query("INSERT INTO Meeting (topic,meeting_time) VALUES ('$topic','$time_slot');") or die("cannot create meeting");

		//mid is number of elements now in Meeting
		$mid = mysql_num_rows(mysql_query("SELECT * FROM MEETING;")) or die("cannot get meeting id");
		
		foreach($people as $person){
			mysql_query("INSERT INTO PersonAttendingMeeting VALUES ('$mid','$person');") or die("cannot add to PersonAttendingMeeting");
			mysql_query("UPDATE Request SET status = 'closed' WHERE (pid = '$person' AND topid = '$topic');") or die("cannot update Request");
		}
	}
?>
