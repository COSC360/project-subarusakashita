<?php
session_start();
$servername = "cosc360.ok.ubc.ca";
$username = "83395822";
$password = "83395822";
$dbname = "db_83395822";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$articleId = "";
if (isset($_POST['articleId'])) {
    $articleId = $_POST['articleId'];
}

$commentingUser = "";
if (isset($_SESSION['username'])){
    $commentingUser = $_SESSION['username'];
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Main Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/short.css">
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p>
            <a href="main.php">Main Page</a> >
            <a href="article.php?articleId= <?php $articleId ?> ">Article Page</a> >
            <a href="write_comment.php">Commenting</a>
        </p>
    </div>
    <?php include "include/top_left.php" ?>
    <div id="right">
        <?php
        $sql1 = "SELECT articleTitle FROM Articles WHERE articleId = '$articleId'";
        $result1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($result1) > 0) {
            while ($row = mysqli_fetch_assoc($result1)) {
                echo ("<h2>Commenting on \"" . $row['articleTitle'] . "\"</h2>");
            }
        }
        ?>

        <div id="comment">
            <form method="post" action="write_comment.php">
                <fieldset>
                    <textarea id="commentBody" name="commentBody" rows="5" placeholder="Write Comment for Article here"
                        required></textarea>
                    <br>
                    <br>
                    <input type="submit" value="Comment">
                </fieldset>
            </form>
            <?php
            if (isset($_POST['commentBody'])) {
                // leave out commentId because it is auto increment

                $commentBody = $_POST['commentBody'];
                $sql2 = "INSERT INTO Comments (username, articleId, commentBody, uploadTime) VALUES ($commentingUser, $articleId, $commentBody, 'date-time')";
                if (mysqli_query($conn, $sql2)) {
                    echo '<script>alert("Comment posted!");</script>';
                }
            }

            mysqli_close($conn);
            ?>


        </div>
        <?php include "include/ad_long.php"; ?>
    </div>
    <?php include "include/footer.php" ?>

</body>

</html>