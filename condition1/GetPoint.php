<?php
$userid = $_POST["USERID"];

$conn_cond = mysqli_connect('localhost', 'root', 'rootroot', 'db_common');
mysqli_query($conn_cond, "set session character_set_connection=utf8");
mysqli_query($conn_cond, "set session character_set_results=utf8");
mysqli_query($conn_cond, "set session character_set_client=utf8");
$query_cond = "SELECT POINTS FROM userinfo WHERE USERID=$userid";
$result_cond = mysqli_query($conn_cond, $query_cond);
$points = mysqli_fetch_array($result_cond)[0];

if($result){
    echo $points."/_/";
}
else{
    echo "ERROR/_/";
}
?>
