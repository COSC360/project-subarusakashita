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

$searchKeyword = "%";
if (isset($_GET['searchKeyword'])) {
    $searchKeyword = "%" . $_GET['searchKeyword'] . "%";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Search Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p>
            <a href="main.php">Main Page</a> >
            <a href="search.php?searchKeyword= <?php echo ($searchKeyword) ?>">Search Page</a>
        </p>
    </div>
    <?php include "include/top_left.php" ?>

    <div id="right">
        <h2>Search Result</h2>
        <?php

        // connection info
        include "include/ad_long.php";

        $sql1 = "SELECT * FROM Articles WHERE articleTitle LIKE 'searchKeyword'";
        $result1 = mysqli_query($conn, $sql1);

        if (mysqli_num_rows($result1) > 0) {
            while ($row = mysqli_fetch_assoc($result1)) {
                // $articleTitle = str_replace('\'', '%27', $art['articleTitle']);
                // $articleTitle = str_replace(' ', '%20', $art['articleTitle']);
                echo ("<a href='article.php?articleId=" . $row['articleId'] . "'>" . $articleTitle . "</a>");
            }
        } else {
            echo ("No results found");
        }

        // close connection
        ?>

    </div>
    <?php include "include/footer.php" ?>
</body>

</html>