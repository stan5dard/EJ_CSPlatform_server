<?php
$conn = mysqli_connect('localhost','root','','db_condition1');
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");
$userid = $_POST["USERID"];
$ideaid = $_POST["IDEAID"];

$query_issue = "SELECT ISSUENUM FROM userinfo WHERE USERID=$userid";
$result_issue = mysqli_query($conn, $query_issue);
$issue = mysqli_fetch_array($result_issue)[0];
$target_table = "issue".$issue."_userevalcheck";
$query = "SELECT * FROM $target_table WHERE USERID=$userid AND IDEAID=$ideaid";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
if($result){
    echo $row["CRE"]."/_/".$row["LGT"]."/_/".$row["REA"]."/_/";
}
else{
    echo "ERROR/_/";
}
?>
