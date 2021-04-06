<?php
$userid = $_POST["USERID"];

$conn_cond = mysqli_connect('localhost', 'root', 'rootroot', 'db_common');
mysqli_query($conn_cond, "set session character_set_connection=utf8");
mysqli_query($conn_cond, "set session character_set_results=utf8");
mysqli_query($conn_cond, "set session character_set_client=utf8");
$query_transfer = "UPDATE userinfo SET AVAILABLEENERGY=0 WHERE USERID=$userid";
$result_transfer = mysqli_query($conn_cond, $query_transfer);
if($result_transfer){
    echo "SUCCESS/_/";
}
else{
    echo "FAIL/_/";
}

$year = date("Y");
$month = date("m");
$day = date("d");

$query_updatetime = "UPDATE userinfo SET ENERGYSENDYEAR=$year, ENERGYSENDMONTH=$month, ENERGYSENDDATE=$day WHERE USERID=$userid";
mysqli_query($conn_cond, $query_updatetime);
?>