<?php
// include 
// database info
$user = $_SESSION['user'];
if (isset($_GET['userId'])) {
    $userId = "%" . $_GET['userId'] . "%";
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
        <h2>My Info</h2>
        <?php

        // connect to server

        $sql = "SELECT * FROM Users WHERE userId = ?";
        //connect sql

        while ($row = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)) {
            echo ("<h2>User ID: " . $userId . "</h2><br><h2>Username: " . $row['username'] . "</h2>");
            echo ("<h3>Email: " . $row['email'] . "</h3><br>
            <h3>" . "Phone Number: " . $row['phoneNum'] . "</h3><br>
            <h3>" . "Address: " . $row['address'] . "</h3><br>
            <h3>" . "City: " . $row['city'] . "</h3><br>
            <h3>" . "State: " . $row['state'] . "</h3><br>
            <h3>" . "Postal Code: " . $row['postalCode'] . "</h3><br>
            <h3>" . "Country: " . $row['country'] . "</h3>");
        }
        ?>

        <a href="#"><img src="ads/long/UniChannel.png" alt="Orinthego Ad"></a>
        <h2>My Articles</h2>

        <?php
        $sql2 = "SELECT articleId, articleTitle FROM Articles WHERE userId = ?";
        //connect

        while ($row = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC)) {
            echo ("<a href='$localhost/articles/article_" . $row['articleId'] . ".html>" . $row['articleTitle'] . "</a><br>");
        }

        // close connection
        ?>

    </div>
    </div>
    <footer>
        <p>Footer Copyright info and etc</p>
    </footer>
</body>

</html>