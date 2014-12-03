<?php 
    require("config.php"); 
    $submitted_email = ''; 
    if(!empty($_POST)){ 
        $query = "
            SELECT
              first_name,
              last_name,
              password,
              email
            FROM Person
            WHERE
              email = :email
        "; 
        $query_params = array( 
            ':email' => $_POST['email'] 
        ); 
         
        try{ 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        $login_ok = false; 
        $row = $stmt->fetch(); 

        if($row){ 
            if($_POST['password'] === $row['password']) {
              $login_ok = true;
            }
        } 

        if($login_ok){ 
            unset($row['password']); 
            $_SESSION['Person'] = $row;  
            header("Location: hub.php"); 
            die("Redirecting to: hub.php"); 
        } 
        else{ 
            print("Login Failed."); 
            $submitted_email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 
?> 


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Study Buddies</title>
    <meta name="description" content="Home page">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <link href="assets/bootstrap.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
        body { background: url(assets/bglight.png); }
        .hero-unit { background-color: #fff; }
        .center { display: block; margin: 0 auto; }
    </style>
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
      <div class="nav-collapse collapse">
        <ul class="nav pull-right">
          <li><a href="register.php">Register</a></li>
          <li class="divider-vertical"></li>
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">Log In <strong class="caret"></strong></a>
            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                <form action="index.php" method="post"> 
                    Email:<br /> 
                    <input type="text" name="email" value="<?php echo $submitted_email; ?>" /> 
                    <br /><br /> 
                    Password:<br /> 
                    <input type="password" name="password" value="" /> 
                    <br /><br /> 
                    <input type="submit" class="btn btn-info" value="Login" /> 
                </form> 
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="container hero-unit">
    <h1>Please register or log in!</h1>
    <p>You can't do anything until you register and log in.</p>
    <ul>
        <li>Create a new user with the <strong>Register</strong> button in the navbar.</li>
        <li>Use the default credentials for testing:<br />
            <strong>email:</strong> test@gmail.com<br />
            <strong>pass:</strong> password<br /></li>
    </ul>
</div>

</body>
</html>
