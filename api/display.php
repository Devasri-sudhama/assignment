<?php

session_start();
require './config.php';
require './uploads.php';

// print_r($_POST);
// echo '<script type="text/javascript">alert("' . $_POST . '")</script>';
$sql = "select * from users";
$result = mysqli_query($conn, $sql);
// $result=mysqli_query("select * from users",$conn);

echo "<table border='1'class='table table-hover' >
<tr>
<td align=center> <b>Name</b></td>
<td align=center><b>Role</b></td>
<td align=center><b>Mobile</b></td>
<td align=center><b>Email</b></td></td>
<td align=center><b>Address</b></td>
<td align=center><b>Date Of Birth</b></td>
<td align=center><b>Profile Picture</b></td>
<td align=center><b>Signature</b></td>
<td align=center><b>Action</b></td>
";

while($data = mysqli_fetch_row($result))
{   
    echo "<tr>";
    echo "<td align=center>$data[1]</td>";
    echo "<td align=center>$data[2]</td>";
    echo "<td align=center>$data[3]</td>";
    echo "<td align=center>$data[4]</td>";
    echo "<td align=center>$data[6]</td>";
    echo "<td align=center>$data[7]</td>";
    echo "<td align=center><img src='$data[9]' width='25px' height='40px'></td>";
    echo "<td align=center><img src='$data[10]' width='25px' height='40px'></td>";
    echo "<td align=center><span data-id='$data[0]' id='edit'>edit</span></td>";

    echo "</tr>";
}
echo "</table>";
?>