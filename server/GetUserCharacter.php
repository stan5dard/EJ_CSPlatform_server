<?php
$userid = $_POST["USERID"];

$conn_cond = mysqli_connect('localhost', 'root', 'rootroot', 'db_common');
mysqli_query($conn_cond, "set session character_set_connection=utf8");
mysqli_query($conn_cond, "set session character_set_results=utf8");
mysqli_query($conn_cond, "set session character_set_client=utf8");
$query_cond = "SELECT * FROM userinfo WHERE USERID=$userid";
$result_cond = mysqli_query($conn_cond, $query_cond);


if($result_cond){
    $row = mysqli_fetch_assoc($result_cond);
    echo $row["USERNAME"]."/_/".$row["IMAGEID"]."/_/".$row["USERAGE"]."/_/".$row["AFFILIATION"]."/_/".$row["JOB"]."/_/";
}
else{
    echo "ERROR/_/";
}
?>
