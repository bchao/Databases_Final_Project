<?php
	session_start();
	if(!session_is_registered(myemail)){
		header("location:main_login.php");
	}
?>

<html>
	<body>
		Login Successful
		<form action="makeRequest.php" method="post"> 
		    <input type="submit" />

		</form>		
	</body>
</html>