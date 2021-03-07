<?php
$conn = mysqli_connect('localhost', 'root', '', 'db_condition1');

$query_date = "SELECT STARTDATE FROM appinfo";
$result_date = mysqli_query($conn, $query_date);
$date = mysqli_fetch_row($result_date)[0];

$time = strtotime($date);

$days = Days($time);
$query_update = "UPDATE appinfo SET PASSEDDAYS=$days WHERE PK=1";
$result_update = mysqli_query($conn, $query_update);

$query_passeddays = "SELECT * FROM appinfo";
$result_passeddays = mysqli_query($conn, $query_passeddays);
$row = mysqli_fetch_assoc($result_passeddays);
echo $row["PROJECTNUM"]."/_/".$row["PASSEDDAYS"]."/_/";

function Days ($time)
{
    $time = time() - $time;
    $time = ($time<1)? 1 : $time;
    $numberOfdate = ceil($time / 86400);
    return $numberOfdate;
}
?>
