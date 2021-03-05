<?php
$conn = mysqli_connect('localhost','root','rootroot','ej_opinion');
$group = $_POST["GROUP"];
$query = "SELECT * FROM issue1_opinion WHERE GROUP=$group ORDER BY OPINIONID";
$result = mysqli_query($conn, $query);
if($result){
    while ($row = mysqli_fetch_array($result))
    {
        echo $row['OPINIONID']."/_/".$row['USERID']."/_/".$row['TAGID']."/_/".$row['OPINIONEX']."/_/";
        echo "/__/";
    }
}
else{
    echo "ERROR/_/";
}
?>
