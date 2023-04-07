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
    <title>UniChannel | Reset Password Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/short.css">
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.php">Main Page</a> > <a href="login.php">Login Page</a> > <a href="reset_password.php">Reset
                Password Page</a></p>
    </div>
    
    <?php
    include "include/top_left.php";
    echo ('</div>');
    ?>


    <div id="right">
        <h2>Reset Password</h2>
        <div id="reset">
            <form method="post" action="reset_password.php">
                <fieldset>
                    <label for="recoverUser">Username:</label>
                    <input type="text" id="recoverUser" name="recoverUser" placeholder="Enter username" required>
                    <br>
                    <br>
                    <input type="submit" value="Reset Password" />
                </fieldset>
            </form>
        </div>
        <?php include "include/ad_long.php"; ?>
        <?php
        if (isset($_POST['recoverUser'])) {
            $recoverUser = $_POST['recoverUser'];

            $passwordParts = [
                "a",
                "b",
                "c",
                "d",
                "e",
                "f",
                "g",
                "h",
                "i",
                "j",
                "k",
                "l",
                "m",
                "n",
                "o",
                "p",
                "q",
                "r",
                "s",
                "t",
                "u",
                "v",
                "w",
                "x",
                "y",
                "z",
                "!",
                "@",
                "#",
                "$",
                "%",
                "^",
                "&",
                "*",
                "(",
                ")"
            ];

            $newPassword = strtoupper($passwordParts[rand(0, 26)]) . strtoupper($passwordParts[rand(0, 25)])
                . $passwordParts[rand(0, 25)] . $passwordParts[rand(0, 25)] . $passwordParts[rand(0, 25)]
                . $passwordParts[rand(0, 25)] . rand(0, 9) . rand(0, 9) . $passwordParts[rand(26, 35)];
            //auto decide new password using $passwordParts, format: AAaaaa11!

            $sql1 = "UPDATE users SET passwords = '$newPassword' WHERE username = '$recoverUser'";
            if (mysqli_query($conn, $sql1)) {
                echo '<script>alert("New password is ' . $newPassword . ' (working on sending new password to email)");</script>';
                $sql = "SELECT email FROM users WHERE username= '$recoverUser'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $email = $row['email'];
                    mb_internal_encoding("UTF-8");
                    $to = $email;
                    $title = "New Password Notice";
                    $content = "The new password is ".$newPassword;
                    if(mb_send_mail($to, $title, $content)){
                        echo "Mail successfully sent";
                        //header ("Location: main.php");
                    } else {
                    echo "Sending failed";
                    };
                    // Use the email variable as needed
                } else {

                    // Handle the case where the query fails
                    echo "No email found in the database";
                }

                mysqli_close($conn);
            }


                    
                 exit;

            // send email of new password
                
            
            
            // $sql2 = "SELECT email FROM users WHERE username = '$recoverUser'";
        

            
        }
        ?>
    </div>
    <?php include "include/footer.php" ?>
</body>

</html>