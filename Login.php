<?php
$conn = mysqli_connect('localhost','root','rootroot','ej_users');
$code = $_POST["CODE"];
$query = "SELECT * FROM userid WHERE CODE=$code";
$result = mysqli_query($conn, $query);
if($result){
    $row = mysqli_fetch_assoc($result);
    echo $row["USERID"]."/_/";
}
else{
    echo "ERROR/_/";
}
?>
