<?php
session_start();
$servername = "cosc360.ok.ubc.ca";
$server_username = "83395822";
$server_password = "83395822";
$dbname = "db_83395822";
$conn = new mysqli($servername, $server_username, $server_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$tagId = null;
if (isset($_GET['tagId'])) {
    $tagId = $_GET['tagId'];
}

$tagName = null;
if (isset($_GET['tagName'])) {
    $tagName = $_GET['tagName'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Article Page</title>
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/article.css">
</head>

<body>
<header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.php">Main Page</a> > <a href='tag.php <?php echo("?tagId=" . $tagId . "&tagName=" . $tagName . "'>" . $tagName);?></a></p>
    </div>
    <?php include "include/top_left.php"?>

    <div id="right">
        <?php
        if (isset($_GET['tagId'])) {
            $tagId = $_GET['tagId'];

            //connect
            $sql = "SELECT articleId, articleTitle, views FROM Articles WHERE tagId =  ? ORDER BY views LIMIT 6";
            $sql2 = "SELECT tagName FROM Tags WHERE tagId = ?";
            //run sql
        
            while ($row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC, array($tagId))) {
                //run sql2
                while ($sql2 = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC, array($tagId))) {
                    echo ("<h2>Tag: " . $sql2['$tagName'] . "</h2><br>");
                }
                echo ("<a href=\"#\"><img src=\"ads/long/" . rand(1, 4) . ".png\" alt=\"Advertisement\"></a>");
                echo ("<a href=\"article.php?articleId=" . $row['articleId'] . "\">" . $row['articleTitle'] . "</a><br>");
            }

            //disconnect
        }
        ?>

        <!-- <h2>Tag: BARK</h2>
        <a href="#"><img src="../ads/long/Orinthego.png" alt="Orinthego Ad"></a>
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