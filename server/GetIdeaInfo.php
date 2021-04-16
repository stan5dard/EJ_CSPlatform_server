<?php
$userid = $_POST["USERID"];

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
$target_opinion_table = "issue".$issue."_opinion";

$conn = mysqli_connect('localhost','root','rootroot',$db_condition);
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");




$query_idea = "SELECT * FROM $target_table ORDER BY PK DESC";
$result = mysqli_query($conn, $query_idea);
if($result){
    if($cond!=3){
        while ($row = mysqli_fetch_array($result))
        {
            $ideaid = $row['PK'];
            $query_opinion_count = "SELECT COUNT(*) FROM $target_opinion_table WHERE GRP=$ideaid";
            $result_opinion_count = mysqli_query($conn, $query_opinion_count);
            $opinion_count = mysqli_fetch_row($result_opinion_count)[0];
            echo $row['PK']."/_/".$row['USERID']."/_/".$row['IDEATITLE']."/_/".$row['IDEAEX']."/_/".$row['CRE']."/_/".$row['LGT']."/_/".$row['REA']."/_/".$opinion_count."/_/";
            echo "/__/";
        }
    }
    else if($cond==3){
        while ($row = mysqli_fetch_array($result))
        {
            $ideawriter = $row['USERID'];
            $query_get_user_name = "SELECT USERNAME FROM userinfo WHERE USERID=$ideawriter";
            $result_get_user_name = mysqli_query($conn_cond, $query_get_user_name);
            $user_name = mysqli_fetch_row($result_get_user_name)[0];
            echo $row['PK']."/_/".$user_name."/_/".$row['IDEATITLE']."/_/".$row['IDEAEX']."/_/".$row['CRE']."/_/".$row['LGT']."/_/".$row['REA']."/_/".$opinion_count."/_/";
            echo "/__/";
        }
    }
}
else{
    echo "ERROR/_/";
}
?>