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
                        // $sql = "SELECT categoryId, categoryName FROM Categories";
                        // run sql
                        // while ($row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)) {
                        //     echo ('<option value="' . $row['categoryId'] . '">' . $row['categoryName'] . '</option>');
                        // }
                        // ?>
                    <option value="Academic">Academic</option>
                    <option value="Lifestyle">Lifestyle</option>
                    <option value="Relationship">Relationship</option>
                    <option value="Extracurricular">Extracurricular</option>
                    <option value="Hobby">Hobby</option>
                    <option value="Other">Other</option>
                    </select>
                    <br>
                    <br>

                    <label for="newArticleTag">Choose Tag</label>
                    <select name="newArticleTag" id="newArticleTag">
                        <?php
                       // $sql = "SELECT tagId, tagName FROM Tags";
                        // run sql
                       // while ($row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)) {
                       //     echo ('<option value="' . $row['tagId'] . '">' . $row['tagName'] . '</option>');
                       // }
                       if ($_POST['category'] == 'Academic') {
                        echo '<option value="professor">Professor</option>';
                        echo '<option value="course">Course</option>';
                    } elseif ($_POST['category'] == 'Relationship') {
                        echo '<option value="Finding Romance">Finding Romance</option>';
                        echo '<option value="Finding classmates">Finding classmates</option>';
                        echo '<option value="Finding group member">Finding group member</option>';
                    } elseif ($_POST['category'] == 'Hobby') {
                        echo '<option value="Gaming">Gaming</option>';
                        echo '<option value="Plants">Plants</option>';
                        echo '<option value="Travel">Travel</option>';
                    }
                    elseif ($_POST['category'] == 'Lifestyle') {
                    echo '<option value="Gaming">Gaming</option>';
                    echo '<option value="Plants">Plants</option>';
                    echo '<option value="Travel">Travel</option>';
                    }
                    elseif ($_POST['category'] == 'Other') {
                        echo '<option value="Gaming">Gaming</option>';
                        echo '<option value="Plants">Plants</option>';
                        echo '<option value="Travel">Travel</option>';
                        }
                        ?>
                    </select>
                    <br>
                    <br>

                    <?php include "include/ad_long.php"; ?>
                    
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