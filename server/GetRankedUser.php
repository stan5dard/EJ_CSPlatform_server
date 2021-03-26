<?php
$userid = $_POST["USERID"];

$conn_cond = mysqli_connect('localhost', 'root', 'rootroot', 'db_common');
mysqli_query($conn_cond, "set session character_set_connection=utf8");
mysqli_query($conn_cond, "set session character_set_results=utf8");
mysqli_query($conn_cond, "set session character_set_client=utf8");
$query_cond = "SELECT COND FROM userinfo WHERE USERID=$userid";
$query_issuenum = "SELECT ISSUENUM FROM userinfo WHERE USERID=$userid";
$result_cond = mysqli_query($conn_cond, $query_cond);
$cond = mysqli_fetch_row($result_cond)[0];
$result_issuenum = mysqli_query($conn_cond, $query_issuenum);
$issuenum = mysqli_fetch_row($result_issuenum)[0];

$query_rank = "SELECT * FROM userinfo WHERE COND=$cond AND ISSUENUM=$issuenum ORDER BY POINTS DESC";
$result_rank = mysqli_query($conn_cond, $query_rank);

if($result_rank){
    $iterator = 1;
    while($row = mysqli_fetch_array($result_rank)){
        echo $iterator."/_/".$row["USERID"]."/_/".$row["POINTS"]."/_/".$row["OPINIONKING"]."/_/".$row["OPINIONMAXLV"]."/_/".$row["IDEAKING"]."/_/".$row["IDEAMAXLV"]."/_/";
        $iterator = $iterator + 1;
        echo "/__/";
    }
}
else{
    echo "ERROR/_/";
}
?>
