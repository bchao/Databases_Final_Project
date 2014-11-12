<?php
	$host="localhost"; // Host name 
        $username="thnbgr_admin"; // Mysql email 
        $password="Database101"; // Mysql password 
        $db_name="thnbgr_db"; // Database name 

	//set sizes of groups
	$MIN_GROUP_SIZE = array('small' => 3, 'medium' => 6, 'large' => 11);
	$MAX_GROUP_SIZE = array('small' => 5, 'medium' => 10, 'large' => 50);
	$GROUP_SIZES = array('large','medium','small');

        // Connect to server and select database.
        mysql_connect("$host", "$username", "$password")or die(mysql_error());
        mysql_select_db("$db_name")or die("cannot select DB");



	function matchRequests(){
		$topics = mysql_query("SELECT DISTINCT topid FROM Topic;");
	}


	//matches up requests for specified topic
	function matchRequestsForTopic($topic, $group_size){

		//$time_slots_per_person = mysql_query("SELECT (pid,") or die("cannot find time slots");

		$made_update = true;
		while ($made_update){
			switch($group_size){
				case 'small':
				$top_time_slot = mysql_fetch_row(mysql_query("SELECT TOP 1 * FROM SmallRequestedTimeSlots WHERE (topid = $topic) ORDER BY num_people DESC;"));
					break;
				case 'medium':
				$top_time_slot = mysql_fetch_row(mysql_query("SELECT TOP 1 * FROM MediumRequestedTimeSlots WHERE (topid = $topic) ORDER BY num_people DESC;"));
					break;
				default:
				$top_time_slot = mysql_fetch_row(mysql_query("SELECT TOP 1 * FROM LargeRequestedTimeSlots WHERE (topid = $topic) ORDER BY num_people DESC;"));
			}
			if(mysql_num_rows($top_time_slot) > 0){
				ADD STUFF HEREEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE	
			}
			else{
				$made_update = false;
			}
		}
	}



	//takes an array of people's ids to be added, a topic id, and a time slot it
	//creates a meeting for them with the specified time and topic, adds them to PersonAttendingMeeting, and updates their requests
	function makeMeeting($people, $topic, $time_slot){
		mysql_query("INSERT INTO Meeting (topic,meeting_time) VALUES ($topic,$time_slot);") or die("cannot create meeting");

		//mid is number of elements now in Meeting
		$mid = mysql_num_rows(mysql_query("SELECT * FROM MEETING;")) or die("cannot get meeting id");
		
		foreach($people as $person){
			mysql_query("INSERT INTO PersonAttendingMeeting VALUES ($mid,$person);") or die("cannot add to PersonAttendingMeeting");
			mysql_query("UPDATE Request SET status = 'closed' WHERE (pid = $person AND topid = $topic);") or die("cannot update Request");
		}
	}
?>
