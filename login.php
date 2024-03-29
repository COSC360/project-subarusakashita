<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    header("Location: profile.php?username='$username'");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>UniChannel | Login Page</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <header><a href="main.php">UniChannel Blog</a></header>
    <div id=trail>
        <p><a href="main.php">Main Page</a> > <a href="login.php">Login Page</a></p>
    </div>

    <?php
    include "include/top_left.php";
    echo ('<a href="#"><img src="ads/short/' . rand(1, 3) . '.png" alt="Advertisement"></a>');
    echo ('<a href="#"><img src="ads/short/' . rand(1, 3) . '.png" alt="Advertisement"></a>');
    echo ('<a href="#"><img src="ads/short/' . rand(1, 3) . '.png" alt="Advertisement"></a>');
    echo ('</div>');
    ?>

    <div id="right">

        <h2>Log in</h2>

        <div id="login">

            <form id="loginform" action="signin.php" method="post">
                <fieldset>
                    <label for="username">Username:</label>
                    <br>
                    <input type="text" id="username" name="username" placeholder="Enter username" class="required">
                    <br>
                    <br>
                    <label for="password">Password: </label>
                    <br>
                    <input type="password" id="password" name="password" placeholder="Enter password" class="required">
                    <br>
                    <br>
                    <input type="submit" value="Log in" />
                    <p id="error-message"></p>
                </fieldset>
            </form>

            <script src="js/login.js"></script>
            <a href="reset_password.php" id="forgot">Forgot Password</a>
        </div>


        <?php include "include/ad_long.php"; ?>


        <h2>Sign up</h2>

        <div id="signup">

            <form id="registerform" action="register.php" method="post">
                <fieldset>
                    <label for="rUsername">Username:</label>
                    <br>
                    <input type="text" id="rUsername" name="rUsername" placeholder="Enter username">
                    <br>
                    <br>
                    <label for="rEmail">Email:</label>
                    <br>
                    <input type="email" id="rEmail" name='rEmail' placeholder="Enter email">
                    <br>
                    <br>
                    <label for="rPassword">Password: </label>
                    <br>
                    <input type="password" id="rPassword" name="rPassword" placeholder="Enter password">
                    <br>
                    <br>
                    <label for="password_conf">Re-enter Password: </label>
                    <br>
                    <input type="password" id="password_conf" name="password_conf" placeholder="Re-enter password">
                    <br>
                    <br>
                    <input type="submit" value="Sign up" />
                    <input type="reset" value="Reset" />
                    <p id="error-message2"></p>
                </fieldset>
            </form>
            <script src="js/register.js"></script>
        </div>
    </div>
    <?php include "include/footer.php"; ?>
</body>

</html>