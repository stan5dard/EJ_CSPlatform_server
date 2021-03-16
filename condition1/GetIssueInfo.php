<?php
$userid = $_POST["USERID"];

$conn_cond = mysqli_connect('localhost','root','','db_common');
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
$issue_table = "issue".$issue."_stat";

$conn = mysqli_connect('localhost', 'root', '', $db_condition);
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");

$query_issuestat = "SELECT * FROM $issue_table";
$result_issuestat = mysqli_query($conn, $query_issuestat);
$issuestat_row = mysqli_fetch_assoc($result_issuestat);
$ideanum = $issuestat_row["IDEANUM"];
$opinionnum = $issuestat_row["OPINIONNUM"];

$query = "SELECT * FROM issuelist WHERE PK=$issue";
$result = mysqli_query($conn_cond, $query);
if($result){
    $row = mysqli_fetch_assoc($result);
    echo $row["ISSUETITLE"]."/_/".$row["ISSUEEX"]."/_/".$ideanum."/_/".$opinionnum."/_/";
}
else{
    echo "ERROR/_/";
}
?>
