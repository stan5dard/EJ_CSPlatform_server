<?php
$conn = mysqli_connect('localhost','root','rootroot','ej_idea');
$userid = $_POST["USERID"];

$ideatitle = $_POST["IDEATITLE"];
$ideaex = $_POST["IDEAEX"];



$insert_idea_query = "INSERT INTO issue1_idea(IDEAID, USERID, IDEATITLE, IDEAEX, CREAT, LOGIC, REA) VALUES ($ideaid, $userid, $ideatitle, $ideaex, 0,0,0)";
$result = mysqli_query($conn, $insert_idea_query);
if($result){
    echo "SUCCESS/_/";
}
else{
    echo "ERROR/_/";
}

$conn2 = mysqli_connect('localhost', 'root', 'rootroot', 'ej_users');
$query2 = "SELECT USERID FROM issue1_idea WHERE USERID=$userid";
$result2 = mysqli_query($conn2, $query2);

$query3 = "SELECT IDEAID FROM"

$query4 = "INSERT INTO userevalcheck(USERID, IDEAID, CREAT, LOGIC, REA) VALUES ($userid)";
while ($row = mysqli_fetch_array($result2))
    {
        
    }
?>
