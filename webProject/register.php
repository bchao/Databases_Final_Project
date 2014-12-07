<?php 
    require("config.php");
    if(!empty($_POST)) 
    { 
        // Ensure that the user fills out fields 
        if(empty($_POST['first_name'])) 
        { die("Please enter your first name."); } 
        if(empty($_POST['last_name'])) 
        { die("Please enter your last name."); } 
        if(empty($_POST['password'])) 
        { die("Please enter a password."); } 
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { die("Invalid E-Mail Address"); } 
         
        // Check if the email is already taken
        $query = " 
            SELECT 
                1 
            FROM Person 
            WHERE 
                email = :email 
        "; 
        $query_params = array( 
            ':email' => $_POST['email'] 
        ); 
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage());} 
        $row = $stmt->fetch(); 
        if($row){ die("This email address is already registered"); } 
         
        // Add row to database 
        $query = "
            INSERT INTO Person (
                first_name,
                last_name,
                password,
                email
            ) VALUES (
                :first_name,
                :last_name,
                :password,
                :email
            )
        "; 

        $query_params = array( 
            ':first_name' => $_POST['first_name'], 
            ':last_name' => $_POST['last_name'], 
            ':password' => $_POST['password'], 
            ':email' => $_POST['email'] 
        ); 
        try {  
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        header("Location: index.php"); 
        die("Redirecting to index.php");
         
        // // Security measures
        // $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
        // $password = hash('sha256', $_POST['password'] . $salt); 
        // for($round = 0; $round < 65536; $round++){ $password = hash('sha256', $password . $salt); } 
        // $query_params = array( 
        //     ':username' => $_POST['username'], 
        //     ':password' => $password, 
        //     ':salt' => $salt, 
        //     ':email' => $_POST['email'] 
        // ); 
        // try {  
        //     $stmt = $db->prepare($query); 
        //     $result = $stmt->execute($query_params); 
        // } 
        // catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        // header("Location: index.php"); 
        // die("Redirecting to index.php"); 
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Study Buddies Register</title>
    <meta name="description" content="Register for Study Buddies">

    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <style type="text/css">
        body { background: url(dist/bglight.png); }
        .hero-unit { background-color: #fff; }
        .center { display: block; margin: 0 auto; }

        .bs-example{
            margin: 20px;
        }
    </style>
</head> 
<body>
<div class="navbar navbar-static-top" role="navigation">
    <nav role="navigation" class="navbar navbar-default navbar-inverse">
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">Study Buddies</a>
        </div>

        <div id="navbarCollapse" class="collapse navbar-collapse ">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Return Home</a></li>
                
            </ul>
        </div>
    </nav>
</div>

<div class="container hero-unit">
    <h1>Register</h1> <br /><br />

<form method="post" action="register.php">
  <div class="col-xs-4">
    <label for="fn">First Name</label>
    <input type="text" class="form-control" id="fn" name="first_name" placeholder="Enter first name">
  </div> <br /><br /><br /><br />
  <div class="col-xs-4">
    <label for="ln">Last Name</label>
    <input type="text" class="form-control" id="ln" name="last_name" placeholder="Enter last name">
  </div> <br /><br /><br /><br />
  <div class="col-xs-4">
    <label for="em">Email</label>
    <input type="text" class="form-control" id="em" name="email" placeholder="Enter email">
  </div> <br /><br /><br /><br />
  <div class="col-xs-4">
    <label for="pw">Password</label>
    <input type="password" class="form-control" id="pw" name="password" placeholder="Enter password">
  </div> <br /><br /><br /><br />
  <button type="submit" class="btn btn-default col-xs-4">Submit</button> <br /><br /><br /><br />
</form>

</div>


</body>
</html>                                     