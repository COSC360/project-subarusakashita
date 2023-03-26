<?php
session_start();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$articleId = 0;
if (isset($_GET['articleId'])) {
    $articleId = $_GET['articleId'];
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Main Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/short.css">
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p>
            <a href="main.php">Main Page</a> >
            <a href="article.php?articleId=<?php echo $articleId; ?>">Article Page</a> >
            <a href="write_comment.php?articleId=<?php echo $articleId; ?>">Commenting</a>
        </p>
    </div>
    <?php include "include/top_left.php" ?>
    <div id="right">
        <?php
        $sql1 = "SELECT articleTitle FROM Articles WHERE articleId = '$articleId'";
        $result1 = mysqli_query($conn, $sql1);
        if (mysqli_num_rows($result1) > 0) {
            while ($row = mysqli_fetch_assoc($result1)) {
                echo ("<h2>Commenting on Article: " . $row['articleTitle'] . "</h2>");
            }
        }

        if (isset($_POST['commentBody'])) {
            $commentBody = $_POST['commentBody'];
            $commentingUser = '';
            if (isset($_SESSION['username'])) {
                $commentingUser = $_SESSION['username'];
            }
            echo ($articleId . "<br>" . $commentBody . "<br>" . $commentingUser);
            $articleId = intval($articleId);
            echo ("<br><br>" . gettype($articleId) . "<br>" . gettype($commentBody) . "<br>" . gettype($commentingUser));
            
            // leave out commentId because it is auto increment
            // $sql2 = "INSERT INTO Comments (username, articleId, commentBody) VALUES ($commentingUser, $articleId, $commentBody)";
            $sql2 = "INSERT INTO Comments (username, articleId, commentBody) VALUES (?, ?, ?)";
            // if (mysqli_query($conn, $sql2)) {
            //     echo '<script>alert("Comment posted!");</script>';
            // }
            // else{
            //     echo '<script>alert("Error");</script>';
            // }
            while ($row = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC, array($commentingUser, $articleId, $commentBody))) {
                // run sql?
            }
        } 
        ?>

        

        <div id="comment">
            <form method="post" action="write_comment.php?articleId=<?php echo $articleId; ?>">
                <!-- <textarea id="commentBody" name="commentBody" rows="5" cols="100" placeholder="Write Comment here"
                    required></textarea> -->
                <input type="text" id="commentBody" name="commentBody" placeholder="Write comment here" required>
                <br>
                <br>
                <input type="submit" value="Comment">
            </form>
            <?php


            mysqli_close($conn);
            ?>


        </div>
        <?php include "include/ad_long.php"; ?>
    </div>
    <?php include "include/footer.php" ?>

</body>

</html>