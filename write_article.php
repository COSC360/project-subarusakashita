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
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Main Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/short.css">
</head>

<body>
    <header><a href="main.html">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.html">Main Page</a></p>
    </div>
    <?php include "include/top_left.php" ?>
    <div id="right">
        <h2>Write new article</h2>
        <div id="article">
            <form method="post" action="write_article.php">
                <fieldset>
                    <label for="newArticleTitle">Article title</label>
                    <input type="text" id="newArticleTitle" name="newArticleTitle" placeholder="Write article title"
                        required>
                    <br>
                    <br>

                    <label for="newArticleCategory">Choose Category</label>
                    <select name="newArticleCategory" id="newArticleCategory">
                        <?php
                        $sql = "SELECT categoryId, categoryName FROM Categories";
                        // run sql
                        while ($row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)) {
                            echo ('<option value="' . $row['categoryId'] . '">' . $row['categoryName'] . '</option>');
                        }
                        ?>
                    </select>
                    <br>
                    <br>

                    <label for="newArticleTag">Choose Tag</label>
                    <select name="newArticleTag" id="newArticleTag">
                        <?php
                        $sql = "SELECT tagId, tagName FROM Tags";
                        // run sql
                        while ($row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)) {
                            echo ('<option value="' . $row['tagId'] . '">' . $row['tagName'] . '</option>');
                        }
                        ?>
                    </select>
                    <br>
                    <br>

                    <a href="#"><img src="ads/long/Orinthego.png" alt="Orinthego Ad"></a>
                    
                    <label for="newArticleBody">Article body</label>
                    <textarea id="newArticleBody" name="newArticleBody" rows="15" placeholder="Write article body here"
                        required></textarea>
                    <br>
                    <br>

                    <input type="submit" value="Post article">
                </fieldset>
            </form>

            <?php
            if (isset($_POST['newArticleTitle']) and isset($_POST['newArticleCategory']) and isset($_POST['newArticleTag']) and isset($_POST['newArticleBody'])) {
                $sql = "INSERT INTO Articles (articleTitle, username, categoryId, tagId, articleBody, views) VALUES (?, ?, ?, ?, ?, 0)";
                // leave out commentId because it is auto increment
                // run sql2
                while ($row = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC, array($_POST['newArticleTitle'], $_SESSION['username'], $_POST['newArticleCategory'], $_POST['newArticleTag'], $_POST['newArticleBody']))) {
                    // run sql?
                }
            }
            ?>


        </div>
    </div>
    <?php include "include/footer.php" ?>

</body>

</html>