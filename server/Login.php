<?php
$code = $_POST["STUDENTID"];
//echo $code;
$conn = mysqli_connect('localhost','root','rootroot','db_common');
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");
$query_cond = "SELECT COND FROM userinfo WHERE STUDENTID='$code'";
$result_cond = mysqli_query($conn, $query_cond);
$cond = mysqli_fetch_array($result_cond)[0];
$query = "SELECT * FROM userinfo WHERE STUDENTID='$code'";
$result = mysqli_query($conn, $query);

if($result){
    $row = mysqli_fetch_assoc($result);
    if($row["ALLOW_CONNECTION"]==1){
        if($cond!=3){
            echo $row["USERID"]."/_/".$row["COND"]."/_/".$row["COND3_FIRSTLAUNCH"]."/_/";
        }
        else if($cond==3){
            $query_get_user_name = "SELECT USERNAME FROM userinfo WHERE STUDENTID=$code";
            $result_get_user_name = mysqli_query($conn, $query_get_user_name);
            $user_name = mysqli_fetch_row($result_get_user_name)[0];
            echo $row["USERID"]."/_/".$row["COND"]."/_/".$row["COND3_FIRSTLAUNCH"]."/_/".$user_name."/_/";
        }
    }
    else{
        echo "NOT ALLOWED/_/";
    }
}
else{
    echo "ERROR/_/";
}
?>
