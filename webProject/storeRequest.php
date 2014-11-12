<?php
	$host="localhost"; // Host name 
	$username="thnbgr_admin"; // Mysql email 
	$password="Database101"; // Mysql password 
	$db_name="thnbgr_db"; // Database name 

	// Connect to server and select database.
	mysql_connect("$host", "$username", "$password")or die(mysql_error()); 
	mysql_select_db("$db_name")or die("cannot select DB");

	// email and password sent from form 
	$mytopic=$_POST['topic']; 
	$mytime=$_POST['time'];

	// grab user name and pid from login
	$myuser=
	// create unique request id 
	$myrid=

	mysql_query("INSERT INTO Table REQUEST") or die(mysql_error());

	header("location:login_success.php");

?>
