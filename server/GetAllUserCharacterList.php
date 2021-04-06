<?php
$userid = $_POST["USERID"];

$conn_cond = mysqli_connect('localhost', 'root', 'rootroot', 'db_common');
mysqli_query($conn_cond, "set session character_set_connection=utf8");
mysqli_query($conn_cond, "set session character_set_results=utf8");
mysqli_query($conn_cond, "set session character_set_client=utf8");
$query_cond = "SELECT * FROM userinfo WHERE USERID=$userid";
$result_cond = mysqli_query($conn_cond, $query_cond);
$row = mysqli_fetch_assoc($result_cond);
$cond = $row["COND"];
$issue = $row["ISSUENUM"];

$query_get_list = "SELECT * FROM userinfo WHERE COND=$cond AND ISSUENUM=$issue AND COND3_FIRSTLAUNCH=0";
$result_get_list = mysqli_query($conn_cond, $query_get_list);

if($result_get_list){
    while ($row = mysqli_fetch_array($result_get_list))
    {
        if($row['USERID']!=$userid){
            echo $row['USERID']."/_/".$row['USERNAME']."/_/".$row['IMAGEID']."/_/".$row['USERAGE']."/_/".$row['AFFILIATION']."/_/".$row['JOB']."/_/";
            echo "/__/";
        }
    }
}
else{
    echo "GET LIST ERROR/_/";
}
?>
