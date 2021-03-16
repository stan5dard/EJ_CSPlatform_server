<?php
$userid = $_POST["USERID"];
$ideaid = $_POST["IDEAID"];
$creat = $_POST["CREAT"];
$logic = $_POST["LOGIC"];
$real = $_POST["REAL"];

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
$target_table = "issue".$issue."_userevalcheck";

$conn = mysqli_connect('localhost','root','', $db_condition);
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");

$query = "UPDATE $target_table SET CRE=$creat, LGT=$logic, REA=$real WHERE USERID=$userid AND IDEAID=$ideaid";
$result = mysqli_query($conn, $query);

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

$query_update = "UPDATE $target_idea_table SET CRE=$cre, LGT=$lgt, REA=$rea WHERE PK=$ideaid";
$result_update = mysqli_query($conn, $query_update);
?>
