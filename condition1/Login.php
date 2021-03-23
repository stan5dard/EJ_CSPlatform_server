<?php
$code = $_POST["STUDENTID"];

$conn = mysqli_connect('localhost','root','rootroot','db_common');
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");

$query = "SELECT * FROM userinfo WHERE STUDENTID=$code";
$result = mysqli_query($conn, $query);
if($result){
    $row = mysqli_fetch_assoc($result);
    echo $row["USERID"]."/_/".$row["USERID"]."/_/"; //logging twice for error detection in frontend
}
else{
    echo "ERROR/_/";
}
?>
