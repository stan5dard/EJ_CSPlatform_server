<?php
$conn = mysqli_connect('localhost','root','','db_condition1');
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");
$userid = $_POST["USERID"];
$opinion_pk = $_POST["PK"];

$query_issue = "SELECT ISSUENUM FROM userinfo WHERE USERID=$userid";
$result_issue = mysqli_query($conn, $query_issue);
$issue = mysqli_fetch_array($result_issue)[0];
$target_table = "issue".$issue."_opinion";

$query_user = "SELECT USERID FROM $target_table WHERE PK=$opinion_pk";
$result_user = mysqli_query($conn, $query_user);
$user = mysqli_fetch_row($result_user)[0];
echo $user."/_/";
?>
