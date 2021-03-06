<?php
$time = strtotime('2021-02-25 00:00:00');

$conn = mysqli_connect('localhost','root','rootroot','ej_time');

$humantime = Days($time);
$query1 = "UPDATE timepassed SET DATE=$humantime WHERE PK=1";
$result1 = mysqli_query($conn, $query1);
$query2 = "SELECT * FROM timepassed";
$result2 = mysqli_query($conn, $query2);
$row = mysqli_fetch_assoc($result2);
echo $row["PROJECTNUM"]."/_/".$row["DATE"]."/_/";

function Days ($time)
{
    $time = time() - $time;
    $time = ($time<1)? 1 : $time;
    $numberOfdate = ceil($time / 86400);
    return $numberOfdate;
}
?>
