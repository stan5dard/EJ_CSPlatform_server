<?php
$name = $_GET["NAME"];

$conn_cond = mysqli_connect('localhost', 'root', 'rootroot', 'db_common');
mysqli_query($conn_cond, "set session character_set_connection=utf8");
mysqli_query($conn_cond, "set session character_set_results=utf8");
mysqli_query($conn_cond, "set session character_set_client=utf8");
//echo $userid." ".$imageid." ".$name." ".$age." ".$affiliation." ".$job."/_/";
$query_username_alreadyexist = "SELECT * FROM userinfo WHERE USERNAME=$name";
$result_username_alreadyexist = mysqli_query($conn_cond, $query_username_alreadyexist);
$result = mysqli_fetch_array($result_username_alreadyexist);
if($result_username_alreadyexist->num_rows){
    echo "0/_/";
}
else{
    echo "1/_/";
}
?>