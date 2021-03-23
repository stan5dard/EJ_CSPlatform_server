<?php
$conn = mysqli_connect('localhost', 'root', 'rootroot', 'db_common');
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");

$query_date = "SELECT STARTDATE FROM appinfo";
$result_date = mysqli_query($conn, $query_date);
$date = mysqli_fetch_row($result_date)[0];

$time = strtotime($date);

$days = Days($time);
$query_update = "UPDATE appinfo SET PASSEDDAYS=$days";
$result_update = mysqli_query($conn, $query_update);

$query_passeddays = "SELECT * FROM appinfo";
$result_passeddays = mysqli_query($conn, $query_passeddays);
$row = mysqli_fetch_assoc($result_passeddays);
$nth_project = nthproject_kr($row["PROJECTNUM"]);
echo $nth_project."/_/".$row["PASSEDDAYS"]."/_/";

function Days ($time)
{
    $time = time() - $time;
    $time = ($time<1)? 1 : $time;
    $numberOfdate = ceil($time / 86400);
    return $numberOfdate;
}


function nthproject_kr($nth){
    if($nth==1){
        return "첫 번째";
    }
    else if($nth==2){
        return "두 번째";
    }
    else{
        return "세 번째";
    }
}
?>
