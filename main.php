<?php
session_start();
if (!isset($_SESSION['username'])) {
    // if not logged in
    // pop-up to encourage log in
    echo '<script>alert("Please login! If you do not have an account, Make it!!");</script>';
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
    <style>
        div#right {
            overflow: hidden;
        }

        div#tag {
            overflow-x: scroll;
            overflow-y: hidden;
            height: 8em;
        }

        div#tag a {
            font-size: 2em;
            text-decoration: none;
            border: 0.2em solid blue;
            border-radius: 1em;
            padding: 0.5em;
            margin: 10em 1em 0em 0em;
            background-color: blue;
            color: gold;
        }
    </style>
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
            $sql1 = "SELECT * FROM Tags ORDER BY articleNumber DESC LIMIT 10";
            $result1 = mysqli_query($conn, $sql1);

            if (mysqli_num_rows($result1) > 0) {
                while ($row = mysqli_fetch_assoc($result1)) {
                    echo ("<a href='tag.php?tagId=" . $row['tagId'] . "'>" . $row['tagName'] . "</a>&nbsp&nbsp");
                }
            } else {
                echo "no rows";
            }
            ?>
        </div>
        <?php include "include/ad_long.php"; ?>

        <h2>Trending Articles</h2>
        <div id="article">
            <ol>
                <?php
                $sql2 = "SELECT articleId, articleTitle FROM Articles ORDER BY views DESC LIMIT 8";
                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                    while ($row = mysqli_fetch_assoc($result2)) {
                        echo ("<li><a href='article.php?articleId=" . $row['articleId'] . "&articleTitle=" . $row['articleTitle'] . "'>" . $row['articleTitle'] . "</a></li>");
                    }
                }
                ?>
            </ol>
        </div>
    </div>
    <!-- <?php include "include/footer.php" ?> -->
    <footer>
        <p>Footer Copyright info and etc</p>
    </footer>
</body>

</html>