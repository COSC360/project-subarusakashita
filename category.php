<?php

session_start();

$servername = "cosc360.ok.ubc.ca";
$username = "83395822";
$password = "83395822";
$dbname = "db_83395822";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$categoryId = null;
if (isset($_GET['categoryId'])) {
    $categoryId = $_GET['categoryId'];
}

$categoryName = null;
if (isset($_GET['categoryName'])) {
    $categoryName = $_GET['categoryName'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Category Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/article.css">
</head>

<body>
<header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.php">Main Page</a> > <a href='category.php <?php echo("?categoryId=" . $categoryId . "&categoryName=" . $categoryName . "'>" . $categoryName);?></a></p>
    </div>
    <?php include "include/top_left.php"?>
    <div id="right">
        <?php
        if (isset($_GET['categoryId'])) {
            $categoryId = $_GET['categoryId'];

            //connect
            $sql = "SELECT articleId, articleTitle, views FROM Articles WHERE categoryId =  ? ORDER BY views LIMIT 6";
            $sql2 = "SELECT categoryName FROM Categories WHERE categoryId = ?";
            //run sql
        
            while ($row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC, array($categoryId))) {
                //run sql2
                while ($sql2 = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC, array($categoryId))) {
                    echo ("<h2>Category: " . $sql2['$categoryName'] . "</h2><br>");
                }
                echo ("<a href=\"#\"><img src=\"ads/long/" . rand(1,4) . ".png\" alt=\"Advertisement\"></a>");
                echo ("<a href=\"article.php?articleId=" . $row['articleId'] . "\">" . $row['articleTitle'] . "</a><br>");
            }

            //disconnect
        }
        ?>

        <!-- <h2>Category: Academic</h2>
        <a href="#"><img src="ads/long/SummerCourse.png" alt="Orinthego Ad"></a>
        <h3>Article Title</h3><br>
        <h3>Article Title</h3><br>
        <h3>Article Title</h3><br>
        <h3>Article Title</h3><br>
        <h3>Article Title</h3><br>
        <h3>Article Title</h3><br>
        <h3>Article Title</h3><br>
        <h3>Article Title</h3><br> -->
    </div>
    <?php include "include/footer.php"?>

</body>

</html>