<?php
include 'connect.php';

//starting the connection
session_start();

// //setting the connetion
// $mysqli = new mysqli('localhost','root','','univisit') or die(mysqli_error($mysqli));

$id=0;
$admin_name="";
$admin_email="";
$admin_password="";

//query to insert data into the database //register
if(isset($_POST['register'])) {
    $id = $_POST['id'];
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];

    //cheking if the fields are empty
    if(empty($_POST['admin_name']) || empty($_POST['admin_email']) || empty($_POST['admin_password'])) {
            $_SESSION['message'] = "Fields cant be empty!";
            $_SESSION['message_type'] = "danger";

            header("location: register.php");
    } else {
        $mysqli->query("INSERT INTO admin (admin_name, admin_email, admin_password) VALUES('$admin_name','$admin_email','$admin_password')") or die(mysqli_error($mysqli));

        $_SESSION['message'] = "Account has been created successfully. Please go to sign in page to login.";
        $_SESSION['message_type'] = "success";

        header("location: register.php");
    }
}


//for admin login
if(isset($_POST['signin'])){
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
  
    $result = $mysqli->query("SELECT * FROM admin WHERE admin_email = '".$_POST['admin_email']."' and admin_password='".$_POST['admin_password']."' ");
  
    $row = mysqli_fetch_assoc($result);
  
    if (count($row) > 0) {
      $_SESSION['id'] = $row["id"];
      $_SESSION['admin_name'] = $row["admin_name"];
      $_SESSION['admin_email'] = $row["admin_email"];
      $_SESSION['admin_password'] = $row["admin_password"];

      $id = $_SESSION['id'];
      
      header("location: dist/dashboard.php?id=$id");
    } else {
      $_SESSION['message'] = "Username and password is invalid!";
      $_SESSION['message_type'] = "danger";

      header("location: index.php");
    }
    
  }

//update
if(isset($_POST['update'])){
  $id = $_POST['id'];
  $admin_name = $_POST['admin_name'];
  $admin_email = $_POST['admin_email'];
  $admin_password = $_POST['admin_password'];

  $mysqli->query("UPDATE admin SET admin_name='$admin_name', admin_email='$admin_email', admin_password='$admin_password' WHERE id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Account has been updated successfully!";
  $_SESSION['message_type'] = "success";

  header("location: ./dist/myaccount.php");
}

//deactivate user
if(isset($_POST['deactivateUser'])){
  $id = $_POST['id'];

  $mysqli->query("UPDATE user SET user_status='Inactive' WHERE id=$id") or die($mysqli->error());

  $_SESSION['message'] = "User has been deactivated successfully!";
  $_SESSION['message_type'] = "success";


  header("location: ./dist/users.php");
}

//activate user
if(isset($_POST['activateUser'])){
  $id = $_POST['id'];

  $mysqli->query("UPDATE user SET user_status='Active' WHERE id=$id") or die($mysqli->error());

  $_SESSION['message'] = "User has been activated successfully!";
  $_SESSION['message_type'] = "success";


  header("location: ./dist/users.php");
}

//deactivate an active user
if(isset($_POST['deactivateActiveUser'])){
  $id = $_POST['id'];

  $mysqli->query("UPDATE user SET user_status='Inactive' WHERE id=$id") or die($mysqli->error());

  $_SESSION['message'] = "User has been deactivated successfully!";
  $_SESSION['message_type'] = "success";


  header("location: ./dist/active_users.php");
}

//activate inactive user
if(isset($_POST['activateInactiveUser'])){
  $id = $_POST['id'];

  $mysqli->query("UPDATE user SET user_status='Active' WHERE id=$id") or die($mysqli->error());

  $_SESSION['message'] = "User has been activated successfully!";
  $_SESSION['message_type'] = "success";


  header("location: ./dist/inactive_users.php");
}


//approve a visit from pending
if(isset($_POST['acceptVisit'])){
  $id = $_POST['id'];

  $mysqli->query("UPDATE record SET visitor_status='Accepted' WHERE record_id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Pending visit has been accepted successfully!";
  $_SESSION['message_type'] = "success";


  header("location: ./dist/pending_visits.php");
}

//approve a visit
if(isset($_POST['declineVisit'])){
  $id = $_POST['id'];

  $mysqli->query("UPDATE record SET visitor_status='Declined' WHERE record_id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Approved visit has been declined successfully!";
  $_SESSION['message_type'] = "success";


  header("location: ./dist/pending_visits.php");
}


/////////////////////////

//approve a visit for all visits
if(isset($_POST['acceptAllVisit'])){
  $id = $_POST['id'];

  $mysqli->query("UPDATE record SET visitor_status='Accepted' WHERE record_id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Visit has been accepted successfully!";
  $_SESSION['message_type'] = "success";


  header("location: ./dist/all_visits.php");
}

//approve a visit
if(isset($_POST['declineAllVisit'])){
  $id = $_POST['id'];

  $mysqli->query("UPDATE record SET visitor_status='Declined' WHERE record_id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Visit has been declined successfully!";
  $_SESSION['message_type'] = "success";


  header("location: ./dist/all_visits.php");
}

/////////////////////////
//approve a declined visit
if(isset($_POST['acceptDeclinedVisit'])){
  $id = $_POST['id'];

  $mysqli->query("UPDATE record SET visitor_status='Accepted' WHERE record_id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Declined visit has been accepted successfully!";
  $_SESSION['message_type'] = "success";


  header("location: ./dist/declined_visits.php");
}

/////////////////////////
//decline a approved visit
if(isset($_POST['declineAcceptedVisit'])){
  $id = $_POST['record_id'];

  $mysqli->query("UPDATE record SET visitor_status='Declined' WHERE record_id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Accepted visit has been declined successfully!";
  $_SESSION['message_type'] = "success";


  header("location: ./dist/accepted_visits.php");
}

?>