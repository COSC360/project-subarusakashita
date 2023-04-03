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

$sql1 = "SELECT * FROM users WHERE $username='$username'";
$result1 = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result1) > 0) {
    while ($row = mysqli_fetch_assoc($result1)) {
        echo ($row['isDisabled']);
    }
}

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $server_username, $server_password);
    $sql = "INSERT INTO Comments(username, articleId, commentBody) VALUES(?,?,?)";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(1, $username);
    $statement->bindValue(2, $articleId);
    $statement->bindValue(3, $comment);
    $statement->execute();
    echo '<script>alert("Comment Posted");</script>';
} catch (Exception $e) {
    echo '<script>alert("Error posting comment");</script>';
}
mysqli_close($conn);

echo "Back to <a href='article.php?articleId=" . $articleId . "'>Article</a>";
?>