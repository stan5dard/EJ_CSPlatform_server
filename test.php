<?php
$conn2 = mysqli_connect('localhost', 'root', 'rootroot', 'ej_users');
$query2 = "SELECT USERID FROM userid";
$result2 = mysqli_query($conn2, $query2);
while ($row = mysqli_fetch_array($result2))
    {
        echo $row[0];
    }
?>
