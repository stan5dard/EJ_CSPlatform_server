<?php
$conn = mysqli_connect('localhost','root','','db_condition1');
$query_issue = "SELECT ISSUENUM FROM appinfo";
$result_issue = mysqli_query($conn, $query_issue);
$issue = mysqli_fetch_array($result_issue)[0];
$target_table = "issue".$issue."_idea";

$idea_pk = $_POST["PK"];

$query_user = "SELECT userid FROM $target_table WHERE PK=$idea_pk";
$result_user = mysqli_query($conn, $query_user);
if($result_user){
    $user = mysqli_fetch_row($result_user)[0];
    echo $user."/_/";
}
else{
    echo "ERROR/_/";
}

?>