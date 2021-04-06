<?php
$userid = $_POST["USERID"];

$conn_cond = mysqli_connect('localhost', 'root', 'rootroot', 'db_common');
mysqli_query($conn_cond, "set session character_set_connection=utf8");
mysqli_query($conn_cond, "set session character_set_results=utf8");
mysqli_query($conn_cond, "set session character_set_client=utf8");
$query_cond = "SELECT * FROM userinfo WHERE USERID=$userid";
$result_cond = mysqli_query($conn_cond, $query_cond);
$row = mysqli_fetch_assoc($result_cond);
$creativity = $row['CUR_CREATIVITY'];
$communication = $row['CUR_COMMUNICATION'];
$cooperation = $row['CUR_COOPERATION'];
$problemsolving = $row['CUR_PROBLEMSOLVING'];

$minimum = min($creativity, $communication, $cooperation, $problemsolving);
if($minimum > 0){
    $query_generate = "UPDATE userinfo SET CUR_CREATIVITY=CUR_CREATIVITY-1, CUR_COMMUNICATION=CUR_COMMUNICATION-1, CUR_COOPERATION=CUR_COOPERATION-1, CUR_PROBLEMSOLVING=CUR_PROBLEMSOLVING-1 WHERE USERID=$userid";
    mysqli_query($conn_cond, $query_generate);
    $query_increase = "UPDATE userinfo SET AVAILABLEENERGY=AVAILABLEENERGY+1 WHERE USERID=$userid";
    mysqli_query($conn_cond, $query_increase);
}
?>
