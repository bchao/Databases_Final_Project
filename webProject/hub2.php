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
        body { background: url(assets/bglight.png); }
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
                <li><a href="Logout.php">Logout</a></li>
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
        <li role="presentation"><a href="#currentrequests" aria-controls="currentrequests" role="tab" data-toggle="tab">Current Requests</a></li>
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
                  <option value=""selected="selected">(please select a topic)</option>

                  <?php
                    $query = "SELECT * FROM Topic";
                    try{
                      $stmt = $db->prepare($query);
                      $result = $stmt->execute();
                    }
                    catch(PDOException $ex) {die("Failed to get Topics: " . $ex->getMessage()); }

                    while($row = $stmt -> fetch()) {
                      echo "<option value=$row[name]>$row[name]</option>";
                    }
                  ?>



                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="date" class="col-sm-3 control-label">Date</label>
              <div class="col-md-6">
                <input type="date" class="form-control" id="date">
              </div>
            </div>

            <div class="form-group">
              <label for="topic" class="col-sm-3 control-label">Group Preference</label>
              <div class="col-sm-10 col-md-6">
                <select class="form-control" id="grouppref" name="grouppref">
                  <option value=""selected="selected">(please select a preference)</option>
                  <option>Small</option>
                  <option>Medium</option>
                  <option>Large</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="topic" class="col-sm-3 control-label">Time</label>
              <div class="col-sm-10 col-md-6">
                <select class="form-control" id="time" name="time">
                  <option value=""selected="selected">(please select a time)</option>
                    <option value="morning">Morning</option>
                    <option value="afternooon">Afternoon</option>
                    <option value="evening">Evening</option>
                    <option value="night">Night</option>
                    <option value="anyTime">Any Time</option>
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

        <div role="tabpanel" class="tab-pane" id="currentrequests">
          <h1>Current Requests</h1>
        </div>
        <div role="tabpanel" class="tab-pane" id="pendingrequests">
          <h1>Pending Requests</h1>
          <hr>

            <table class="table table-striped table-hover">
              <thead>
                <tr class = "active">
                  <td>name</td>
                  <td>time</td>
                </tr>
              </thead>

              <tbody>
                <?php
                  $query = "
                    SELECT name, time
                    FROM Request, Topic
                    WHERE Request.topid = Topic.topid
                    "; 

                  $query_params = array( 
                    ':pid' => htmlentities($_SESSION['Person']['pid'], ENT_QUOTES, 'UTF-8')
                  ); 
               
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
                    echo '<td>' . $row['time'] . '</td>';
                  }
                ?>
              </tbody>
            </table>

          </hr>
        </div>
        <div role="tabpanel" class="tab-pane" id="pastrequests">
          <h1>Past Requests</h1>
        </div>
      </div>
    </div>
    </div>

  </div>
</div>

</body>
</html>
