<?php
$userid = $_POST["USERID"];

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
$target_table = "issue".$issue."_idea";

$conn = mysqli_connect('localhost','root','',$db_condition);
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");

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