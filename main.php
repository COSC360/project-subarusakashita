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
            <form method="get" action="search.php">
                <input type="search" id="searchKeyword" name="searchkeyword" placeholder="Search Users and Articles">
                <input type="submit" value="Search">
            </form>
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
        <h2>Trending Tags</h2>
        <div id="tag">
            <?php
            // connect
            $sql1 = "SELECT tagId, tagName FROM Tags ORDER BY articleNumber LIMIT 10";

            //run sql
            while ($row = sqlsrv_fetch_array($sql1, SQLSRV_FETCH_ASSOC)) {
                echo ("<a href=\"$localhost/tags/tag_" . $row['tagId'] . ".html>" . $sql1['tagName'] . "</a>");
            }
            ?>

            <!-- <a href="tags/midterm.html" id="content">Midterm</a>
            <a href="tags/co-op.html" id="content">Co-op</a>
            <a href="tags/cosc360.html" id="content">COSC 360</a>
            <a href="tags/campus_food.html" id="content">Campus Food</a>
            <a href="tags/bark.html" id="content">BARK</a>
            <a href="tags/orinthego.html" id="content">ORINTHEGO</a> -->
        </div>
        <a href="#"><img src="ads/long/UniChannel.png" alt="Orinthego Ad"></a>
        <h2>Trending Articles</h2>
        <div id="article">
            <ul>
                <?php
                $sql2 = "SELECT articleId, articleTitle FROM Articles ORDER BY views LIMIT 6";
                //run sql
                while ($row = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC)) {
                    echo ("<li><a href=\"$localhost/articles/article_" . $row['articleId'] . ".html>" . $sql2['articleTitle'] . "</a></li>");
                }

                // disconnect
                ?>

                <!-- <li><a href="articles/article_001.html">Study Tips for the Procrastinators</a></li>
                <li><a href="articles/article_002.html">Personal Reviews of Orinthego Store</a></li>
                <li><a href="articles/article_003.html">5 Ways to Meet BARK Dogs</a></li>
                <li><a href="articles/article_004.html">11 Best Study Places on Campus</a></li>
                <li><a href="articles/article_005.html">Top 3 Napping Locations on Campus</a></li>
                <li><a href="articles/article_006.html">Subway Reopens at Arts & Science!!!</a></li>
                <li><a href="articles/article_007.html">Overpriced Campus Food: Are they worth it?</a></li>
                <li><a href="articles/article_008.html">The Journey of My Avocado Plants</a></li> -->
            </ul>
        </div>
    </div>
    <footer>
        <p>Footer Copyright info and etc</p>
    </footer>
</body>

</html>