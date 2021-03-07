<?php
$conn = mysqli_connect('localhost','root','rootroot','ej_users');
$userid = $_POST["USERID"];
$ideaid = $_POST["IDEAID"];
$query = "SELECT * FROM userevalcheck WHERE USERID=$userid AND IDEAID=$ideaid";
$result = mysqli_query($conn, $query);
if($result){
    $row = mysqli_fetch_assoc($result);
    echo $row["CRE"]."/_/"["LOG"]."/_/"["REA"]."/_/";
}
else{
    echo "ERROR/_/";
}
?>
