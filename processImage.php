<?php
session_start();

$servername = "cosc360.ok.ubc.ca";
$server_username = "83395822";
$server_password = "83395822";
$dbname = "db_83395822";
$conn = new mysqli($servername, $server_username, $server_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// check login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
$username = $_SESSION['username'];

$file = basename($_FILES['userImage']['name']);
$imageFileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
echo '<script>alert(' . $username . ');</script>';

if (
    getimagesize($_FILES['userImage']['tmp_name']) !== false &&
    $_FILES['userImage']['size'] < 100000 && ($imageFileType === "jpg" || $imageFileType === "png")
) {
    $sql1 = "SELECT * FROM Images WHERE username='$username'";
    $result1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result1) > 0) {
        // user already has image

        $sql2 = "UPDATE Images SET fileType=?, file=? WHERE username = '$username'";
        $imagedata = file_get_contents($_FILES['userImage']['tmp_name']);
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql2);
        $null = null;
        mysqli_stmt_bind_param(
            $stmt,
            "isb",
            $imageFileType,
            $null
        );
        mysqli_stmt_send_long_data($stmt, 2, $imagedata);
        $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
        mysqli_stmt_close($stmt);
    } else {
        // user does not have image yet

        // if (move_uploaded_file($_FILES['userImage']['tmp_name'], $file)) {
        //     echo '<script>alert("Upload successful");</script>';
        // } else {
        //     echo '<script>alert("Error during upload");</script>';
        // }

        $imagedata = file_get_contents($_FILES['userImage']['tmp_name']);
        $sql3 = "INSERT INTO Images (username, fileType, file) VALUES('$username', '$imageFileType', null)";
        $conn->query($sql3);
        // $stmt = mysqli_stmt_init($conn);
        // mysqli_stmt_prepare($stmt, $sql3);
        // $null = null;
        // mysqli_stmt_bind_param(
        //     $stmt,
        //     "isb",
        //     $username,
        //     $imageFileType,
        //     $null
        // );
        // mysqli_stmt_send_long_data($stmt, 2, $imagedata);
        // $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));

    }
    echo '<script>alert("Image uploaded 👍");</script>';
} else {
    echo '<script>alert("Image does not fit requirements");</script>';
}

mysqli_close($conn);

echo ("Go back to <a href='profile.php?username=" . $username . "'>Profile Page</a>");
?>