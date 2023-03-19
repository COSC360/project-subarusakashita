<?php
session_start();
include 'main.html';
// include database info

$articleTitle = "";
if (isset($_GET['searchKeyword'])) {
    $articleTitle = "%" . $_GET['searchKeyword'] . "%";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Main Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <header><a href="main.html">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.html">Main Page</a></p>
    </div>
    <div id=top>
        <a href="login.html">Log in</a>
        <fieldset>
            <input type="type" id="search" placeholder="Search Users and Articles">
            <input type="submit" value="Search">
        </fieldset>
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
        <a href="#"><img src="ads/short/Orinthego.png" alt="Orinthego Ad"></a>
        <a href="#"><img src="ads/short/SummerCourse.png" alt="Orinthego Ad"></a>
    </div>
    <div id="right">
        <h2>Search Result</h2>
        <?php

        // connection info
        
        $sql = "SELECT articleId, articleTitle, articleLink FROM articles WHERE articleTitle LIKE '" . $articleTitle . "'";

        while ($art = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)) {
            $articleTitle = str_replace('\'', '%27', $art['articleTitle']);
            echo ("<a href='$localhost/articles/article_" . $art['articleId'] . ".html>" . $articleTitle . "</a><br>");
        }

        // close connection
        ?>

    </div>
    <footer>
        <p>Footer Copyright info and etc</p>
    </footer>
</body>

</html>