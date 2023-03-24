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

$articleTitle = null;
if (isset($_GET['articleTitle'])) {
    $articleTitle = $_GET['articleTitle'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Article Page</title>
    <link rel="stylesheet" href="css/default.css">
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.php">Main Page</a> > 
        <a href='article.php <?php echo "?articleId=" . $articleId . "&articleTitle=" . $articleTitle; ?>' >
        <?php echo $articleTitle; ?>
    </a></p>
    </div>
    <?php include "include/top_left.php" ?>
    <div id="right">
        <?php
        if (isset($_GET['articleId'])) {
            $articleId = $_GET['articleId'];

            //connect
        
            // article 
            //$sql1 = "SELECT articleTitle, username, categoryId, tagId, articleBody, commentId FROM Articles WHERE articleId = ?";
            $sql1 = "SELECT articleId, articleTitle, articleBody FROM Articles WHERE articleId =  '$articleId'";
            $result1 = mysqli_query($conn, $sql1);
            $row = mysqli_fetch_assoc($result1);
            echo "<h2>". $row["articleTitle"] . "</h2>";
            echo "<p>" . $row["articleBody"] . "</p>";
            //follow button
            // $sql2 = "SELECT following FROM Users WHERE username = ?";
            // $result2 = mysqli_query($conn, $sql2, array());
            // $sql3 = "INSERT INTO Users (following) VALUES (?) WHERE username = ?";

            //comments
            // $sql4 = "SELECT username, commentBody FROM Comments WHERE articleId = ?";
            // $result4 = mysqli_query($conn, $sql4, array());


            //related articles
           // $sql5 = "SELECT articleId, articleTitle, views FROM Articles WHERE categoryId = ? ORDER BY views LIMIT 3";
          //  $result5 = mysqli_query($conn, $sql5, array());

           // $categoryId = "";
           // $authorId = "";

            // while ($row = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC, array($articleId))) {
            //     echo ("<h2>" . $row['articleTitle'] . "</h2><br>");
            //     echo ("<h3>" . $row['username'] . "</h3><br>");
            //     echo ("<h3>" . $row['categoryId'] . "</h3><br>");
            //     echo ("<h3>" . $row['tagId'] . "</h3>");

            include "include/ad_long.php";

            //     echo ("<h3>" . $row['articleBody'] . "</h3>");

            //     $categoryId = $row['categoryId'];
            //     $authorId = $row['username'];
            // }
            // while ($row = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC, array($_SESSION['username']))) {
            //     if (in_array($authorId, $row['following'])) {
            //         echo ("<Following this user>");
            //     } else {
                   

            //         //echo ("<button type=button onclick='followUser()'>Follow</button>");
            //     }
            // }

            // while ($row = sqlsrv_fetch_array($result4, SQLSRV_FETCH_ASSOC, array($articleId))) {
            //     echo ("<h3>" . $row['username'] . "</h3><br>");
            //     echo ("<h3>" . $row['commentBody'] . "</h3><br>");
            // }

            // while ($row = sqlsrv_fetch_array($result5, SQLSRV_FETCH_ASSOC, array($categoryId))) {
            //     echo ('<h3><a href="article.php?articleId=' . $row["articleId"] . '&articleTitle=' . $row["articleTitle"] . '">' . $row["articleTitle"] . '</a></h3><br>');
            // }

            //disconnect
        }
        ?>
    </div>
    <?php include "include/footer.php"; ?> 
</body>

</html>