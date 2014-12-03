<?php
	session_start();
?>

<html>
	<body>
		Login Successful
		<?php
			// echo $_SESSION['userID'];
			// echo $_SESSION['useremail'];
		?>

		<form action="makeRequest.php" method="post"> 
		    <input type="submit" />

		</form>		
	</body>
</html>