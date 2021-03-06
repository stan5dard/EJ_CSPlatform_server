<?php
$conn = mysqli_connect('localhost','root','rootroot','ej_issue');
$query = "SELECT * FROM issuelist";
$result = mysqli_query($conn, $query);
if($result){
    $row = mysqli_fetch_assoc($result);
    echo $row["PK"]."/_/".$row["ISSUETITLE"]."/_/".$row["ISSUEEX"]."/_/".$row["IDEANUM"]."/_/".$row["OPINIONNUM"]."/_/";
}
else{
    echo "ERROR/_/";
}
?>
