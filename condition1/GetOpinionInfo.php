<?php
$conn = mysqli_connect('localhost','root','rootroot','db_condition1');
$query_issue = "SELECT ISSUENUM FROM appinfo";
$result_issue = mysqli_query($conn, $query_issue);
$issue = mysqli_fetch_array($result_issue)[0];
$target_table = "issue".$issue."_opinion";

$group = $_POST["GROUP"];

$query = "SELECT * FROM $target_table WHERE GRP=$group ORDER BY PK";
$result = mysqli_query($conn, $query);
if($result){
    while ($row = mysqli_fetch_array($result))
    {
        echo $row['PK']."/_/".$row['USERID']."/_/".$row['TAGID']."/_/".$row['OPINIONEX']."/_/";
        echo "/__/";
    }
}
else{
    echo "ERROR/_/";
}
?>
