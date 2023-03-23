<?php
session_start();
// if not logged in
// pop-up to encourage log in
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
    <?php include "include/top_left.php"?>
    
    <div id="right">
        <h2>Trending Tags</h2>
        <div id="tag">
            <?php
            // connect
            $sql1 = "SELECT tagId, tagName FROM Tags ORDER BY articleNumber LIMIT 10";

            //run sql
            while ($row = sqlsrv_fetch_array($sql1, SQLSRV_FETCH_ASSOC)) {
                echo ("<a href=\"tag.php?tagId=" . $row['tagId'] . "&tagName=" . $row['tagName'] . "\">" . $row['tagName'] . "</a>");
            }
            ?>

            <!-- <a href="tags/midterm.html" id="content">Midterm</a>
            <a href="tags/co-op.html" id="content">Co-op</a>
            <a href="tags/cosc360.html" id="content">COSC 360</a>
            <a href="tags/campus_food.html" id="content">Campus Food</a>
            <a href="tags/bark.html" id="content">BARK</a>
            <a href="tags/orinthego.html" id="content">ORINTHEGO</a> -->
        </div>
        <a href="#"><img src="ads/long/UniChannel.png" alt="Orinthego Ad"></a>
        <h2>Trending Articles</h2>
        <div id="article">
            <ul>
                <?php
                $sql2 = "SELECT articleId, articleTitle FROM Articles ORDER BY views LIMIT 6";
                //run sql
                while ($row = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC)) {
                    echo ("<li><a href=\"article.php?articleId=" . $row['articleId'] . "&articleTitle=" . $row['articleTitle'] . ">" . $row['articleTitle'] . "</a></li>");
                }

                // disconnect
                ?>

                <!-- <li><a href="articles/article_001.html">Study Tips for the Procrastinators</a></li>
                <li><a href="articles/article_002.html">Personal Reviews of Orinthego Store</a></li>
                <li><a href="articles/article_003.html">5 Ways to Meet BARK Dogs</a></li>
                <li><a href="articles/article_004.html">11 Best Study Places on Campus</a></li>
                <li><a href="articles/article_005.html">Top 3 Napping Locations on Campus</a></li>
                <li><a href="articles/article_006.html">Subway Reopens at Arts & Science!!!</a></li>
                <li><a href="articles/article_007.html">Overpriced Campus Food: Are they worth it?</a></li>
                <li><a href="articles/article_008.html">The Journey of My Avocado Plants</a></li> -->
            </ul>
        </div>
    </div>
    <?php include "include/footer.php"?>

</body>

</html>