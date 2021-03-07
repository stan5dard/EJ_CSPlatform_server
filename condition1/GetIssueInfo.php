<?php
$conn = mysqli_connect('localhost','root','','db_condition1');
$query_issue = "SELECT ISSUENUM FROM appinfo";
$result_issue = mysqli_query($conn, $query_issue);
$issue = mysqli_fetch_array($result_issue)[0];

$query = "SELECT * FROM issuelist WHERE PK=$issue";
$result = mysqli_query($conn, $query);
if($result){
    $row = mysqli_fetch_assoc($result);
    echo $row["ISSUETITLE"]."/_/".$row["ISSUEEX"]."/_/".$row["IDEANUM"]."/_/".$row["OPINIONNUM"]."/_/";
}
else{
    echo "ERROR/_/";
}
?>
