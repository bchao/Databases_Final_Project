<?php
if (isset($_POST['Submit'])) {
	//connects me to site/database
	mysql_connect("localhost", "thnbgr_admin", "Database101") or die(mysql_error());

	//selects the database
	mysql_select_db("thnbgr_db") or die(mysql_error());

	mysql_query("INSERT INTO Person VALUES($_POST[id], 
		'$_POST[firstname]', 
		'$_POST[lastname]', 
		'$_POST[password]', 
		'$_POST[email]')") or die("Could not create new user");

		header("location:main_login.php");
} else {
?>
<!-- user creation -->
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
	<tr>
		<form action='' method='post'>
			<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
				<tr>
					<td colspan="3"><strong>Create a New User </strong></td>
				</tr>

				<tr>
					<td width="78">First Name</td>
					<td width="6">:</td>
					<td width="294"><input name="firstname" type="text" id="firstname"></td>
				</tr>
				
				<tr>
					<td width="78">Last Name</td>
					<td width="6">:</td>
					<td width="294"><input name="lastname" type="text" id="lastname"></td>
				</tr>
				
				<tr>
					<td width="78">ID</td>
					<td width="6">:</td>
					<td width="294"><input name="id" type="int" id="id"></td>
				</tr>

				<tr>
					<td width="78">Email</td>
					<td width="6">:</td>
					<td width="294"><input name="email" type="text" id="email"></td>
				</tr>

				<tr>
					<td>Password</td>
					<td>:</td>
					<td><input name="password" type="text" id="password"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><input type="submit" name="Submit" value="Create New User"></td>
				</tr>
			</table>
		</form>
	</tr>
</table>
<?php
}
?>
