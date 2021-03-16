<?php
$userid = $_POST["USERID"];
$group = $_POST["GROUP"];

$conn_cond = mysqli_connect('localhost', 'root', '', 'db_common');
mysqli_query($conn_cond, "set session character_set_connection=utf8");
mysqli_query($conn_cond, "set session character_set_results=utf8");
mysqli_query($conn_cond, "set session character_set_client=utf8");

$query_cond = "SELECT COND FROM userinfo WHERE USERID=$userid";
$result_cond = mysqli_query($conn_cond, $query_cond);
$cond = mysqli_fetch_array($result_cond)[0];
$db_condition = "db_condition".$cond;

$query_issue = "SELECT ISSUENUM FROM userinfo WHERE USERID=$userid";
$result_issue = mysqli_query($conn_cond, $query_issue);
$issue = mysqli_fetch_array($result_issue)[0];
$target_table = "issue".$issue."_opinion";

$conn = mysqli_connect('localhost','root','', $db_condition);
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");

$query = "SELECT * FROM $target_table WHERE GRP=$group ORDER BY PK";
$result = mysqli_query($conn, $query);
if($result){
    while ($row = mysqli_fetch_array($result))
    {
        echo $row['PK']."/_/".$row['USERID']."/_/".$row['ISIDEATAG']."/_/".$row['TAGID']."/_/".$row['OPINIONEX']."/_/";
        echo "/__/";
    }
}
else{
    echo "ERROR/_/";
}
?>
