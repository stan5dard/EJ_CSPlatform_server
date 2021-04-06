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
    echo $row["CUR_CREATIVITY"]."/_/".$row["ACC_CREATIVITY"]."/_/".$row["CUR_COMMUNICATION"]."/_/".$row["ACC_COMMUNICATION"]."/_/".$row["CUR_COOPERATION"]."/_/".$row["ACC_COOPERATION"]."/_/".$row["CUR_PROBLEMSOLVING"]."/_/".$row["ACC_PROBLEMSOLVING"]."/_/";
}
else{
    echo "ERROR/_/";
}
?>
