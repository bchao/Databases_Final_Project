<html>
	<table width="450" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
		<tr>
			<form name="form1" method="post" action="process.php">
				<td>
					<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
						<tr>
							<td colspan="3"><strong>Member Login </strong></td>
						</tr>
						<tr>
							<td width="78">Topic</td>
							<td width="6">:</td>
							<td width="294">
								<select name="topic">
									<option>Math</option>
									<option>History</option>
									<option>Art</option>
								</select>
							</td>
						</tr>
						<tr>
							<td width="78">Date</td>
							<td width="6">:</td>
							<td width="294">
								<select name="month"> 
							        <option>Jan</option><option>Feb</option>
							        <option>Mar</option><option>Apr</option>
							        <option>May</option><option>Jun</option>
							        <option>Jul</option><option>Aug</option>
							        <option>Sep</option><option>Oct</option>
							        <option>Nov</option><option>Dec</option>

							    </select>
							    <select name="day">
							        <option>01</option><option>02</option>
							        <option>03</option><option>04</option>
							        <option>05</option><option>06</option>
							        <option>07</option><option>08</option>
							        <option>09</option><option>10</option>
							        <option>11</option><option>12</option>
							        <option>13</option><option>14</option>
							        <option>15</option><option>16</option>
							        <option>17</option><option>18</option>
							        <option>19</option><option>20</option>
							        <option>21</option><option>22</option>
							        <option>23</option><option>24</option>
							        <option>25</option><option>26</option>
							        <option>27</option><option>28</option>
							        <option>29</option><option>30</option>
							        <option>31</option>
							    </select>

							    <select name="year">
							        <option>2014</option><option>2015</option>
							        <option>2016</option><option>2017</option>
							    </select>
							</td>
						</tr>					
						<tr>
							<td>Time</td>
							<td>:</td>
							<td>
								<select name="time">
									<option>morning</option>
									<option>afternoon</option>
									<option>evening</option>
									<option>night</option>
								</select>
							</td>
						</tr>
						<tr>
							<?php 
								$testvar="myuseremail";
							?>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><input type="submit" name="Submit" value="Login"></td>
						</tr>
					</table>
				</td>
			</form>
		</tr>
	</table>

</html>