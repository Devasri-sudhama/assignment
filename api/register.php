<?php


require './config.php';

session_start();
// $post = $_POST;
$errors = [];

if(isset($_SESSION["name"])){
  $last_updated_by = $_SESSION["name"];
}else{
  $last_updated_by = $_POST["name"];
}
$name = $_POST["name"];
$mobile = $_POST["mobile"];
$email = $_POST["email"];
$address = $_POST["address"];
$password = $_POST["password"];
$gender = $_POST["gender"];
$dateofbirth = $_POST["dateofbirth"];
$profile = $_POST["profile"];
$sql = "select email from users where email = '$email'";
$result = mysqli_query($conn, $sql);
$rowcount = mysqli_num_rows($result);
if ($rowcount < 1) {
  // $sql = "INSERT INTO users (title,description) VALUES ('".$post['title']."','".$post['description']."')";
  $sql = "INSERT INTO users (name,mobile,email,password,address,gender,dateofbirth,profilepicture,last_updated_by) 
	VALUES ('$name','$mobile','$email','$password','$address','$gender','$dateofbirth','$profile','$last_updated_by')";
  $result = mysqli_query($conn, $sql);
  echo json_encode(array("statusCode" => 200));
} else {
  echo json_encode(array("statusCode" => 201, "message" => "Email Id Already Exists"));
}


  // $result = $mysqli->query($sql);


  // $sql = "SELECT * FROM items Order by id desc LIMIT 1"; 


  // $result = $mysqli->query($sql);


  // $data = $result->fetch_assoc();
?>