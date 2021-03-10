<?php
$conn = mysqli_connect('localhost','root','','db_condition1');
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");
$userid = $_POST["USERID"];
$isideatag = $_POST["ISIDEATAG"];
$tagid = $_POST["TAGID"];
$opinionex = $_POST["OPINIONEX"];
$group = $_POST["GRP"];

$query_issue = "SELECT ISSUENUM FROM userinfo WHERE USERID=$userid";
$result_issue = mysqli_query($conn, $query_issue);
$issue = mysqli_fetch_array($result_issue)[0];
$target_table = "issue".$issue."_opinion";



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
$query_update = "UPDATE issuelist SET OPINIONNUM=$opinionnum WHERE PK=$issue";
$result_update = mysqli_query($conn, $query_update);

?>
