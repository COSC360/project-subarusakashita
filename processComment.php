<?php
    $servername = "cosc360.ok.ubc.ca";
    $server_username = "83395822";
    $server_password = "83395822";
    $dbname = "db_83395822";

// Create connection
    $conn = new mysqli($servername, $server_username, $server_password, $dbname);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    session_start();
    $username = $_SESSION['username'];
    $articleId = $_POST['articleId'];
    $comment = $_POST['comment'];
   // echo $comment;
   // echo $articleId;
   // echo $username;
    $sql = "INSERT INTO Comments(username, articleId, commentBody) VALUES('$username','$articleId','$comment')";
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Comment Uploaded")</script>';
        header("Location: main.php");
        exit;
    }
    else{
        $error = "Comment Upload failed";
    }
    mysqli_close($conn);
?>