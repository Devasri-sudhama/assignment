<?php


 require './config.php';


 $id  = $_POST["id"];


 $sql = "DELETE FROM users WHERE id = '$id'";

 $result = mysqli_query($conn, $sql);
//  $result = $mysqli->query($sql);


 echo json_encode([$id]);


?>