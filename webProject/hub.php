<?php
    require("config.php");
    if(empty($_SESSION['Person'])) 
    {
        header("Location: index.php");
        die("Redirecting to index.php"); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Study Buddies</title>
    <meta name="description" content="Home page">

    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <style type="text/css">
        body { background: url(dist/bglight.png); }
        .unit { background-color: #fff; }
        .well { background-color: #fff; }
        .block { background-color: #fff;
          padding-left: 30px;
          padding-top: 30px;
          padding-right: 30px;
          padding-bottom: 30px;}

        .fixme { position: fixed; }
        /* Landscape phone to portrait tablet */
        @media (max-width: 767px) {
          .fixme { width: 100%; position: static; }
        }    
    </style>

<body>

<div class="navbar navbar-static-top" role="navigation">
    <nav role="navigation" class="navbar navbar-default navbar-inverse">
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">Study Buddies</a>
        </div>

        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="register.php">Register</a></li>
                <li class="divider-vertical"></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
</div>

<div class="container hero-unit">
  <div class="row tabbable well" role="tabpanel">
    <div class="col-md-3 fixme">
      <h2>Welcome, <?php echo htmlentities($_SESSION['Person']['first_name'], ENT_QUOTES, 'UTF-8'); ?>!</h2>
      <hr>
      <h4>Navigation</h4>
      <!-- Nav tabs -->
      <ul class="nav nav-pills nav-stacked" role="tablist">
        <li role="presentation" class="active"><a href="#create" aria-controls="create" role="tab" data-toggle="tab">Create</a></li>
        <li role="presentation"><a href="#topics" aria-controls="topics" role="tab" data-toggle="tab">Topics</a></li>
        <li role="presentation"><a href="#scheduledmeetings" aria-controls="scheduledmeetings" role="tab" data-toggle="tab">Scheduled Meetings</a></li>
        <li role="presentation"><a href="#pendingrequests" aria-controls="pendingrequests" role="tab" data-toggle="tab">Pending Requests</a></li>
        <li role="presentation"><a href="#pastrequests" aria-controls="pastrequests" role="tab" data-toggle="tab">Past Requests</a></li>
      </ul>
    </div>

    <div class="col-md-offset-4 block">
      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="create">
          <h1>Create New Request</h1>
          <hr>
                      
          <form class="form-horizontal" method="post" action="storeRequest.php" role="form">
            <div class="form-group">
              <label for="topic" class="col-sm-3 control-label">Topic</label>
              <div class="col-sm-10 col-md-6">
                <select class="form-control" id="topic" name="topic">
                  <?php
                    $query = "SELECT * FROM Topic";
                    try{
                      $stmt = $db->prepare($query);
                      $result = $stmt->execute();
                    }
                    catch(PDOException $ex) {die("Failed to get Topics: " . $ex->getMessage()); }

                    while($row = $stmt -> fetch()) {
                      echo "<option>$row[name]</option>";
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="date" class="col-sm-3 control-label">Date</label>
              <div class="col-md-6">
                <input name ="date" type="date" class="form-control" id="date">
              </div>
            </div>

            <div class="form-group">
              <label for="topic" class="col-sm-3 control-label">Group Preference</label>
              <div class="col-sm-10 col-md-6">
                <select multiple class="form-control" id="grouppref" name="grouppref[]">
                  <option value="Small">Small (2-3)</option>
                  <option value="Medium">Medium (4-6)</option>
                  <option value="Large">Large (7+)</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="topic" class="col-sm-3 control-label">Time</label>
              <div class="col-sm-10 col-md-6">
                <select multiple class="form-control" id="time" name="time[]">
                    <option value="morning">Morning</option>
                    <option value="afternoon">Afternoon</option>
                    <option value="evening">Evening</option>
                    <option value="night">Night</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
              </div>
            </div>
          </form>

          <br>
          <br>
          <h1>Create New Topic</h1>
          <hr>

          <form class="form-horizontal" method="post" action="storeTopic.php" role="form">

            <div class="form-group">
              <label for="topicName" class="col-sm-3 control-label">Topic</label>
              <div class="col-md-6">
                <input name="topicName" type="text" class="form-control" id="topicName">
              </div>
            </div>

            <div class="form-group">
              <label for="topicDescription" class="col-sm-3 control-label">Description</label>
              <div class="col-md-6">
                <input name="topicDescription" type="text" class="form-control" id="topicDescription">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-10">
                <button type="submit" class="btn btn-default">Submit</button>
              </div>
            </div>
          </form>

        </div>

        <div role="tabpanel" class="tab-pane" id="topics">
          <h1>Topics</h1>
          <hr>

            <table class="table table-striped table-hover">
              <thead>
                <tr class = "active">
                  <td>Topic</td>
                  <td>Description</td>
                </tr>
              </thead>

              <tbody>
                <?php
                  $query = "
                    SELECT name, description
                    FROM Topic
                    "; 
               
                  try{ 
                     $stmt = $db->prepare($query); 
                     $result = $stmt->execute($query_params); 
                  } 
                  catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 

                  while ($row = $stmt -> fetch()) {
                    // Print out the contents of the entry 
                    echo '<tr>';
                    echo '<tr>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                  }
                ?>
              </tbody>
            </table>

          </hr>
        </div>

        <div role="tabpanel" class="tab-pane" id="scheduledmeetings">
          <h1>Scheduled Meetings</h1>

          <hr>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Meeting ID</th>
                  <th>Topic</th>
                  <th>Time</th>
                </tr>
              </thead>

              <tbody>
                <?php
                 $query = "
                  SELECT name, Meeting.mid AS mid, time_slot_date, time_slot_time
                  FROM Meeting, PersonAttendingMeeting, Topic, TimeSlot
                  WHERE pid = :pid AND Meeting.mid = PersonAttendingMeeting.mid AND Meeting.topic = Topic.topid
                    AND meeting_time = TimeSlot.tsid AND time_slot_date >= NOW()
                  "; 
                  $query_params = array( 
                  ':pid' => htmlentities($_SESSION['Person']['pid'], ENT_QUOTES, 'UTF-8')
                  ); 
              
                  try{ 
                     $stmt = $db->prepare($query); 
                     $result = $stmt->execute($query_params); 
                  } 
                  catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
      
                  $num = 0;

                  while ($row = $stmt -> fetch()) {
                    // Print out the contents of the entry 
                    echo '<tr>';
                    echo '<td>' . $row['mid'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['time_slot_date'] . '  ' . $row['time_slot_time'] . '</td>';
                    $num++;
                  }
                ?>
              </tbody>
            </table>
            <?php
              if($num < 3) {
                echo '<br><br>';
                if($num == 0) {
                  echo '<center>';
                  echo '<p>You have no scheduled meetings</p>';
                  echo '<p>Request meetings in the <strong>Create</strong> tab';
                  echo '</center>';
                }
                echo '<br>';
              }
            ?>
        </div>

        <div role="tabpanel" class="tab-pane" id="pendingrequests">
          <h1>Pending Requests</h1>
          <hr>
            <form class="form-horizontal" method="post" action="deleteRequest.php" role="form">
              <div class="form-group">
              <label for="request" class="col-sm-3 control-label">Delete Request</label>
              <div class="col-sm-10 col-md-6">
                <select class="form-control" id="request" name="request">
                  <?php
                    $query = "
                      SELECT *
                      FROM Request
                      WHERE pid=:pid AND status='open'
                      ";
                    $query_params = array( 
                      ':pid' => htmlentities($_SESSION['Person']['pid'], ENT_QUOTES, 'UTF-8')
                     ); 
                    try{
                      $stmt = $db->prepare($query);
                      $result = $stmt->execute($query_params);
                    }
                    catch(PDOException $ex) {die("Failed to get Requests: " . $ex->getMessage()); }

                    while($row = $stmt -> fetch()) {
                      echo "<option>$row[rid]</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            </form>
            <table class="table table-striped table-hover">
              <thead>
                <tr class = "active">
                  <td>Request ID</td>
                  <td>Topic</td>
                  <td>Time at Request</td>
                </tr>
              </thead>

              <tbody>
                <?php
                  $query = "
                    SELECT name, rid, time
                    FROM Request, Topic
                    WHERE pid=:pid AND Request.topid = Topic.topid AND status = 'open'
                    "; 

                  $query_params = array( 
                    ':pid' => htmlentities($_SESSION['Person']['pid'], ENT_QUOTES, 'UTF-8')
                  ); 
               
                  try{ 
                     $stmt = $db->prepare($query); 
                     $result = $stmt->execute($query_params); 
                  } 
                  catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 

                  $num = 0;

                  while ($row = $stmt -> fetch()) {
                    // Print out the contents of the entry 
                    echo '<tr>';
                    echo '<tr>';
                    echo '<td>' . $row['rid'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . date("h:i:s A \o\\n l, F jS",$row['time']) . '</td>';
                    $num++;
                  }
                ?>
              </tbody>
            </table>
            <?php
              if($num < 3) {
                echo '<br><br>';
                if($num == 0) {
                  echo '<center>';
                  echo '<p>You have no pending requests</p>';
                  echo '<p>Request meetings in the <strong>Create</strong> tab';
                  echo '</center>';
                }
                echo '<br>';
              }
            ?>
          </hr>
        </div>
        <div role="tabpanel" class="tab-pane" id="pastrequests">
          <h1>Past Meetings</h1>
          <hr>

            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Topic</th>
                  <th>Time</th>
                </tr>
              </thead>

              <tbody>
                <?php
                 $query = "
                  SELECT name, time_slot_date, time_slot_time
                  FROM Meeting, PersonAttendingMeeting, Topic, TimeSlot
                  WHERE pid = :pid AND Meeting.mid = PersonAttendingMeeting.mid AND Meeting.topic = Topic.topid
                    AND meeting_time = TimeSlot.tsid AND time_slot_date < NOW()
                  "; 
                  $query_params = array( 
                  ':pid' => htmlentities($_SESSION['Person']['pid'], ENT_QUOTES, 'UTF-8')
                  ); 
              
                  try{ 
                     $stmt = $db->prepare($query); 
                     $result = $stmt->execute($query_params); 
                  } 
                  catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
      
                  $num = 0;

                  while ($row = $stmt -> fetch()) {
                    // Print out the contents of the entry 
                    echo '<tr>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['time_slot_date'] . '  ' . $row['time_slot_time'] . '</td>';
                    $num++;
                  }
                ?>
              </tbody>
            </table>
            <?php
              if($num < 3) {
                echo '<br><br>';
                if($num == 0) {
                  echo '<center>';
                  echo '<p>You have no past meetings</p>';
                  echo '<p>Request meetings in the <strong>Create</strong> tab to get started';
                  echo '</center>';
                }
                echo '<br>';
              }
            ?>
        </div>
      </div>
    </div>
    </div>

  </div>
</div>

</body>
</html>
