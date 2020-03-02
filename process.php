<?php

//starting the connection
session_start();

// //setting the connetion
$mysqli = new mysqli('127.0.0.1','root','hipe1108','univisit') or die(mysqli_error($mysqli));

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

        $_SESSION['message'] = "Successfully created your account";
        $_SESSION['message_type'] = "success";

        header("location: register.php");
    }
}

//check if the login button is pressed
if(isset($_POST['signin'])){
    // $id = $_POST['id'];
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];

    $yourid = $_SESSION['id'];
  
    $result = $mysqli->query("SELECT * FROM admin WHERE admin_email = '".$_POST['admin_email']."' and admin_password='".$_POST['admin_password']."' ");
  
    $row = mysqli_fetch_assoc($result);
  
    if (count($row) > 0) {
      $_SESSION['id'] = $row["id"];
      $_SESSION['admin_name'] = $row["admin_name"];
      $_SESSION['admin_email'] = $row["admin_email"];
      $_SESSION['admin_password'] = $row["admin_password"];
      
      header("location: dist/dashboard.php?id=$yourid");
    } else {
      $_SESSION['message'] = "Username and password is invalid!";
      $_SESSION['message_type'] = "danger";

      header("location: index.php");
    }
    
  }

//save is clicked
if(isset($_POST['save'])){
    $id = $_POST['id'];
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];

    $mysqli->query("UPDATE admin admin_name='$admin_name', admin_email='$admin_email', admin_password='$admin_password'
                    WHERE id=$id") or die($mysqli->error());
    
    $_SESSION['message'] = "Profile has been updated!";
    $_SESSION['warning'] = "warning";

    header("location: ./dist/myaccount.php");
}

?>