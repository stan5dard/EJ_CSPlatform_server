<?php
$userid = $_POST["USERID"];

$conn_cond = mysqli_connect('localhost', 'root', 'rootroot', 'db_common');
mysqli_query($conn_cond, "set session character_set_connection=utf8");
mysqli_query($conn_cond, "set session character_set_results=utf8");
mysqli_query($conn_cond, "set session character_set_client=utf8");
$query_cond = "SELECT * FROM userinfo WHERE USERID=$userid";
$result_cond = mysqli_query($conn_cond, $query_cond);
$row = mysqli_fetch_assoc($result_cond);
$year = $row['ENERGYSENDYEAR'];
$month = $row['ENERGYSENDMONTH'];
$day = $row['ENERGYSENDDATE'];

if(strlen((string)$month)==1){
    $month = "0".$month;
}
if(strlen((string)$day)==1){
    $day = "0".$day;
}
if($result_cond){
    if($year==0 & $month==0 & $day==0){
        echo "0/_/";
    }
    else{
        echo $year."/_/".$month."/_/".$day."/_/";
    }

}
else{
    echo "DATE ERROR/_/";
}
?>
