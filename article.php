<?php
// record count every time page loads (to display top viewed articles in main page)
$servername = "cosc360.ok.ubc.ca";
$server_username = "83395822";
$server_password = "83395822";
$dbname = "db_83395822";

$conn = mysqli_connect($servername, $server_username, $server_password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
$articleId = null;
if (isset($_GET['articleId'])) {
    $articleId = $_GET['articleId'];
}

$articleTitle = null;
if (isset($_GET['articleTitle'])) {
    $articleTitle = $_GET['articleTitle'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Article Page</title>
    <link rel="stylesheet" href="css/default.css">
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.php">Main Page</a> > <a href='article.php <?php echo ("?articleId=" . $articleId . "&articleTitle=" . $articleTitle . "'>" . $articleTitle); ?></a></p>
    </div>
    <?php include "include/top_left.php" ?>
    <div id="right">
        <?php
        if (isset($_GET['articleId'])) {
            $articleId = $_GET['articleId'];

            //connect
            $sql = "SELECT articleTitle, username, categoryId, tagId, articleBody, commentId FROM Articles WHERE articleId = ?";
            $sql2 = "SELECT username, commentBody FROM Comments WHERE articleId = ?";
            $sql3 = "SELECT articleId, articleTitle, views FROM Articles WHERE categoryId = ? ORDER BY views LIMIT 3";
            //run sql
        
            $categoryId = "";

            while ($row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC, array($articleId))) {
                echo ("<h2>" . $row['articleTitle'] . "</h2><br>");
                echo ("<h3>" . $row['username'] . "</h3><br>");
                echo ("<h3>" . $row['categoryId'] . "</h3><br>");
                echo ("<h3>" . $row['tagId'] . "</h3>");

                echo ("<a href=#><img src=\"ads/long/UniChannel.png\" alt=\"UniChannel Ad\"></a>");

                echo ("<h3>" . $row['articleBody'] . "</h3>");

                $categoryId = $row['categoryId'];
            }
            while ($row = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC, array($articleId))) {
                echo ("<h3>" . $row['username'] . "</h3><br>");
                echo ("<h3>" . $row['commentBody'] . "</h3><br>");
            }

            while ($row = sqlsrv_fetch_array($sql3, SQLSRV_FETCH_ASSOC, array($categoryId))) {
                echo ('<h3><a href="article.php?articleId=' . $row["articleId"] . '&articleTitle=' . $row["articleTitle"] . '">' . $row["articleTitle"] . '</a></h3><br>');
            }

            //disconnect
        }
        ?>
    </div>
    <?php include "include/footer.php" ?>

</body>

</html>