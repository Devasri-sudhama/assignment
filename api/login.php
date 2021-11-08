<?php

session_start();
require './config.php';
require './uploads.php';


$post = $_POST;
$errors = [];
$email = $_POST["email"];
$password = $_POST["password"];
$sql = "select id,email,name,role,status from users where email = '$email' and password = '$password'";
$result = mysqli_query($conn, $sql);

$result = mysqli_query($conn, $sql);
$rowcount = mysqli_num_rows($result);

$row=mysqli_fetch_array($result);


if(is_array($row)) {
    $_SESSION["id"] = $row['id'];
    $_SESSION["role"] = $row['role'];
    $_SESSION["name"] = $row['name'];
    $_SESSION["email"] = $row['email'];
    $_SESSION["status"] = $row['status'];
    // header("Location:../dashboard.php");
    echo json_encode(array("statusCode" => 200));
    } else{
    echo json_encode(array("statusCode" => 201,"msg"=>"Invalid Details"));
 }
?>