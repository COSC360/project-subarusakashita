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
        <p><a href="main.php">Main Page</a> > <a href='category.php <?php echo ("?categoryId=" . $categoryId . "&categoryName=" . $categoryName . "'>" . $categoryName); ?></a></p>
    </div>
    <?php include "include/top_left.php" ?>
    <div id="right">
        <?php
        if (isset($_GET['categoryId'])) {
            $categoryId = $_GET['categoryId'];

            //connect
            $sql = "SELECT articleTitle FROM Articles WHERE categoryId =  '$categoryId'";
            //$sql2 = "SELECT categoryName FROM Categories WHERE categoryId = ?";
            //run sql
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<h2>" . $row["articleTitle"] . "</h2>";
                    //echo "<p>" . $row["body"] . "</p>";
                }
            } else {
                echo "0 results";
            }
            
            // while ($sql2 = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC, array($categoryId))) {
            //     echo ("<h2>Category: " . $sql2['$categoryName'] . "</h2><br>");
            // }
            include "include/ad_long.php";

            // while ($row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC, array($categoryId))) {
            //     echo ("<a href=\"article.php?articleId=" . $row['articleId'] . "\">" . $row['articleTitle'] . "</a><br>");
            // }

            //disconnect
            mysqli_close($conn);
        }
        ?>

    </div>
    <?php include "include/footer.php" ?>

</body>

</html>