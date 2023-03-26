<?php
// record count every time page loads (to display top viewed articles in main page)
session_start();
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

$user = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Article Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/article.css">
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.php">Main Page</a> > <a href='article.php?articleId= <?php $articleId ?>'>Article Page</a></p>
    </div>
    <?php include "include/top_left.php" ?>
    <div id="right">
        <?php
        if (isset($_GET['articleId'])) {
            $categoryId = "";
            $authorId = "";

            // Article 
            $sql1 = "SELECT * FROM Articles WHERE articleId =  '$articleId'";
            $result1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($result1) > 0) {
                while ($row = mysqli_fetch_assoc($result1)) {
                    echo "<h2>" . $row["articleTitle"] . "</h2>";
                    echo "<h3>Author: " . $row['username'] . "</h3>";
                    include "include/ad_long.php";
                    echo "<p>" . $row["articleBody"] . "</p>";
                    $categoryId = $row['categoryId'];
                    $authorId = $row['username'];
                }
            }

            // //follow button
            // $sql2 = "SELECT following FROM Users WHERE username = ?";
            // $result2 = mysqli_query($conn, $sql2, array());
            // $sql3 = "INSERT INTO Users (following) VALUES (?) WHERE username = ?";

            // //comments
            // $sql4 = "SELECT username, commentBody FROM Comments WHERE articleId = ?";
            // $result4 = mysqli_query($conn, $sql4, array());

            //related articles
            $sql5 = "SELECT * FROM Articles WHERE categoryId = '$categoryId' ORDER BY views LIMIT 3";
            $result5 = mysqli_query($conn, $sql5);
            echo ("<br><h2>Related Articles</h2>");
            if (mysqli_num_rows($result5) > 0) {
                while ($row = mysqli_fetch_assoc($result5)) {
                    echo ('<h3><a href="article.php?articleId=' . $row["articleId"] . '">' . $row["articleTitle"] . '</a></h3>');
                }
            }

        } else {
            echo "Article not found";
        }
        mysqli_close($conn);
        ?>
    </div>
    <?php include "include/footer.php"; ?>

    <?php
    include "showComment.php";
    include "write_comment.php";
    ?>
</body>

</html>