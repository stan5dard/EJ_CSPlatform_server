<?php
$conn = mysqli_connect('localhost','root','','db_condition1');
$userid = $_GET["USERID"];
$ideaid = $_GET["IDEAID"];
$creat = $_GET["CREAT"];
$logic = $_GET["LOGIC"];
$real = $_GET["REAL"];
$query_issue = "SELECT ISSUENUM FROM userinfo WHERE USERID=$userid";
$result_issue = mysqli_query($conn, $query_issue);
$issue = mysqli_fetch_array($result_issue)[0];
$target_table = "issue".$issue."_userevalcheck";

$query = "UPDATE $target_table SET CRE=$creat, LGT=$logic, REA=$real WHERE USERID=$userid AND IDEAID=$ideaid";
$result = mysqli_query($conn, $query);
if($result){
    echo "SUCCESS/_/";
}
else{
    echo "ERROR/_/";
}

$target_idea_table = "issue".$issue."_idea";
$query_cre = "SELECT COUNT(CRE) FROM $target_table WHERE IDEAID=$ideaid AND CRE=1";
$result_cre = mysqli_query($conn, $query_cre);
$cre = mysqli_fetch_row($result_cre)[0];

$query_lgt = "SELECT COUNT(LGT) FROM $target_table WHERE IDEAID=$ideaid AND LGT=1";
$result_lgt = mysqli_query($conn, $query_lgt);
$lgt = mysqli_fetch_row($result_lgt)[0];

$query_rea = "SELECT COUNT(REA) FROM $target_table WHERE IDEAID=$ideaid AND REA=1";
$result_rea = mysqli_query($conn, $query_rea);
$rea = mysqli_fetch_row($result_rea)[0];

echo $cre.$lgt.$rea;

$query_update = "UPDATE $target_idea_table SET CRE=$cre, LGT=$lgt, REA=$rea WHERE PK=$ideaid";
$result_update = mysqli_query($conn, $query_update);
?>
