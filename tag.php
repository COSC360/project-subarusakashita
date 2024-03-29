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
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Tag Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/article.css">
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.php">Main Page</a> > <a href='tag.php?tagId= <?php $tagId ?>'>Tag Page</a></p>
    </div>
    
    <?php
    include "include/top_left.php";
    echo ('<a href="#"><img src="ads/short/' . rand(1, 3) . '.png" alt="Advertisement"></a>');
    echo ('</div>');
    ?>


    <div id="right">
        <?php
        if (isset($_GET['tagId'])) {
            $sql1 = "SELECT tagName FROM Tags WHERE tagId = '$tagId'";
            $result1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($result1) > 0) {
                while ($row = mysqli_fetch_assoc($result1)) {
                    echo ("<h2>Tag: " . $row['tagName'] . "</h2>");
                }
            }

            include "include/ad_long.php";

            $sql2 = "SELECT * FROM Articles WHERE tagId = '$tagId' ORDER BY commentNum DESC LIMIT 20";
            $result2 = mysqli_query($conn, $sql2);
            if (mysqli_num_rows($result2) > 0) {
                while ($row = mysqli_fetch_assoc($result2)) {
                    echo ("<h3><a href='article.php?articleId=" . $row['articleId'] . "'>" . $row['articleTitle'] . "</a></h3>");
                }
            }
            else{
                echo ("Articles not found in this tag yet");
            }

            //disconnect
        }
        ?>
    </div>
        <?php include "include/footer.php" ?>
</body>

</html>