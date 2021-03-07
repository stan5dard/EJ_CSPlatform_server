<?php
$conn = mysqli_connect('localhost','root','','db_condition1');
$query_issue = "SELECT ISSUENUM FROM appinfo";
$result_issue = mysqli_query($conn, $query_issue);
$issue = mysqli_fetch_array($result_issue)[0];
$target_table = "issue".$issue."_idea";

$userid = $_GET["USERID"];
$ideatitle = $_GET["IDEATITLE"];
$ideaex = $_GET["IDEAEX"];

/*
$query_ideaid = "SELECT IDEAID FROM $target_table ORDER BY PK DESC LIMIT 1";
$result_ideaid = mysqli_query($conn, $query_ideaid);
$ideaid = mysqli_fetch_row($result_ideaid)[0] + 1;
*/

$insert_idea_query = "INSERT INTO $target_table(USERID, IDEATITLE, IDEAEX, CRE, LGT, REA) VALUES ($userid, $ideatitle, $ideaex, 0,0,0)";
$result = mysqli_query($conn, $insert_idea_query);
if($result){
    $ideaid = mysqli_insert_id($conn);
    echo "SUCCESS/_/";
}
else{
    echo "ERROR/_/";
}

$query_eval = "SELECT USERID FROM userinfo WHERE ISSUENUM=$issue";
$result_eval = mysqli_query($conn, $query_eval);
while ($row = mysqli_fetch_array($result_eval))
{
    $target_eval_table = "issue".$issue."_userevalcheck";
    $user = $row['USERID'];
    $query_insert = "INSERT INTO $target_eval_table(USERID, IDEAID, CRE, LGT, REA) VALUES ($user, $ideaid, 0,0,0)";
    $result_insert = mysqli_query($conn, $query_insert);
    if($result_insert){
        echo "SUCCESS/_/";
    }
    else{
        echo "ERROR/_/";
    }
}

$query_ideanum = "SELECT COUNT(*) FROM $target_table";
$result_ideanum = mysqli_query($conn, $query_ideanum);
$ideanum = mysqli_fetch_row($result_ideanum)[0];
$query_update = "UPDATE issuelist SET IDEANUM=$ideanum WHERE PK=$issue";
$result_update = mysqli_query($conn, $query_update);
?>
