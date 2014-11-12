<?php
	session_start();

	$host="localhost"; // Host name 
	$username="thnbgr_admin"; // Mysql email 
	$password="Database101"; // Mysql password 
	$db_name="thnbgr_db"; // Database name 

	// Connect to server and select databse.
	mysql_connect("$host", "$username", "$password")or die(mysql_error()); 
	mysql_select_db("$db_name")or die("cannot select DB");

	// email and password sent from form 
	$mypid = $_SESSION['userID'];
	echo $mypid;
	$mytopic=$_POST['topic'];
	echo $mytopic;
	// $mytid = mysql_query("SELECT topid FROM Topic WHERE name='$mytopic'");
	$mytime=$_POST['time'];
	echo $mytime;
	// mysql_query("INSERT INTO Table REQUEST VALUE(1, '$mypid', '$mytid', '$mytime', 'open')") or die(mysql_error());
?>