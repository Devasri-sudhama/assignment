<?php


 require './config.php';
 session_start();

 $id  = $_POST["id"];



 $sql = " UPDATE users SET status = 1 WHERE id = '$id'";

 mysqli_query($conn, $sql);
// $result = $mysqli->query($sql);


 echo json_encode([$id]);


?>