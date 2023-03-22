<?php
// Start a session to store the username
session_start();

// Connect to the database
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$username = $_POST["username"];
$password = $_POST["password"];
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // Login successful
    $_SESSION["username"] = $username;
    header("Location: welcome.php");
    exit;
} else {
    // Login failed
    $error = "Invalid username or password";
}
mysqli_close($conn);
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
$user = "";
$user=$row[0];
?>
