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
// if (isset($_POST['emailNew'])) {
//     $email = $_POST['emailNew'];
// }

// if (isset($_POST['addressNew'])) {
//     $address = $_POST['addressNew'];
// }
// if (isset($_POST['postalCodeNew'])) {
//     $postalCode = $_POST['postalCodeNew'];
// }
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Profile Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.php">Main Page</a> > <a
                href="profile.php?username= <?php echo ($_SESSION['username']) ?> ">Profile Page</a></p>
    </div>
    <?php include "include/top_left.php" ?>

    <div id="right">
        <h2>My Info</h2>

        <?php
        $session_username = $_SESSION['username'];

        $sql = "SELECT * FROM users WHERE username = '$session_username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo ("<h3>Username: " . $row['username'] . "</h3><br>");
                //username is unchangeable
        
                echo ("<form action=\"profile.php?username=" . $_SESSION['username'] . "\" method=\"post\">");
                //form open, submitted change will change the variables at very top of page
        
                echo ("<label for=\"emailNew\">Email</label><br>");
                echo ("<input type=\"email\" id=\"emailNew\" name=\"emailNew\" placeholder=\"" . $row['email'] . "\"><br><br>");
                //current email in placeholder, email will update when typed into the input
        
                echo ("<label for=\"phoneNumNew\">Phone number</label><br>");
                echo ("<input type=\"tel\" id=\"phoneNumNew\" name=\"phoneNumNew\" placeholder=\"" . $row['phoneNum'] . "\"><br><br>");

                echo ("<label for=\"addressNew\">Address</label><br>");
                echo ("<input type=\"text\" id=\"addressNew\" name=\"addressNew\" placeholder=\"" . $row['address'] . "\"><br><br>");

                echo ("<label for=\"postalCodeNew\">Postal Code</label><br>");
                echo ("<input type=\"text\" id=\"postalCodeNew\" name=\"postalCodeNew\" placeholder=\"" . $row['postalCode'] . "\"><br><br>");

                echo ("</form>");
                //close form
        
                if ($row['isAdmin'] == true) {
                    echo ("<a href=\"adminControl.php\">Admin Control Page</a>");
                }

                // log out button
                echo ("<a href=\"logout.php\">Log Out</a>");
            }
        } else {
            echo "No rows";
        }
        ?>

        <?php include "include/ad_long.php"; ?>
        <h2>My Articles</h2>

        <?php
        $session_username = $_SESSION['username'];
        $sql2 = "SELECT articleId, articleTitle FROM Articles WHERE username = '$session_username'";
        
        $result2 = mysqli_query($conn, $sql2);

        if (mysqli_num_rows($result2) > 0) {
            while ($row = mysqli_fetch_assoc($result2)) {
                echo ("<h3><a href='article.php?articleId=" . $row['articleId'] . "'>" . $row['articleTitle'] . "</a></h3><br>");
            }
        } else {
            echo "No rows";
        }
        // while ($row = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC, array($username))) {
        //     echo ("<a href='$localhost/article.php?articleId=" . $row['articleId'] . ">" . $row['articleTitle'] . "</a><br>");
        // }

        mysqli_close($conn);
        ?>

    </div>
    </div>
    <?php include "include/footer.php" ?>

</body>

</html>