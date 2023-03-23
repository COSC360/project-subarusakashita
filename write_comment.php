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
if (isset($_GET['articleId'])) {
    $articleId = $_GET['articleId'];
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
    <header><a href="main.html">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.html">Main Page</a> > <a href="article_001.html">Study Tips for the Procrastinators</a> > <a
                href="comment.html">Commenting</a></p>
    </div>
    <?php include "include/top_left.php" ?>
    <div id="right">
        <?php
        $sql1 = "SELECT articleTitle FROM Articles WHERE articleId = ?";
        // run sql1
        while ($row = sqlsrv_fetch_array($sql1, SQLSRV_FETCH_ASSOC, array($articleId))) {
            echo ("<h2>" . $row['articleTitle'] . "</h2>");
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
                $sql2 = "INSERT INTO Comments (username, articleId, commentBody) VALUES (?, ?, ?)";
                // leave out commentId because it is auto increment
                // run sql2
                while ($row = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC, array($_SESSION['username'], $articleId, $_POST['commentBody']))) {
                    // run sql?
                }
            }
            ?>


        </div>
        <?php include "include/ad_long.php"; ?>
    </div>
    <?php include "include/footer.php" ?>

</body>

</html>