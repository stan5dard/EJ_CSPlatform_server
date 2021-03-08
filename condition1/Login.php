<?php
$conn = mysqli_connect('localhost','root','rootroot','db_condition1');
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
