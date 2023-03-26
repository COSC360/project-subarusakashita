<?php

session_start();

$servername = "cosc360.ok.ubc.ca";
$server_username = "83395822";
$server_password = "83395822";
$dbname = "db_83395822";

$conn = mysqli_connect($servername, $server_username, $server_password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$categoryId = null;
if (isset($_GET['categoryId'])) {
    $categoryId = $_GET['categoryId'];
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
        <p><a href="main.php">Main Page</a> > <a href='category.php?categoryId= <?php $categoryId?> '>Category Page</a></p>
    </div>
    <?php include "include/top_left.php" ?>
    <div id="right">
        <?php
        if (isset($_GET['categoryId'])) {
            $categoryId = $_GET['categoryId'];

            $sql1 = "SELECT categoryName FROM Categories WHERE categoryId = '$categoryId'";
            $result1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($result1) > 0) {
                while ($row = mysqli_fetch_assoc($result1)) {
                    echo ("<h2>Category: " . $row['categoryName'] . "</h2>");
                }
            }

            include "include/ad_long.php";

            $sql2 = "SELECT articleId, articleTitle FROM Articles WHERE categoryId =  '$categoryId'";
            $result2 = mysqli_query($conn, $sql2);
            if (mysqli_num_rows($result2) > 0) {
                while($row = mysqli_fetch_assoc($result2)) {
                    echo "<h3><a href='article.php?articleId=" . $row["articleId"] . "'>". $row["articleTitle"] . "</h3>";
                }
            } else {
                echo "Articles not found in this category yet";
            }
            
            mysqli_close($conn);
        }
        ?>

    </div>
    <?php include "include/footer.php" ?>

</body>

</html>