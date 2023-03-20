<?php
include "dbconnect.php";

$username= $_POST['username'];
$password= $_POST['password'];

$pdo = new PDO('mysql:host=localhost;dbname=mydb;charset=utf8','dbuser','P@ssw0rd');
$sql = "SELECT username, password FROM user WHERE username=?, password=?)";
$sql->bindValue('ii',$username, $password);
//$qry = $pdo->prepare($sql);
$qry->execute();
$result = $stmt->get_result();

?>