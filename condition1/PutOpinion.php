<?php
$conn = mysqli_connect('localhost','root','','db_condition1');
$query_issue = "SELECT ISSUENUM FROM appinfo";
$result_issue = mysqli_query($conn, $query_issue);
$issue = mysqli_fetch_array($result_issue)[0];
$target_table = "issue".$issue."_opinion";

$userid = $_POST["USERID"];
$tagid = $_POST["TAGID"];
$opinionex = $_POST["OPINIONEX"];
$group = $_POST["GRP"];

$insert_opinion_query = "INSERT INTO $target_table(USERID, TAGID, OPINIONEX, GRP) VALUES ($userid, $tagid, $opinionex, $group)";
$result = mysqli_query($conn, $insert_opinion_query);
if($result){
    echo "SUCCESS/_/";
}
else{
    echo "ERROR/_/";
}

$query_opinionnum = "SELECT COUNT(*) FROM $target_table";
$result_opinionnum = mysqli_query($conn, $query_opinionnum);
$opinionnum = mysqli_fetch_row($result_opinionnum)[0];
$query_update = "UPDATE issuelist SET OPINIONNUM=$opinionnum WHERE PK=$issue";
$result_update = mysqli_query($conn, $query_update);

?>
