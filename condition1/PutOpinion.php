<?php
$userid = $_POST["USERID"];
$isideatag = $_POST["ISIDEATAG"];
$tagid = $_POST["TAGID"];
$opinionex = $_POST["OPINIONEX"];
$group = $_POST["GRP"];

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
$target_issuestat = "issue".$issue."_stat";

$conn = mysqli_connect('localhost','root','',$db_condition);
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");

$insert_opinion_query = "INSERT INTO $target_table(USERID, ISIDEATAG, TAGID, OPINIONEX, GRP) VALUES ($userid, $isideatag, $tagid, '$opinionex', $group)";
$result = mysqli_query($conn, $insert_opinion_query);
if($result){
    echo "opinion insertion".$opinionex."SUCCESS/_/";
}
else{
    echo "opinion insertion ".$opinionex."ERROR/_/";
}

$query_opinionnum = "SELECT COUNT(*) FROM $target_table";
$result_opinionnum = mysqli_query($conn, $query_opinionnum);
$opinionnum = mysqli_fetch_row($result_opinionnum)[0];
$query_update = "UPDATE $target_issuestat SET OPINIONNUM=$opinionnum";
$result_update = mysqli_query($conn, $query_update);

?>
