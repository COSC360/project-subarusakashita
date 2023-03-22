<?php
// Start a session to store the username
session_start();

// Connect to the database
$servername = "cosc360.ok.ubc.ca";
$server_username = "83395822";
$server_password = "83395822";
$dbname = "db_83395822";

$conn = mysqli_connect($servername, $server_username, $server_password, $dbname);
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