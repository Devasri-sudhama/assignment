<?php
require 'config.php';



if (isset($_GET["search"])) {
    $search  = $_GET["search"];
} else {
   return false;
}



$sqlTotal = "SELECT * FROM users";
// $sql = "SELECT * FROM users where name like '%$search%' or address like '%$search%' or email like '%$search%' Order By id desc LIMIT $start_from, $num_rec_per_page";
$sql = "SELECT * FROM users where name like '%$search%' or address like '%$search%' or email like '%$search%' Order By id desc";
// -- LIMIT $start_from, $num_rec_per_page";

// $result = $mysqli->query($sql);
$result = mysqli_query($conn, $sql);
// $row = ;
while ($row=mysqli_fetch_assoc($result)) {
    $json[] = $row;
}


$data['data'] = $json;


$result =  mysqli_query($conn, $sqlTotal);


$data['total'] = mysqli_num_rows($result);

echo json_encode($data);
?>