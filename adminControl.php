<?php
// include 
// database info
$user = $_SESSION['user'];
if (isset($_GET['username'])) {
    $username = $_GET['username'];
}

if (isset($_POST['emailNew'])) {
    $email = $_POST['emailNew'];
}
if (isset($_POST['phoneNumNew'])) {
    $phoneNum = $_POST['phoneNumNew'];
}
if (isset($_POST['addressNew'])) {
    $address = $_POST['addressNew'];
}
if (isset($_POST['postalCodeNew'])) {
    $postalCode = $_POST['postalCodeNew'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Admin Control Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <header><a href="main.html">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.html">Admin Control Page</a></p>
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
        <?php
        // connect to server
        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        $sql1 = "SELECT * FROM Users";
        //connect sql
        
        echo ("<h3>Users</h3><br>");
        echo ("
            <table>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Postal Code</th>
                    <th>Admin</th>
                </tr>");

        while ($row = sqlsrv_fetch_array($sql1, SQLSRV_FETCH_ASSOC)) {
            echo ("
                <tr>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['phoneNum'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['postalCode'] . "</td>
                    <td>" . $row['isAdmin'] . "</td>
                </tr>
            ");
        }
        echo ("</table>");

        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $sql2 = "SELECT * FROM Articles";
        //connect sql
        
        echo ("<h3>Articles</h3><br>");
        echo ("
            <table>
                <tr>
                    <th>Article ID</th>
                    <th>Article Title</th>
                    <th>Author</th>
                    <th>Category ID</th>
                    <th>Views</th>
                </tr>");

        while ($row = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC)) {
            echo ("
                <tr>
                    <td>" . $row['articleId'] . "</td>
                    <td>" . $row['articleName'] . "</td>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['categoryId'] . "</td>
                    <td>" . $row['views'] . "</td>
                </tr>
            ");
        }
        echo ("</table>");

        /////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $sql1 = "SELECT * FROM Ads";
        //connect sql
        
        echo ("<h3>Ads</h3><br>");

        while ($row = sqlsrv_fetch_array($sql1, SQLSRV_FETCH_ASSOC)) {
            echo ("<img src=\"" . $row['adPath'] . "\" alt=\"Ads\">");
        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////////


        //close server connection
        ?>

        <a href="#"><img src="ads/long/UniChannel.png" alt="Orinthego Ad"></a>
        <h2>My Articles</h2>


    </div>
    </div>
    <footer>
        <p>Footer Copyright info and etc</p>
    </footer>
</body>

</html>