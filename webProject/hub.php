<?php
    require("config.php");
    if(empty($_SESSION['Person'])) 
    {
        header("Location: index.php");
        die("Redirecting to index.php"); 
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Study Buddies Hub Page</title>
    <meta name="description" content="Hub Page">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <link href="assets/bootstrap.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
        body { background: url(assets/bglight.png); }
        .unit { background-color: #fff; }
        .well { background-color: #fff; }

        .fixme { position: fixed; }
        /* Landscape phone to portrait tablet */
        @media (max-width: 767px) {
          .fixme { width: 100%; position: static; }
        }    </style>
</head>

<body>

<div class="navbar navbar-fixed-top navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand">Study Buddies</a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li><a href="register.php">Register</a></li>
          <li class="divider-vertical"></li>
          <li><a href="Logout.php">Log Out</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="container hero-unit">
  <div class="row tabbable">
    <div class="span3 fixme">
      <h2>Welcome, <?php echo htmlentities($_SESSION['Person']['first_name'], ENT_QUOTES, 'UTF-8'); ?>!</h2>
      <hr>
      <h4>Navigation</h4>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#createrequest" data-toggle="tab">Create Request</a></li>
        <li><a href="#currentrequests" data-toggle="tab">Current Requests</a></li>
        <li><a href="#pendingrequests" data-toggle="tab">Pending Requests</a></li>
        <li><a href="#pastrequests" data-toggle="tab">Past Requests</a></li>
      </ul>
    </div>

    <div class="span8 well pull-right">
      <div class="tab-content">
        <div id="createrequest" class="tab-pane active">
          <h1>Create a New Request</h1>
          <hr>
            <h2>New Request stuff goes here</h2>
            <form class="form-horizontal" method="post" action="storeRequest.php">
              <fieldset>

                <!-- topic select -->
                <div class="control-group">
                  <label class="control-label">Topic</label>
                  <div class="controls">
                    <select id="topic" name="topic" class="input-xlarge">
                      <option value=""selected="selected">(please select a topic)</option>
                      <option>Math</option>
                      <option>History</option>
                      <option>Art</option>
                      <option>Etc</option>
                    </select>
                  </div>
                </div>

                <!-- date select -->
                <div class="control-group">
                  <label class="control-label">Date</label>
                  <div class="controls">
                    <select id="month" name="month" class="input-small">
                      <option value=""selected="selected">(month)</option>
                      <option>Jan</option><option>Feb</option>
                      <option>Mar</option><option>Apr</option>
                      <option>May</option><option>Jun</option>
                      <option>Jul</option><option>Aug</option>
                      <option>Sep</option><option>Oct</option>
                      <option>Nov</option><option>Dec</option>
                    </select>

                    <select id="day" name="day" class="input-small">
                      <option value=""selected="selected">(day)</option>
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

                    <select id="year" name="year" class="input-small">
                      <option value=""selected="selected">(year)</option>
                      <option>2014</option><option>2015</option>
                      <option>2016</option><option>2017</option>
                    </select>
                  </div>
                </div>
                
                <!-- group preference select -->
                <div class="control-group">
                  <label class="control-label">Group Preference</label>
                  <div class="controls">
                    <select id="grouppref" name="grouppref" class="input-xlarge">
                      <option value=""selected="selected">(please select a preference)</option>
                      <option value="small">Small</option>
                      <option value="medium">Medium</option>
                      <option value="large">Large</option>
                    </select>
                  </div>
                </div>

                <!-- time select -->
                <div class="control-group">
                  <label class="control-label">Time</label>
                  <div class="controls">
                    <select id="time" name="time" class="input-xlarge">
                      <option value=""selected="selected">(please select a time)</option>
                      <option value="morning">Morning</option>
                      <option value="afternooon">Afternoon</option>
                      <option value="evening">Evening</option>
                      <option value="night">Night</option>
                      <option value="anyTime">Any Time</option>
                    </select>
                  </div>
                </div> 

              <td><input type="submit" name="Submit" value="Submit"></td>
            </form>
        </div>

        <div id="currentrequests" class="tab-pane">
          <h1>Scheduled Meetings</h1>
          <hr>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>name</th>
                  <th>time</th>
                </tr>
              </thead>

              <tbody>
                <?php
                 $query = "
                  SELECT name, time_slot_date, time_slot_time
                  FROM Meeting, PersonAttendingMeeting, Topic, TimeSlot
                  WHERE pid = :pid AND Meeting.mid = PersonAttendingMeeting.mid AND Meeting.topic = Topic.topid
                    AND meeting_time = TimeSlot.tsid
                  "; 
                  $query_params = array( 
                  ':pid' => $_SESSION['Person']['pid']
                  ); 
              
                  try{ 
                     $stmt = $db->prepare($query); 
                     $result = $stmt->execute($query_params); 
                  } 
                  catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
      
 
                  while ($row = $stmt -> fetch()) {
                    // Print out the contents of the entry 
                    echo '<tr>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['time_slot_time'] + ' on ' + $row['time_slot_date'] . '</td>';
                  }
                ?>
              </tbody>
            </table>
            <h2>Scheduled Meetings table goes here</h2>
               
        </div>

        <div id="pendingrequests" class="tab-pane">
          <h1>Pending Requests</h1>
          <hr>
            <h2>Pending Requests table goes here</h2>


            <table class="table table-striped">
              <thead>
                <tr>
                  <th>name</th>
                  <th>time</th>
                </tr>
              </thead>

              <tbody>
                <?php
                  $query = "
                    SELECT name, time
                    FROM Request, Topic
                    WHERE pid = :pid AND Request.topid = Topic.topid AND status = 'open'
                    "; 

                  $query_params = array( 
                    ':pid' => $_SESSION['Person']['pid']
                  ); 
               
                  try{ 
                     $stmt = $db->prepare($query); 
                     $result = $stmt->execute($query_params); 
                  } 
                  catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 

                  while ($row = $stmt -> fetch()) {
                    // Print out the contents of the entry 
                    echo '<tr>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . date("g:i a \on F j, Y",$row['time']) . '</td>';
                  }
                ?>
              </tbody>
            </table>


        </div>

        <div id="pastrequests" class="tab-pane">
          <h1>Past Requests</h1>
          <hr>
            <h2>Past Requests table goes here</h2>
        </div>        
      </div>
    </div>
  </div>
</div>

</body>
</html>

















