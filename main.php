<?php
session_start();
if (!isset($_SESSION['username'])) {
    // if not logged in
    // pop-up to encourage log in
}

$servername = "cosc360.ok.ubc.ca";
$server_username = "83395822";
$server_password = "83395822";
$dbname = "db_83395822";

$conn = mysqli_connect($servername, $server_username, $server_password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Main Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.php">Main Page</a></p>
    </div>
    <?php include "include/top_left.php" ?>

    <div id="right">
        <h2>Trending Tags</h2>
        <div id="tag">
            <?php
            $sql1 = "SELECT tagId, tagName FROM Tags ORDER BY articleNumber LIMIT 10";
            $result1 = mysqli_query($conn, $sql1);

            while ($row = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC)) {
                echo ("<a href='tag.php?tagId=" . $row['tagId'] . "&tagName=" . $row['tagName'] . "'>" . $row['tagName'] . "</a>");
            }
            ?>
        </div>
        <?php include "include/ad_long.php"; ?>

        <h2>Trending Articles</h2>
        <div id="article">
            <ul>
                <?php
                $sql2 = "SELECT articleId, articleTitle FROM Articles ORDER BY views LIMIT 6";
                $result2 = mysqli_query($conn, $sql2 );
                while ($row = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC)) {
                    echo ("<li><a href='article.php?articleId=" . $row['articleId'] . "&articleTitle=" . $row['articleTitle'] . "'>" . $row['articleTitle'] . "</a></li>");
                }
                ?>
            </ul>
        </div>
    </div>
    <?php include "include/footer.php" ?>

</body>

</html>