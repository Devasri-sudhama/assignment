<?php


  require './config.php';
  session_start();
  // $post = $_POST;
  if(isset($_SESSION["name"])){
    $last_updated_by = $_SESSION["name"];
    // echo $last_updated_by;
  }else{
    $last_updated_by = $_POST["name"];
    // echo $last_updated_by;
  }
  $id  = $_POST["id"];

  // print_r($_POST);
  
  $name = $_POST["name"];
$mobile = $_POST["mobile"];
$role = $_POST["role"];
// $email = $_POST["email"];
$address = $_POST["address"];
$userSign = $_POST["userSign"];
// $password = $_POST["password"];

$dateofbirth = $_POST["dateofbirth"];
$profile =$_POST["profile"];

  $sql = "UPDATE users SET name='$name',role='$role',mobile=$mobile,address='$address',dateofbirth='$dateofbirth',profilepicture='$profile',signature='$userSign',last_updated_by='$last_updated_by' WHERE id = '$id'";

// echo $sql;
  $result =  mysqli_query($conn, $sql);

// echo $result;
  $sql = "SELECT * FROM users WHERE id = $id"; 


  $result =  mysqli_query($conn, $sql);


  $data = mysqli_fetch_assoc($result);
  // echo $data;


  echo json_encode($data);


?>