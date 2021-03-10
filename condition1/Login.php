<?php
$conn = mysqli_connect('localhost','root','','db_condition1');
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");
$code = $_POST["STUDENTID"];
$query = "SELECT * FROM userinfo WHERE STUDENTID=$code";
$result = mysqli_query($conn, $query);
if($result){
    $row = mysqli_fetch_assoc($result);
    echo $row["USERID"]."/_/";
}
else{
    echo "ERROR/_/";
}
?>
