<?php
$userid = $_POST["USERID"];

$conn_cond = mysqli_connect('localhost', 'root', 'rootroot', 'db_common');
mysqli_query($conn_cond, "set session character_set_connection=utf8");
mysqli_query($conn_cond, "set session character_set_results=utf8");
mysqli_query($conn_cond, "set session character_set_client=utf8");
$query_cond = "SELECT * FROM userinfo ORDER BY POINTS ASC";
$result_cond = mysqli_query($conn_cond, $query_cond);

if($result_cond){
    $iterator = 1;
    while($row = mysqli_fetch_array($result_cond)){
        echo $iterator."/_/".$row["USERID"]."/_/".$row["POINTS"]."/_/".$row["OPINIONKING"]."/_/".$row["OPINIONMAXLV"]."/_/".$row["IDEAKING"]."/_/".$row["IDEAMAXLV"]."/_/";
        $iterator = $iterator + 1;
        echo "/__/";
    }
}
else{
    echo "ERROR/_/";
}
?>
