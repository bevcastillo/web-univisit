<!DOCTYPE html>
<html lang="en">
<head>
	<title>UniVisit - Admin Register</title>
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
		$mysqli = new mysqli('127.0.0.1','root','hipe1108','univisit') or die(mysqli_error($mysqli));

	?>
	<?php
		require_once 'process.php';
	?>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<form class="login100-form validate-form" action="process.php" method="POST">
					<span class="login100-form-title p-b-30">
						Hey there! Let's get started
					</span>

					<?php
                      if(isset($_SESSION['message'])): ?>          
                       <div class="alert alert-<?=$_SESSION['message_type']?>">
                    <?php
                      echo $_SESSION['message'];
                      unset($_SESSION['message']);
                    ?>
                      </div>
                    <?php endif ?>

                    
                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Name is required">
						<input class="input100" type="text" name="admin_name" placeholder="Name">
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Email address is required">
						<input class="input100" type="text" name="admin_email" placeholder="Email">
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" name="admin_password" placeholder="Password">
						</span>
					</div>
					
					<div class="container-login100-form-btn p-t-25">
						<button class="login100-form-btn" name="register">
							Create account
						</button>
					</div>

					<div class="text-center w-full p-t-30">
						<span class="txt1">
							Already a member?
						</span>

						<a class="txt1 bo1 hov1" href="index.php">
							Sign in						
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="js/main.js"></script>

</body>
</html>