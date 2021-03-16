<?php
$userid = $_POST["USERID"];
$ideatitle = $_POST["IDEATITLE"];
$ideaex = $_POST["IDEAEX"];

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
$target_issuestat = "issue".$issue."_stat";

$conn = mysqli_connect('localhost','root','',$db_condition);
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");


$insert_idea_query = "INSERT INTO $target_table(USERID, IDEATITLE, IDEAEX, CRE, LGT, REA) VALUES ('$userid', '$ideatitle', '$ideaex', 0,0,0)";
$result = mysqli_query($conn, $insert_idea_query);
if($result){
    echo "idea insertion SUCCESS/_/";
}
else{
    echo "idea insertion ERROR/_/";
}
$ideaid = mysqli_insert_id($conn);
$query_eval = "SELECT USERID FROM userinfo WHERE ISSUENUM=$issue AND COND=$cond";
$result_eval = mysqli_query($conn_cond, $query_eval);
while ($row = mysqli_fetch_array($result_eval))
{
    $target_eval_table = "issue".$issue."_userevalcheck";
    $user = $row['USERID'];
    $query_insert = "INSERT INTO $target_eval_table(USERID, IDEAID, CRE, LGT, REA) VALUES ($user, $ideaid, 0,0,0)";
    $result_insert = mysqli_query($conn, $query_insert);
    if($result_insert){
        echo "evaluation table SUCCESS/_/";
    }
    else{
        echo "evaluation table ERROR/_/";
    }
}

$query_ideanum = "SELECT COUNT(*) FROM $target_table";
$result_ideanum = mysqli_query($conn, $query_ideanum);
$ideanum = mysqli_fetch_row($result_ideanum)[0];
$query_update = "UPDATE $target_issuestat SET IDEANUM=$ideanum";
$result_update = mysqli_query($conn, $query_update);
?>
