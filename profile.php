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

        // user info before edit
        $sql1 = "SELECT * FROM users WHERE username = '$session_username'";
        $result1 = mysqli_query($conn, $sql1);

        $email = "";
        $phoneNum = "";
        $address = "";
        $postalCode = "";
        $password = "";

        if (mysqli_num_rows($result1) > 0) {
            while ($row = mysqli_fetch_assoc($result1)) {
                $email = $row['email'];
                $phoneNum = $row['phoneNum'];
                $address = $row['address'];
                $postalCode = $row['postalCode'];
                $password = $row['passwords'];
            }
        }

        // update info from form
        if (!empty($_POST['emailNew'])) {
            $email = $_POST['emailNew'];
        }
        if (!empty($_POST['phoneNumNew'])) {
            $phoneNum = $_POST['phoneNumNew'];
        }
        if (!empty($_POST['addressNew'])) {
            $address = $_POST['addressNew'];
        }
        if (!empty($_POST['postalCodeNew'])) {
            $postalCode = $_POST['postalCodeNew'];
        }
        if (!empty($_POST['passwordNew'])) {
            $password = $_POST['passwordNew'];
        }
        $sql2 = "UPDATE users SET email='$email', phoneNum='$phoneNum', address='$address', 
        postalCode='$postalCode', passwords='$password' WHERE username='$session_username'";
        if (mysqli_query($conn, $sql2)) {
            echo '<script>alert("Personal information updated successfully");</script>';
        }

        // Show updated info in placeholder
        // Form to let users change info
        $sql3 = "SELECT * FROM users WHERE username = '$session_username'";
        $result3 = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result3) > 0) {
            while ($row = mysqli_fetch_assoc($result3)) {
                echo ("<h3>Username: " . $row['username'] . "</h3>");
                //username is unchangeable
        
                echo ("<form action=\"profile.php?username=" . $_SESSION['username'] . "\" method=\"post\">");
                //form open, submitted change will change the variables at very top of page
        
                echo ("<label for=\"emailNew\">Email</label><br>");
                echo ("<input type=\"email\" id=\"emailNew\" name=\"emailNew\" placeholder=\"" . $row['email'] . "\"><br><br>");
                //current email in placeholder, email will update when typed into the input
        
                echo ("<label for=\"passwordNew\">Password</label><br>");
                echo ("<input type=\"text\" id=\"passwordNew\" name=\"passwordNew\" placeholder=\"" . $row['passwords'] . "\"><br><br>");

                echo ("<label for=\"phoneNumNew\">Phone number</label><br>");
                echo ("<input type=\"tel\" id=\"phoneNumNew\" name=\"phoneNumNew\" placeholder=\"" . $row['phoneNum'] . "\"><br><br>");

                echo ("<label for=\"addressNew\">Address</label><br>");
                echo ("<input type=\"text\" id=\"addressNew\" name=\"addressNew\" placeholder=\"" . $row['address'] . "\"><br><br>");

                echo ("<label for=\"postalCodeNew\">Postal Code</label><br>");
                echo ("<input type=\"text\" id=\"postalCodeNew\" name=\"postalCodeNew\" placeholder=\"" . $row['postalCode'] . "\"><br><br>");

                echo ("<input type=\"submit\" value='Save edits'>");
                echo ("</form>");
                //close form
        
                if ($row['isAdmin'] == true) {
                    echo ("<br><br><a href=\"admin_control.php\">Admin Control Page</a><br>");
                }

                // log out button
                echo ("<a href=\"logout.php\">Log Out</a>");
            }
        } else {
            echo "User not found";
        }
        ?>

        <?php include "include/ad_long.php"; ?>
        <h2>My Articles <a href="write_article.php">[write new article]</a></h2>

        <?php
        $session_username = $_SESSION['username'];
        $sql4 = "SELECT articleId, articleTitle FROM Articles WHERE username = '$session_username'";
        $result4 = mysqli_query($conn, $sql4);

        if (mysqli_num_rows($result4) > 0) {
            while ($row = mysqli_fetch_assoc($result4)) {
                echo ("<h3><a href='article.php?articleId=" . $row['articleId'] . "'>" . $row['articleTitle'] . "</a></h3>");
            }
        } else {
            echo "No articles published yet";
        }

        mysqli_close($conn);
        ?>

    </div>
    </div>
    <?php include "include/footer.php" ?>

</body>

</html>