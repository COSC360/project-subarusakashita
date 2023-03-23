<?php
// database info?

session_start();
$username = null;
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
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
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.php">Main Page</a> > <a href="profile.php? <?php echo($username) ?>">Profile Page</a> > <a href="admin_control.php">Admin Control Page</a> </p>
    </div>
    <?php include "include/top_left.php"?>
    <div id="right">
        <?php
        // connect to server
        $servername = "cosc360.ok.ubc.ca";
        $server_username = "83395822";
        $server_password = "83395822";
        $dbname = "db_83395822";
        $conn = new mysqli($servername, $server_username, $server_password, $dbname);

        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
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
    <?php include "include/footer.php"?>

</body>

</html>