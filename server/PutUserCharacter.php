<?php
$userid = $_POST["USERID"];
$imageid = $_POST["IMAGEID"];
$name = $_POST["NAME"];
$age = $_POST["AGE"];
$affiliation = $_POST["AFFILIATION"];
$job = $_POST["JOB"];

$conn_cond = mysqli_connect('localhost', 'root', 'rootroot', 'db_common');
mysqli_query($conn_cond, "set session character_set_connection=utf8");
mysqli_query($conn_cond, "set session character_set_results=utf8");
mysqli_query($conn_cond, "set session character_set_client=utf8");
echo $userid." ".$imageid." ".$name." ".$age." ".$affiliation." ".$job."/_/";
$query_cond = "UPDATE userinfo SET IMAGEID=$imageid, USERNAME=$name, USERAGE=$age, AFFILIATION=$affiliation, JOB=$job WHERE USERID=$userid";
$result_cond = mysqli_query($conn_cond, $query_cond);

if($result_cond){
    $query_firstlaunch = "UPDATE userinfo SET COND3_FIRSTLAUNCH=0 WHERE USERID=$userid";
    mysqli_query($conn_cond, $query_firstlaunch);
    echo "USER CHARACTER UPDATE SUCCESS/_/";
}
else{
    echo mysqli_error($conn_cond)."/_/";
}

?>
