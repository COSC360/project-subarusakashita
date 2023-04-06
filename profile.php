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

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Profile Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/main.css">
    <script>
        div#left {
            height: 130em;;
        }
        div#right {
            height: 130em;;
        }
        div#right img{
            height: 5em;;
        }
    </script>
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.php">Main Page</a> > <a
                href="profile.php?username= <?php echo ($_SESSION['username']) ?> ">Profile Page</a></p>
    </div>

    <?php
    include "include/top_left.php";
    echo ('<a href="#"><img src="ads/short/' . rand(1, 3) . '.png" alt="Advertisement"></a>');
    echo ('<a href="#"><img src="ads/short/' . rand(1, 3) . '.png" alt="Advertisement"></a>');
    echo ('<a href="#"><img src="ads/short/' . rand(1, 3) . '.png" alt="Advertisement"></a>');
    echo ('</div>');
    ?>


    <div id="right">
        <h2>My Info</h2>

        <?php
        $session_username = $_SESSION['username'];
        echo ("<h3>Username: " . $session_username . "</h3>");

        // profile image
        $sql5 = "SELECT fileType, fileContent FROM Images WHERE username='$session_username'";
        $result5 = mysqli_query($conn, $sql5);
        $type = null;
        $image = null;

        if (mysqli_num_rows($result5) > 0) {
            while ($row = mysqli_fetch_assoc($result5)) {
                $type = $row['fileType'];
                $image = $row['fileContent'];
            }
        }

        $sql5 = "SELECT fileType, fileContent FROM Images WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql5);
        mysqli_stmt_bind_param($stmt, "s", $session_username);
        $result5 = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
        mysqli_stmt_bind_result($stmt, $type, $image);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
        echo '<img src="data:image/' . $type . ';base64,' . base64_encode($image) . '"/>';

        echo '<script>alert("' . $type . $image . $session_username . '");</script>';


        echo ('
                <form method="post" action="processImage.php" enctype="multipart/form-data">
                <label for="userImage">Insert Profile Image: </label><br>
                <input type="file" name="userImage" id="userImage" required>
                <input type="submit" value="Submit Image">
                </form><br><br>');


        // user info before edit
        $sql1 = "SELECT * FROM users WHERE username = '$session_username'";
        $result1 = mysqli_query($conn, $sql1);

        $email = "";
        $phoneNum = "";
        $address = "";
        $postalCode = "";
        $password = "";
        $isDisabled = "";

        if (mysqli_num_rows($result1) > 0) {
            while ($row = mysqli_fetch_assoc($result1)) {
                $email = $row['email'];
                $phoneNum = $row['phoneNum'];
                $address = $row['address'];
                $postalCode = $row['postalCode'];
                $password = $row['passwords'];
                $isDisabled = $row['isDisabled'];
            }
        }


        if (
            !empty($_POST['emailNew']) || !empty($_POST['phoneNumNew']) || !empty($_POST['addressNew'])
            || !empty($_POST['postalCodeNew']) || !empty($_POST['passwordNew'])
        ) {

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

            try {
                $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $server_username, $server_password);
                $sql2 = "UPDATE users SET email=?, phoneNum=?, address=?, postalCode=?, passwords=? WHERE username=?";
                $statement = $pdo->prepare($sql2);
                $statement->bindValue(1, $email);
                $statement->bindValue(2, $phoneNum);
                $statement->bindValue(3, $address);
                $statement->bindValue(4, $postalCode);
                $statement->bindValue(5, md5($password));
                $statement->bindValue(6, $session_username);
                $statement->execute();
                echo '<script>alert("Personal information updated successfully");</script>';
            } catch (Exception $e) {
                echo '<script>alert("Error updating personal info");</script>';
            }
        }

        // Show updated info in placeholder
        // Form to let users change info
        $sql3 = "SELECT * FROM users WHERE username = '$session_username'";
        $result3 = mysqli_query($conn, $sql3);
        if (mysqli_num_rows($result3) > 0) {
            while ($row = mysqli_fetch_assoc($result3)) {
                echo ("Personal Information<br>");

                echo ("<form action='profile.php?username=" . $_SESSION['username'] . "' method='post'>");
                //form open, submitted change will change the variables above
        
                echo ("<label for='emailNew'>Email</label><br>");
                echo ("<input type='email' id='emailNew' name='emailNew' placeholder='" . $row['email'] . "'><br><br>");
                //current email in placeholder, email will update when typed into the input
        
                echo ("<label for='passwordNew'>Password</label><br>");
                echo ("<input type='password' id='passwordNew' name='passwordNew' placeholder='●●●●●●●'><br><br>");

                echo ("<label for='phoneNumNew'>Phone number</label><br>");
                echo ("<input type='tel' id='phoneNumNew' name='phoneNumNew' placeholder='" . $row['phoneNum'] . "'><br><br>");

                echo ("<label for='addressNew'>Address</label><br>");
                echo ("<input type='text' id='addressNew' name='addressNew' placeholder='" . $row['address'] . "'><br><br>");

                echo ("<label for='postalCodeNew'>Postal Code</label><br>");
                echo ("<input type='text' id='postalCodeNew' name='postalCodeNew' placeholder='" . $row['postalCode'] . "'><br><br>");

                echo ("<input type='submit' value='Save edits'>");
                echo ("</form><br><br>");
                //close form
        
                if ($row['isAdmin'] === '1') {
                    echo ("<a href='admin_control.php'>Admin Control Page</a><br>");
                }

                // log out button
                echo ("<a href='logout.php'>Log Out</a>");
            }
        } else {
            echo "User not found";
        }
        ?>

        <?php include "include/ad_long.php"; ?>
        <h2>My Articles </h2>

        <?php
        if (!$isDisabled) {
            echo "<a href='write_article.php'>Write New Article</a>";
        }

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