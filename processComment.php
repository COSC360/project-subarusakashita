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
$username = null;
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: login.php");
    exit;
}
$articleId = $_POST['articleId'];
$comment = $_POST['comment'];

$sql1 = "SELECT * FROM users WHERE username='$username'";
$result1 = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result1) > 0) {
    while ($row = mysqli_fetch_assoc($result1)) {
        if ($row['isDisabled'] === '1') {
            // if user account is disabled
            echo '<script>alert("Account is disabled");</script>';
            header("Location: main.php");
            exit;
        }
    }
}

$sql2 = "SELECT * FROM Articles WHERE articleId='$articleId'";
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        if ($row['isDisabled'] === '1') {
            // if article is disabled
            echo '<script>alert("Article is disabled");</script>';
            header("Location: main.php");
            exit;
        }
    }
}

// user account is not disabled & article is not disabled
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $server_username, $server_password);

    $sql3 = "INSERT INTO Comments(username, articleId, commentBody) VALUES(?,?,?)";
    $statement = $pdo->prepare($sql3);
    $statement->bindValue(1, $username);
    $statement->bindValue(2, $articleId);
    $statement->bindValue(3, $comment);
    $statement->execute();

    $sql4 = "UPDATE Articles SET commentNum = commentNum+1 WHERE articleId=?";
    $statement = $pdo->prepare($sql4);
    $statement->bindValue(1, $articleId);
    $statement->execute();

    echo '<script>alert("Comment Posted");</script>';



    $sql4 = "SELECT * FROM Comments WHERE articleId = '$articleId'";
    $result4 = mysqli_query($conn, $sql4);
    echo ("<br><h2>Comments</h2>");
    echo("<div id = 'showcomments'>");
    //echo ("<h3><a href='write_comment.php?articleId=" . $articleId . "'>[Post new comment]</a></h3>");
    if (mysqli_num_rows($result4) > 0) {
        while ($row = mysqli_fetch_assoc($result4)) {
            echo ('<h3>' . $row["username"] . ' - ' . $row["commentBody"] . '</h3>');
        }
    } else {
        echo "No comments yet";
    }
    echo("</div>");


} catch (Exception $e) {
    echo '<script>alert("Error posting comment");</script>';
}

mysqli_close($conn);

echo "Back to <a href='article.php?articleId=" . $articleId . "'>Article</a>";
?>