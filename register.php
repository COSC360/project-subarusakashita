<?php
include "dbconnect.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$phonenum = $_POST['phoneNum'];
$address = $_POST['address'];

$pdo = new PDO('mysql:host=localhost;dbname=mydb;charset=utf8', 'dbuser', 'P@ssw0rd');
$sql = "INSERT INTO Users(username, email, password, phoneNum) VALUES ($username, $email,
$password, $phonenum, $address)";
$qry = $pdo->prepare($sql);
$qry->execute();


?>