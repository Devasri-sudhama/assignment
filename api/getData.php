<?php
require 'config.php';

session_start();
$num_rec_per_page = 5;


if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
}
$role=$_SESSION["role"];
$id=$_SESSION["id"];
// echo $id;
$start_from = ($page - 1) * $num_rec_per_page;

if($role=="1" || $role=="2"){

    
$sqlTotal = "SELECT * FROM users";
$sql = "SELECT * FROM users Order By id desc LIMIT $start_from, $num_rec_per_page";
}
else{
    // echo "uf";
    $sqlTotal = "SELECT * FROM users where id=$id";
    $sql = "SELECT * FROM users where id=$id";
    }

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