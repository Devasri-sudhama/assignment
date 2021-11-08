<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["name"]);
unset($_SESSION["role"]);
unset($_SESSION["email"]);
unset($_SESSION["status"]);
header("Location:index.php");
?>
 