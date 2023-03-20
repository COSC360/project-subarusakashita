<?php
include "dbconnect.php";

// $username= $_POST['username'];
// $password= $_POST['password'];

$pdo = new PDO('mysql:host=cosc360.ok.ubc.ca;dbname=user;charset=utf8','83395822','83395822');
// $sql = "SELECT username, password FROM user WHERE username=?)";
$sql="SELECT username FROM user";
$sql->bindValue('i',$username);
//$qry = $pdo->prepare($sql);
$qry->execute();
$result = $stmt->get_result();
while ($row = mysql_fetch_assoc($result)) {
    print_r($row);
    
    // do stuff with $row
}
var user = "";
user=$row[0];
?>