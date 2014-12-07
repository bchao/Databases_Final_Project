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
        <li role="presentation" class="active"><a href="#createrequest" aria-controls="requeststatus" role="tab" data-toggle="tab">Create</a></li>
      </ul>
    </div>

    <div class="col-md-offset-4 block">
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
