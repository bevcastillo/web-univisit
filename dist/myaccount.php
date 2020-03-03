<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>My Account - UniVisit Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
    session_start();
    require_once '../process.php'; ?>

    <?php
    $admin_id = $_SESSION['admin_id'];
    $mysqli = new mysqli('127.0.0.1','root','hipe1108','univisit') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM admin WHERE admin_id='$admin_id'") or die(mysqli_error($mysqli));

    while($row = mysqli_fetch_array($result)){
    $admin_id = $row['admin_id'];
    $admin_name = $row['admin_name'];
    $admin_email = $row['admin_email'];
    $admin_password = $row['admin_password']; 
    }?>
        
    <?php
    if(isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['message_type']?>">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
        <a class="navbar-brand" href="dashboard.php?id=<?php echo $_SESSION['admin_id']; ?>">UniVisit Admin</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"></button>
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <a class="text-white">Welcome, <?php echo $_SESSION['admin_email'];?></a>
        </form>

        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="myaccount.php?id=<?php echo $_SESSION['admin_id'];?>">My Account</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../admin_logout.php">Logout</a>
                </div>
            </li>
        </ul>

    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-primary" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="dashboard.php?=id<?php echo $_SESSION['admin_id'];?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <div class="sb-sidenav-menu-heading">Interface</div>

                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usersCollapse" aria-expanded="false" aria-controls="visitsCollapse">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Users
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="usersCollapse" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="active_users.php?id=<?php echo $_SESSION['admin_id']; ?>">Active Users</a>
                                <a class="nav-link" href="inactive_users.php?id=<?php echo $_SESSION['admin_id']; ?>">Inactive Users</a>
                                <a class="nav-link" href="users.php?id=<?php echo $_SESSION['admin_id']; ?>">All Users</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#visitsCollapse" aria-expanded="false" aria-controls="visitsCollapse">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Visits
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="visitsCollapse" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="pending_visits.php?id=<?php echo $_SESSION['admin_id'];?>">Pending Visits</a>
                                <a class="nav-link" href="accepted_visits.php?id=<?php echo $_SESSION['admin_id'];?>">Accepted Visits</a>
                                <a class="nav-link" href="cancelled_visits.php?id=<?php echo $_SESSION['admin_id'];?>">Cancelled Visits</a>
                                <a class="nav-link" href="all_visits.php?id=<?php echo $_SESSION['admin_id']?>">All Visits</a>
                            </nav>
                        </div>

                        <div class="sb-sidenav-menu-heading"></div> 
                        
                    </div>
                </div>

                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo $_SESSION['admin_name'];?>
                </div>

            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">My Account</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php?id=<?php echo $_SESSION['admin_id'];?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                    </ol>

                    <div class="">
                        <div class="wrap-login100 p-l-0 p-r-50 p-t-0 p-b">
                            <form action="../process.php" method="POST">

                                <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">

                                <label>Name</label></br>
                                <input type="text" class="form-control" name="admin_name" value="<?php echo $admin_name; ?>">


                                <label class="mt-4">Email</label></br>
                                <input type="email" class="form-control" name="admin_email" value="<?php echo $admin_email; ?>">

                                <label class="mt-4">Password</label></br>
                                <input type="password" class="form-control" name="admin_password" value="<?php echo $admin_password; ?>">

                                <button class="btn btn-primary mt-3" name="update">SAVE</button>
                            </form>


                        </div>
                    </div>                       

                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; UniVisit 2020</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
        <script src="vendor/bootstrap/js/popper.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
