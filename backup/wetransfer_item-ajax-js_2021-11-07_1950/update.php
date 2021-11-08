<?php


  require './config.php';


  $id  = $_POST["id"];
  $post = $_POST;


  $sql = "UPDATE users SET name='$name',mobile='$mobile',address='$address',gender='$gender',dateofbirth='$dateofbirth',profile='$profile' WHERE id = '".$id."'";


  $result = $mysqli->query($sql);


  $sql = "SELECT * FROM users WHERE id = '".$id."'"; 


  $result = $mysqli->query($sql);


  $data = $result->fetch_assoc();


  echo json_encode($data);


?>