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
    <script src="dist/js/bootstrap.min.js"></script>
    <link href="dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
        body { background: url(dist/bglight.png); }
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
        <li class="active"><a href="#requeststatus" data-toggle="tab">Request Status</a></li>
      </ul>
    </div>

    <div class="span8 well pull-right">
      <div class="tab-content">
        <div id="requeststatus" class="tab-pane active">
          <h1>Request made!</h1>
          <hr>
        </br >
          <a class="btn btn-primary btn-lg btn-block" type="button" href="hub.php">Return Home</a>
        </div>
    </div>
  </div>
</div>

</body>
</html>

















