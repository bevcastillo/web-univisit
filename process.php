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
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];

    //cheking if the fields are empty

    if(empty($_POST['admin_name']) || empty($_POST['admin_email']) || empty($_POST['admin_password'])) {
            $_SESSION['message'] = "Fields cant be empty!";
            $_SESSION['message_type'] = "danger";

            header("location: index.html");
    } else {
        $mysqli->query("INSERT INTO admin (admin_name, admin_email, admin_password) VALUES('$admin_name','$admin_email','$admin_password')") or die(mysqli_error($mysqli));

        $_SESSION['message'] = "Successfully created your account";
        $_SESSION['message_type'] = "success";

        header("location: dist/dashboard.html");
    }
}


?>