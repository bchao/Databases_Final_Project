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

                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" >Login <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right" style="padding: 15px; padding-bottom: 0px;">              
<form action="index.php" method="post"> 
                    Email:<br /> 
                    <input type="text" name="email" value="<?php echo $submitted_email; ?>" /> 
                    <br /><br /> 
                    Password:<br /> 
                    <input type="password" name="password" value="" /> 
                    <br /><br /> 
                    <input type="submit" class="btn btn-info" value="Login" /> 
                </form> 
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
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


