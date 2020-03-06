<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Active Users - UniVisit Admin</title>
    <link rel="icon" type="image/png" href="../images/icons/logo.png"/>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <?php
         session_start();

        if(!isset($_SESSION['id'])) {
            header("Location: ../admin_logout.php");
        }
        // require_once '../process.php';
        $mysqli = new mysqli('localhost','root','','univisit') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM user WHERE user_status='Active' ") or die(mysqli_error($mysqli));
    ?>

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
        <a class="navbar-brand" href="dashboard.php?id=<?php echo $_SESSION['id'];?>">UniVisit Admin</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"></button>

        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <a class="text-white">Welcome, <?php echo $_SESSION['admin_email'];?></a>
        </form>

        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="myaccount.php?id=<?php echo $_SESSION['id'];?>">My Account</a>
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
                        <div class="sb-sidenav-menu-heading">
                        Core</div>

                        <a class="nav-link" href="dashboard.php?id=<?php echo $_SESSION['id'];?>"><div class="sb-nav-link-icon">
                            <i class="fas fa-tachometer-alt"></i></div>
                        Dashboard</a>

                        <div class="sb-sidenav-menu-heading">
                        Interface</div>

                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usersCollapse" aria-expanded="false" aria-controls="visitsCollapse">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Users
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="usersCollapse" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="active_users.php?id=<?php echo $_SESSION['id']; ?>">Active Users</a>
                                <a class="nav-link" href="inactive_users.php?id=<?php echo $_SESSION['id']; ?>">Inactive Users</a>
                                <a class="nav-link" href="users.php?id=<?php echo $_SESSION['id']; ?>">All Users</a>
                            </nav>
                        </div>


                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#visitsCollapse" aria-expanded="false" aria-controls="visitsCollapse">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Visits
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="visitsCollapse" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="pending_visits.php?id=<?php echo $_SESSION['id']; ?>">Pending Visits</a>
                                <a class="nav-link" href="accepted_visits.php?id=<?php echo $_SESSION['id']; ?>">Accepted Visits</a>
                                <a class="nav-link" href="cancelled_visits.php?id=<?php echo $_SESSION['id']; ?>">Cancelled Visits</a>
                                <a class="nav-link" href="all_visits.php?id=<?php echo $_SESSION['id']; ?>">All Visits</a>
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
                    <h1 class="mt-4">Active Users</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php?id=<?php echo $_SESSION['id'];?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Active Users</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" 
                                id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Phone number</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        while($row = $result->fetch_assoc()){ ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td>
                                                <?php echo $row['user_fname']; ?>
                                                <?php echo $row['user_lname']; ?>
                                            </td>
                                            <td><?php echo $row['user_address']; ?></td>
                                            <td><?php echo $row['user_contact']; ?></td>
                                            <td><?php echo $row['user_uname']; ?></td>
                                            <td><?php echo $row['user_email']; ?></td>
                                            <td><?php echo $row['user_status']; ?></td>
                                            <td>
                                            <!-- <button class="btn btn-primary" onclick="activateUser()">Activate</button> -->
                                            <form action="../process.php" method="POST">
                                                <input type="text" name="id" value="<?php echo $row['id']; ?>" hidden>
                                                <button class="btn btn-danger" name="deactivateActiveUser">Deactivate</button>
                                            </form>
                                            </td>
                                        </tr>
                                        <?php
                                            }  
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>
</html>
