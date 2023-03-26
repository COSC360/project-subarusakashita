<?php
session_start();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$articleId = "";
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
        ?>

        <div id="comment">
            <form method="post" action="write_comment.php?articleId=<?php echo $articleId; ?>">
            <label for="commentBody">Post comment on article</label>
                <textarea id="commentBody" name="commentBody" rows="5" cols="100" 
                placeholder="Write Comment here" required></textarea>
                <br>
                <br>
                <input type="submit" value="Comment">
            </form>
            <?php
            if (isset($_POST['commentBody'])) {
                // leave out commentId because it is auto increment
            
                $commentBody = $_POST['commentBody'];
                $commentingUser = "";
                if (isset($_SESSION['username'])) {
                    $commentingUser = $_SESSION['username'];
                }

                $sql2 = "INSERT INTO Comments (username, articleId, commentBody) VALUES ($commentingUser, $articleId, $commentBody)";
                if (mysqli_query($conn, $sql2)) {
                    echo '<script>alert("Comment posted!");</script>';
                }
            }

            mysqli_close($conn);
            ?>


        </div>
        <?php include "include/ad_long.php"; ?>
    </div>
    <?php include "include/footer.php" ?>

</body>

</html>