<?php
$userid = $_POST["USERID"];
$isideatag = $_POST["ISIDEATAG"];
$tagid = $_POST["TAGID"];
$opinionex = $_POST["OPINIONEX"];
$group = $_POST["GRP"];

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
$target_table = "issue".$issue."_opinion";
$target_issuestat = "issue".$issue."_stat";

$conn = mysqli_connect('localhost','root','rootroot',$db_condition);
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");

// insert opinion to the table
$insert_opinion_query = "INSERT INTO $target_table(USERID, ISIDEATAG, TAGID, OPINIONEX, GRP) VALUES ($userid, $isideatag, $tagid, '$opinionex', $group)";
$result = mysqli_query($conn, $insert_opinion_query);
if($result){
    echo "opinion insertion".$opinionex."SUCCESS/_/";
    
    // if condition2, calculate the user score
    if($cond==2){
        $query_point = "UPDATE userinfo SET POINTS=POINTS+20 WHERE USERID=$userid";
        $result_point = mysqli_query($conn_cond, $query_point);

        // calculate whether the person got opinion_king badge
        $query_opinion_num = "SELECT COUNT(*) FROM $target_table WHERE USERID=$userid";
        $result_opinion_num = mysqli_query($conn, $query_opinion_num);
        $opinion_num = mysqli_fetch_array($result_opinion_num)[0];
        if($opinion_num >= 10 & $opinion_num < 20){
            $query_opinion_king = "UPDATE userinfo SET OPINIONKING=1 WHERE USERID=$userid";
            mysqli_query($conn_cond, $query_opinion_king);
        }
        else if($opinion_num >= 20){
            $query_opinion_maxlv = "UPDATE userinfo SET OPINIONMAXLV=1 WHERE USERID=$userid";
            mysqli_query($conn_cond, $query_opinion_maxlv);
        }
    }
}
else{
    echo "opinion insertion ".$opinionex."ERROR/_/";
}

// get the number of opinion
$query_opinionnum = "SELECT COUNT(*) FROM $target_table";
$result_opinionnum = mysqli_query($conn, $query_opinionnum);
$opinionnum = mysqli_fetch_row($result_opinionnum)[0];
$query_update = "UPDATE $target_issuestat SET OPINIONNUM=$opinionnum";
$result_update = mysqli_query($conn, $query_update);
?>
