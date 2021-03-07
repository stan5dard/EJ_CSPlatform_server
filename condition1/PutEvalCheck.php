<?php
$conn = mysqli_connect('localhost','root','rootroot','ej_users');
$userid = $_POST["USERID"];
$ideaid = $_POST["IDEAID"];
$creat = $_POST["CREAT"];
$logic = $_POST["LOGIC"];
$real = $_POST["REAL"];

$query = "UPDATE userevalcheck SET CRE=$creat, LGT=$logic, REA=$real WHERE USERID=$userid AND IDEAID=$ideaid";
$result = mysqli_query($conn, $query);
if($result){
    echo "SUCCESS/_/";
}
else{
    echo "ERROR/_/";
}
?>
