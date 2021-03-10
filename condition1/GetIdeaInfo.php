<?php
$conn = mysqli_connect('localhost','root','','db_condition1');
$userid = $_POST["USERID"];
$query_issue = "SELECT ISSUENUM FROM userinfo WHERE USERID=$userid";
$result_issue = mysqli_query($conn, $query_issue);
$issue = mysqli_fetch_array($result_issue)[0];
$target_table = "issue".$issue."_idea";

$query_idea = "SELECT * FROM $target_table";
$result = mysqli_query($conn, $query_idea);
if($result){
    while ($row = mysqli_fetch_array($result))
    {
        echo $row['PK']."/_/".$row['USERID']."/_/".$row['IDEATITLE']."/_/".$row['IDEAEX']."/_/".$row['CRE']."/_/".$row['LGT']."/_/".$row['REA']."/_/";
        echo "/__/";
    }
}
else{
    echo "ERROR/_/";
}
?>
