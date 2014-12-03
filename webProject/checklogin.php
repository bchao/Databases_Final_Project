<?php
	session_start();

	$host="localhost"; // Host name 
	$username="thnbgr_admin"; // Mysql email 
	$password="Database101"; // Mysql password 
	$db_name="thnbgr_db"; // Database name 
	$tbl_name="Person"; // Table name 

	// Connect to server and select databse.
	mysql_connect("$host", "$username", "$password")or die(mysql_error()); 
	mysql_select_db("$db_name")or die("cannot select DB");

	// email and password sent from form 
	$myemail=$_POST['email'];
	$mypassword=$_POST['password'];

	// To protect MySQL injection (more detail about MySQL injection)
	$myemail = stripslashes($myemail);
	$mypassword = stripslashes($mypassword);
	$myemail = mysql_real_escape_string($myemail);
	$mypassword = mysql_real_escape_string($mypassword);
	$result=mysql_query("SELECT * FROM Person WHERE email='$myemail' and password='$mypassword'") or die("cannot get result");

	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);

	// If result matched $myemail and $mypassword, table row must be 1 row
	if($count==1){
		$row = mysql_fetch_array($result);
		$_SESSION['userID'] = $row['pid'];
		$_SESSION['useremail'] = $myemail;
		header("location:login_success.php");
	}
	else {
		echo "Wrong Email or Password!!!!";
	}
?>