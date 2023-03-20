<?php
// record count every time page loads (to display top viewed articles in main page)
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Login Page</title>
    <link rel="stylesheet" href="css/default.css">
</head>

<body>
    <header><a href="main.html">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.html">Main Page</a> > <a href="posts.html">Posts Page</a></p>
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
        <a href="#"><img src="ads/short/UniChannel.png" alt="UniChannel Ad"></a>
        <a href="#"><img src="ads/short/Orinthego.png" alt="Orinthego Ad"></a>
    </div>
    <div id="right">
        <?php
        if (isset($_GET['articleId'])) {
            $articleId = $_GET['articleId'];

            //connect
            $sql = "SELECT articleTitle, username, categoryId, tagId, articleBody, commentId FROM Articles WHERE articleId = " . $articleId;
            $sql2 = "SELECT username, commentBody FROM Comments WHERE articleId = " . $articleId;
            //run sql
        
            while ($row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)) {
                echo ("<h2>" . $row['articleTitle'] . "</h2><br>");
                echo ("<h3>" . $row['username'] . "</h3><br>");
                echo ("<h3>" . $row['categoryId'] . "</h3><br>");
                echo ("<h3>" . $row['tagId'] . "</h3>");

                echo ("<a href=#><img src=\"ads/long/UniChannel.png\" alt=\"UniChannel Ad\"></a>");

                echo ("<h3>" . $row['articleBody'] . "</h3>");

                while ($com = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC)) {
                    echo ("<h3>" . $com['username'] . "</h3><br>");
                    echo ("<h3>" . $com['commentBody'] . "</h3><br>");
                }
            }

            //disconnect
        }
        ?>
    </div>
    <footer>
        <p>Footer Copyright info and etc</p>
    </footer>
</body>

</html>