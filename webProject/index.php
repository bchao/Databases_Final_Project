<html>
	<b>
		<?php
			//connects me to site/database
			mysql_connect("localhost", "thnbgr_admin", "Database101") or die(mysql_error());

			//selects the database
			mysql_select_db("thnbgr_db") or die(mysql_error());

			mysql_query("drop table members");
			
			mysql_query("CREATE TABLE members(
				id INTEGER NOT NULL PRIMARY KEY,
				first_name VARCHAR(20) NOT NULL,
				last_name VARCHAR(20) NOT NULL,
				password VARCHAR(20) NOT NULL default '',
				email VARCHAR(30) NOT NULL)") or die(mysql_error());

			mysql_query("INSERT INTO members VALUES(1, 'peter', 'yom', 'password', 'ypeter999')") or die(mysql_error());

		?>
		<!-- user login -->
		<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
			<tr>
				<form name="form1" method="post" action="checklogin.php">
					<td>
						<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
							<tr>
								<td colspan="3"><strong>Member Login </strong></td>
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
								<td><input type="submit" name="Submit" value="Login"></td>
							</tr>
						</table>
					</td>
				</form>
			</tr>
		</table>
		<?php
		
			//connects me to site/database
			mysql_connect("localhost", "thnbgr_admin", "Database101") or die(mysql_error());

			//selects the database
			mysql_select_db("thnbgr_db") or die(mysql_error());

			mysql_query("drop table Topic");

			mysql_query("CREATE TABLE Topic(
				topid INTEGER NOT NULL PRIMARY KEY,
				name VARCHAR(50) NOT NULL,
				description VARCHAR(300))") or die(mysql_error());

			mysql_query("drop table Person");
			
			mysql_query("CREATE TABLE Person(
				pid INTEGER NOT NULL PRIMARY KEY,
				first_name VARCHAR(20) NOT NULL,
				last_name VARCHAR(20) NOT NULL,
				password VARCHAR(20) NOT NULL default '',
				email VARCHAR(30) NOT NULL)") or die(mysql_error());

			mysql_query("drop table Request");
			
			mysql_query("CREATE TABLE Request(
				rid INTEGER NOT NULL PRIMARY KEY,
				pid INTEGER NOT NULL REFERENCES Person(pid),
				topid INTEGER NOT NULL REFERENCES Topic(topid),
				time TIMESTAMP NOT NULL,
				status VARCHAR(9) NOT NULL CHECK(status = 'open' OR status = 'closed'))") or die(mysql_error());

			mysql_query("drop table TimeSlot");
			
			mysql_query("CREATE TABLE TimeSlot(
				tsid INTEGER NOT NULL PRIMARY KEY,
				time_slot_date DATE NOT NULL,
				time_slot_time VARCHAR(9)
				CHECK(time_slot_time = 'morning' 
					OR time_slot_time = 'afternoon' 
					OR time_slot_time = 'evening' 
					OR time_slot_time = 'night'))") or die(mysql_error());

			mysql_query("drop table RequestTimes");
			
			mysql_query("CREATE TABLE RequestTimes(
				rid INTEGER NOT NULL REFERENCES Request(rid),
				tsid INTEGER NOT NULL REFERENCES TimeSlot(tsid),
				PRIMARY KEY(rid,tsid))") or die(mysql_error());

			mysql_query("drop table Meeting");
			
			mysql_query("CREATE TABLE Meeting(
				mid INTEGER NOT NULL PRIMARY KEY,
				topic INTEGER NOT NULL REFERENCES Topic(topid),
				meeting_time INTEGER NOT NULL REFERENCES TimeSlot(tsid))") or die(mysql_error());
			
			mysql_query("drop table PersonAttendingMeeting");
			
			mysql_query("CREATE TABLE PersonAttendingMeeting(
				pid INTEGER NOT NULL REFERENCES Person(pid),
				mid INTEGER NOT NULL REFERENCES Meeting(mid),
				PRIMARY KEY(pid,mid))") or die(mysql_error());

			mysql_query("INSERT INTO Person VALUES(1, 'peter', 'yom', 'password', 'ypeter999')") or die(mysql_error());

			mysql_query("drop table example");

			echo "success";
			
		?>
	</b>
</html>