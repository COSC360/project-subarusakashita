<?php
    // $dsn = 'mysql:host=localhost;dname=user;charset=utf8';
    // $user = 'subaru';
    // $pass = 'password';
    // $dbh = new PDO($dsn, $user, $pass);
    
    // var_dump($dbh);
    $servername = "localhost";
    $username = "subaru";
    $password = "password";
    $dbname = "user";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "SELECT * FROM user";
$result = $conn->query($sql);


$conn->close();

?>