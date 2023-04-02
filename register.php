<?php

$servername = "cosc360.ok.ubc.ca";
$server_username = "83395822";
$server_password = "83395822";
$dbname = "db_83395822";

$conn = mysqli_connect($servername, $server_username, $server_password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['rUsername'])) {
    $username = $_POST['rUsername'];
    $email = $_POST['rEmail'];
    $password = $_POST['rPassword'];
    $password_conf = $_POST['password_conf'];
} else {
    echo "Username is not loaded. Try again.";
}

//Validate password and confirmation password
if ($password !== $password_conf) {
    // Passwords don't match, display error message
    $error = "Password and password confirmation do not match";
}

//Validate User
else {

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);


    if (mysqli_num_rows($result) > 0) {
        // Username already exists, display error message
        $error = "Username already exists. Num of rows: " . mysqli_num_rows($result) . " Username: " . $username;
    }
    //Uploading to DB
    else {

        // insert new user info
        $sql1 = "INSERT INTO users(username, email, passwords) VALUES ('$username','$email','$password')";
        if (mysqli_query($conn, $sql1)) {
            // Account created successfully, redirect to login page
            echo '<script>alert("Account created👍");</script>';
            // header("Location: login.php");
            // exit;
        } else {
            $error = "Account creation failed";
        }


        echo $_FILES['userImage']['name'];

        if (
            getimagesize($_FILES['userImage']['tmp_name']) !== false &&
            $_FILES['userImage']['size'] < 100000 &&
            ($imageFileType == "jpg" || $imageFileType == "png")
        ) {
            echo "Image";
            $imageFileType = strtolower(pathinfo(basename($_FILES['userImage']["name"]), PATHINFO_EXTENSION));
            $imagedata = file_get_contents($_FILES['userImage']['tmp_name']);
            $sql2 = "INSERT INTO images (file_type, userID, file) VALUES(?, ?, ?)";
            $stmt = mysqli_stmt_init($connection);
            mysqli_stmt_prepare($stmt, $sql2);
            $null = null;
            mysqli_stmt_bind_param($stmt, "isb", $imageFileType, $username, $null);
            mysqli_stmt_send_long_data($stmt, 2, $imagedata);
            $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
            mysqli_stmt_close($stmt);
            echo '<script>alert("Image uploaded 👍");</script>';

        }
        header("Location: login.php");
        exit;

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
        <p>
            <?php echo $error; ?>
        </p>
    <?php } ?>
</body>

</html>