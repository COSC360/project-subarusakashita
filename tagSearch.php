<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Article Page</title>
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/article.css">
</head>

<body>
    <header><a href="main.html">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.html">Main Page</a> > <a href="bark.html">BARK Tag</a></p>
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
        if (isset($_GET['tagId'])) {
            $tagId = $_GET['tagId'];

            //connect
            $sql = "SELECT articleId, articleTitle, views FROM Articles WHERE tagId =  ? ORDER BY views LIMIT 6";
            $sql2 = "SELECT tagName FROM Tags WHERE tagId = ?";
            //run sql
        
            while ($row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC, array($tagId))) {
                //run sql2
                while ($sql2 = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC, array($tagId))) {
                    echo ("<h2>Tag: " . $sql2['$tagName'] . "</h2><br>");
                }
                echo ("<a href=\"#\"><img src=\"ads/long/" . rand(1, 4) . ".png\" alt=\"Advertisement\"></a>");
                echo ("<a href=\"$localhost/article.php?articleId=" . $row['articleId'] . "\">" . $row['articleTitle'] . "</a><br>");
            }

            //disconnect
        }
        ?>

        <!-- <h2>Tag: BARK</h2>
        <a href="#"><img src="../ads/long/Orinthego.png" alt="Orinthego Ad"></a>
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