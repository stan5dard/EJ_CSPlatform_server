<?php
$userid = $_GET["USERID"];
$ideaid = $_GET["IDEAID"];
$creat = $_GET["CREAT"];
$logic = $_GET["LOGIC"];
$real = $_GET["REAL"];

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
$target_table = "issue".$issue."_userevalcheck";
$target_idea_table = "issue".$issue."_idea";

$conn = mysqli_connect('localhost','root','rootroot', $db_condition);
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");



//condition 2 point calculation
if($cond==2){
    $query_prev_eval = "SELECT * FROM $target_table WHERE USERID=$userid AND IDEAID=$ideaid";
    $result_prev_eval = mysqli_query($conn, $query_prev_eval);
    $row = mysqli_fetch_assoc($result_prev_eval);
    $prev_cre = $row["CRE"];
    $prev_lgt = $row["LGT"];
    $prev_rea = $row["REA"];
    $prev_evaluated = $row["HAS_EVALUATED"];

    if($prev_cre==0 & $prev_lgt==0 & $prev_rea==0 & ($creat!=0 | $logic!=0 | $real!=0)){
        $query_increase_points = "UPDATE userinfo SET POINTS=POINTS+5 WHERE USERID=$userid";
        mysqli_query($conn_cond, $query_increase_points);
    }
    else if(($prev_cre!=0 | $prev_lgt!=0 | $prev_rea!=0) & $creat==0 & $logic==0 & $real==0){
        $query_decrease_points = "UPDATE userinfo SET POINTS=POINTS-5 WHERE USERID=$userid";
        mysqli_query($conn_cond, $query_decrease_points);
    }
}

$query = "UPDATE $target_table SET CRE=$creat, LGT=$logic, REA=$real, HAS_EVALUATED=1 WHERE USERID=$userid AND IDEAID=$ideaid";
$result = mysqli_query($conn, $query);


if($cond==2){
    // check whether there's a user who got idea max level
    $query_get_idea_writer = "SELECT USERID FROM $target_idea_table WHERE PK=$ideaid";
    $result_get_idea_writer = mysqli_query($conn, $query_get_idea_writer);
    $ideawriter = mysqli_fetch_array($result_get_idea_writer)[0];

    $query_ideawriter_ideanum = "SELECT IDEANUM FROM userinfo WHERE USERID=$ideawriter";
    $result_ideawriter_ideanum = mysqli_query($conn_cond, $query_ideawriter_ideanum);
    $ideawriter_ideanum = mysqli_fetch_array($result_ideawriter_ideanum)[0];

    /*
    $query_get_cre_for_idea = "SELECT COUNT(*) FROM $target_table WHERE IDEAID=$ideaid AND CRE=1";
    $idea_cre = mysqli_fetch_array(mysqli_query($conn, $query_get_cre_for_idea))[0];
    $query_get_lgt_for_idea = "SELECT COUNT(*) FROM $target_table WHERE IDEAID=$ideaid AND LGT=1";
    $idea_lgt = mysqli_fetch_array(mysqli_query($conn, $query_get_lgt_for_idea))[0];
    $query_get_rea_for_idea = "SELECT COUNT(*) FROM $target_table WHERE IDEAID=$ideaid AND REA=1";
    $idea_rea = mysqli_fetch_array(mysqli_query($conn, $query_get_rea_for_idea))[0];
    */
    $query_get_cre_for_idea = "SELECT CRE FROM $target_idea_table WHERE USERID=$ideawriter";
    $idea_cre = mysqli_fetch_array(mysqli_query($conn, $query_get_cre_for_idea))[0];
    $query_get_lgt_for_idea = "SELECT LGT FROM $target_idea_table WHERE USERID=$ideawriter";
    $idea_lgt = mysqli_fetch_array(mysqli_query($conn, $query_get_lgt_for_idea))[0];
    $query_get_rea_for_idea = "SELECT REA FROM $target_idea_table WHERE USERID=$ideawriter";
    $idea_rea = mysqli_fetch_array(mysqli_query($conn, $query_get_rea_for_idea))[0];

    $query_get_eff_for_idea = "SELECT IS_EFFECTIVE FROM $target_idea_table WHERE USERID=$ideawriter";
    $eff = mysqli_fetch_array(mysqli_query($conn, $query_get_eff_for_idea))[0];
    echo $idea_cre.$idea_lgt.$idea_rea.$eff;

    if($idea_cre >= 5 & $idea_lgt >= 5 & $idea_rea >= 5 & $eff == 0){
        $query_set_eff = "UPDATE $target_idea_table SET IS_EFFECTIVE=1 WHERE PK=$ideaid";
        mysqli_query($conn, $query_set_eff);
        $query_increase_eff_idea = "UPDATE userinfo SET EFFECTIVE_IDEANUM=EFFECTIVE_IDEANUM+1 WHERE USERID=$ideawriter";
        //$query_set_ideamaxlv = "UPDATE userinfo SET IDEAMAXLV=1 WHERE USERID=$ideawriter";
        mysqli_query($conn_cond, $query_increase_eff_idea);
        //mysqli_query($conn_cond, $query_set_ideamaxlv);
    }
    else if(($idea_cre < 5 | $idea_lgt < 5 | $idea_rea < 5) & $eff == 1){
        $query_set_eff = "UPDATE $target_idea_table SET IS_EFFECTIVE=0 WHERE PK=$ideaid";
        mysqli_query($conn, $query_set_eff);
        $query_increase_eff_idea = "UPDATE userinfo SET EFFECTIVE_IDEANUM=EFFECTIVE_IDEANUM-1 WHERE USERID=$ideawriter";
        //$query_set_ideamaxlv = "UPDATE userinfo SET IDEAMAXLV=0 WHERE USERID=$ideawriter";
        mysqli_query($conn_cond, $query_increase_eff_idea);
        //mysqli_query($conn_cond, $query_set_ideamaxlv);
    }

    $query_get_eff_idea_num = "SELECT EFFECTIVE_IDEANUM FROM userinfo WHERE USERID=$ideawriter";
    $result_eff_idea_num = mysqli_query($conn_cond, $query_get_eff_idea_num);
    $eff_idea_num = mysqli_fetch_array($result_eff_idea_num)[0];
    if($eff >= 2){
        $query_set_ideamaxlv = "UPDATE userinfo SET IDEAMAXLV=1 WHERE USERID=$ideawriter";
        mysqli_query($conn_cond, $query_set_ideamaxlv);
    }
    else if($eff < 2){
        $query_set_ideamaxlv = "UPDATE userinfo SET IDEAMAXLV=0 WHERE USERID=$ideawriter";
        mysqli_query($conn_cond, $query_set_ideamaxlv);
    }
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

$query_update = "UPDATE $target_idea_table SET CRE=$cre, LGT=$lgt, REA=$rea WHERE PK=$ideaid";
$result_update = mysqli_query($conn, $query_update);
?>
