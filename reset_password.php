<?php
session_start();
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
    <?php include "include/top_left.php"?>

    <div id="right">
        <h2>Reset Password</h2>
        <div id="reset">
            <form method="post" action="reset_password.php">
                <fieldset>
                    <label for="recoverUser">Username:</label>
                    <input type="text" id="recoverUser" placeholder="Enter username" required>
                    <br>
                    <br>
                    <input type="submit" value="Reset Password" />
                </fieldset>
            </form>
        </div>
        <a href="#"><img src="ads/long/Orinthego.png" alt="Orinthego Ad"></a>
    <?php
        if(isset($_GET['recoverUser'])){
            //connect

            $passwordParts = ["a","b","c","d","e","f","g","h","i","j","k","l",
            "m","n","o","p","q","r","s","t","u","v","w","x","y","z",
            "!","@","#","$","%","^","&","*","(",")"];

            $newPassword = strtoupper($passwordParts[rand(0,26)]) . strtoupper($passwordParts[rand(0,26)])
             . $passwordParts[rand(0,26)] . $passwordParts[rand(0,26)] . $passwordParts[rand(0,26)]
             . $passwordParts[rand(0,26)] . rand(0,10) . rand(0,10) . $passwordParts[rand(26,36)];
            //auto decide new password using $passwordParts, format: AAaaaa11!

            $recoverUser = $_GET['recoverUser'];
            $sql1 = "SELECT email FROM Users WHERE username = " . $recoverUser;
            $sql2 = "UPDATE Users SET password = " . $newPassword . "WHERE username = " . $recoverUser;
            
            // run sql statements
            // send email of new password


            //disconnect
        }
    ?>
    </div>
        <?php include "include/footer.php"?>
</body>

</html>