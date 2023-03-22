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
    header("Location: main.php");
    exit;
} else {
    // Login failed
    $error = "Invalid username or password";
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Validation</title>
</head>
<body>
    <h1>Login Check</h1>
    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
</body>
</html>