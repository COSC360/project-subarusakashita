<?php
session_start();

$file = basename($_FILES['userImage']['name']);
$imageFileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));

if (
    getimagesize($_FILES['userImage']['tmp_name']) !== false &&
    $_FILES['userImage']['size'] < 100000 && ($imageFileType === "jpg" || $imageFileType === "png")
) {
    echo "Image";
    // $imagedata = file_get_contents($_FILES['userImage']['tmp_name']);
    // $sql2 = "INSERT INTO images (file_type, userID, file) VALUES(?, ?, ?)";
    // $stmt = mysqli_stmt_init($connection);
    // mysqli_stmt_prepare($stmt, $sql2);
    // $null = null;
    // mysqli_stmt_bind_param(
    //     $stmt,
    //     "isb",
    //     $imageFileType,
    //     $username,
    //     $null
    // );
    // mysqli_stmt_send_long_data($stmt, 2, $imagedata);
    // $result = mysqli_stmt_execute($stmt) or
    //     die(mysqli_stmt_error($stmt));
    // mysqli_stmt_close($stmt);
    echo '<script>alert("Image uploaded 👍");</script>';
} else {
    echo "Image does not fit requirements";
}

?>