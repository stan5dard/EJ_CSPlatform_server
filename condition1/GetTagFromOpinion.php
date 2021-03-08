<?php
$conn = mysqli_connect('localhost','root','rootroot','db_condition1');
$query_issue = "SELECT ISSUENUM FROM appinfo";
$result_issue = mysqli_query($conn, $query_issue);
$issue = mysqli_fetch_array($result_issue)[0];
$target_table = "issue".$issue."_opinion";

$opinion_pk = $_POST["PK"];

$query_user = "SELECT TAGID FROM $target_table WHERE PK=$opinion_pk";
$result_user = mysqli_query($conn, $query_user);
$user = mysqli_fetch_row($result_user)[0];
echo $user."/_/";
?>
