<?php
$userid = $_POST["USERID"];
$ideatitle = $_POST["IDEATITLE"];
$ideaex = $_POST["IDEAEX"];

$conn_cond = mysqli_connect('localhost', 'root', 'rootroot', 'db_common');
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

$conn = mysqli_connect('localhost','root','rootroot',$db_condition);
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");


// new idea insertion part
$insert_idea_query = "INSERT INTO $target_table(USERID, IDEATITLE, IDEAEX, CRE, LGT, REA, IS_EFFECTIVE) VALUES ('$userid', '$ideatitle', '$ideaex', 0,0,0,0)";
$result = mysqli_query($conn, $insert_idea_query);
if($result){
    echo "idea insertion SUCCESS/_/";

    // calculating idea points if condition2
    if($cond==2){
        $query_point = "UPDATE userscore_condition2 SET POINTS=POINTS+50 WHERE USERID=$userid";
        $result_point = mysqli_query($conn_cond, $query_point);

        $query_idea_num = "SELECT COUNT(*) FROM $target_table WHERE USERID=$userid";
        $result_idea_num = mysqli_query($conn, $query_idea_num);
        $idea_num = mysqli_fetch_array($result_idea_num)[0];

        $query_update_ideanum = "UPDATE userscore_condition2 SET IDEANUM=$idea_num WHERE USERID=$userid";
        mysqli_query($conn_cond, $query_update_ideanum);
        if($idea_num >= 3){
            $query_idea_king = "UPDATE userscore_condition2 SET IDEAKING=1 WHERE USERID=$userid";
            mysqli_query($conn_cond, $query_idea_king);
        }
    }
}
else{
    echo "idea insertion ERROR/_/";
}


// user eval check table part
$ideaid = mysqli_insert_id($conn);
$query_eval = "SELECT USERID FROM userinfo WHERE ISSUENUM=$issue AND COND=$cond";
$result_eval = mysqli_query($conn_cond, $query_eval);
while ($row = mysqli_fetch_array($result_eval))
{
    $target_eval_table = "issue".$issue."_userevalcheck";
    $user = $row['USERID'];
    $query_insert = "INSERT INTO $target_eval_table(USERID, IDEAID, CRE, LGT, REA, HAS_EVALUATED) VALUES ($user, $ideaid, 0,0,0,0)";
    $result_insert = mysqli_query($conn, $query_insert);
    if($result_insert){
        echo "evaluation table SUCCESS/_/";
    }
    else{
        echo "evaluation table ERROR/_/";
    }
}


// calculating number of idea
$query_ideanum = "SELECT COUNT(*) FROM $target_table";
$result_ideanum = mysqli_query($conn, $query_ideanum);
$ideanum = mysqli_fetch_row($result_ideanum)[0];
$query_update = "UPDATE $target_issuestat SET IDEANUM=$ideanum";
$result_update = mysqli_query($conn, $query_update);



?>
