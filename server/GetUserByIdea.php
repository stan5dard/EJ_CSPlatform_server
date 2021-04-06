<?php
$userid = $_POST["USERID"];
$idea_pk = $_POST["PK"];

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

$conn = mysqli_connect('localhost','root','rootroot', $db_condition);
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");

$query_user = "SELECT USERID FROM $target_table WHERE PK=$idea_pk";
$result_user = mysqli_query($conn, $query_user);
$user = mysqli_fetch_row($result_user)[0];

$query_user_name = "SELECT USERNAME FROM userinfo WHERE USERID=$user";
$result_user_name = mysqli_query($conn_cond, $query_user_name);
$user_name = mysqli_fetch_row($result_user_name)[0];
if($result_user){
    if($cond!=3){
        echo $user."/_/";
    }
    else if($cond==3){
        echo $user_name."/_/";
    }    
}
else{
    echo "ERROR/_/";
}

?>
