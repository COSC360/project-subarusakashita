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
include 'main.html';
// include database info

$searchKeyword = "";
if (isset($_GET['searchKeyword'])) {
    $searchKeyword = "%" . $_GET['searchKeyword'] . "%";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | <?php echo($searchKeyword);?> </title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.php">Main Page</a> > <a href="search.php?searchKeyword= <?php echo($searchKeyword)?> "></p>
    </div>
    <?php include "include/top_left.php"?>
    
    <div id="right">
        <h2>Search Result</h2>
        <?php

        // connection info
        
        $sql = "SELECT articleId, articleTitle, articleLink FROM articles WHERE articleTitle LIKE ?";

        while ($art = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC, array($searchKeyword))) {
            // $articleTitle = str_replace('\'', '%27', $art['articleTitle']);
            // $articleTitle = str_replace(' ', '%20', $art['articleTitle']);
            echo ("<a href='article.php?articleId=" . $art['articleId'] . "&articleTitle=" . $articleTitle . "'>" . $articleTitle . "</a><br>");
        }

        // close connection
        ?>

    </div>
    <?php include "include/footer.php"?>
</body>

</html>