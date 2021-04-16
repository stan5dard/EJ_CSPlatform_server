<?php
$userid = $_POST["USERID"];
$logdate = $_POST["DATE"];
$logtimestamp = $_POST["TIMESTAMP"];
$logging = $_POST["LOGGING"];
$actionmeaning = $_POST["ACTIONMEANING"];
$logdata = $_POST["DATA"];

$conn = mysqli_connect('localhost', 'root', 'rootroot', 'db_log');
mysqli_query($conn, "set session character_set_connection=utf8");
mysqli_query($conn, "set session character_set_results=utf8");
mysqli_query($conn, "set session character_set_client=utf8");

$target_table = "log_".$userid;
$query_log = "INSERT INTO $target_table(LOGDATE, LOGTIMESTAMP, LOGGING, ACTIONMEANING, LOGDATA) VALUES ('$logdate', '$logtimestamp', '$logging', '$actionmeaning', '$logdata')";
$result_log = mysqli_query($conn, $query_log);

if($result_log){
    echo "SUCCESS/_/";
}
else{
    $query_create_table = "CREATE TABLE $target_table(PK INT NOT NULL AUTO_INCREMENT, LOGDATE VARCHAR(200) DEFAULT NULL, LOGTIMESTAMP VARCHAR(200) DEFAULT NULL, LOGGING VARCHAR(200) DEFAULT NULL, ACTIONMEANING VARCHAR(200) DEFAULT NULL, LOGDATA VARCHAR(200) DEFAULT NULL, PRIMARY KEY(PK)) DEFAULT CHARSET=utf8";
    mysqli_query($conn, $query_create_table);
    mysqli_query($conn, $query_log);
    echo "GENERATED TABLE/_/";
}
?>
