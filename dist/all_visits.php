<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - UniVisit Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>
<!-- <body class="sb-nav-fixed"> -->
<body>
    <?php
        require_once '../process.php';
        $mysqli = new mysqli('127.0.0.1','root','hipe1108','univisit') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM visit_record INNER JOIN users ON visit_record.user_id = users.user_id ") or die(mysqli_error($mysqli));
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
        <a class="navbar-brand" href="dashboard.php">Dashboard - UniVisit Admin</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"></button>

        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <a class="text-white">Welcome, <?php echo $_SESSION['admin_email'];?></a>
        </form>

        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="myaccount.php">My Account</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../index.php">Logout</a>
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

                        <a class="nav-link" href="dashboard.php"><div class="sb-nav-link-icon">
                            <i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link" href="users.php"><div class="sb-nav-link-icon">
                            <i class="fas fa-columns"></i></div>
                            Users
                            <div class="sb-sidenav-collapse-arrow"></div></a>

                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#visitsCollapse" aria-expanded="false" aria-controls="visitsCollapse">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Visits
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                            
                        <div class="collapse" id="visitsCollapse" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="pending_visits.php?id=<?php echo $_SESSION['id']; ?>">Pending Visits</a>
                                <a class="nav-link" href="accepted_visits.php?id=<?php echo $_SESSION['id']; ?>">Accepted Visits</a>
                                <a class="nav-link" href="declined_visits.php?id=<?php echo $_SESSION['id']; ?>">Declined Visits</a>
                                <a class="nav-link" href="all_visits.php?id=<?php echo $_SESSION['id']; ?>">All Visits</a>
                            </nav>
                        </div>

                        <div class="sb-sidenav-menu-heading"></div> 
                        
                    </div>
                </div>

                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo $_SESSION['admin_name']; ?>
                </div>

            </nav>
        </div>
            
        <div id="layoutSidenav_content">
            <main>
            <div class="container-fluid">
                <h1 class="mt-4">All Visits</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">All Visits</li>
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
                                        <th>Phone</th>
                                        <th>ID #</th>
                                        <th>Visit Type</th>
                                        <th>Visit Date & Time</th>
                                        <th>Purpose</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                <?php
                                while($row = $result->fetch_assoc()){ ?>
                                <tr>
                                    <td><?php echo $row['record_id']; ?></td>
                                    <td>
                                        <?php echo $row['user_firstname']; ?>
                                        <?php echo $row['user_lastname']; ?>
                                    </td>
                                    <td><?php echo $row['user_phone']; ?></td>
                                    <td><?php echo $row['visit_id_num']; ?></td>
                                    <td><?php echo $row['user_visit_type']; ?></td>
                                    <td>
                                        <?php echo $row['visit_date']; ?>
                                        <?php echo $row['visit_time']; ?>
                                    </td>
                                    <td><?php echo $row['visit_purpose']; ?></td>
                                    <td><?php echo $row['visit_status']; ?></td>
                                    <td>
                                    <form action="../process.php" method="POST">
                                    <input type="text" name="record_id" value="<?php echo $row['record_id'] ?>" hidden>
                                    <button class="btn btn-primary" name="acceptAllVisit">Accept</button>
                                    <button class="btn btn-danger" name="declineAllVisit">Decline</button>
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
