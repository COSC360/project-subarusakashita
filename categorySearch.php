<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Category Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/article.css">
</head>

<body>
    <header><a href="main.html">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.html">Main Page</a> > <a href="academic.html">Academic Category</a></p>
    </div>
    <div id=top>
        <a href="login.html">Log in</a>
        <form>
            <fieldset>
                <input type="type" id="search" placeholder="Search Users and Articles">
                <input type="submit" value="Search" />
            </fieldset>
        </form>
    </div>
    <div id="left">
        <h2>Categories</h2>
        <ul>
            <li><a href="category/academic.html">Academic</a></li>
            <li><a href="category/lifestyle.html">Lifestyle</a></li>
            <li><a href="category/relationship.html">Relationship</a></li>
            <li><a href="category/extracurricular.html">Extracurricular</a></li>
            <li><a href="category/hobby.html">Hobby</a></li>
            <li><a href="category/random_chat.html">Random Chatting Platform</a></li>
        </ul>
        <?php
        echo ("<a href=\"#\"><img src=\"ads/short/" . rand(1, 4) . ".png\" alt=\"Advertisement\"></a>");
        echo ("<a href=\"#\"><img src=\"ads/short/" . rand(1, 4) . ".png\" alt=\"Advertisement\"></a>");
        ?>
    </div>
    <div id="right">
        <?php
        if (isset($_GET['categoryId'])) {
            $categoryId = $_GET['categoryId'];

            //connect
            $sql = "SELECT articleId, articleTitle, views FROM Articles WHERE categoryId =  ? ORDER BY views LIMIT 6";
            $sql2 = "SELECT categoryName FROM Categories WHERE categoryId = ?";
            //run sql
        
            while ($row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC, array($categoryId))) {
                //run sql2
                while ($sql2 = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC, array($categoryId))) {
                    echo ("<h2>Category: " . $sql2['$categoryName'] . "</h2><br>");
                }
                echo ("<a href=\"#\"><img src=\"ads/long/" . rand(1,4) . ".png\" alt=\"Advertisement\"></a>");
                echo ("<a href=\"$localhost/article.php?articleId=" . $row['articleId'] . "\">" . $row['articleTitle'] . "</a><br>");
            }

            //disconnect
        }
        ?>

        <!-- <h2>Category: Academic</h2>
        <a href="#"><img src="ads/long/SummerCourse.png" alt="Orinthego Ad"></a>
        <h3>Article Title</h3><br>
        <h3>Article Title</h3><br>
        <h3>Article Title</h3><br>
        <h3>Article Title</h3><br>
        <h3>Article Title</h3><br>
        <h3>Article Title</h3><br>
        <h3>Article Title</h3><br>
        <h3>Article Title</h3><br> -->
    </div>
    <footer>
        <p>Footer Copyright info and etc</p>
    </footer>
</body>

</html>