<!DOCTYPE html>
<html>
<head>
    <title>Admin Logout</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/logo.png"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css"> 
</head>
<body>
    <?php
        //starting the session
        session_start();

        //unsetting all the sessions
        $_SESSION = array();

        if (ini_get("session.use_cookies")) { 
            $params = session_get_cookie_params(); 
            setcookie(session_name(), '', time() - 42000, 
                $params["path"], $params["domain"], 
                $params["secure"], $params["httponly"] 
            ); 
        } 

        //destroying the session
        session_destroy();

    ?>
    <div class="limiter">
        <div class="container-login100">
            <span class="ogin100-form-title p-b-55 text-center">
                <h4 class="p-b-20 text-white">You have been logged out</h4>
                <h6 class="p-b-55 text-white">Thank you for visiting UniVisit for Admin</h6>
                <a class="btn btn-light text-primary" href="index.php">Sign in again</a>
            </span>
        </div>

    </div>
</body>
</html>