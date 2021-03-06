<?php
$conn = mysqli_connect('localhost','root','rootroot','ej_idea');
$query = "SELECT * FROM issue1_idea";
$result = mysqli_query($conn, $query);
if($result){
    while ($row = mysqli_fetch_array($result))
    {
        echo $row['IDEAID']."/_/".$row['USERID']."/_/".$row['IDEATITLE']."/_/".$row['IDEAEX']."/_/".$row['CREAT']."/_/".$row['LOGIC']."/_/".$row['REA']."/_/";
        echo "/__/";
    }
}
else{
    echo "ERROR/_/";
}
?>
