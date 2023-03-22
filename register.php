<?php

$servername = "cosc360.ok.ubc.ca";
$username = "83395822";
$password = "83395822";
$dbname = "db_83395822";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$phonenum = $_POST['phoneNum'];
$address = $_POST['address'];

$sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    
if (mysqli_num_rows($result) > 0) {
        // Username already exists, display error message
        $error = "Username already exists";
}
else{
    $sql = "INSERT INTO Users(username, email, password, phoneNum) VALUES ($username, $email,$password, $phonenum, $address)";
        if (mysqli_query($conn, $sql)) {
            // Account created successfully, redirect to login page
            header("Location: login.php");
            exit;
        }
        else{
            $error = "Account creation failed";
        }
}
// $pdo = new PDO('mysql:host=localhost;dbname=mydb;charset=utf8', 'dbuser', 'P@ssw0rd');
// $sql = "INSERT INTO Users(username, email, password, phoneNum) VALUES ($username, $email,
// $password, $phonenum, $address)";
// $qry = $pdo->prepare($sql);
// $qry->execute();
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Account Validation</title>
</head>
<body>
    <h1>Create Account Validation Check...</h1>
    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
</body>
</html>